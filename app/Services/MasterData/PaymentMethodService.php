<?php

namespace App\Services\MasterData;

use App\Http\Requests\MasterData\PaymentMethodRequest;
use App\Models\MasterPaymentMethod;
use Exception;
use Illuminate\Http\Request;

class PaymentMethodService
{

    private MasterPaymentMethod $masterPaymentMethodEntity;
    public string $mainUrl;

    public function __construct(
        MasterPaymentMethod $masterPaymentMethodEntity
    ) {
        $this->masterPaymentMethodEntity = $masterPaymentMethodEntity;

        $this->mainUrl = url('master-data/payment-method');

        view()->share("mainUrl", $this->mainUrl);
    }

    public function getData(Request $request)
    {
        $formArray = filterDataTableToArray($request->form);
        $query = $this->masterPaymentMethodEntity->select("id", "code", "name");

        foreach ($formArray as $key => $attribute) {
            if (!empty($attribute)) {
                $query = $query->where($key, "like", "%{$attribute}%");
            }
        }

        $canEdit = auth()->user()->can('edit master-data payment-method');
        $canDelete = auth()->user()->can('delete master-data payment-method');
        return datatables()->of($query)
            ->addColumn("actions", function ($row) use ($canEdit, $canDelete) {
                return view("components.table.actions", [
                    "actions" => [
                        "edit" => !$canEdit ? null : [
                            "url" => $this->mainUrl . '/edit/' . $row->id
                        ],
                        "delete" => !$canDelete ? null : [
                            "url" => $this->mainUrl . '/delete/' . $row->id
                        ],
                    ]
                ]);
            })
            ->make();
    }

    public function create(PaymentMethodRequest $request)
    {
        $this->masterPaymentMethodEntity->create($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been saved");
    }

    public function edit(PaymentMethodRequest $request, $id)
    {
        $MasterPaymentMethodEntity = $this->masterPaymentMethodEntity->findOrFail($id);

        $MasterPaymentMethodEntity->update($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been updated");
    }

    public function delete($id)
    {
        $MasterPaymentMethodEntity = $this->masterPaymentMethodEntity->findOrFail($id);
        try {
            $MasterPaymentMethodEntity->delete();
            return redirect($this->mainUrl)->with("success", "Data has been deleted");
        } catch (Exception $e) {
            return redirect($this->mainUrl)->with("info", "Data cannot be deleted, because this data already used");
        }
    }

    public function getAll()
    {
        return $this->masterPaymentMethodEntity->all();
    }
}