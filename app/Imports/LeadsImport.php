<?php

namespace App\Imports;

use App\Models\Lead;
use App\Models\Tag;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LeadsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
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

        $lead = new Lead([
            'name'     => $row['name'],
            'email'    => $row['email'],
            'phone'    => $phone,
            'origin'   => $row['origin'],
        ]);

        $lead->save(); // Save the lead to the database

        $lead->tags()->sync($tagIds); // Sync the tags if there are tags to sync

        return $lead;
    }

    function formatPhoneNumber($phoneNumber)
    {
        // Remove all non-numeric characters from the phone number
        $phoneNumber = preg_replace('/\D/', '', $phoneNumber);

        return $phoneNumber;
    }
}
