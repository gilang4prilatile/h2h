<?php

namespace App\Services\UserAdministration;

use Exception;
use Illuminate\Http\Request;
use App\Helpers\GeneralHelper;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\UserAdministration\RoleRequest;
use Illuminate\Support\Facades\Log;

class RoleService
{
    private Role $roleEntity;
    private Permission $permissionEntity;
    public string $mainUrl;

    public function __construct(
        Role       $roleEntity,
        Permission $permissionEntity
    )
    {
        $this->roleEntity = $roleEntity;
        $this->permissionEntity = $permissionEntity;

        $this->mainUrl = url('user-administration/role');

        view()->share("mainUrl", $this->mainUrl);
    }

    public function getData(Request $request)
    {
        $formArray = filterDataTableToArray($request->form);
        $query = $this->roleEntity
            ->select("id", "name")
            ->where('name', '<>', 'Super Admin');

        $user = auth()->user();
        if (!$user->hasRole(['Super Admin'])) {
            $query->where('name', $user->getRoleNames()->toArray());
        } 

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

    public function create(RoleRequest $request)
    {
        DB::beginTransaction();

        try {
            $role = $this->roleEntity->create([
                "name" => $request->name,
            ]);

            if (!empty($request->action)) {
                foreach ($request->action as $action) {
                    $permission = $this->permissionEntity->updateOrCreate([
                        "name" => $action,
                    ]);

                    $role->givePermissionTo($permission);
                }
            }

            DB::commit();

            return redirect($this->mainUrl)->with("success", "Data has been saved");
        } catch (Exception $e) {
            DB::rollback();

            Log::emergency("error when creating role " . $e->getMessage() . ", line:" . $e->getLine());

            return redirect($this->mainUrl)->with("error", "Whoops something went wrong!");
        }
    }

    public function edit(RoleRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $roleEntity = $this->roleEntity->findOrFail($id);

            $roleEntity->update($request->all());

            foreach ($this->permissionEntity->all() as $perm) {
                $roleEntity->revokePermissionTo($perm->name);
            }

            if (!empty($request->action)) {
                foreach ($request->action as $action) {
                    $permission = $this->permissionEntity->updateOrcreate([
                        "name" => $action,
                    ]);

                    $roleEntity->givePermissionTo($permission);
                }
            }

            DB::commit();

            return redirect($this->mainUrl)->with("success", "Data has been updated");
        } catch (Exception $e) {
            DB::rollback();

            Log::emergency("error when updating role " . $e->getMessage() . ", line:" . $e->getLine());

            return redirect($this->mainUrl)->with("error", "Whoops something went wrong!");
        }
    }

    public function delete($id)
    {
        $roleEntity = $this->roleEntity->findOrFail($id);
        try {
            $roleEntity->delete();
            return redirect($this->mainUrl)->with("success", "Data has been deleted");
        } catch (Exception $e) {
            return redirect($this->mainUrl)->with("info", "Data cannot be deleted, because this data already used");
        }
    }
}
