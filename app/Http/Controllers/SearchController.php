<?php


namespace App\Http\Controllers;

use App\Models\Treatment;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;


class SearchController extends BaseController
{
    public const PAGE_SIZE = 10;        //TODO: there is probably a better place for this

    public function getView()
    {
        return view('search');
    }

    public function search(Request $request)
    {
        session(['user-latitude' => $request->input('user-latitude')]);
        session(['user-longitude' => $request->input('user-longitude')]);
        $url = sprintf('search/list?city=%s&disease=%s',
            $request->input('city'),
            $request->input('disease')
        );

        return redirect($url);
    }

    public function list(Request $request)
    {
        $disease = $request->get('disease');
        $city = $request->get('city');
        $treatments = Treatment::search($disease, $city)
            ->paginate(self::PAGE_SIZE);
        $userLatitude = session()->has('user-latitude') ? session()->get('user-latitude') : -34.397;
        $userLongitude = session()->has('user-longitude') ? session()->get('user-longitude') : 150.644;

        return view('disease-list', [
            'treatments' => $treatments,
            'disease' => $disease,
            'city' => $city,
            'userLatitude' => $userLatitude,
            'userLongitude' => $userLongitude
        ]);
    }
}