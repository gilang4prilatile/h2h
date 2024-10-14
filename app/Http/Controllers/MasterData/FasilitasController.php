<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Requests\MasterData\FasilitasRequest;
use App\Models\fasilitas;
use App\Http\Requests\StorefasilitasRequest;
use App\Http\Requests\UpdatefasilitasRequest;
use App\Models\InboundDetail;
use App\Models\MasterFasilitas;
use App\Models\OutboundDetail;
use App\Services\MasterData\FasilitasService;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class FasilitasController extends MasterDataController
{

    public MasterFasilitas $masterFasilitasEntity;
    public FasilitasService $fasilitasService;

    public function __construct(
        MasterFasilitas $masterFasilitasEntity,
        FasilitasService $fasilitasService
    )
    {
        parent::__construct();

        $this->view .= "fasilitas.";
        $this->masterFasilitasEntity = $masterFasilitasEntity;
        $this->fasilitasService = $fasilitasService;
    }

    public function getData(Request $request)
    {
        return $this->fasilitasService->getData($request);
    }

    public function getCreate(){
        return $this->makeView('form', [
            "model" => $this->masterFasilitasEntity,
            "moduleNav" => "fasilitas",
        ]);
    }

    public function postCreate(FasilitasRequest $request){
        return $this->fasilitasService->create($request);
    }

    public function getIndex(){
        return $this->makeView("index" , array("moduleNav" => "fasilitas"));
    }

    public function getEdit($id){
        $model = $this->masterFasilitasEntity->findOrFail($id);

        return $this->makeView("form", [
            "model" => $model,
            'moduleNav'=>'fasilitas'
        ]);
    }

    public function postEdit(FasilitasRequest $request, $id){
        return $this->fasilitasService->edit($request, $id);
    }
    
    public function getDelete($id){
        return $this->fasilitasService->delete($id);
    }

}
