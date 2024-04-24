<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\App;

class Controller extends BaseController
{
    public function all(Request $request)
    {
        $pages = $request->input('pages', 10);

        return $this->service->all($pages, $request);
    }

    public function find(Request $request, $id)
    {
        return [
            "data" => $this->service->find($id, $request)
        ];
    }

    public function create(Request $request)
    {
        $data = $request->all();
        $object = $this->service->create($data, $request);

        if ($this->service->hasErrors()) {
            return [
                "errors" => $this->service->getErrors()
            ];
        }

        return [
            "data" => $object
        ];
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $object = $this->service->update($id, $data, $request);

        if ($this->service->hasErrors()) {
            return [
                "errors" => $this->service->getErrors()
            ];
        }

        return [
            "data" => $object
        ];
    }
}
