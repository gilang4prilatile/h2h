<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Requests\MasterData\TypeGoodsRequest;
use App\Http\Requests\MasterData\TypeOfGuaranteeRequest;
use App\Models\MasterTypeOfGuarantee;
use App\Services\MasterData\TypeOfGuaranteeService;
use Illuminate\Http\Request;

class TypeOfGuaranteeController extends MasterDataController
{
    public MasterTypeOfGuarantee $typeGuarantee;
    public TypeOfGuaranteeService $typeGuaranteeService;

    public function __construct(
        TypeOfGuaranteeService $typeGuaranteeService,
        MasterTypeOfGuarantee $typeGuarantee
    ) {
        parent::__construct();

        $this->view .= "type-of-guarantee.";
        $this->typeGuaranteeService = $typeGuaranteeService;
        $this->typeGuarantee = $typeGuarantee;
    }

    public function getData(Request $request)
    {
        return $this->typeGuaranteeService->getData($request);
    }

    public function getIndex()
    {
        return $this->makeView("index",array('moduleNav'=>'typeofguarantee'));
    }

    public function getCreate()
    {
        return $this->makeView("form", [
            "model" => $this->typeGuarantee,
            'moduleNav'=>'typeofguarantee'
        ]);
    }

    public function postCreate(TypeOfGuaranteeRequest $request)
    {
        return $this->typeGuaranteeService->create($request);
    }

    public function getEdit($id)
    {
        $model = $this->typeGuarantee->findOrFail($id);

        return $this->makeView("form", [
            "model" => $model,
            'moduleNav'=>'typeofguarantee'
        ]);
    }

    public function postEdit(TypeOfGuaranteeRequest $request, $id)
    {
        return $this->typeGuaranteeService->edit($request, $id);
    }

    public function getDelete($id)
    {
        return $this->typeGuaranteeService->delete($id);
    }
}
