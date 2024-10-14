<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Requests\MasterData\ExportCategoryRequest;
use App\Models\MasterExportCategory;
use App\Services\MasterData\ExportCategoryService;
use App\Services\MasterData\ImportMethodService;
use Illuminate\Http\Request;

class ExportCategoryController extends MasterDataController
{
    public MasterExportCategory $exportCategoryEntity;
    public ExportCategoryService $exportCategoryService;

    public function __construct(
        ExportCategoryService $exportCategoryService,
        MasterExportCategory $exportCategoryEntity
    ) {
        parent::__construct();

        $this->view .= "export-category.";
        $this->exportCategoryService = $exportCategoryService;
        $this->exportCategoryEntity = $exportCategoryEntity;
    }

    public function getData(Request $request)
    {
        return $this->exportCategoryService->getData($request);
    }

    public function getIndex()
    {
        return $this->makeView("index",array('moduleNav'=>'exportcategory'));
    }

    public function getCreate()
    {
        return $this->makeView("form", [
            "model" => $this->exportCategoryEntity,
            'moduleNav'=>'exportcategory'
        ]);
    }

    public function postCreate(ExportCategoryRequest $request)
    {
        return $this->exportCategoryService->create($request);
    }

    public function getEdit($id)
    {
        $model = $this->exportCategoryEntity->findOrFail($id);

        return $this->makeView("form", [
            "model" => $model,
            'moduleNav'=>'exportcategory'
        ]);
    }

    public function postEdit(ExportCategoryRequest $request, $id)
    {
        return $this->exportCategoryService->edit($request, $id);
    }

    public function getDelete($id)
    {
        return $this->exportCategoryService->delete($id);
    }
}
