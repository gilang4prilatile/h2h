<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Requests\MasterData\ImportMethodRequest;
use App\Http\Requests\MasterData\TypeGoodsRequest;
use App\Models\MasterImportType;
use App\Services\MasterData\ImportMethodService;
use Illuminate\Http\Request;

class ImportMethodController extends MasterDataController
{
    public MasterImportType $importTypeEntity;
    public ImportMethodService $importMethodService;

    public function __construct(
        ImportMethodService $importMethodService,
        MasterImportType $importTypeEntity
    ) {
        parent::__construct();

        $this->view .= "import-method.";
        $this->importMethodService = $importMethodService;
        $this->importTypeEntity = $importTypeEntity;
    }

    public function getData(Request $request)
    {
        return $this->importMethodService->getData($request);
    }

    public function getIndex()
    {
        return $this->makeView("index",array('moduleNav'=>'importmethod'));
    }

    public function getCreate()
    {
        return $this->makeView("form", [
            "model" => $this->importTypeEntity,
            'moduleNav'=>'importmethod'
        ]);
    }

    public function postCreate(ImportMethodRequest $request)
    {
        return $this->importMethodService->create($request);
    }

    public function getEdit($id)
    {
        $model = $this->importTypeEntity->findOrFail($id);

        return $this->makeView("form", [
            "model" => $model,
            'moduleNav'=>'importmethod'
        ]);
    }

    public function postEdit(ImportMethodRequest $request, $id)
    {
        return $this->importMethodService->edit($request, $id);
    }

    public function getDelete($id)
    {
        return $this->importMethodService->delete($id);
    }
}
