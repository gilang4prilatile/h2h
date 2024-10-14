<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Requests\MasterData\GoodCategoryRequest;
use App\Models\MasterGoodCategory;
use App\Services\MasterData\GoodCategoryService;
use Illuminate\Http\Request;

class GoodCategoryController extends MasterDataController
{
    public MasterGoodCategory $goodCategoryEntity;
    public GoodCategoryService $goodCategoryService;

    public function __construct(
        GoodCategoryService $goodCategoryService,
        MasterGoodCategory $goodCategoryEntity
    ) {
        parent::__construct();

        $this->view .= "good-category.";
        $this->goodCategoryService = $goodCategoryService;
        $this->goodCategoryEntity = $goodCategoryEntity;
    }

    public function getData(Request $request)
    {
        return $this->goodCategoryService->getData($request);
    }

    public function getIndex()
    {
        return $this->makeView("index",array('moduleNav'=>'goodcategory'));
    }

    public function getCreate()
    {
        return $this->makeView("form", [
            "model" => $this->goodCategoryEntity,
            'moduleNav'=>'goodcategory'
        ]);
    }

    public function postCreate(GoodCategoryRequest $request)
    {
        return $this->goodCategoryService->create($request);
    }

    public function getEdit($id)
    {
        $model = $this->goodCategoryEntity->findOrFail($id);

        return $this->makeView("form", [
            "model" => $model,
            'moduleNav'=>'goodcategory'
        ]);
    }

    public function postEdit(GoodCategoryRequest $request, $id)
    {
        return $this->goodCategoryService->edit($request, $id);
    }

    public function getDelete($id)
    {
        return $this->goodCategoryService->delete($id);
    }
}
