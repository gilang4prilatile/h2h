<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Requests\MasterData\UkuranPetiKemasRequest;
use App\Models\MasterUkuranPetiKemas;
use App\Services\MasterData\UkuranPetiKemasService;
use Illuminate\Http\Request;

class UkuranPetiKemasController extends MasterDataController
{
    public MasterUkuranPetiKemas $ukuranPetiKemasEntity;
    public UkuranPetiKemasService $ukuranPetiKemasService;

    
    public function __construct(
        UkuranPetiKemasService $ukuranPetiKemasService,
        MasterUkuranPetiKemas $ukuranPetiKemasEntity
    ) {
        parent::__construct();

        $this->view .= "ukuran-peti-kemas.";
        $this->ukuranPetiKemasEntity = $ukuranPetiKemasEntity;
        $this->ukuranPetiKemasService = $ukuranPetiKemasService;
    }

    public function getData(Request $request)
    {
        return $this->ukuranPetiKemasService->getData($request);
    }
    
    public function getDetail($id)
    {
        return $this->ukuranPetiKemasService->getDetailJSON($id);
    }

    public function getIndex()
    {
        return $this->makeView("index",array('moduleNav'=>'ukuran-peti-kemas'));
    }

    public function getCreate()
    {
        return $this->makeView("form", [
            "model" => $this->ukuranPetiKemasEntity,
            'moduleNav'=>'ukuran-peti-kemas'
        ]);
    }

    public function postCreate(UkuranPetiKemasRequest $request)
    {
        return $this->ukuranPetiKemasService->create($request);
    }

    public function getEdit($id)
    {
        $model = $this->ukuranPetiKemasEntity->findOrFail($id);

        return $this->makeView("form", [
            "model" => $model,
            'moduleNav'=>'ukuran-peti-kemas'
        ]);
    }

    public function postEdit(UkuranPetiKemasRequest $request, $id)
    {
        return $this->ukuranPetiKemasService->edit($request, $id);
    }

    public function getDelete($id)
    {
        return $this->ukuranPetiKemasService->delete($id);
    }

}
