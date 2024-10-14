<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\MasterData\MasterDataController;
use App\Http\Requests\MasterData\PlaceOriginRequest;
use App\Models\MasterPlaceOfOrigin;
use App\Services\MasterData\PlaceOriginService;
use Illuminate\Http\Request;

class PlaceOriginController extends MasterDataController
{
    public MasterPlaceOfOrigin $placeOrigin;
    public PlaceOriginService $placeOriginService;

    public function __construct(
        PlaceOriginService $placeOriginService,
        MasterPlaceOfOrigin $placeOrigin
    ) {
        parent::__construct();

        $this->view .= "place-of-origin.";
        $this->placeOriginService = $placeOriginService;
        $this->placeOrigin = $placeOrigin;
    }

    public function getData(Request $request)
    {
        return $this->placeOriginService->getData($request);
    }

    public function getIndex()
    {
        return $this->makeView("index",array('moduleNav'=>'placeoforigin'));
    }

    public function getCreate()
    {
        return $this->makeView("form", [
            "model" => $this->placeOrigin,
            'moduleNav'=>'placeoforigin'
        ]);
    }

    public function postCreate(PlaceOriginRequest $request)
    {
        return $this->placeOriginService->create($request);
    }

    public function getEdit($id)
    {
        $model = $this->placeOrigin->findOrFail($id);

        return $this->makeView("form", [
            "model" => $model,
            'moduleNav'=>'placeoforigin'
        ]);
    }

    public function postEdit(PlaceOriginRequest $request, $id)
    {
        return $this->placeOriginService->edit($request, $id);
    }

    public function getDelete($id)
    {
        return $this->placeOriginService->delete($id);
    }
}