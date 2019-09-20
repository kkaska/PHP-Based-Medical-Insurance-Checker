<?php


namespace App\Http\Controllers;

use App\Hospital;

class HospitalController
{
    public function list()
    {
        $hospitals = Hospital::paginate(20);

        return view('hospitals-list', [
            'hospitals' => $hospitals
        ]);
    }
}