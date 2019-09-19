<?php


namespace App\Http\Controllers;

use App\Hospital;
use Illuminate\Routing\Controller as BaseController;


class SearchController extends BaseController
{
    public function search()
    {
        $hospitals = Hospital::paginate(20);

        return view('search', [
            'hospitals' => $hospitals
        ]);
    }
}