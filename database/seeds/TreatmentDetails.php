<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TreatmentDetails extends Seeder
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

        $counter = 1870001;   //lines start at 1
        $file->seek(1870001);
        while (!$file->eof()) {
            if (($counter - 1) % 10000 == 0) {
                Log::info('Reached' . $counter);
            }

            $line = $file->fgets();
            if ($counter % 2 == 0) {
                $jsonDecoded = json_decode($line);
                $drgDef = explode(' - ', $jsonDecoded->dRGDefinition);
                $drgId = (int)$drgDef[0];
                $hospitalId = $jsonDecoded->providerId;

                //TODO: Use a model for this, and then use the firstOrNew() function on the model.
                if (!empty($hospitalId) && !empty($drgId)) {

                    $record = DB::table('TreatmentDetails')
                        ->where('DrgId', '=', $drgId)
                        ->where('HospitalId', '=', $hospitalId)
                        ->where('Year', '=', $jsonDecoded->year)
                        ->get();

                    if ($record->isEmpty()) {
                        DB::table('TreatmentDetails')->insert([
                            'DrgId' => $drgId,
                            'HospitalId' => $hospitalId,
                            'AverageCoveredCharges' => $this->stripCharacters($jsonDecoded->averageCoveredCharges),
                            'AverageTotalPayments' => $this->stripCharacters($jsonDecoded->averageTotalPayments),
                            'AverageMedicarePayments' => $this->stripCharacters($jsonDecoded->averageMedicarePayments),
                            'Year' => $jsonDecoded->year,
                            'TotalDischarges' => $this->stripCharacters($jsonDecoded->totalDischarges)
                        ]);
                    }
                }
            }
            $counter += 1;
        }
    }

    /** @return string */
    private function stripCharacters($string)
    {
        $result = preg_replace("/,/", '', $string);
        $result = preg_replace("/\\$/", '', $result);
        return $result;
    }
}
