<?php

namespace App\Http\Controllers\MasterData;

use App\Models\MasterValas;
use Illuminate\Http\Request;
use App\Services\MasterData\ValasService;
use App\Http\Requests\MasterData\ValasRequest;

class ValasController extends MasterDataController
{
    public MasterValas $valasEntity;
    public ValasService $valasService;

    public function __construct(
        ValasService $valasService,
        MasterValas $valasEntity
    ) {
        parent::__construct();

        $this->view .= "valas.";
        $this->valasService = $valasService;
        $this->valasEntity = $valasEntity;
    }

    public function getData(Request $request)
    {
        return $this->valasService->getData($request);
    }
    
    public function getDetail($id)
    {
        return $this->valasService->getDetailJSON($id);
    }

    public function getIndex()
    {
        return $this->makeView("index",array('moduleNav'=>'valas'));
    }

    public function getCreate()
    {
        return $this->makeView("form", [
            "model" => $this->valasEntity,
            'moduleNav'=>'valas'
        ]);
    }

    public function postCreate(ValasRequest $request)
    {
        return $this->valasService->create($request);
    }

    public function getEdit($id)
    {
        $model = $this->valasEntity->findOrFail($id);

        return $this->makeView("form", [
            "model" => $model,
            'moduleNav'=>'valas'
        ]);
    }

    public function postEdit(ValasRequest $request, $id)
    {
        return $this->valasService->edit($request, $id);
    }

    public function getDelete($id)
    {
        return $this->valasService->delete($id);
    }
}
