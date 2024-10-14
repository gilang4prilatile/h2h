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
    $(document).ready(function() {
        function float(equation, precision = 9) {
            return Math.floor(equation * (10 ** precision)) / (10 ** precision);
        }
        var table = $('#table').DataTable({
            data: selectedGoods,
            paging: false,
            columns: [
                {
                    data: 'details.kode_barang',
                    name: 'details.kode_barang',
                    defaultContent: '',
                },
                {
                    data: 'name',
                    name: 'name',
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
                                '<button type="button" class="btn btn-warning btn-sm" onclick="editGoodById('+data['good_id']+')">Edit</button>'+
                                '<button type="button" class="btn btn-danger btn-sm" onclick="deleteGoodById('+data['good_id']+')"">Delete</button>'+
                            '</div>'
                        );
                    },
                },
            ]
        });

        deleteGoodById = (id) => {
            selectedGoods = selectedGoods.filter(function (val) {
                return val.good_id != id;
            })

            refreshGoodsInfo()
        }

        editGoodById = (id) => {
            let good = selectedGoods.find(function (val) {return val.good_id == id})
            selectedGood = good;
            $('#add-modal').modal('show')
        }

    });
</script>
@endpush