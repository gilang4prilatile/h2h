<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Requests\MasterData\TypeGoodsRequest;
use App\Models\MasterTypeGoods;
use App\Services\MasterData\TypeGoodsService;
use Illuminate\Http\Request;

class TypeGoodsController extends MasterDataController
{
    public MasterTypeGoods $typeGoodsEntity;
    public TypeGoodsService $typeGooodsService;

    public function __construct(
        TypeGoodsService $typeGooodsService,
        MasterTypeGoods $typeGoodsEntity
    ) {
        parent::__construct();

        $this->view .= "type-goods.";
        $this->typeGooodsService = $typeGooodsService;
        $this->typeGoodsEntity = $typeGoodsEntity;
    }

    public function getData(Request $request)
    {
        return $this->typeGooodsService->getData($request);
    }

    public function getIndex()
    {
        return $this->makeView("index",array('moduleNav'=>'typegoods'));
    }

    public function getCreate()
    {
        return $this->makeView("form", [
            "model" => $this->typeGoodsEntity,
            'moduleNav'=>'typegoods'
        ]);
    }

    public function postCreate(TypeGoodsRequest $request)
    {
        return $this->typeGooodsService->create($request);
    }

    public function getEdit($id)
    {
        $model = $this->typeGoodsEntity->findOrFail($id);

        return $this->makeView("form", [
            "model" => $model,
            'moduleNav'=>'typegoods'
        ]);
    }

    public function postEdit(TypeGoodsRequest $request, $id)
    {
        return $this->typeGooodsService->edit($request, $id);
    }

    public function getDelete($id)
    {
        return $this->typeGooodsService->delete($id);
    }
}
