<?php
namespace App\Services\MasterData\Ftz;

use App\Http\Requests\MasterData\FtzOriginGoodRequest;
use App\Http\Requests\MasterData\OriginGoodRequest;
use App\Models\Ftz\MasterOriginGood;
use Exception;
use Illuminate\Http\Request;

class OriginGoodService
{
    private MasterOriginGood $masterOriginGoodFtz;
    public string $mainUrl;

    public function __construct(
        MasterOriginGood $masterOriginGoodFtz
    ) {
        $this->masterOriginGoodFtz = $masterOriginGoodFtz;

        $this->mainUrl = url('master-data/ftz-origin-of-goods');

        view()->share("mainUrl", $this->mainUrl);
    }

    public function getData(Request $request)
    {
        $formArray = filterDataTableToArray($request->form);
        $query = $this->masterOriginGoodFtz->select("id", "code", "name");

        foreach ($formArray as $key => $attribute) {
            if (!empty($attribute)) {
                $query = $query->where($key, "like", "%{$attribute}%");
            }
        }

        $canEdit = auth()->user()->can('edit master-data ftz-origin-of-goods');
        $canDelete = auth()->user()->can('delete master-data ftz-origin-of-goods');
        return datatables()->of($query)
            ->addColumn("actions", function ($row) use ($canEdit, $canDelete) {
                return view("components.table.actions", [
                    "actions" => [
                        "edit" => !$canEdit ? null : [
                            "url" => $this->mainUrl . '/edit/' . $row->id
                        ],
                        "delete" => !$canDelete ? null : [
                            "url" => $this->mainUrl . '/delete/' . $row->id
                        ],
                    ]
                ]);
            })
            ->make();
    }

    public function create(FtzOriginGoodRequest $request)
    {
        $this->masterOriginGoodFtz->create($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been saved");
    }

    public function edit(FtzOriginGoodRequest $request, $id)
    {
        $masterOriginGoodFtz = $this->masterOriginGoodFtz->findOrFail($id);

        $masterOriginGoodFtz->update($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been updated");
    }

    public function delete($id)
    {
        $masterOriginGoodFtz = $this->masterOriginGoodFtz->findOrFail($id);
        try {
            $masterOriginGoodFtz->delete();
            return redirect($this->mainUrl)->with("success", "Data has been deleted");
        } catch (Exception $e) {
            return redirect($this->mainUrl)->with("info", "Data cannot be deleted, because this data already used");
        }
    }

    public function getAll()
    {
        return $this->masterOriginGoodFtz->all();
    }
}
