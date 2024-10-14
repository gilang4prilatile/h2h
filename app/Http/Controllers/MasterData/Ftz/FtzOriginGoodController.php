<?php

namespace App\Http\Controllers\MasterData\Ftz;

use App\Http\Controllers\MasterData\MasterDataController;
use App\Http\Requests\MasterData\FtzOriginGoodRequest;
use App\Http\Requests\MasterData\OriginGoodRequest;
use App\Models\Ftz\MasterOriginGood;
use App\Services\MasterData\Ftz\OriginGoodService;
use Illuminate\Http\Request;

class FtzOriginGoodController extends MasterDataController
{

    public MasterOriginGood $masterOriginGoodFtz;
    public OriginGoodService $originGoodServiceFtz;

    public function __construct(
        OriginGoodService $originGoodServiceFtz,
        MasterOriginGood $masterOriginGoodFtz
    ) {
        parent::__construct();

        $this->view .= "ftz-origin-of-goods.";
        $this->originGoodServiceFtz = $originGoodServiceFtz;
        $this->masterOriginGoodFtz = $masterOriginGoodFtz;
    }

    public function getData(Request $request)
    {
        return $this->originGoodServiceFtz->getData($request);
    }

    public function getIndex()
    {
        return $this->makeView("index",array('moduleNav'=>'ftzorigingoods'));
    }

    public function getCreate()
    {
        return $this->makeView("form", [
            "model" => $this->masterOriginGoodFtz,
            'moduleNav'=>'ftzorigingoods'
        ]);
    }

    public function postCreate(FtzOriginGoodRequest $request)
    {
        return $this->originGoodServiceFtz->create($request);
    }

    public function getEdit($id)
    {
        $model = $this->masterOriginGoodFtz->findOrFail($id);

        return $this->makeView("form", [
            "model" => $model,
            'moduleNav'=>'ftzorigingoods'
        ]);
    }

    public function postEdit(FtzOriginGoodRequest $request, $id)
    {
        return $this->originGoodServiceFtz->edit($request, $id);
    }

    public function getDelete($id)
    {
        return $this->originGoodServiceFtz->delete($id);
    }

}