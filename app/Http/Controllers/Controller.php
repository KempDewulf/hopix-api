<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    protected $service;

    public function __construct($service)
    {
        $this->service = $service;
    }

    public function all(Request $request)
    {
        $pages = $request->query('pages', 10);

        return $this->service->all($pages);
    }

    public function find($id)
    {
        return [
            "data" => $this->service->find($id)
        ];
    }

    public function create(Request $request)
    {
        $data = $request->all();

        $object = $this->service->create($data);

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

        $object = $this->service->update($id, $data);

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
