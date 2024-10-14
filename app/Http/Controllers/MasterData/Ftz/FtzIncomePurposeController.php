<?php

namespace App\Http\Controllers\MasterData\Ftz;

use App\Http\Controllers\MasterData\MasterDataController;
use App\Http\Requests\MasterData\IncomePurposeRequest;
use App\Models\Ftz\MasterIncomePurpose;
use App\Services\MasterData\Ftz\IncomePurposeService;
use Illuminate\Http\Request;

class FtzIncomePurposeController extends MasterDataController
{
    public MasterIncomePurpose $incomePurposeEntity;
    public IncomePurposeService $incomePurposeService;

    public function __construct(
        IncomePurposeService $incomePurposeService,
        MasterIncomePurpose $incomePurposeEntity
    ) {
        parent::__construct();

        $this->view .= "ftz-income-purpose.";
        $this->incomePurposeService = $incomePurposeService;
        $this->incomePurposeEntity = $incomePurposeEntity;
    }

    public function getData(Request $request)
    {
        return $this->incomePurposeService->getData($request);
    }

    public function getIndex()
    {
        return $this->makeView("index",array('moduleNav'=>'incomepurpose'));
    }

    public function getCreate()
    {
        return $this->makeView("form", [
            "model" => $this->incomePurposeEntity,
            'moduleNav'=>'incomepurpose'
        ]);
    }

    public function postCreate(IncomePurposeRequest $request)
    {
        return $this->incomePurposeService->create($request);
    }

    public function getEdit($id)
    {
        $model = $this->incomePurposeEntity->findOrFail($id);

        return $this->makeView("form", [
            "model" => $model,
            'moduleNav'=>'incomepurpose'
        ]);
    }

    public function postEdit(IncomePurposeRequest $request, $id)
    {
        return $this->incomePurposeService->edit($request, $id);
    }

    public function getDelete($id)
    {
        return $this->incomePurposeService->delete($id);
    }
}
