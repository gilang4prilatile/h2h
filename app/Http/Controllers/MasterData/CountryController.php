<?php

namespace App\Http\Controllers\MasterData;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Services\MasterData\CountryService;
use App\Http\Requests\MasterData\CountryRequest;

class CountryController extends MasterDataController
{
    public Country $countryEntity;
    public CountryService $countryService;

    public function __construct(
        CountryService $countryService,
        Country $countryEntity
    ) {
        parent::__construct();

        $this->view .= "country.";
        $this->countryService = $countryService;
        $this->countryEntity = $countryEntity;
    }

    public function getData(Request $request)
    {
        return $this->countryService->getData($request);
    }

    public function getIndex()
    {
        $data['moduleNav'] = 'country';
        return $this->makeView("index",$data);
    }

    public function getCreate()
    {
        return $this->makeView("form", [
            "model" => $this->countryEntity,
            "moduleNav" => 'country'
        ]);
    }

    public function postCreate(CountryRequest $request)
    {
        return $this->countryService->create($request);
    }

    public function getEdit($id)
    {
        $model = $this->countryEntity->findOrFail($id);

        return $this->makeView("form", [
            "model" => $model,
            "moduleNav" => 'country'
        ]);
    }

    public function postEdit(CountryRequest $request, $id)
    {
        return $this->countryService->edit($request, $id);
    }

    public function getDelete($id)
    {
        return $this->countryService->delete($id);
    }
}
