<?php

namespace App\Http\Controllers\MasterData;

use App\Models\MasterPackage;
use Illuminate\Http\Request;
use App\Services\MasterData\PackageService;
use App\Http\Requests\MasterData\PackageRequest;

class PackageController extends MasterDataController
{
    public MasterPackage $packageEntity;
    public PackageService $packageService;

    public function __construct(
        PackageService $packageService,
        MasterPackage $packageEntity
    ) {
        parent::__construct();

        $this->view .= "package.";
        $this->packageService = $packageService;
        $this->packageEntity = $packageEntity;
    }

    public function getData(Request $request)
    {
        return $this->packageService->getData($request);
    }

    public function getIndex()
    {
        return $this->makeView("index",array('moduleNav'=>'package'));
    }

    public function getCreate()
    {
        return $this->makeView("form", [
            "model" => $this->packageEntity,
            'moduleNav'=>'package'
        ]);
    }

    public function postCreate(PackageRequest $request)
    {
        return $this->packageService->create($request);
    }

    public function getEdit($id)
    {
        $model = $this->packageEntity->findOrFail($id);

        return $this->makeView("form", [
            "model" => $model,
            'moduleNav'=>'package'
        ]);
    }

    public function postEdit(PackageRequest $request, $id)
    {
        return $this->packageService->edit($request, $id);
    }

    public function getDelete($id)
    {
        return $this->packageService->delete($id);
    }
}
