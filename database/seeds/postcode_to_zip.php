<?php

use App\Hospital;
use Illuminate\Database\Seeder;

class postcode_to_zip extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filedir = __DIR__ . '\US.txt';

        $file = new SplFileObject($filedir);
        while (!$file->eof())
        {
            $line = $file->fgets();
            $parts = preg_split("/[\t]/", $line);
            $entry = null;
            if (count($parts) >= 12) {
                $entries = Hospital::where('Zip', '=', (int) $parts[1])->get();
                foreach ($entries as $entry) {
                    if (!empty($entry)) {
                        $entry->Latitude = $parts[9];
                        $entry->Longitude = $parts[10];
                        $entry->save();
                    }
                }
            }
        }
    }
}
