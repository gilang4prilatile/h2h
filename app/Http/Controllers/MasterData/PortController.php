<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\MasterData\MasterDataController;
use App\Http\Requests\StorePortRequest;
use App\Http\Requests\UpdatePortRequest;
use App\Models\Country;
use App\Models\MasterKppbc;
use App\Models\Port;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\PotentiallyMissing;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Routing\Loader\ProtectedPhpFileLoader;

class PortController extends MasterDataController 
{
    public Country $countries;
    public MasterKppbc $masterKppbc;

    public function __construct(
        Country $countries,
        MasterKppbc $masterKppbc
    )
    {
        parent::__construct();
        $this->view .= "port.";
        $this->mainUrl = url('master-data/port');
        $this->countries = $countries;
        $this->masterKppbc = $masterKppbc;

        view()->share("mainUrl", $this->mainUrl);
    }

    public function getData(Request $request) {
        $formArray = filterDataTableToArray($request->form);

        $query = Port::with('createdBy')->select('*');

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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $countries = $this->countries->all()->pluck('name', 'id')->toArray();       
        $masterKppbc = $this->masterKppbc->all()->pluck('description', 'id')->toArray();

        return $this->makeView('index', [
            "moduleNav" => "port",
            "countries" => [ "" => "-- Select --"] + $countries,
            "masterKppbc" => ["" => "-- Select --"] + $masterKppbc
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {

        $countries = $this->countries->all()->pluck('name', 'id')->toArray();      
        $masterKppbc = $this->masterKppbc->all()->pluck('description', 'id')->toArray();

        return $this->makeView('form', [
            "model" => new Port(),
            "moduleNav" => "port",
            "countries" => ["" => "-- Select --"] + $countries,
            "masterKppbc" => ["" => "-- Select --"] + $masterKppbc
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePortRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function postCreate(StorePortRequest $request)
    {

        if (Port::create($request->all())) {
            return redirect($this->mainUrl)->with("success", "Data has been saved");
        }

        return redirect($this->mainUrl)->with("success", "Failed to saved the data");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Port  $port
     * @return \Illuminate\Http\Response
     */
    public function getEdit($id)
    {
        $model = Port::findOrFail($id);
        $countries = $this->countries->all()->pluck('name', 'id')->toArray();    
        $masterKppbc = $this->masterKppbc->all()->pluck('description', 'id')->toArray();

        return $this->makeView("form", [
            "model" => $model,
            "moduleNav" => "port",
            "countries" => ["" => "-- Select --"] + $countries,
            "masterKppbc" => ["" => "-- Select --"] + $masterKppbc
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Port  $port
     * @return \Illuminate\Http\Response
     */
    public function postEdit(UpdatePortRequest $request,$id)
    {
        if (Port::find($id)->update($request->all())) {
            return redirect($this->mainUrl)->with("success", "Data has been updated");
        }

        return redirect($this->mainUrl)->with("error", "Failed to update the specified resource");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePortRequest  $request
     * @param  \App\Models\Port  $port
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePortRequest $request, Port $port)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Port  $port
     * @return \Illuminate\Http\Response
     */
    public function destroy(Port $port)
    {
        //
    }

    public function getDelete($id)
    {
        try {
            Port::find($id)->delete();
            return redirect($this->mainUrl)->with("success", "Data has been deleted");
        } catch (\Throwable $th) {
            return redirect($this->mainUrl)->with("info", "Data cannot be deleted, because this data already used");
        }
    }

    public function getCountry($id)
    {
        $result = Port::find($id);
        if($result){
            return json_encode($result->country);
        }
        return null;
    }

    public function getMasterKppbc($id){
        $port = Port::find($id);
        if($port){
            if($port->master_kppbc_code == NULL){
                return json_encode([
                    'message'   => 'data not found'
                ]);
            }
    
            $masterKPPB = MasterKppbc::where('code', intval($port->master_kppbc_code))->first();
            return json_encode($masterKPPB);
        }
        return null;
   
    }

    public function getSearch(Request $request)
    {
        $search = $request->get('search');
        $result = Port::where('code', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%")
                    ->get()
                    ->map(function ($v) {
                        return [
                            "id"                => $v->id,
                            "text"              => $v->code . " - " . $v->name

                        ];
                    });
        return json_encode($result);
    }
}
