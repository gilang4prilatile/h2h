<?php

namespace App\Services\MasterData;

use App\Http\Requests\MasterData\JenisBarangRequest;
use Exception;
use Illuminate\Http\Request;
use App\Models\MasterJenisBarang;

class JenisBarangService
{
    private MasterJenisBarang $jenisBarangEntity;
    public string $mainUrl;

    public function __construct(
        MasterJenisBarang $jenisBarangEntity
    ) {
        $this->jenisBarangEntity = $jenisBarangEntity;

        $this->mainUrl = url('master-data/jenis-barang');

        view()->share("mainUrl", $this->mainUrl);
    }

    public function getData(JenisBarangRequest $request)
    {
        $formArray = filterDataTableToArray($request->form);
        $query = $this->jenisBarangEntity->select("id", "code", "name");


        foreach ($formArray as $key => $attribute) {
            if (!empty($attribute)) {
                $query = $query->where($key, "like", "%{$attribute}%");
            }
        }

        $canEdit = auth()->user()->can('edit master-data jenis-barang');
        $canDelete = auth()->user()->can('delete master-data jenis-barang');
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

    public function create(JenisBarangRequest $request)
    {
        $this->jenisBarangEntity->create($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been saved");
    }

    public function edit(JenisBarangRequest $request, $id)
    {
        $jenisBarangEntity = $this->jenisBarangEntity->findOrFail($id);

        $jenisBarangEntity->update($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been updated");
    }

    public function delete($id)
    {
        $jenisBarangEntity = $this->jenisBarangEntity->findOrFail($id);
        try {
            $jenisBarangEntity->delete();
            return redirect($this->mainUrl)->with("success", "Data has been deleted");
        } catch (Exception $e) {
            return redirect($this->mainUrl)->with("info", "Data cannot be deleted, because this data already used");
        }
    }

    public function getAll()
    {
        return $this->jenisBarangEntity->all();
    }
}
