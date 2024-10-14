<table class="table align-middle table-row-dashed fs-6 gy-5" id="table">
    <!--begin::Table head-->
    <thead>
        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
            <th class="min-w-10px">No Seri</th>
            <th class="min-w-50px">Kode Barang</th>
            <th class="min-w-125px">Nama Barang</th>
            <th class="min-w-125px">Uraian</th>
            <th class="min-w-125px">HS Code</th>  <!-- Tambahkan kolom HS Code di sini -->
            <th class="min-w-125px">Kuantitas</th>
            <th class="text-end min-w-100px">Action</th>
        </tr>
    </thead>

    <!--end::Table head-->
    <!--begin::Table body-->
    <tbody class="text-gray-600 fw-bold">

    </tbody>
    <!--end::Table body-->
</table>
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/form-data-json-convert/dist/form-data-json.min.js"></script>
@endpush

@push('js')
<script>
    var deleteGoodById = null;
    var editGoodById = null;
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
            processing: true,
            serverSide: true,
            ajax: {
                type    : "GET",
                url     : `/inbound-details/data/${inbound.id}`,
                dataSrc : function(json){
                    var no_seri = 1;
                    json.inboundDetails.forEach(element => {
                        if (!element['no_seri'] || element['no_seri'] === 0) {
                            element['no_seri'] = no_seri++;
                        }
                    });
                    return json.inboundDetails;
                }
            },
            paging: false,
            columns: [
                {
                    data: 'no_seri',
                    name: 'no_seri',
                },
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
                    data: 'details.uraian',
                    name: 'details.uraian',
                    defaultContent: '',
                },
                {
                    data: 'hs_code.code',  // Tambahkan kolom HS Code di sini
                    name: 'hs_code.code',
                    defaultContent: '',
                },
                {
                    data: 'quantity',
                    name: 'quantity',
                    render : function(data, type, meta){
                        return parseFloat(data).toFixed(2);
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
                    "targets": 6, // Sesuaikan target agar tetap untuk action
                    "render": function (val, type, data, meta) {
                        return (
                            '<div class="btn-group">' +
                                '<button type="button" class="btn btn-warning btn-sm" onclick="editGoodById('+data['id']+')">Edit</button>'+
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

            inboundDetails = inboundDetails.filter(function (val) {
                return val.id != id;
            })
            refreshGoodsInfo()

            let jsonObjectInbound = convertFormToJSON($('#create-form'))
     
            const token = "{{ csrf_token() }}"
            $.ajax({
                type: "PUT",
                url: 'inbound-details/delete-update-inbound/' + id,
                data : jsonObjectInbound,
                headers: {'X-CSRF-TOKEN': token},
                success: function(res) {
                    if(res.status == 'success'){
                        inboundDetails = inboundDetails.filter(function (val) {
                            return val.id != id;
                        })
                        refreshGoodsInfo()
                        table.ajax.reload();
                        $('#add-modal').modal('hide')
                        Swal.fire('Success', `Success to  Deleted Good !`, 'Success')
                    }else {

                        Swal.fire('Error', 'Failed to Deleted Good !', 'error')

                    }

                }
            })

        }

        editGoodById = (id) => {

            const inboundDetail = inboundDetails.find(function (val) {return val.id == id})
            selectedInboundDetail = inboundDetail
            
           
            $('#add-modal').modal('show');

        }

    });
</script>
@endpush