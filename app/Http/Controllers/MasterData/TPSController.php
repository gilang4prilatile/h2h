<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterData\TPSRequest;
use App\Models\MasterTPS;
use App\Services\MasterData\TPSService;
use Illuminate\Http\Request;

class TPSController extends MasterDataController
{
    public MasterTPS $tpsEntity;
    public TPSService $tpsService;

    public function __construct(
        TPSService $tpsService,
        MasterTPS $tpsEntity
    ) {
        parent::__construct();

        $this->view .= "tps.";
        $this->tpsService = $tpsService;
        $this->tpsEntity = $tpsEntity;
    }

    public function getData(Request $request)
    {
        return $this->tpsService->getData($request);
    }
    
    public function getDetail($id)
    {
        return $this->tpsService->getDetailJSON($id);
    }

    public function getIndex()
    {
        return $this->makeView("index",array('moduleNav'=>'tps'));
    }

    public function getCreate()
    {
        return $this->makeView("form", [
            "model" => $this->tpsEntity,
            'moduleNav'=>'tps'
        ]);
    }

    public function postCreate(TPSRequest $request)
    {
        return $this->tpsService->create($request);
    }

    public function getEdit($id)
    {
        $model = $this->tpsEntity->findOrFail($id);

        return $this->makeView("form", [
            "model" => $model,
            'moduleNav'=>'tps'
        ]);
    }

    public function postEdit(TPSRequest $request, $id)
    {
        return $this->tpsService->edit($request, $id);
    }

    public function getDelete($id)
    {
        return $this->tpsService->delete($id);
    }

    public function getAjax($idKppbc)
    {

        $result = MasterTPS::where('master_kppbc_id', $idKppbc)->get()->map(function ($v) {
            return [
                "id"                => $v->id,
                "text"              => $v->code_office . " - " . $v->name

            ];
        });

        return response()->json([
            'data'  => $result
        ]);

    }

}
