<?php

namespace App\Services\MasterData;

use App\Models\MasterTpb;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\MasterData\TpbRequest;

class TpbService
{
    private MasterTpb $tpbEntity;
    public string $mainUrl;

    public function __construct(
        MasterTpb $tpbEntity
    ) {
        $this->tpbEntity = $tpbEntity;

        $this->mainUrl = url('master-data/tpb');

        view()->share("mainUrl", $this->mainUrl);
    }

    public function getData(Request $request)
    {
    }

    public function create(TpbRequest $request)
    {
        $this->tpbEntity->create($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been saved");
    }

    public function edit(TpbRequest $request, $id)
    {
        $tpbEntity = $this->tpbEntity->findOrFail($id);

        $tpbEntity->update($request->all());

        return redirect($this->mainUrl)->with("success", "Data has been updated");
    }

    public function delete($id)
    {
        $tpbEntity = $this->tpbEntity->findOrFail($id);
        try {
            $tpbEntity->delete();
            return redirect($this->mainUrl)->with("success", "Data has been deleted");
        } catch (Exception $e) {
            return redirect($this->mainUrl)->with("info", "Data cannot be deleted, because this data already used");
        }
    }

    public function getAll()
    {
        return $this->tpbEntity->all();
    }
}
