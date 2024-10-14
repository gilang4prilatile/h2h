<?php

namespace App\Http\Controllers\MasterData;

use App\Models\MasterDocument;
use Illuminate\Http\Request;
use App\Services\MasterData\DocumentService;
use App\Http\Requests\MasterData\DocumentRequest;
use App\Models\InboundDocument;

class DocumentController extends MasterDataController
{
    public MasterDocument $documentEntity;
    public DocumentService $documentService;

    public function __construct(
        DocumentService $documentService,
        MasterDocument $documentEntity
    ) {
        parent::__construct();

        $this->view .= "document.";
        $this->documentService = $documentService;
        $this->documentEntity = $documentEntity;
    }

    public function getData(Request $request)
    {
        return $this->documentService->getData($request);
    }

    public function getIndex()
    {
        return $this->makeView("index",array('moduleNav'=>'document'));
    }

    public function getCreate()
    {
        return $this->makeView("form", [
            "model" => $this->documentEntity,
            'moduleNav'=>'document'
        ]);
    }

    public function postCreate(DocumentRequest $request)
    {
        return $this->documentService->create($request);
    }

    public function getEdit($id)
    {
        $model = $this->documentEntity->findOrFail($id);

        return $this->makeView("form", [
            "model" => $model,
            'moduleNav'=>'document'
        ]);
    }

    public function postEdit(DocumentRequest $request, $id)
    {
        return $this->documentService->edit($request, $id);
    }

    public function getDelete($id)
    {
        return $this->documentService->delete($id);
    }
    
    public function getDocumentbyid($id)
    {
        $dokumennya = InboundDocument::where('inbound_detail_id','=',$id)->where('document_id','!=', 104)->join('master_documents','master_documents.id','inbound_documents.document_id')->get();
        return $dokumennya;
    }
}
