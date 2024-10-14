<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\MasterData\MasterDataController;
use App\Http\Requests\MasterData\TradeMethodRequest;
use App\Models\MasterTradeMethod;
use App\Services\MasterData\TradeMethodService;
use Illuminate\Http\Request;

class TradeMethodController extends MasterDataController
{

    public MasterTradeMethod $tradeMethod;
    public TradeMethodService $tradeMethodService;

    public function __construct(
        TradeMethodService $tradeMethodService,
        MasterTradeMethod $tradeMethod
    ) {
        parent::__construct();

        $this->view .= "trade-method.";
        $this->tradeMethodService = $tradeMethodService;
        $this->tradeMethod = $tradeMethod;
    }

    public function getData(Request $request)
    {
        return $this->tradeMethodService->getData($request);
    }

    public function getIndex()
    {
        return $this->makeView("index",array('moduleNav'=>'trademethod'));
    }

    public function getCreate()
    {
        return $this->makeView("form", [
            "model" => $this->tradeMethod,
            'moduleNav'=>'trademethod'
        ]);
    }

    public function postCreate(TradeMethodRequest $request)
    {
        return $this->tradeMethodService->create($request);
    }

    public function getEdit($id)
    {
        $model = $this->tradeMethod->findOrFail($id);

        return $this->makeView("form", [
            "model" => $model,
            'moduleNav'=>'trademethod'
        ]);
    }

    public function postEdit(TradeMethodRequest $request, $id)
    {
        return $this->tradeMethodService->edit($request, $id);
    }

    public function getDelete($id)
    {
        return $this->tradeMethodService->delete($id);
    }

}