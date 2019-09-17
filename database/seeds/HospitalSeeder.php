<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HospitalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filedir = __DIR__ . '\DRGChargesData.json';

        $file = new SplFileObject($filedir);

        $counter = 1;   //lines start at 1
        while (!$file->eof())
        {
            $line = $file->fgets();

            if ($counter % 2 == 0) {
                $jsonDecoded = json_decode($line);

                //TODO: Use a model for this, and then use the firstOrNew() function on the model.
                $nonExistent = empty(DB::table('hospital')->find($jsonDecoded->providerId));
                if ($nonExistent && !empty($jsonDecoded->providerId)) {
                    DB::table('Hospital')->insert([
                        'Id' => $jsonDecoded->providerId,
                        'Name' => $jsonDecoded->providerName,
                        'StreetAddress' => $jsonDecoded->providerStreetAddress,
                        'City' => $jsonDecoded->providerCity,
                        'State' => $jsonDecoded->providerState,
                        'Zip' => $jsonDecoded->providerZipCode
                    ]);
                }
            }

            $counter += 1;
        }
    }
}
