<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Requests\MasterData\TransportationRequest;
use App\Models\Country;
use App\Models\Transportation;
use App\Models\TransportLine;
use App\Services\MasterData\TransportationService;
use Illuminate\Http\Request;

class TransportationController extends MasterDataController
{

    public Transportation $Transportation;
    public TransportationService $TransportationService;

    public function __construct(
        TransportationService $TransportationService,
        Transportation $Transportation
    ) {
        parent::__construct();

        $this->view .= "transportation.";
        $this->TransportationService = $TransportationService;
        $this->Transportation = $Transportation;
    }

    public function getData(Request $request)
    {
        return $this->TransportationService->getData($request);
    }

    public function getIndex()
    {
        return $this->makeView("index",array('moduleNav'=>'transportations', 'transportLine' => TransportLine::all()->pluck('name' , 'id')));
    }

    public function getCreate()
    {
        return $this->makeView("form", [
            "model" => $this->Transportation,
            'moduleNav'=>'transportations',
            'transportLine' => TransportLine::all()->pluck('name', 'id'),
            'country' => Country::all()->pluck('name', 'id'),
        ]);
    }

    public function postCreate(TransportationRequest $request)
    {
        return $this->TransportationService->create($request);
    }

    public function getEdit($id)
    {
        $model = $this->Transportation->findOrFail($id);

        return $this->makeView("form", [
            "model" => $model,
            'moduleNav'=>'transportations',
            'transportLine' => TransportLine::all()->pluck('name', 'id'),
            'country' => Country::all()->pluck('name', 'id'),
        ]);
    }

    public function postEdit(TransportationRequest $request, $id)
    {
        return $this->TransportationService->edit($request, $id);
    }

    public function getDelete($id)
    {
        return $this->TransportationService->delete($id);
    }

    public function getDetail($id)
    {
        $data_country = Transportation::select([
            'transportations.*',
            'transport_lines.name as transport_line_name',
            'countries.name as country_name'
        ])
            ->leftjoin('transport_lines','transport_lines.id','=','transportations.transport_line_id')
            ->leftjoin('countries','countries.id','=','transportations.country_id')
            ->where('transportations.id','=',$id)
            ->first();

        return response()->json($data_country);
    }
}
