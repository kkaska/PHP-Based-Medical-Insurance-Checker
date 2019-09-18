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
        ini_set('memory_limit','2048M');

        $filedir = __DIR__ . '\DRGChargesData.json';

        $file = new SplFileObject($filedir);

        $counter = 1;   //lines start at 1
        while (!$file->eof()) {

            if (($counter - 1) % 10000 == 0) {
                Log::info('Reached' . $counter);
            }

            $line = $file->fgets();
            if ($counter % 2 == 0) {
                //Get some sort of progress report in laravel logs every 10000 lines


                $jsonDecoded = json_decode($line);

                $drgDef = $jsonDecoded->dRGDefinition;
                $split = explode(' - ', $drgDef);   //separate id from name

                $nonExistent = empty(DB::table('drgdefinition')->find($split[0]));
                if ($nonExistent && !empty($split[0])) {
                    DB::table('drgdefinition')->insert([
                        'Id' => $split[0],
                        'Name' => $split[1],
                        'Type' => null
                    ]);
                }
//
//                $drgDef = null;
//                $split = null;
//                $line = null;
//                $jsonDecoded = null;
//                $nonExistent = null;
//
//                unset($drgDef);
//                unset($split);
//                unset($line);
//                unset($jsonDecoded);
//                unset($nonExistent);
            }
            $counter += 1;
        }
    }
}
