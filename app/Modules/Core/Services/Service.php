<?php

namespace App\Modules\Core\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

abstract class Service
{
    protected $model;
    protected $errors;
    protected $rules;

    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->errors = new MessageBag();
    }

    protected function validate($data)
    {
        $this->errors = new MessageBag();

        $validator = Validator::make($data, $this->rules);

        if ($validator->fails()) {
            $this->errors = $validator->errors();
        }
    }

    public function hasErrors()
    {
        return $this->errors->any();
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function all($perPage, Request $request)
    {
        return $this->model->all();
    }

    public function find($id, Request $request)
    {
        return $this->model->find($id);
    }

    public function create($data, Request $request)
    {
        $this->validate($data);
        if ($this->hasErrors()) {
            return null;
        }

        return $this->model->create($data);
    }

    public function update($id, $data, Request $request)
    {
        $this->validate($data);
        if ($this->hasErrors()) {
            return null;
        }

        return $this->model->find($id)->update($data);
    }
}
