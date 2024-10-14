<?php

namespace App\Http\Controllers\MasterData;

use App\Models\MasterKppbc;
use Illuminate\Http\Request;
use App\Services\MasterData\KppbcService;
use App\Http\Requests\MasterData\KppbcRequest;

class KppbcController extends MasterDataController
{
    public MasterKppbc $kppbcEntity;
    public KppbcService $kppbcService;

    public function __construct(
        KppbcService $kppbcService,
        MasterKppbc $kppbcEntity
    ) {
        parent::__construct();

        $this->view .= "kppbc.";
        $this->kppbcService = $kppbcService;
        $this->kppbcEntity = $kppbcEntity;
    }

    public function getData(Request $request)
    {
        return $this->kppbcService->getData($request);
    }

    public function getIndex()
    {
        return $this->makeView("index",array('moduleNav'=>'kppbc'));
    }

    public function getCreate()
    {
        return $this->makeView("form", [
            "model" => $this->kppbcEntity,
            'moduleNav'=>'kppbc'
        ]);
    }

    public function postCreate(KppbcRequest $request)
    {
        return $this->kppbcService->create($request);
    }

    public function getEdit($id)
    {
        $model = $this->kppbcEntity->findOrFail($id);

        return $this->makeView("form", [
            "model" => $model,
            'moduleNav'=>'kppbc'
        ]);
    }

    public function postEdit(KppbcRequest $request, $id)
    {
        return $this->kppbcService->edit($request, $id);
    }

    public function getDelete($id)
    {
        return $this->kppbcService->delete($id);
    }
}
