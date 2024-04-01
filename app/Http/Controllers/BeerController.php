<?php

namespace App\Http\Controllers;

use App\Modules\Beers\Services\BeerService;
use Illuminate\Http\Request;

class BeerController extends Controller
{
    private $beerService;

    public function __construct(BeerService $beerService)
    {
        $this->beerService = $beerService;
    }

    public function all(Request $request)
    {
        $pages = $request->query('pages', 10);

        return $this->beerService->all($pages);
    }

    public function find($id)
    {
        return [
            "data" => $this->beerService->find($id)
        ];
    }

    public function create(Request $request)
    {
        $data = $request->all();

        $beer = $this->beerService->create($data);

        if ($this->beerService->hasErrors()) {
            return [
                "errors" => $this->beerService->getErrors()
            ];
        }

        return [
            "data" => $beer
        ];
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $beer = $this->beerService->update($id, $data);

        if ($this->beerService->hasErrors()) {
            return [
                "errors" => $this->beerService->getErrors()
            ];
        }

        return [
            "data" => $beer
        ];
    }
}
