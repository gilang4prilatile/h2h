<?php

namespace App\Services;

use App\Models\Inbound;
use Exception;
use Illuminate\Http\Request;

class InboundService {
    private Inbound $model;
    
    public function __construct(Inbound $model) {
        $this->model = $model;
    }

    public function getModel() {
        return $this->model;
    }

    public function getData(Request $request) {
        return $this->model->with("bcForm")->select("*");
    }

    public function delete($id) {
        return $this->model->destroy($id);
    }

    public function getDetail($id) {
        return $this->model->with('inboundDetails')->findOrFail($id);
    }
}