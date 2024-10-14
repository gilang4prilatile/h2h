<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Requests\StoreRatePreferenceRequest;
use App\Http\Requests\UpdateRatePreferenceRequest;
use App\Models\InboundDetail;
use App\Models\OutboundDetail;
use App\Models\RatePreference;
use Illuminate\Http\Request;

class RatePreferenceController extends MasterDataController
{
    public function __construct() {
        parent::__construct();

        $this->view .= "rate-preference.";
        $this->mainUrl = url('master-data/rate-preference');

        view()->share("mainUrl", $this->mainUrl);
    }

    public function getData(Request $request) {
        $formArray = filterDataTableToArray($request->form);

        $query = RatePreference::select('*');

        foreach ($formArray as $key => $attribute) {
            if (!empty($attribute)) {
                $query = $query->where($key, "like", "%{$attribute}%");
            }
        }

        $canEdit = auth()->user()->can('edit master-data rate-preference');
        $canDelete = auth()->user()->can('delete master-data rate-preference');
        return datatables()->of($query)
            ->addColumn("actions", function ($row) use ($canEdit, $canDelete) {
                return view("components.table.actions", [
                    "actions" => [
                        "edit" => !$canEdit ? null : [
                            "url" => $this->mainUrl . '/edit/' . $row->id,
                        ],
                        "delete" => !$canDelete ? null : [
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
    public function index()
    {
        return $this->makeView("index",array('moduleNav'=>'rate-preference'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
        return $this->makeView("form", [
            "model" => new RatePreference(),
            "moduleNav" => "rate-preference"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRatePreferenceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function postCreate(StoreRatePreferenceRequest $request)
    {
        if (RatePreference::create($request->all())) {
            return redirect($this->mainUrl)->with("success", "Data has been saved");
        }

        return redirect($this->mainUrl)->with("error", "Failed to saved the data");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RatePreference  $ratePreference
     * @return \Illuminate\Http\Response
     */
    public function getEdit($id)
    {
        //
        return $this->makeView("form", [
            "model" => RatePreference::find($id),
            'moduleNav'=>'rate-preference',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RatePreference  $ratePreference
     * @return \Illuminate\Http\Response
     */
    public function postEdit(UpdateRatePreferenceRequest $request, $id)
    {
        if (RatePreference::find($id)->update($request->all())) {
            return redirect($this->mainUrl)->with("success", "Data has been updated");
        }

        return redirect($this->mainUrl)->with("error", "Failed to update the specified resource");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRatePreferenceRequest  $request
     * @param  \App\Models\RatePreference  $ratePreference
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRatePreferenceRequest $request, RatePreference $ratePreference)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RatePreference  $ratePreference
     * @return \Illuminate\Http\Response
     */
    public function getDelete($id)
    {
        $checkdetailinbound  = InboundDetail::where('details->rate_preference',$id)->first();
        $checkdetailoutbound = OutboundDetail::where('details->rate_preference',$id)->first();
        try {
            if($checkdetailinbound == null && $checkdetailoutbound == null){
                RatePreference::find($id)->delete();
                return redirect($this->mainUrl)->with("success", "Data has been deleted");
            }
            else{
                return redirect($this->mainUrl)->with("info", "Data cannot be deleted, because this data already used");
            }
        } catch (\Throwable $th) {
            return redirect($this->mainUrl)->with("info", "Data cannot be deleted, because this data already used");
        }
    }
}
