<?php

namespace App\Modules\Core\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
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

    protected function setLocale(Request $request)
    {
        $locale = App::getLocale();
        $language = $request->input('lang', $locale);
        if ($language != $locale) {
            App::setLocale($language);
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

    public function all($pages, Request $request)
    {
        $this->setLocale($request);

        return $this->model->paginate($pages)->withQueryString();
    }

    public function find($id, Request $request)
    {
        $this->setLocale($request);

        return $this->model->find($id);
    }

    public function create($data, Request $request)
    {
        $this->setLocale($request);

        $this->validate($data);
        if ($this->hasErrors()) {
            return null;
        }

        return $this->model->create($data);
    }

    public function update($id, $data, Request $request)
    {
        $this->setLocale($request);

        $this->validate($data);
        if ($this->hasErrors()) {
            return null;
        }

        return $this->model->find($id)->update($data);
    }
}
