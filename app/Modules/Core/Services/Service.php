<?php

namespace App\Modules\Core\Services;

use Illuminate\Database\Eloquent\Model;
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

    public function all($pages)
    {
        return $this->model->paginate($pages)->withQueryString();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function create($data)
    {
        $this->validate($data);
        if ($this->hasErrors()) {
            return null;
        }

        return $this->model->create($data);
    }

    public function update($id, $data)
    {
        $this->validate($data);
        if ($this->hasErrors()) {
            return null;
        }

        return $this->model->find($id)->update($data);
    }
}
