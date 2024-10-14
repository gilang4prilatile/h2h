<?php

namespace App\Http\Controllers\MasterData;

use Illuminate\Http\Request;

class StatusController extends MasterDataController
{
    //
  /*  public MasterStatus $statusEntity;
    public StatusService $statusService;

    public function __construct(
        StatusService $statusService,
        MasterStatus $statusEntity
    ) {
        parent::__construct();

        $this->view .= "status.";
        $this->statusService = $statusService;
        $this->statusEntity = $statusEntity;
    }

    public function getData(Request $request)
    {
        return $this->statusService->getData($request);
    }

    public function getIndex()
    {
        return $this->makeView("index");
    }

    public function getCreate()
    {
        return $this->makeView("form", [
            "model" => $this->statusEntity,
        ]);
    }

    public function postCreate(StatusRequest $request)
    {
        return $this->statusService->create($request);
    }

    public function getEdit($id)
    {
        $model = $this->statusEntity->findOrFail($id);

        return $this->makeView("form", [
            "model" => $model,
        ]);
    }

    public function postEdit(StatusRequest $request, $id)
    {
        return $this->statusService->edit($request, $id);
    }

    public function getDelete($id)
    {
        return $this->statusService->delete($id);
    } */
}
