<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\MasterData\MasterDataController;
use App\Http\Requests\MasterData\BankRequest;
use App\Models\Bank;
use App\Services\MasterData\BankService;
use Illuminate\Http\Request;

class BankController extends MasterDataController
{

    public Bank $bank;
    public BankService $bankService;

    public function __construct(
        BankService $bankService,
        Bank $bank
    ) {
        parent::__construct();

        $this->view .= "bank.";
        $this->bankService = $bankService;
        $this->bank = $bank;
    }

    public function getData(Request $request)
    {
        return $this->bankService->getData($request);
    }

    public function getIndex()
    {
        return $this->makeView("index",array('moduleNav'=>'bank'));
    }

    public function getCreate()
    {
        return $this->makeView("form", [
            "model" => $this->bank,
            'moduleNav'=>'bank'
        ]);
    }

    public function postCreate(BankRequest $request)
    {
        return $this->bankService->create($request);
    }

    public function getEdit($id)
    {
        $model = $this->bank->findOrFail($id);

        return $this->makeView("form", [
            "model" => $model,
            'moduleNav'=>'bank'
        ]);
    }

    public function postEdit(BankRequest $request, $id)
    {
        return $this->bankService->edit($request, $id);
    }

    public function getDelete($id)
    {
        return $this->bankService->delete($id);
    }

}