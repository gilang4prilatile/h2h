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
            <th class="min-w-125px"> Actions</th>
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

        console.log(outboundDetails);
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
                    data: 'total_partial',
                    name: 'total_partial',
                    render : function(data, type, meta){
                        return float(data);
                    }
                },
                {
                    "data": "kode_barang",
                    "render": function(data, type, row, meta){
                     
                        if ({{ $outbound->partial }} != 0 ) {
                            data = '<div class="btn-group"><a class="btn btn-light-warning" href="{{ $partialLink }}/{{ $outbound->id }}/'+ data +'"><i class="fas fa-truck-moving"></i> Partial</a>';
                            return data;
                        }
                        else{
                            data = '<div class="btn-group"><a class="btn btn-light-warning" style="display: none" href="outbound/bc-40/detail/partial/'+ {{ $outbound->id }} +'/'+ data +'" target="_blank"><i class="fas fa-truck-moving"></i>Partial</a>';
                            return data;
                        }
                    },
                    
                },
                {
                    
                    "data": "kode_barang",
                    "render": function(data, type, row, meta){
                        // console.log(data1lagi);
                        // data = '<a href="' + data + '">' + data + '</a>'
                        var htmlStr = '<div class="btn-group"><a href="javascript:void(0);" id="btn-tambah-barang" data-detail-kode-barang="' + data + '" data-bs-toggle="modal" data-bs-target="#detail-modal" class="btn btn-secondary">Detail</a>';
                        return htmlStr;
                    },
                    
                }
            ],
        });
    });
</script>
@endpush