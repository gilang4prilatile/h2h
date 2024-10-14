<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\MasterData\MasterDataController;
use App\Http\Requests\MasterData\SpecialSpecificationRequest;
use App\Models\MasterSpecialSpecification;
use App\Services\MasterData\SpecialSpecificationService;
use Illuminate\Http\Request;

class SpecialSpecificationController extends MasterDataController
{

    public MasterSpecialSpecification $specialSpecification;
    public SpecialSpecificationService $specialSpecificationService;

    public function __construct(
        SpecialSpecificationService $specialSpecificationService,
        MasterSpecialSpecification $specialSpecification
    ) {
        parent::__construct();

        $this->view .= "special-specification.";
        $this->specialSpecificationService = $specialSpecificationService;
        $this->specialSpecification = $specialSpecification;
    }

    public function getData(Request $request)
    {
        return $this->specialSpecificationService->getData($request);
    }

    public function getIndex()
    {
        return $this->makeView("index",array('moduleNav'=>'specialspecification'));
    }

    public function getCreate()
    {
        return $this->makeView("form", [
            "model" => $this->specialSpecification,
            'moduleNav'=>'specialspecification'
        ]);
    }

    public function postCreate(SpecialSpecificationRequest $request)
    {
        return $this->specialSpecificationService->create($request);
    }

    public function getEdit($id)
    {
        $model = $this->specialSpecification->findOrFail($id);

        return $this->makeView("form", [
            "model" => $model,
            'moduleNav'=>'specialspecification'
        ]);
    }

    public function postEdit(SpecialSpecificationRequest $request, $id)
    {
        return $this->specialSpecificationService->edit($request, $id);
    }

    public function getDelete($id)
    {
        return $this->specialSpecificationService->delete($id);
    }

}