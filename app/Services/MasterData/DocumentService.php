<?php

namespace App\Services\MasterData;

use App\Models\MasterDocument;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\MasterData\DocumentRequest;

class DocumentService
{
    private MasterDocument $documentEntity;
    public string $mainUrl;

    public function __construct(
        MasterDocument $documentEntity
    ) {
        $this->documentEntity = $documentEntity;

        $this->mainUrl = url('master-data/document');

        view()->share("mainUrl", $this->mainUrl);
    }

    public function getData(Request $request)
    {
        $formArray = filterDataTableToArray($request->form);
        $query = $this->documentEntity->select("id", "code","name");

        foreach ($formArray as $key => $attribute) {
            if (!empty($attribute)) {
                $query = $query->where($key, "like", "%{$attribute}%");
            }
        }

        $canEdit = auth()->user()->can('edit master-data document');
        $canDelete = auth()->user()->can('delete master-data document');
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

    public function create(DocumentRequest $request)
    {

        $data_insert = array();
        $data_insert['code'] = $request->post('code');
        $data_insert['name'] = $request->post('name');
        if($request->hasFile('upload')){
            $file = $request->file('upload');
            $fileExt = $request->file('upload')->guessExtension();
            // $fileName = $file->getClientOriginalName();
            $fileName = date('YmdHis').".".$fileExt;
            $destinationPath = public_path().'/documents';
            $file->move($destinationPath,$fileName);
            $data_insert['file'] = $fileName;
            // echo $fileName;
        }

        $this->documentEntity->create($data_insert);

        return redirect($this->mainUrl)->with("success", "Data has been saved");
    }

    public function edit(DocumentRequest $request, $id)
    {
        $documentEntity = $this->documentEntity->findOrFail($id);
        $data_insert = array();
        $data_insert['code'] = $request->post('code');
        $data_insert['name'] = $request->post('name');
        if($request->hasFile('upload')){
            $file = $request->file('upload');
            $fileExt = $request->file('upload')->guessExtension();
            // $fileName = $file->getClientOriginalName();
            $fileName = date('YmdHis').".".$fileExt;
            $destinationPath = public_path().'/documents';
            $file->move($destinationPath,$fileName);
            $data_insert['file'] = $fileName;
            if($documentEntity->file!=null){
                unlink($destinationPath."/".$documentEntity->file);
            }
        }
        $documentEntity->update($data_insert);

        return redirect($this->mainUrl)->with("success", "Data has been updated");
    }

    public function delete($id)
    {
        $documentEntity = $this->documentEntity->findOrFail($id);
        try {
            $documentEntity->delete();
            return redirect($this->mainUrl)->with("success", "Data has been deleted");
        } catch (Exception $e) {
            return redirect($this->mainUrl)->with("info", "Data cannot be deleted, because this data already used");
        }
    }

    public function getAll()
    {
        return $this->documentEntity->all();
    }
}
