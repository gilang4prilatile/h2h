<?php

namespace App\Services\MasterData;

use App\Http\Requests\MasterData\InstitutionalPermissionRequest;
use App\Models\MasterInstitutionalPermission;
use Exception;
use Illuminate\Http\Request;

class InstitutionalPermissionService
{
    public string $mainUrl;
    private MasterInstitutionalPermission $permissionEntity;

    public function __construct(
        MasterInstitutionalPermission $permissionEntity
    ) {
        $this->permissionEntity = $permissionEntity;

        $this->mainUrl = url('master-data/institutional-permission');

        view()->share("mainUrl", $this->mainUrl);
    }

    public function getData(Request $request)
    {
        $formArray = filterDataTableToArray($request->form);
        $query = $this->permissionEntity->select("id", "code", "name");

        foreach ($formArray as $key => $attribute) {
            if (!empty($attribute)) {
                $query = $query->where($key, "like", "%{$attribute}%");
            }
        }

        $canEdit = auth()->user()->can('edit master-data institutional-permission');
        $canDelete = auth()->user()->can('delete master-data institutional-permission');
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

    public function create(InstitutionalPermissionRequest $request)
    {
        $this->permissionEntity->create($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been saved");
    }

    public function edit(InstitutionalPermissionRequest $request, $id)
    {
        $permissionEntity = $this->permissionEntity->findOrFail($id);

        $permissionEntity->update($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been updated");
    }

    public function delete($id)
    {
        $permissionEntity = $this->permissionEntity->findOrFail($id);
        try {
            $permissionEntity->delete();
            return redirect($this->mainUrl)->with("success", "Data has been deleted");
        } catch (Exception $e) {
            return redirect($this->mainUrl)->with("info", "Data cannot be deleted, because this data already used");
        }
    }

    public function getAll()
    {
        return $this->permissionEntity->all();
    }
}
