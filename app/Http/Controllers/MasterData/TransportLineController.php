<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Requests\MasterData\TransportLineRequest;
use App\Models\TransportLine;
use App\Services\MasterData\TransportLineService;
use Illuminate\Http\Request;

class TransportLineController extends MasterDataController
{
    public TransportLine $transportLineEntity;
    public TransportLineService $transportLineService;

    public function __construct(
        TransportLineService $transportLineService,
        TransportLine $transportLineEntity
    ) {
        parent::__construct();

        $this->view .= "transport-line.";
        $this->transportLineService = $transportLineService;
        $this->transportLineEntity = $transportLineEntity;
    }

    public function getData(Request $request)
    {
        return $this->transportLineService->getData($request);
    }

    public function getIndex()
    {
        return $this->makeView("index",array('moduleNav'=>'transportline'));
    }

    public function getCreate()
    {
        return $this->makeView("form", [
            "model" => $this->transportLineEntity,
            'moduleNav'=>'transportline'
        ]);
    }

    public function postCreate(TransportLineRequest $request)
    {
        return $this->transportLineService->create($request);
    }

    public function getEdit($id)
    {
        $model = $this->transportLineEntity->findOrFail($id);

        return $this->makeView("form", [
            "model" => $model,
            'moduleNav'=>'transportline'
        ]);
    }

    public function postEdit(TransportLineRequest $request, $id)
    {
        return $this->transportLineService->edit($request, $id);
    }

    public function getDelete($id)
    {
        return $this->transportLineService->delete($id);
    }
}
