<?php

namespace App\Services\UserAdministration;

use Exception;
use Html;
use App\User;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use App\Helpers\GeneralHelper;
use App\Http\Requests\UserAdministration\StoreUserRequest;
use App\Http\Requests\UserAdministration\UpdateUserRequest;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserAdministration\UserRequest;
use App\Models\Good;
use App\Models\Inbound;
use App\Models\Outbound;
use App\Models\Profile;
use Illuminate\Support\Facades\Log;

class UserService
{
    private User $userEntity;
    private Role $roleEntity;
    private Warehouse $warehouseEntity;

    public string $mainUrl;

    public function __construct(
        User      $userEntity,
        Role      $roleEntity,
        Warehouse $warehouseEntity
    ) {
        $this->userEntity = $userEntity;
        $this->roleEntity = $roleEntity;
        $this->warehouseEntity = $warehouseEntity;

        $this->mainUrl = url('user-administration/user');

        view()->share("mainUrl", $this->mainUrl);
    }

    public function getData(Request $request)
    {

        $user = auth()->user();
        $formArray = filterDataTableToArray($request->form);
        $query = $this->userEntity->with(['warehouse'])
            ->where("id", "!=", 1);

        if (!$user->hasRole(['Super Admin'])) {
            $query->where('profile_id', $user->profile_id);
            $query->where('warehouse_id', $user->warehouse_id);
        }

        foreach ($formArray as $key => $attribute) {
            if (!empty($attribute)) {
                $query = $query->where($key, "like", "%{$attribute}%");
            }
        }

        return datatables()->eloquent($query)

            ->addColumn('role', function ($row) {
                return join(", ", $row->getRoleNames()->toArray());
            })
            ->addColumn('warehouse', function ($row) {
                return @$row->warehouse->name;
            })
            ->addColumn("actions", function ($row) {
                $user = User::find($row->id);
                if ($user->active == 1) {
                    return view("components.table.actions", [
                        "actions" => [
                            "edit" => [
                                "url" => $this->mainUrl . '/edit/' . $row->id,
                            ],
                            "delete" => [
                                "url" => $this->mainUrl . '/delete/' . $row->id,
                            ],
                            "disable" => [
                                "url" => $this->mainUrl . '/disable/' . $row->id,
                            ],
                        ]
                    ]);
                } else if ($user->active == 0) {
                    return view("components.table.actions", [
                        "actions" => [
                            "edit" => [
                                "url" => $this->mainUrl . '/edit/' . $row->id,
                            ],
                            "delete" => [
                                "url" => $this->mainUrl . '/delete/' . $row->id,
                            ],
                            "enable" => [
                                "url" => $this->mainUrl . '/enable/' . $row->id,

                            ],

                        ]
                    ]);
                }
            })
            ->make();
    }



    public function enable($id)
    {
        try {
            $user = User::find($id);
            $user->active = 1;
            $user->save();
            return redirect($this->mainUrl)->with("success", "User has been enabled");
        } catch (Exception $e) {
            return redirect($this->mainUrl)->with("error", "Whoops something went wrong");
        }
    }

    public function disable($id)
    {
        try {
            $user = User::find($id);
            $user->active = 0;
            $user->save();
            return redirect($this->mainUrl)->with("success", "User has been disabled");
        } catch (Exception $e) {
            return redirect($this->mainUrl)->with("error", "Whoops something went wrong!");
        }
    }


    public function create(StoreUserRequest $request)
    {
        DB::beginTransaction();
        try {
            $inputs = $request->all();
            $inputs['password'] = Hash::make($request->password);

            $user = $this->userEntity->create($inputs);

            $role = Role::find($inputs["role_id"]);
            $user->assignRole($role);

            DB::commit();

            return redirect($this->mainUrl)->with("success", "Data has been saved");
        } catch (Exception $e) {
            DB::rollback();

            Log::emergency("error when updating role " . $e->getMessage() . ", line:" . $e->getLine());

            return redirect($this->mainUrl)->with("error", "Whoops something went wrong!");
        }
    }

    public function edit(UpdateUserRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $inputs = $request->all();

            if(isset($inputs['switch_password'])){
                $inputs['password'] = Hash::make($request->password);
            }
            
            $user = $this->userEntity->findOrFail($id);
            $user->update($inputs);

            $role = Role::find($inputs["role_id"]);
            $user->syncRoles([$role]);
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
        DB::beginTransaction();
        $user = auth()->user();

        if ($id == 1 && $user->id != 1) {
            abort(401);
        }

        try {
            $userEntity = $this->userEntity->findOrFail($id);
            $userEntity->delete();
            DB::commit();
            return redirect($this->mainUrl)->with("success", "Data has been deleted");
        } catch (Exception $e) {
            DB::rollback();
            return redirect($this->mainUrl)->with("info", "Data cannot be deleted, because this data already used");
        }
    }

    public function getRoleArray(): array
    {
        $roles = $this->roleEntity
            ->where("name", "!=", "Super Admin")
            ->get()
            ->pluck("name", "id")
            ->toArray();

        $roles = ['' => ''] + $roles;

        return $roles;
    }

    public function createProperties()
    {
        $warehouses = null;
        $user = auth()->user();
        if (!$user->hasRole(['Super Admin'])) {
            $warehouses = Warehouse::where('id', $user->warehouse_id);
        } else {
            $warehouses = Warehouse::all();
        }

        return [
            "roles" => $this->getRoleArray(),
            "warehouses" => $warehouses->pluck('name', 'id'),
            "model" => $this->userEntity,
            'moduleNav' => 'user',
            "canChangeClientOrRole" => true,
            "profiles" => Profile::whereRaw("JSON_CONTAINS(types, '[\"user\"]')")->pluck('name', 'id')
        ];
    }

    public function editProperties($id)
    {
        $warehouses = null;
        $user = auth()->user();
        if (!$user->hasRole(['Super Admin'])) {
            $warehouses = Warehouse::where('id', $user->warehouse_id);
        } else {
            if ($id == 1) {
                abort(401);
            }
            $warehouses = Warehouse::all();
        }

        $canChangeClientOrRole = true;

        $model = $this->userEntity->findOrFail($id);
        $model->role_id = $model->roles()->first()->id;

        $inboundsUser   = Inbound::where('created_by', $user->id)->get();
        $outboundsUser  = Outbound::where('created_by', $user->id)->get();
        $goodsUser      = Good::where('created_by', $user->id)->get();

        if ($inboundsUser || $outboundsUser || $goodsUser) {
            $canChangeClientOrRole = false;
        }

        return [
            "roles" => $this->getRoleArray(),
            "warehouses" => $warehouses->pluck('name', 'id'),
            "model" => $model,
            'moduleNav' => 'user',
            "canChangeClientOrRole" => $canChangeClientOrRole,
            "profiles" => Profile::whereRaw("JSON_CONTAINS(types, '[\"user\"]')")->pluck('name', 'id')
        ];
    }

    public function indexProperties()
    {
        return [
            "roles" => $this->getRoleArray(),
            "warehouses" => $this->warehouseEntity->getSelectBox(),
            'moduleNav' => 'user'
        ];
    }
}
