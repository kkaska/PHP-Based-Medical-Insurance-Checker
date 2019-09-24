<?php


namespace App\Http\Controllers;

use App\Models\Treatment;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;


class SearchController extends BaseController
{
    public const PAGE_SIZE = 10;        //TODO: there is probably a better place for this

    public function getView()
    {
        return view('search');
    }

    public function list(Request $request)
    {
        $disease = $request->get('disease');
        $city = $request->get('city');
        $treatments = Treatment::search($disease, $city)
            ->paginate(self::PAGE_SIZE);

        return view('disease-list', [
            'treatments' => $treatments,
            'disease' => $disease,
            'city' => $city
        ]);
    }
}