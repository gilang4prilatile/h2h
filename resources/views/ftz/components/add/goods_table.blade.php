<table class="table align-middle table-row-dashed fs-6 gy-5" id="table"> 
    <thead> 
        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
            <th class="min-w-125px">No Seri</th>
            <th class="min-w-125px">Kode Barang</th>
            <th class="min-w-125px">Nama Barang</th>
            <th class="min-w-125px">Uraian</th>
            <th class="min-w-125px">Kuantitas</th>
            <th class="text-end min-w-100px">Action</th>
        </tr> 
    </thead> 
    <tbody class="text-gray-600 fw-bold">

    </tbody> 
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
            paging: true,
            pageLength: 5,
            columns: [
                {
                    data: 'no_seri',
                    name: 'no_seri',
                },
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
                    data: 'details.uraian',
                    name: 'details.uraian',
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
                    "targets": 5,
                    "render": function (val, type, data, meta) { // Note: not sure what "val" is actually
                        return (
                            '<div class="btn-group">' +
                                '<button type="button" class="btn btn-warning btn-sm" onclick="editGoodById('+data['no_seri']+', '+data['good_id']+')">Edit</button>'+
                                '<button type="button" class="btn btn-danger btn-sm" onclick="deleteGoodById('+data['no_seri']+', '+data['good_id']+')"">Delete</button>'+
                            '</div>'
                        );
                    },
                },
            ]
        });

        deleteGoodById = (noSeri, goodID) => {
            if(noSeri != ''){
                selectedGoods = selectedGoods.filter(function (val) {return val.no_seri != noSeri})
            }else {
                selectedGoods = selectedGoods.filter(function (val) {return val.good_id != goodID})
            }
       
            refreshGoodsInfo()
        }

        editGoodById = (noSeri, goodID) => {
            let good = {};
            if(noSeri != ''){
               good = selectedGoods.find(function (val) {return val.no_seri == noSeri})
            }else {
                good = selectedGoods.find(function (val) {return val.good_id == goodID})
            }
          
            selectedGood = good;


            // Entitas Barang
            
            // const mapOptions = selectedGoods.map(v => ({id: v.good_id, text: v.name}));
            // $('#goods_facility').html("")
            // $('#goods_facility').select2({data: mapOptions})
            // $('#goods_facility').val(pemilikBarang.goods_facility).trigger('change');
          
            $('#add-modal').modal('show')
        }

    });
</script>
@endpush
