<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\MasterData\MasterDataController;
use App\Http\Requests\MasterData\PaymentMethodRequest;
use App\Models\MasterPaymentMethod;
use App\Services\MasterData\PaymentMethodService;
use Illuminate\Http\Request;

class PaymentMethodController extends MasterDataController
{

    public MasterPaymentMethod $paymentMethodEntity;
    public PaymentMethodService $paymentMethodService;

    public function __construct(
        PaymentMethodService $paymentMethodService,
        MasterPaymentMethod $paymentMethodEntity
    ) {
        parent::__construct();

        $this->view .= "payment-method.";
        $this->paymentMethodService = $paymentMethodService;
        $this->paymentMethodEntity = $paymentMethodEntity;
    }

    public function getData(Request $request)
    {
        return $this->paymentMethodService->getData($request);
    }

    public function getIndex()
    {
        return $this->makeView("index",array('moduleNav'=>'paymentmethod'));
    }

    public function getCreate()
    {
        return $this->makeView("form", [
            "model" => $this->paymentMethodEntity,
            'moduleNav'=>'paymentmethod'
        ]);
    }

    public function postCreate(PaymentMethodRequest $request)
    {
        return $this->paymentMethodService->create($request);
    }

    public function getEdit($id)
    {
        $model = $this->paymentMethodEntity->findOrFail($id);

        return $this->makeView("form", [
            "model" => $model,
            'moduleNav'=>'paymentmethod'
        ]);
    }

    public function postEdit(PaymentMethodRequest $request, $id)
    {
        return $this->paymentMethodService->edit($request, $id);
    }

    public function getDelete($id)
    {
        return $this->paymentMethodService->delete($id);
    }


}