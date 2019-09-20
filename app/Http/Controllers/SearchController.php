<?php


namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;


class SearchController extends BaseController
{
    public function getView()
    {
        return view('search');
    }

    public function search()
    {

    }
}