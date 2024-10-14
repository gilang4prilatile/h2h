<?php

namespace App\Services\MasterData;

use App\Models\MasterPackage;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\MasterData\PackageRequest;

class PackageService
{
    private MasterPackage $packageEntity;
    public string $mainUrl;

    public function __construct(
        MasterPackage $packageEntity
    )
    {
        $this->packageEntity = $packageEntity;

        $this->mainUrl = url('master-data/package');

        view()->share("mainUrl", $this->mainUrl);
    }

    public function getData(Request $request)
    {
        $formArray = filterDataTableToArray($request->form);
        $query = $this->packageEntity->select("id", "code", "name");

        $user = auth()->user();

        // if (!$user->hasRole(['Super Admin'])) {
            // $query->whereNull("warehouse_id")
            //     ->orWhere('warehouse_id', $user->warehouse_id);
        // }

        foreach ($formArray as $key => $attribute) {
            if (!empty($attribute)) {
                $query = $query->where($key, "like", "%{$attribute}%");
            }
        }

        $canEdit = $user->can('edit master-data package');
        $canDelete = $user->can('delete master-data package');
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

    public function create(PackageRequest $request)
    {
        $this->packageEntity->create($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been saved");
    }

    public function edit(PackageRequest $request, $id)
    {
        $packageEntity = $this->packageEntity->findOrFail($id);

        $packageEntity->update($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been updated");
    }

    public function delete($id)
    {
        $packageEntity = $this->packageEntity->findOrFail($id);
        try {
            $packageEntity->delete();
            return redirect($this->mainUrl)->with("success", "Data has been deleted");
        } catch (Exception $e) {
            return redirect($this->mainUrl)->with("info", "Data cannot be deleted, because this data already used");
        }
    }

    public function getAll()
    {
        return $this->packageEntity->all();
    }
}
