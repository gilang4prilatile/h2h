<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Requests\MasterData\TypePetiKemasRequest;
use App\Http\Requests\MasterData\UkuranPetiKemasRequest;
use App\Models\MasterTypePetiKemas;
use App\Models\MasterUkuranPetiKemas;
use App\Services\MasterData\TypePetiKemasService;
use App\Services\MasterData\UkuranPetiKemasService;
use Illuminate\Http\Request;

class TypePetiKemasController extends MasterDataController
{
    public MasterTypePetiKemas $typePetiKemasEntity;
    public TypePetiKemasService $typePetiKemasService;

    
    public function __construct(
        TypePetiKemasService $typePetiKemasService,
        MasterTypePetiKemas $typePetiKemasEntity
    ) {
        parent::__construct();

        $this->view .= "type-peti-kemas.";
        $this->typePetiKemasEntity = $typePetiKemasEntity;
        $this->typePetiKemasService = $typePetiKemasService;
    }

    public function getData(Request $request)
    {
        return $this->typePetiKemasService->getData($request);
    }
    
    public function getDetail($id)
    {
        return $this->typePetiKemasService->getDetailJSON($id);
    }

    public function getIndex()
    {
        return $this->makeView("index",array('moduleNav'=>'type-peti-kemas'));
    }

    public function getCreate()
    {
        return $this->makeView("form", [
            "model" => $this->typePetiKemasEntity,
            'moduleNav'=>'type-peti-kemas'
        ]);
    }

    public function postCreate(TypePetiKemasRequest $request)
    {
        return $this->typePetiKemasService->create($request);
    }

    public function getEdit($id)
    {
        $model = $this->typePetiKemasEntity->findOrFail($id);

        return $this->makeView("form", [
            "model" => $model,
            'moduleNav'=>'type-peti-kemas'
        ]);
    }

    public function postEdit(TypePetiKemasRequest $request, $id)
    {
        return $this->typePetiKemasService->edit($request, $id);
    }

    public function getDelete($id)
    {
        return $this->typePetiKemasService->delete($id);
    }

}
