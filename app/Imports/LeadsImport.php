<?php

namespace App\Imports;

use App\Models\Country;
use App\Models\Lead;
use App\Models\Tag;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

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
        $email = $row['email'];

        // Check if a lead with the same email already exists
        if (Lead::where('email', $email)->exists()) {
            $this->errorCount++;
            return null; // Skip the record
        }

        $phone = $this->formatPhoneNumber($row['phone']); // Format the phone number

        // Create or retrieve tags
        $tagNames = explode(',', $row['tag']);
        $tagIds = [];
        foreach ($tagNames as $tagName) {
            if (!empty($tagName)) {
                $tag = Tag::firstOrCreate(['name' => $tagName]);
                $tagIds[] = $tag->id;
            }
        }

        // Find the country by name or create a new one if it doesn't exist
        $country = Country::firstOrCreate(['name' => strtolower($row['origin'])]);

        $lead = new Lead([
            'name'     => $row['name'],
            'email'    => $row['email'],
            'phone'    => $phone,
            'origin'   => $country->id,
        ]);

        $lead->save(); // Save the lead to the database

        $lead->tags()->sync($tagIds); // Sync the tags if there are tags to sync

        $this->successCount++;

        return $lead;
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
