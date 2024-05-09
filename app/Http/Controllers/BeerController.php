<?php

namespace App\Http\Controllers;

use App\Models\Beer;
use App\Modules\Beers\Services\BeerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class BeerController extends Controller
{
    protected BeerService $service;

    public function __construct(BeerService $beerService)
    {
        $this->service = $beerService;
    }

    public function findByName(Request $request, $name)
    {
        return [
            "data" => $this->service->findByName($name, $request)
        ];
    }

    public function aromas(Request $request, $id)
    {
        return [
            "data" => $this->service->aromas($id, $request)
        ];
    }

    public function reviews(Request $request, $id)
    {
        return [
            "data" => $this->service->reviews($id, $request)
        ];
    }

    public function brewery(Request $request, $id)
    {
        return [
            "data" => $this->service->brewery($id, $request)
        ];
    }

    public function delete(Request $request, $id)
    {
        return [
            "data" => $this->service->delete($id, $request)
        ];
    }
}
