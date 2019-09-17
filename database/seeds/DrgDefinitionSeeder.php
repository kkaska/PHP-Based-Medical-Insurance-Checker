<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class DrgDefinitionSeeder extends Seeder
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

                $drgDef = $jsonDecoded->dRGDefinition;
                $split = explode(' - ', $drgDef);   //separate id from name

                Log::info((int)$split[0]);

                $nonExistent = empty(DB::table('drgdefinition')->find($split[0]));
                if ($nonExistent && !empty($split[0])) {
                    DB::table('drgdefinition')->insert([
                        'Id' => $split[0],
                        'Name' => $split[1],
                        'Type' => null
                    ]);
                }

                unset($drgDef);
                unset($split);
                unset($line);
                unset($jsonDecoded);
                unset($nonExistent);
            }

            $counter += 1;
        }
    }
}
