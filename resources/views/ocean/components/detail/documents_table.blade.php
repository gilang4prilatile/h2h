<h2 class="fw-bolder mt-4">Dokumen</h2>
<table class="table align-middle table-row-dashed fs-6 gy-5" id="table-documents">
    <!--begin::Table head-->
    <thead>
        <!--begin::Table row-->
        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
            <th class="min-w-125px">Jenis Dokumen</th>
            <th class="min-w-125px">Tanggal</th>
            <th class="min-w-125px">Nomor Dokumen</th>
            <th class="min-w-125px">File</th>
        </tr>
        <!--end::Table row-->
    </thead>
    <!--end::Table head-->
    <!--begin::Table body-->
    <tbody class="text-gray-600 fw-bold">

    </tbody>
    <!--end::Table body-->
</table>

@push('js')
<script>
    var deleteGoodById = null;
    var editGoodById = null;

    $(document).ready(function() {
        
        var table = $('#table-documents').DataTable({
            data: inboundDocuments,
            paging: false,
            columns: [
                {
                    data: 'master_document.code_name',
                    name : 'master_document.code_name',
                    render: (data, type, row) => {
                        if(row.document_id != 104)
                            return '<div>'+ data +'<div>';
                        else
                            return ''
                        }
                },
                {
                    data: 'details.date',
                    name: 'details.date',
                    render: (data, type, row) => {
                        if(row.document_id != 104)
                            return '<div>'+ data +'<div>';
                        else
                            return ''
                        }
                },
                {
                    data: 'details.nomor_dokumen',
                    name: 'details.nomor_dokumen',
                    render: (data, type, row) => {
                        if(row.document_id != 104)
                            return '<div>'+ data +'<div>';
                        else
                            return ''
                        }
                },
                {
                    data: 'file.name',
                    name: 'file.name',
                    defaultContent: '',
                    render: (data, type, row) => {
                        if(row.document_id != 104)
                            return `<div id='file' class="btn-group "><span class="mt-5 mt-md-10" style="margin-right:14px;margin-top:20px;">${data}</span><button onclick="window.open('${row.file.path}', '_blank')" class="btn_link btn btn-sm btn-light-success mt-3 mt-md-8" download="" > <i class="la la-file"></i></button></div>`;
                        else
                            return ''
                    }


                },
            ],
        });
    })
</script>
@endpush
