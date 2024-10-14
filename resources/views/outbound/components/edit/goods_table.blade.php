<table class="table align-middle table-row-dashed fs-6 gy-5" id="table">
    <!--begin::Table head-->
    <thead>
        <!--begin::Table row-->
        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
            <th class="min-w-125px">Kode Barang</th>
            <th class="min-w-125px">Nama Barang</th>
            <th class="min-w-125px">Kuantitas</th>
            <th class="text-end min-w-100px">Action</th>
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
    var detailGoodById = null;
    $(document).ready(function() {
        function convertFormToJSON(form) {
            const array = $(form).serializeArray(); // Encodes the set of form elements as an array of names and values.
            const json = {};
            $.each(array, function () {
                const isArray = this.name.includes('[]');
                if (isArray) {
                    const name = this.name.replace('[]', '');
                    if (!json[name]) {
                        json[name] = [];
                    }
                    json[name].push(this.value);
                } else {
                    const nestedName = this.name.substring(this.name.indexOf("[") + 1, this.name.lastIndexOf("]"))
                    if (nestedName.length == 0) {
                        json[this.name] = this.value || "";
                    } else {
                        const parentName = this.name.substring(0, this.name.indexOf("["))
                        json[parentName] = json[parentName] || {};
                        Object.assign(json[parentName], {[nestedName]: this.value || ""})

                    }
                }
            });
            return json;
        }
        
        function float(equation, precision = 9) {
            return Math.floor(equation * (10 ** precision)) / (10 ** precision);
        }

        var table = $('#table').DataTable({
            ajax: {
                type    : "GET",
                url     : `/outbound-details/data/${outbound.id}`,
                dataSrc : 'outboundDetails'
            },
            paging: false,
            columns: [
                {
                    data: 'details.kode_barang',
                    name: 'details.kode_barang',
                },
                {
                    data: 'good.name',
                    name: 'good.name',
                    defaultContent: '',
                },
                {
                    data: 'quantity',
                    name: 'quantity',
                    render : function(data, type, meta){
                        return float(data);
                    }
                },
                {
                    data: 'actions',
                    name: 'actions',
                    className : "text-end",
                    'ordering': false,
                    'width': '20%',
                },
            ],
            "columnDefs": [
                {
                    "targets": 3,
                    "render": function (val, type, data, meta) { // Note: not sure what "val" is actually
               
                        return (
                            '<div class="btn-group">' +
                                '<button id="btn-tambah-barang" data-detail-kode-barang="' + data['details']['kode_barang'] + '" data-bs-toggle="modal" data-bs-target="#detail-modal" type="button" class="btn btn-secondary btn-sm">Detail</button>' +
                                '<button type="button" class="btn btn-warning btn-sm" onclick="editGoodById('+ data['id'] +')">Edit</button>'+
                                '<button type="button" class="btn btn-danger btn-sm" onclick="deleteGood('+data['id']+')"">Delete</button>'+
                            '</div>'
                        );
                    },
                },
            ]
        });

        deleteGood = (id) => {
            if (!confirm("Are you sure you want to delete this item?")) {
                return
            }

            selectedGoods = selectedGoods.filter(function (val) {
                return val.id != id;
            })
            refreshGoodsInfo()

            let jsonObjectOutbound = convertFormToJSON($('#create-form'))

            const token = "{{ csrf_token() }}"
            $.ajax({
                type: "PUT",
                headers: {'X-CSRF-TOKEN': token},
                url: 'outbound-details/delete-update-outbound/' + id,
                success: function(res) {
                    if(res.status == 'success'){
                        selectedGoods = selectedGoods.filter(function (val) {
                            return val.id != id;
                        })
                        refreshGoodsInfo()
                        table.ajax.reload();
                        $('#add-modal').modal('hide')
                        Swal.fire('Success', `Success to  Deleted Good !`, 'Success')

                    }else {
                        console.log(res);
                        Swal.fire('Error', 'Failed to Deleted Good !', 'error')

                    }
                }
            })

        }

        editGoodById = (id) => {
            let outboundDetail = selectedGoods.find(function (val) {return val.id == id})
            let details = outboundDetail.details
            selectedOutboundDetail = outboundDetail

            // Set Form
            let data = $('#outbound_documents').repeaterVal().outbound_documents.map((v, i, array) => {
                return {id: i, text: `${v.nomor_dokumen} ${v.date}`}
            })
            $('#good-document-options').select2({data})

            // Set GoodDocument
            $.ajax({
                type    : 'GET',
                url     : `/outbound-details/data-detail-document/${id}`,
                success: function(res) {
                    var goodDocumentOptions = [];
                    $.each(res.outboundDocuments, (i , vl) => {
                        goodDocumentOptions.push((vl.seri_document - 1));
                    });

                    $('#good-document-options').val(goodDocumentOptions).trigger('change')
                }
            })

            console.log(selectedOutboundDetail);
            // $('#kode_barang').val(details.kode_barang)
            // $('#kode_barang').val(details.kode_barang)
            // $('#name').val(outboundDetail.good.name)
            // $('#spesifikasi_lain').val(details.spesifikasi_lain)
            // $('#merk').val(details.merk)
            // $('#type').val(details.type)
            // $('#ukuran').val(details.ukuran)
            // $('#uraian').val(details.uraian)
            // $('#quantity').val(outboundDetail.quantity)
            // $('#amount').val(outboundDetail.amount)
            $('#uom_id').val(selectedOutboundDetail.good.uom_id).trigger('change')
            // $('#nett_weight').val(outboundDetail.nett_weight)
            // $('#volume').val(outboundDetail.volume)
            // $('#package_id').val(outboundDetail.package_id)
            FormDataJson.fromJson($('#add-form'), selectedOutboundDetail)
            const packageDetails = outboundDetail.package_details
            $('#name').val(selectedOutboundDetail.good.name).trigger('change');
            $('#hscode_id').val(selectedOutboundDetail.hs_code_id).trigger('change');
            $('#merk_kemasan').val(packageDetails.merk)
            $('#jumlah').val(packageDetails.jumlah)
            $('#add-modal').modal('show')
        }

    });
</script>
@endpush