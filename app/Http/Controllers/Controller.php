<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function all(Request $request)
    {
        $perPage = $request->input('per_page', 10);

        return $this->service->all($perPage, $request);
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
