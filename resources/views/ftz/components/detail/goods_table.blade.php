<table class="table align-middle table-row-dashed fs-6 gy-5" id="table">
    <!--begin::Table head-->
    <thead>
        <!--begin::Table row-->
        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
            <th class="min-w-125px">Kode Barang</th>
            <th class="min-w-125px">Nama Barang</th>
            <th class="min-w-125px">Kuantitas</th>
            <th class="min-w-125px">Total Partial</th>
            <th class="min-w-125px">Partial</th>
            <th class="min-w-125px">Actions</th>
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
        // function convertFormToJSON(form) {
        //     const array = $(form).serializeArray(); // Encodes the set of form elements as an array of names and values.
        //     const json = {};
        //     $.each(array, function () {
        //         const isArray = this.name.includes('[]');
        //         if (isArray) {
        //             const name = this.name.replace('[]', '');
        //             if (!json[name]) {
        //                 json[name] = [];
        //             }
        //             json[name].push(this.value);
        //         } else {
        //             const nestedName = this.name.substring(this.name.indexOf("[") + 1, this.name.lastIndexOf("]"))
        //             if (nestedName.length == 0) {
        //                 json[this.name] = this.value || "";
        //             } else {
        //                 const parentName = this.name.substring(0, this.name.indexOf("["))
        //                 json[parentName] = json[parentName] || {};
        //                 Object.assign(json[parentName], {[nestedName]: this.value || ""})

        //             }
        //         }
        //     });
        //     return json;
        // }

        function float(equation, precision = 9) {
            return Math.floor(equation * (10 ** precision)) / (10 ** precision);
        }
        var table = $('#table').DataTable({
            data: @json($arrayku),
            paging: false,
            columns: [
                {
                    data: 'kode_barang',
                    name: 'kode_barang',
                },
                {
                    data: 'name',
                    name: 'name',
                },
                {
                    data: 'quantity',
                    name: 'quantity',
                    render : function(data, type, meta){
                        return float(data);
                    }
                },
                {
                    data: 'total_partial',
                    name: 'total_partial',
                    render : function(data, type, meta){
                        return float(data);
                    }
                },
                {
                    "data": "kode_barang",
                    "render": function(data, type, row, meta){
                     
                        if ({{ $inbound->partial }} != 0 ) {
                            data = '<div class="btn-group"><a class="btn btn-light-warning" href="{{ $partialLink }}/{{ $inbound->id }}/'+ data +'"><i class="fas fa-truck-moving"></i> Partial</a>';
                            return data;
                        }
                        else{
                            data = '<div class="btn-group"><a class="btn btn-light-warning" style="display: none" href="inbound/bc-40/detail/partial/'+ {{ $inbound->id }} +'/'+ data +'" target="_blank"><i class="fas fa-truck-moving"></i>Partial</a>';
                            return data;
                        }
                    },
                    
                },
                {
                    "data": 'inboundDetail_id',
                    "render": function(data, type, row, meta){

                            data = '<button type="button" class="btn btn-warning btn-sm buttonbuatklik" onclick="editGoodById('+data+')">View</button>';

                            return data;
                    },
                    
                }
            ],
            // "columnDefs": [
            //     {
            //         "targets": 3,
            //         "render": function (val, type, data, meta) { // Note: not sure what "val" is actually
            //             return (
            //                 '<div class="btn-group">' +
            //                     '<button type="button" class="btn btn-warning btn-sm" onclick="editGoodById({{ $inbound->inboundDetails[0]->id }})">Edit</button>'
            //                 '</div>'
            //             );
            //         },
            //     },
            // ]
        });

        editGoodById = (id) => {

            const inboundDetail = inboundDetails.find(function (val) {return val.id == id})
            const details = inboundDetail.details
            selectedInboundDetail = inboundDetail

            // Set Form
            // let data = $('#table-documents').repeaterVal().inbound_documents.map((v, i, array) => {
            //     return {id: i, text: `${v.nomor_dokumen} ${v.date}`}
            // })
            // $('#good-document-options').select2({data})

            // Set GoodDocument
            $.ajax({
                type    : 'GET',
                url     : `/inbound-details/data-detail-document/${id}`,
                success: function(res) {
                    var goodDocumentOptions = [];
                    $.each(res.inboundDocuments, (i , vl) => {
                        goodDocumentOptions.push((vl.seri_document - 1));
                    });

                    $('#good-document-options').val(goodDocumentOptions).trigger('change')
                }
            })
            $('#name').val(selectedInboundDetail.good.name).trigger('change');
            $('#uom_id').val(selectedInboundDetail.good.uom_id).trigger('change')
            $('#package_id').val(selectedInboundDetail.package_id).trigger("change")
            $('#hscode_id').val(selectedInboundDetail.hs_code_id).trigger('change');
            FormDataJson.fromJson($('#add-form'), selectedInboundDetail)
            $('#add-modal').modal('show');

            }
    });
</script>

@endpush