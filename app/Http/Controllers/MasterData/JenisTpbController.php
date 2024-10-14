<?php

namespace App\Http\Controllers\MasterData;

use App\Models\MasterJenisTpb;
use Illuminate\Http\Request;
use App\Services\MasterData\JenisTpbService;
use App\Http\Requests\MasterData\JenisTpbRequest;

class JenisTpbController extends MasterDataController
{
    public MasterJenisTpb $jenisTpbEntity;
    public JenisTpbService $jenisTpbService;

    public function __construct(
        JenisTpbService $jenisTpbService,
        MasterJenisTpb $jenisTpbEntity
    ) {
        parent::__construct();

        $this->view .= "jenis-tpb.";
        $this->jenisTpbService = $jenisTpbService;
        $this->jenisTpbEntity = $jenisTpbEntity;
    }

    public function getData(Request $request)
    {
        return $this->jenisTpbService->getData($request);
    }

    public function getIndex()
    {
        return $this->makeView("index",array('moduleNav'=>'jenistpb'));
    }

    public function getCreate()
    {
        return $this->makeView("form", [
            "model" => $this->jenisTpbEntity,
            'moduleNav'=>'jenistpb'
        ]);
    }

    public function postCreate(JenisTpbRequest $request)
    {
        return $this->jenisTpbService->create($request);
    }

    public function getEdit($id)
    {
        $model = $this->jenisTpbEntity->findOrFail($id);

        return $this->makeView("form", [
            "model" => $model,
            'moduleNav'=>'jenistpb'
        ]);
    }

    public function postEdit(JenisTpbRequest $request, $id)
    {
        return $this->jenisTpbService->edit($request, $id);
    }

    public function getDelete($id)
    {
        return $this->jenisTpbService->delete($id);
    }
}
