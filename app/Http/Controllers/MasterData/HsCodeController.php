<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\MasterData\MasterDataController;
use App\Http\Requests\StoreHsCodeRequest;
use App\Http\Requests\UpdateHsCodeRequest;
use App\Models\HsCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HsCodeController extends MasterDataController
{
    public function __construct()
    {
        parent::__construct();

        $this->view .= "hscode.";
        $this->mainUrl = url('master-data/hscode');
        view()->share("mainUrl", $this->mainUrl);
    }

    public function getData(Request $request) {

        $formArray = filterDataTableToArray($request->form);

        $query = HsCode::select('*');

        foreach ($formArray as $key => $attribute) {
            if (!empty($attribute)) {
                
                if($key == 'type'){
                    $query = $query->where($key,  '=' , "$attribute");
                }else {
                    $query = $query->where($key,  'like' , "%$attribute%");
                }

            }
        }

        $canEdit = auth()->user()->can('edit master-data hscode');
        $canDelete = auth()->user()->can('delete master-data hscode');
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

    public function getOptions(Request $request) {
        $query = HsCode::select("*")->with('hsCode.hsCode.hsCode');
        if ($request->has('parent_id')) {
            $query->where('parent_id', $request->input('parent_id'));
        }

        if ($request->has('code')) {
            $query->where('code', 'like', '%'.$request->input('code').'%');
        }

        if ($request->has('type')) {
            $query->where('type', $request->input('type'));
        }

        return $query->get();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->makeView("index", [
            'moduleNav' => 'hscode',
            "types" => [
                "" => "-- Select --",
                "bag" => "Bag",
                "bab" => "Bab",
                "pos" => "Pos",
                "sub-pos" => "Sub Pos",
                "sub-pos-asean" => "Sub Pos Asean"
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
        return $this->makeView("form", [
            "model" => new HsCode(),
            "moduleNav" => "hscode",
            "tipe_form" => "create",
            "types" => [
                "" => "-- Select --",
                "bag" => "Bag",
                "bab" => "Bab",
                "pos" => "Pos",
                "sub-pos" => "Sub Pos",
                "sub-pos-asean" => "Sub Pos Asean"
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreHsCodeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function postCreate(StoreHsCodeRequest $request)
    {

        switch($request->type) {
        case "bab":
            $request['parent_id'] = $request->bag_id;
            break;
        case "pos":
            $request['parent_id'] = $request->bab_id;
            break;
        case "sub-pos":
            $request['parent_id'] = $request->pos_id;
            break;
        case "sub-pos-asean":
            $request['parent_id'] = $request->sub_pos_id;
            break;
        }
        if (HsCode::create($request->all())) {
            return redirect($this->mainUrl)->with("success", "Data has been saved");
        }

        return redirect($this->mainUrl)->with("error", "Failed to saved the data");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HsCode  $hsCode
     * @return \Illuminate\Http\Response
     */
    public function getEdit($id)
    {
        return $this->makeView("form", [
            "model" => HsCode::with('hsCode.hsCode.hsCode.hsCode')->find($id),
            "moduleNav" => "hscode",
            "tipe_form" => "edit",
            "types" => [
                "" => "-- Select --",
                "bag" => "Bag",
                "bab" => "Bab",
                "pos" => "Pos",
                "sub-pos" => "Sub Pos",
                "sub-pos-asean" => "Sub Pos Asean"
            ]
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HsCode  $hsCode
     * @return \Illuminate\Http\Response
     */
    public function postEdit(UpdateHsCodeRequest $request, $id)
    {
        switch($request->type) {
        case "bab":
            $request['parent_id'] = $request->bag_id;
            break;
        case "pos":
            $request['parent_id'] = $request->bab_id;
            break;
        case "sub-pos":
            $request['parent_id'] = $request->pos_id;
            break;
        case "sub-pos-asean":
            $request['parent_id'] = $request->sub_pos_id;
            break;
        }
        if (HsCode::find($id)->update($request->all())) {
            return redirect($this->mainUrl)->with("success", "Data has been updated");
        }

        return redirect($this->mainUrl)->with("error", "Failed to update the specified resource");
    }
    
    public function postCreateAjax(Request $request)
    {
        $details = [
            'bk' => null,
            'bm' => $request->input('bm'),
            'ppn' => $request->input('ppn'),
            'note' => null,
            'bm_ad' => null,
            'bm_im' => null,
            'bm_tp' => null,
            'cukai' => null,
            'ppnbm' => $request->input('ppnbm'),
            'pph_api' => null,
            'pph_non_api' => null,
            'status_lantas' => $request->input('status_lantas', '0'),
            'description_id' => $request->input('description_id', 'Lain-lain'),
            'description_eng' => $request->input('description_eng', 'Other')
        ];

        $hsCode = HsCode::firstOrCreate(
            ['code' => $request->input('code')],
            [
                'type' => 'sub-pos-asean',
                'details' => $details,
                'parent_id' => 3440,
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 1,
                'updated_by' => 1
            ]
        );

        return response()->json(['id' => $hsCode->id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHsCodeRequest  $request
     * @param  \App\Models\HsCode  $hsCode
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHsCodeRequest $request, HsCode $hsCode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HsCode  $hsCode
     * @return \Illuminate\Http\Response
     */
    public function getDelete($id)
    {
        try {
            HsCode::find($id)->delete();
            return redirect($this->mainUrl)->with("success", "Data has been deleted");
        } catch (\Throwable $th) {
            return redirect($this->mainUrl)->with("info", "Data cannot be deleted, because this data already used");
        }
    }

    public function getHsCodeByIdAjax($id) {
        return HsCode::find($id);
    }

    public function getSearch(Request $request)
    {
        $search = $request->get('search');
        $result = HsCode::where('code', 'like', "%{$search}%")
                    ->orWhere('type', 'like', "%{$search}%")
                    ->get()
                    ->map(function ($v) {
                        return [
                            "id"                => $v->code,
                            "text"              => $v->code . " - " . $v->type
                        ];
                    });
        return json_encode($result);
    }	
}
