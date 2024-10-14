<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterData\IncotermsRequest;
use App\Models\InboundDetail;
use App\Models\MasterIncoterm;
use App\Services\MasterData\IncotermsService;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class IncotermsController extends MasterDataController
{

    public MasterIncoterm $incotermEntity;
    public IncotermsService $incotermService;

    public function __construct(
        MasterIncoterm $incotermEntity,
        IncotermsService $incotermService
    )
    {
        parent::__construct();

        $this->view .= "incoterms";
        $this->incotermService = $incotermService;
        $this->incotermEntity = $incotermEntity;
    }

    public function getData(Request $request)
    {
        return $this->incotermService->getData($request);
    }

    public function getCreate2(){
        $__user = auth()->user();

        $moduleNav = 'incoterms';

        return view('master-data.incoterms.Cform',compact('__user','moduleNav'));
    }

    public function getCreate()
    {
        return $this->makeView("form", [
            "model" => $this->incotermEntity,
            'moduleNav'=>'incoterms'
        ]);
    }
    
    public function getIndex(){
        return $this->makeView("index",array('moduleNav'=>'incoterms'));
    }

    public function getIndex2(){
        $getdata = DB::table('master_incoterms')
                   ->select('*')->orderBy('code','ASC')->get();

        $__user = auth()->user();

        $moduleNav = 'incoterms';

        return view('master-data.incoterms.index',compact('getdata','__user','moduleNav'));
    }

    
    public function postCreate(IncotermsRequest $request){
        // $request->validate([
        //     'code' => 'required|unique:master_incoterms,code',
        //     'decs' => 'required'
        // ]);
        // $__user = auth()->user();

        // DB::table('master_incoterms')->insert([
        //     'code' => $request['code'],
        //     'description' => $request['decs'],
        //     'created_at' => date('Y-m-d H:i:s'),
        //     'updated_at' => date('Y-m-d H:i:s'),
        //     'created_by' => $__user->id
        // ]);

        return $this->incotermService->create($request);
    }

    public function getDelete($id){
        return $this->incotermService->delete($id);
    }

    // public function getEdit2($id){
    //     $getupdate = DB::table('master_incoterms')
    //                  ->select('*')->where('id','=',$id)->first();

    //     $__user = auth()->user();

    //     $moduleNav = 'incoterms';

    //     return view('master-data.incoterms.Eform', compact('getupdate','__user','moduleNav'));
    // }

    public function getEdit($id)
    {
        $model = $this->incotermEntity->findOrFail($id);

        return $this->makeView("form", [
            "model" => $model,
            'moduleNav'=>'incoterms'
        ]);
    }

    
    public function postEdit(IncotermsRequest $request, $id)
    {
        return $this->incotermService->edit($request, $id);
    }

    // public function postEdit(Request $request, $id){
    //     $request->validate([
    //         'code' => 'required|unique:master_incoterms,code,'.$id,
    //         'decs' => 'required'
    //     ]);
    //     $__user = auth()->user();

    //     DB::table('master_incoterms')->where('id','=',$id)->update([
    //         'code' => $request['code'],
    //         'description' => $request['decs'],
    //         'updated_at' => date('Y-m-d H:i:s'),
    //         'updated_by' => $__user->id
    //     ]);

    //     return redirect()->action([IncotermsController::class, 'getIndex']);
    // }
}
