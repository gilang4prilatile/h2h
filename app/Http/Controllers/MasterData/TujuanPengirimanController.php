<?php

namespace App\Http\Controllers\MasterData;

use App\Models\MasterTujuanPengiriman;
use Illuminate\Http\Request;
use App\Services\MasterData\TujuanPengirimanService;
use App\Http\Requests\MasterData\TujuanPengirimanRequest;

class TujuanPengirimanController extends MasterDataController
{
    public MasterTujuanPengiriman $tujuanPengirimanEntity;
    public TujuanPengirimanService $tujuanPengirimanService;

    public function __construct(
        TujuanPengirimanService $tujuanPengirimanService,
        MasterTujuanPengiriman $tujuanPengirimanEntity
    ) {
        parent::__construct();

        $this->view .= "tujuan-pengiriman.";
        $this->tujuanPengirimanService = $tujuanPengirimanService;
        $this->tujuanPengirimanEntity = $tujuanPengirimanEntity;
    }

    public function getData(Request $request)
    {
        return $this->tujuanPengirimanService->getData($request);
    }

    public function getIndex()
    {
        return $this->makeView("index",array('moduleNav'=>'tujuanpengiriman'));
    }

    public function getCreate()
    {
        return $this->makeView("form", [
            "model" => $this->tujuanPengirimanEntity,
            'moduleNav'=>'tujuanpengiriman'
        ]);
    }

    public function postCreate(TujuanPengirimanRequest $request)
    {
        return $this->tujuanPengirimanService->create($request);
    }

    public function getEdit($id)
    {
        $model = $this->tujuanPengirimanEntity->findOrFail($id);

        return $this->makeView("form", [
            "model" => $model,
            'moduleNav'=>'tujuanpengiriman'
        ]);
    }

    public function postEdit(TujuanPengirimanRequest $request, $id)
    {
        return $this->tujuanPengirimanService->edit($request, $id);
    }

    public function getDelete($id)
    {
        return $this->tujuanPengirimanService->delete($id);
    }
}
