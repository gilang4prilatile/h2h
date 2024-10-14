<?php

namespace App\Http\Controllers\MasterData;

use App\Models\MasterUom;
use Illuminate\Http\Request;
use App\Services\MasterData\UomService;
use App\Http\Requests\MasterData\UomRequest;

class UomController extends MasterDataController
{
    public MasterUom $uomEntity;
    public UomService $uomService;

    public function __construct(
        UomService $uomService,
        MasterUom $uomEntity
    ) {
        parent::__construct();

        $this->view .= "uom.";
        $this->uomService = $uomService;
        $this->uomEntity = $uomEntity;
    }

    public function getAll() {
        return $this->uomEntity->all();
    }

    public function getData(Request $request)
    {
        return $this->uomService->getData($request);
    }

    public function getIndex()
    {
        $data['moduleNav'] = 'uom';
        return $this->makeView("index",$data);
    }

    public function getCreate()
    {
        return $this->makeView("form", [
            "model" => $this->uomEntity,
            "moduleNav" => 'uom',
        ]);
    }

    public function postCreate(UomRequest $request)
    {
        return $this->uomService->create($request);
    }

    public function getEdit($id)
    {
        $model = $this->uomEntity->findOrFail($id);

        return $this->makeView("form", [
            "model" => $model,
            "moduleNav" => 'uom',
        ]);
    }

    public function postEdit(UomRequest $request, $id)
    {
        return $this->uomService->edit($request, $id);
    }

    public function getDelete($id)
    {
        return $this->uomService->delete($id);
    }
}
