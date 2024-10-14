<table class="table align-middle table-row-dashed fs-6 gy-5" id="table-pemilik-barang">
    <!--begin::Table head-->
    <thead>
        <!--begin::Table row-->
        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
            <th class="min-w-125px">Seri</th>
            <th class="min-w-125px">Nomor Identitas</th>
            <th class="min-w-200px">Alamat</th>
            <th class="min-w-125px">Nama</th>
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
    var deletePemilikBarangById = null;
    var editPemilikBarangById = null;
    $(document).ready(function() {
        var table = $('#table-pemilik-barang').DataTable({
            data: banyakPemilikBarang,
            paging: false,
            columns: [
                {
                    data: 'no_seri',
                    name: 'no_seri',
                    defaultContent: '',
                },
                {
                    data: 'pemilik_nomor_identitas',
                    name: 'pemilik_nomor_identitas',
                    defaultContent: '',
                },
                {
                    data: 'pemilik_alamat',
                    name: 'pemilik_alamat',
                    defaultContent: '',
                },
                {
                    data: 'pemilik_nama',
                    name: 'pemilik_nama',
                    defaultContent: '',
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
                    "targets": 4,
                    "render": function (val, type, data, meta) { // Note: not sure what "val" is actually
                        return (
                            '<div class="btn-group">' +
                                '<button type="button" class="btn btn-warning btn-sm" onclick="editPemilikBarangById('+data['no_seri']+')">Edit</button>'+
                                '<button type="button" class="btn btn-danger btn-sm" onclick="deletePemilikBarangById('+data['no_seri']+')"">Delete</button>'+
                            '</div>'
                        );
                    },
                },
            ]
        });

        deletePemilikBarangById = (id) => {
            banyakPemilikBarang = banyakPemilikBarang.filter(function (val) {
                return val.no_seri != id;
            })

            var seriPemilikBarang = 1;
            banyakPemilikBarang.forEach(function(val){
                val.no_seri = seriPemilikBarang;
                seriPemilikBarang++;
            })

            refreshPemilikBarang()
        }

        editPemilikBarangById = (id) => {
            let selectedData = banyakPemilikBarang.find(function (val) {return val.no_seri == id})
            pemilikBarang = selectedData;
            $('#pemilik-barang-modal').modal('show')
        }

    });
</script>
@endpush
