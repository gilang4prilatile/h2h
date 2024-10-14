<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\MasterData\MasterDataController;
use App\Http\Requests\MasterData\OriginGoodRequest;
use App\Models\MasterOriginOfGood;
use App\Services\MasterData\OriginGoodService;
use Illuminate\Http\Request;

class OriginGoodController extends MasterDataController
{

    public MasterOriginOfGood $originGoodEntity;
    public OriginGoodService $originGoodService;

    public function __construct(
        OriginGoodService $originGoodService,
        MasterOriginOfGood $originGoodEntity
    ) {
        parent::__construct();

        $this->view .= "origin-of-goods.";
        $this->originGoodService = $originGoodService;
        $this->originGoodEntity = $originGoodEntity;
    }

    public function getData(Request $request)
    {
        return $this->originGoodService->getData($request);
    }

    public function getIndex()
    {
        return $this->makeView("index",array('moduleNav'=>'origingoods'));
    }

    public function getCreate()
    {
        return $this->makeView("form", [
            "model" => $this->originGoodEntity,
            'moduleNav'=>'origingoods'
        ]);
    }

    public function postCreate(OriginGoodRequest $request)
    {
        return $this->originGoodService->create($request);
    }

    public function getEdit($id)
    {
        $model = $this->originGoodEntity->findOrFail($id);

        return $this->makeView("form", [
            "model" => $model,
            'moduleNav'=>'origingoods'
        ]);
    }

    public function postEdit(OriginGoodRequest $request, $id)
    {
        return $this->originGoodService->edit($request, $id);
    }

    public function getDelete($id)
    {
        return $this->originGoodService->delete($id);
    }

}