<?php

namespace App\Imports;

use App\Models\Country;
use App\Models\Lead;
use App\Models\Tag;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Propaganistas\LaravelPhone\Casts\RawPhoneNumberCast;
use Propaganistas\LaravelPhone\Casts\E164PhoneNumberCast;
use Propaganistas\LaravelPhone\PhoneNumber;
use App\Helpers\Helper;

class LeadsImport implements ToModel, WithHeadingRow, WithChunkReading
{
    protected $successCount = 0;
    protected $errorCount = 0;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Remove the "n-"
        $emailsString = str_replace("n-", "", $row['email']);
        // Remove the "ph:" prefix
        $phoneNumbersString = str_replace("ph:", "", $row['phone']);

        $emails = explode(';', $emailsString);
        $phones = explode(';', $phoneNumbersString);

        // Align phones and emails by numeric order
        $alignedData = $this->alignData($phones, $emails);

        foreach ($alignedData as $data) {
            $email = $data['email'];

            // Check if a lead with the same email already exists
            if (empty($email) || Lead::where('email', $email)->exists()) {
                $this->errorCount++;
                continue; // Skip the record
            }

            $phone = $this->formatPhoneNumber($data['phone']); // Format the phone number

            // Create or retrieve tags
            $tagNames = explode(',', $row['tag']);
            $tagIds = [];
            foreach ($tagNames as $tagName) {
                if (!empty($tagName)) {
                    $tag = Tag::firstOrCreate(['name' => $tagName]);
                    $tagIds[] = $tag->id;
                }
            }

            // Determine country name based on 'origin' field or phone number
            $countryName = !empty($row['origin'])
                ? $this->getCountryNameByCode($row['origin'])
                : $this->getCountryNameByPhoneNumber($phone);

            if (empty($countryName)) {
                $this->errorCount++;
                continue; // Skip the record
            }

            // Find the country by name or create a new one if it doesn't exist
            $country = Country::firstOrCreate(['name' => strtolower($countryName)]);

            $lead = new Lead([
                'name'     => $row['name'],
                'email'    => $email,
                'phone'    => $phone,
                'origin'   => $country->id,
            ]);

            $lead->save(); // Save the lead to the database

            $lead->tags()->sync($tagIds); // Sync the tags if there are tags to sync

            $this->successCount++;
        }

        return null; // Skip the record in the original model
    }

    /**
     * Align phones and emails by numeric order
     *
     * @param array $phones
     * @param array $emails
     * @return array
     */
    private function alignData(array $phones, array $emails)
    {
        $maxCount = max(count($phones), count($emails));

        $alignedData = [];
        for ($i = 0; $i < $maxCount; $i++) {
            $phone = isset($phones[$i]) ? $phones[$i] : null;
            $email = isset($emails[$i]) ? $emails[$i] : null;
            $alignedData[] = ['phone' => $phone, 'email' => $email];
        }

        return $alignedData;
    }

    private function getCountryNameByCode($code)
    {
        if (empty($code)) {
            return null;
        }
        return Helper::countryCodeToName($code);
    }

    private function getCountryNameByPhoneNumber($phoneNumber)
    {
        if (empty($phoneNumber)) {
            return null;
        }
        $phone = new PhoneNumber($phoneNumber);
        $countryCode = $phone->getCountry();
        return $this->getCountryNameByCode($countryCode);
    }

    function formatPhoneNumber($phoneNumber)
    {
        // Remove all non-numeric characters from the phone number
        $phoneNumber = preg_replace('/\D/', '', $phoneNumber);

        return $phoneNumber;
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function getSuccessCount()
    {
        return $this->successCount;
    }

    public function getErrorCount()
    {
        return $this->errorCount;
    }
}
