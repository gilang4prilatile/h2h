<?php

namespace App\Services\MasterData;

use App\Http\Requests\MasterData\CountryRequest;
use App\Models\Country;
use App\Models\InboundTransportation;
use App\Models\Profile;
use Exception;
use Illuminate\Http\Request;

class CountryService
{
    public string $mainUrl;
    private Country $countryEntity;

    public function __construct(
        Country $countryEntity
    ) {
        $this->countryEntity = $countryEntity;

        $this->mainUrl = url('master-data/country');

        view()->share("mainUrl", $this->mainUrl);
    }

    public function getData(Request $request)
    {
        $formArray = filterDataTableToArray($request->form);
        $query = $this->countryEntity->select("id", "code", "name");

        foreach ($formArray as $key => $attribute) {
            if (!empty($attribute)) {
                $query = $query->where($key, "like", "%{$attribute}%");
            }
        }

        $canEdit = auth()->user()->can('edit master-data country');
        $canDelete = auth()->user()->can('delete master-data country');
        return datatables()->of($query)
            ->addColumn("actions", function ($row) use ($canEdit, $canDelete) {
                return view("components.table.actions", [
                    "actions" => [
                        "edit" => !$canEdit ? null : [
                            "url" => $this->mainUrl . '/edit/' . $row->id,
                        ],
                        "delete" => !$canDelete ? null : [
                            "url" => $this->mainUrl . '/delete/' . $row->id,
                        ],
                    ]
                ]);
            })
            ->make();
    }

    public function create(CountryRequest $request)
    {
        $this->countryEntity->create($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been saved");
    }

    public function edit(CountryRequest $request, $id)
    {
        $countryEntity = $this->countryEntity->findOrFail($id);

        $countryEntity->update($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been updated");
    }

    public function delete($id)
    {
        $countryEntity = $this->countryEntity->findOrFail($id);
        $checkinboundtransport  = InboundTransportation::where('country_code', $countryEntity->code)->first();
        $checkprofile = Profile::where('country_id', $countryEntity->id)->first();
        try {
            if ($checkinboundtransport == null && $checkprofile == null) {
                $countryEntity->delete();
                return redirect($this->mainUrl)->with("success", "Data has been deleted");
            } else {
                return redirect($this->mainUrl)->with("info", "Data cannot be deleted, because this data already used");
            }
        } catch (Exception $e) {
            return redirect($this->mainUrl)->with("info", "Data cannot be deleted, because this data already used");
        }
    }
}
