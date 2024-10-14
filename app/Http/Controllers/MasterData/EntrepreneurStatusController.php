<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\MasterData\MasterDataController;
use App\Http\Requests\MasterData\EntrepreneurStatusRequest;
use App\Models\MasterEntrepreneurStatus;
use App\Services\MasterData\EntrepreneurStatusService;
use Illuminate\Http\Request;

class EntrepreneurStatusController extends MasterDataController
{
    public MasterEntrepreneurStatus $entrepreneurStatusEntity;
    public EntrepreneurStatusService $entrepreneurStatusService;

    public function __construct(
        EntrepreneurStatusService $entrepreneurStatusService,
        MasterEntrepreneurStatus $entrepreneurStatusEntity
    ) {
        parent::__construct();

        $this->view .= "entrepreneur-status.";
        $this->entrepreneurStatusService = $entrepreneurStatusService;
        $this->entrepreneurStatusEntity = $entrepreneurStatusEntity;
    }

    public function getData(Request $request)
    {
        return $this->entrepreneurStatusService->getData($request);
    }

    public function getIndex()
    {
        return $this->makeView("index",array('moduleNav'=>'entrepreneurstatus'));
    }

    public function getCreate()
    {
        return $this->makeView("form", [
            "model" => $this->entrepreneurStatusEntity,
            'moduleNav'=>'entrepreneurstatus'
        ]);
    }

    public function postCreate(EntrepreneurStatusRequest $request)
    {
        return $this->entrepreneurStatusService->create($request);
    }

    public function getEdit($id)
    {
        $model = $this->entrepreneurStatusEntity->findOrFail($id);

        return $this->makeView("form", [
            "model" => $model,
            'moduleNav'=>'entrepreneurstatus'
        ]);
    }

    public function postEdit(EntrepreneurStatusRequest $request, $id)
    {
        return $this->entrepreneurStatusService->edit($request, $id);
    }

    public function getDelete($id)
    {
        return $this->entrepreneurStatusService->delete($id);
    }

}