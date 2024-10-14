<?php

namespace App\Services\MasterData;

use App\Models\MasterPengirimBarang;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\MasterData\PengirimBarangRequest;
use App\Models\Country;
use App\Models\Profile;

class PengirimBarangService
{
    private MasterPengirimBarang $pengirimBarangEntity;
    private Country $countryEntity;

    public string $mainUrl;

    public function __construct(
        MasterPengirimBarang $pengirimBarangEntity,
        Country              $countryEntity
    ) {
        $this->pengirimBarangEntity = $pengirimBarangEntity;
        $this->countryEntity = $countryEntity;

        $this->mainUrl = url('master-data/pengirim-barang');

        view()->share("mainUrl", $this->mainUrl);
        view()->share("countries", $this->countryEntity->selectBox());
    }

    public function getData(Request $request)
    {
        $formArray = filterDataTableToArray($request->form);

        $query = Profile::select('*')->where('type', 'tpb');

        foreach ($formArray as $key => $attribute) {
            if (!empty($attribute)) {
                $query = $query->where($key, "like", "%{$attribute}%");
            }
        }

        return datatables()->of($query)
            ->addColumn("actions", function ($row) {
                return view("components.table.actions", [
                    "actions" => [
                        "edit" => [
                            "url" => $this->mainUrl . '/edit/' . $row->id,
                        ],
                        "delete" => [
                            "url" => $this->mainUrl . '/delete/' . $row->id,
                        ],
                    ]
                ]);
            })
            ->make();
    }

    public function getIndex()
    {
        return $this->makeView("index");
    }

    public function getCreate()
    {
        return $this->makeView("form", [
            "model" => new Profile,
            "tipe_identitas" => [
                'ktp' => 'KTP',
                'npwp-12-digit' => 'NPWP 12 Digit',
                'npwp-15-digit' => 'NPWP 15 Digit'
            ],
        ]);
    }

    public function postCreate(StoreProfileRequest $request)
    {
        $request['type'] = "ppjk";
        if (Profile::create($request->all())) {
            return redirect($this->mainUrl)->with("success", "Data has been saved");
        }

        return redirect($this->mainUrl)->with("error", "Failed to saved the data");
    }

    public function getEdit($id)
    {
        $model = Profile::findOrFail($id);

        return $this->makeView("form", [
            "model" => $model,
            "tipe_identitas" => [
                'ktp' => 'KTP',
                'npwp-12-digit' => 'NPWP 12 Digit',
                'npwp-15-digit' => 'NPWP 15 Digit'
            ],
        ]);
    }

    public function postEdit(UpdateProfileRequest $request, $id)
    {
        if (Profile::find($id)->update($request->all())) {
            return redirect($this->mainUrl)->with("success", "Data has been updated");
        }

        return redirect($this->mainUrl)->with("error", "Failed to update the specified resource");
    }

    public function getDelete($id)
    {
        if (Profile::find($id)->delete()) {
            return redirect($this->mainUrl)->with("success", "Data has been deleted");
        }

        return redirect($this->mainUrl)->with("error", "Failed to delete the specified resource");
    }

    public function getAll() {
        return Profile::all();
    }
}
