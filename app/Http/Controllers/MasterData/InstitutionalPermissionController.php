<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\MasterData\MasterDataController;
use App\Http\Requests\MasterData\InstitutionalPermissionRequest;
use App\Models\MasterInstitutionalPermission;
use App\Services\MasterData\InstitutionalPermissionService;
use Illuminate\Http\Request;

class InstitutionalPermissionController extends MasterDataController
{

    public MasterInstitutionalPermission $permission;
    public InstitutionalPermissionService $permissionService;

    public function __construct(
        InstitutionalPermissionService $permissionService,
        MasterInstitutionalPermission $permission
    ) {
        parent::__construct();

        $this->view .= "institutional-permission.";
        $this->permissionService = $permissionService;
        $this->permission = $permission;
    }

    public function getData(Request $request)
    {
        return $this->permissionService->getData($request);
    }

    public function getIndex()
    {
        return $this->makeView("index",array('moduleNav'=>'institutionalpermission'));
    }

    public function getCreate()
    {
        return $this->makeView("form", [
            "model" => $this->permission,
            'moduleNav'=>'institutionalpermission'
        ]);
    }

    public function postCreate(InstitutionalPermissionRequest $request)
    {
        return $this->permissionService->create($request);
    }

    public function getEdit($id)
    {
        $model = $this->permission->findOrFail($id);

        return $this->makeView("form", [
            "model" => $model,
            'moduleNav'=>'institutionalpermission'
        ]);
    }

    public function postEdit(InstitutionalPermissionRequest $request, $id)
    {
        return $this->permissionService->edit($request, $id);
    }

    public function getDelete($id)
    {
        return $this->permissionService->delete($id);
    }

}