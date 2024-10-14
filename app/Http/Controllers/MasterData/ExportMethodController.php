<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\MasterData\MasterDataController;
use App\Http\Requests\MasterData\ExportMethodRequest;
use App\Models\MasterExportMethod;
use App\Models\MasterInstitutionalPermission;
use App\Services\MasterData\ExportMethodService;
use Illuminate\Http\Request;

class ExportMethodController extends MasterDataController
{

    public MasterExportMethod $exportMethod;
    public ExportMethodService $exportMethodService;

    public function __construct(
        ExportMethodService $exportMethodService,
        MasterExportMethod $exportMethod
    ) {
        parent::__construct();

        $this->view .= "export-method.";
        $this->exportMethodService = $exportMethodService;
        $this->exportMethod = $exportMethod;
    }

    public function getData(Request $request)
    {
        return $this->exportMethodService->getData($request);
    }

    public function getIndex()
    {
        return $this->makeView("index",array('moduleNav'=>'exportmethod'));
    }

    public function getCreate()
    {
        return $this->makeView("form", [
            "model" => $this->exportMethod,
            'moduleNav'=>'exportmethod'
        ]);
    }

    public function postCreate(ExportMethodRequest $request)
    {
        return $this->exportMethodService->create($request);
    }

    public function getEdit($id)
    {
        $model = $this->exportMethod->findOrFail($id);

        return $this->makeView("form", [
            "model" => $model,
            'moduleNav'=>'exportmethod'
        ]);
    }

    public function postEdit(ExportMethodRequest $request, $id)
    {
        return $this->exportMethodService->edit($request, $id);
    }

    public function getDelete($id)
    {
        return $this->exportMethodService->delete($id);
    }

}