<?php

namespace App\Http\Controllers\UserAdministration;

use Illuminate\Http\Request;
use App\Services\UserAdministration\RoleService;
use App\Http\Requests\UserAdministration\RoleRequest;
use DB;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends UserAdministrationController
{
    public RoleService $roleService;
    public Role $roleEntity;

    public function __construct(
        Role $roleEntity,
        RoleService $roleService,
    ) {
        parent::__construct();

        $this->view .= "role.";

        $this->roleService = $roleService;
        $this->roleEntity = $roleEntity;

        $this->mainUrl = url('user-administration/role');

        view()->share("mainUrl", $this->mainUrl);
    }

    public function getData(Request $request)
    {
        return $this->roleService->getData($request);
    }

    public function getIndex()
    {
        return $this->makeView("index",array('moduleNav'=>'role'));
    }

    public function getCreate()
    {
        $hasPermissions = [];

        $permissions = [];
        $user = auth()->user();
        if (!$user->hasRole(['Super Admin'])) {
            $userPermissions = $user->getAllPermissions()->pluck('id')->toArray();
            $permissions = Permission::whereIn('id', $userPermissions)->get();
        } else {
            $permissions = Permission::all();
        }
        return $this->makeView("add.add", [
            "model" => $this->roleEntity,
            "permissions" => $permissions,
            "moduleNav"=>'role',
            "hasPermissions" => [],
        ]);
    }

    public function postCreate(RoleRequest $request)
    {

        $validation = Validator::make($request->all(), [
            'permission_ids' => 'required'
        ]);

        if($validation->fails()){
            return redirect()->back()->with('error', 'Please check your input data !');
        }

        DB::beginTransaction();
        $permissions = Permission::whereIn("id", $request->permission_ids)->get();
        $role = Role::create(['name' => $request->name]);
        $rolePermissions = $role->givePermissionTo($permissions);
        
        if (!$role || !$rolePermissions) {
            DB::rollBack();
            return redirect($this->mainUrl)->with("error", "Whoops something went wrong!");
        }

        DB::commit();
        return redirect($this->mainUrl)->with("success", "Data has been saved");
    }

    public function getEdit($id)
    {
        $model = $this->roleEntity->findOrFail($id);

        $hasPermissions = $model->permissions->pluck('name', 'id');

        $permissions = [];
        $user = auth()->user();
        if (!$user->hasRole(['Super Admin'])) {
            $userPermissions = $user->getAllPermissions()->pluck('id')->toArray();
            $permissions = Permission::whereIn('id', $userPermissions)->get();
        } else {
            $permissions = Permission::all();
        }

        return $this->makeView("edit.edit", [
            "model" => $model,
            "permissions" => $permissions,
            "hasPermissions" => $hasPermissions,
            "moduleNav"=>'role',
        ]);
    }

    public function postEdit(RoleRequest $request, $id)
    {

        $validation = Validator::make($request->all(), [
            'permission_ids' => 'required'
        ]);

        if($validation->fails()){
            return redirect()->back()->with('error', 'Please check your input data !');
        }


        DB::beginTransaction();
        $permissions = Permission::whereIn("id", $request->permission_ids)->get();
        $role = Role::findById($id);
        $role->name = $request->name;
        $save = $role->save();
        $rolePermissions = $role->syncPermissions($permissions);
        
        if (!$save || !$rolePermissions) {
            DB::rollBack();
            return redirect($this->mainUrl)->with("error", "Whoops something went wrong!");
        }

        DB::commit();
        return redirect($this->mainUrl)->with("success", "Data has been saved");
    }

    public function getDelete($id)
    {
        return $this->roleService->delete($id);
    }
}
