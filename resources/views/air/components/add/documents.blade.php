<div class="form-group row" style="margin-top:10px;">
    <div class="col-md-12">
        <h2 class="fw-bolder mt-4">Dokumen</h2>
        @if($errors->has('inbound_documents'))
            <span class="error text-danger">{{ $errors->first('inbound_documents') }}</span>
        @endif
        @if($errors->has('inbound_documents.*.*'))
            <span class="error text-danger">{{ $errors->first('inbound_documents.*.*') }}</span>
        @endif
        <!--begin::Repeater-->
        <div id="inbound_documents">
            <!--begin::Form group-->
            <div class="form-group">
                <div data-repeater-list="inbound_documents">
                    <div data-repeater-item> 
                        <div class="bg-transparent border-dashed border-1  rounded p-3" style="margin-bottom:10px;">
                            <div class="form-group row">
                                <div class="col-md-1">
                                    <label class="form-label">Seri:</label>
                                    {!! Form::text('no_seri', null, ['class' => 'form-control number no_seri', 'required' => true,'oninput' => 'this.value = this.value.toUpperCase()', 'readonly' => 'readonly']) !!}
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Type:</label>
                                    {!! Form::select('document_id', $documentSelectBox , null,  ['class' => 'form-select' , 'required' => true , 'placeholder' => '--Select--']) !!}
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Tanggal:</label>
                                    {!! Form::text('date', null, ['class' => 'form-control datepicker', 'required' => true, 'placeholder' => 'Pilih Tanggal']) !!}
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Nomor:</label>
                                    {!! Form::text('nomor_dokumen', null, ['class' => 'form-control number', 'required' => true, 'placeholder' => 'Nomor','oninput' => 'this.value = this.value.toUpperCase()']) !!}
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">File:</label>
                                    {!! Form::file('file', ['class' => 'form-control', 'placeholder' => 'File' , 'id' => 'inputfile']) !!}
                                </div>
                                <div class="col-md-4" id="inputan_izin" style="display: none;">
                                    <label class="form-label">Izin:</label>
                                    {!! Form::select('id_institutional_permission', $IzinSelectBox , null,  ['class' => 'form-select', 'placeholder' => '--Select--']) !!}
                                </div>
                                <div class="col-md-4" id="inputan_fasilitas" style="display: none;">
                                    <label class="form-label">Fasilitas:</label>
                                    {!! Form::select('id_fasilitas', $FasilitasSelectBox , null,  ['class' => 'form-select', 'placeholder' => '--Select--']) !!}
                                </div> 
                                <div class="col-md-7" id="inputan_fasilitas_barang" name="inputan_fasilitas_barang" style="display: none;">
                                    <label class="form-label">&nbsp; </label>
                                    <a href="javascript:void(0);" id="openFasilitasBarangModal" class="btn btn-light-primary">
                                        <i class="la la-plus"></i>Pilih Barang
                                    </a>
                                    <div id="selected_fasilitas_barang">
                                        {!! Form::hidden('barang_terpilih[]', null, ['class' => 'form-control barang-terpilih']) !!}

                                        <div id="selected_fasilitas_barang_text">

                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <a href="javascript:;" data-repeater-delete
                                        class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                        <i class="la la-trash-o"></i>
                                    </a>
                                </div> 
                            </div>
                        </div>
                    </div>    
                </div>
            </div> 
            <div class="form-group mt-5">
                <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
                    <i class="la la-plus"></i>Add
                </a>
            </div> 
        </div> 
    </div>
</div> 
<div class="modal fade" id="fasilitasBarangModal" tabindex="-1" role="dialog" aria-labelledby="fasilitasBarangModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fasilitasBarangModalLabel">Pilih Barang</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="barangTable">
                    <thead>
                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                            <th class="min-w-50px">Pilih</th>
                            <th class="min-w-50px">No Seri</th>
                            <th class="min-w-125px">Kode Barang</th>
                            <th class="min-w-125px">Nama Barang</th>
                            <th class="min-w-125px">Kuantitas</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 fw-bold"></tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveFasilitasBarang">Submit</button>
            </div>
        </div>
    </div>
</div>

@push('js')
<script>

var modulNav = @json($moduleNav);
var division = @json($division);

var documentRepeater = null;

$(document).ready(function() {
    var index = 0;
    let angka = 0;

    // Initialize the document repeater
    documentRepeater = $('#inbound_documents').repeater({
        initEmpty: true,
        show: function() {
            $(this).slideDown();
            $documentid = $("[name='inbound_documents["+angka+"][document_id]']");
            angka++;
            if (angka == 1) {
                $(this).find('select').val(5);
            } else if (angka == 2) {            
                if (division == "air") {
                    iddok = 108;
                }else{
                    iddok = 107;
                }
                $(this).find('select').val(iddok);
            }

            $(this).find('input').eq(0).val(angka);
            $(this).find("select").select2({});
            $(this).find(".datepicker").flatpickr({ dateFormat: 'd-m-Y' });

            // Handle document_id change for each new repeater item
           
            $(this).find('select[name$="[document_id]"]').on('change', function() {
                var documentId = $(this).val();
                var $row = $(this).closest('[data-repeater-item]');
                var $izin = $row.find('select[name$="[id_institutional_permission]"]').closest('.col-md-4');
                var $fasilitas = $row.find('select[name$="[id_fasilitas]"]').closest('.col-md-4');
                var $fasilitasBarang = $row.find('#inputan_fasilitas_barang');

                if (documentId == 140) {
                    $izin.show();
                    $fasilitas.hide();
                    $fasilitasBarang.hide();
                } else if (documentId == 133 || documentId == 134) {
                    $fasilitas.show();
                    $izin.hide();
                    $fasilitasBarang.show();
                } else if (documentId == 157 || documentId == 135) {
                    $fasilitas.hide();
                    $izin.hide();
                    $fasilitasBarang.show();    
                } else {
                    $izin.hide();
                    $fasilitas.hide();
                    $fasilitasBarang.hide();
                }

                // Set data attribute to track current document ID and row index
                $fasilitasBarang.data('documentId', documentId);
                $fasilitasBarang.data('rowIndex', $row.index());
            }).trigger('change');
        },
        hide: function(deleteElement) {
            $(this).slideUp(deleteElement, function () {
                $(this).remove();
                setSeri();
                angka--;
            });
        }
    });

    function setSeri(){
        var repeaterData = $('div[data-repeater-list="inbound_documents"] > div');
        for(var i = 0 ; i < repeaterData.length ; i++){
            repeaterData.eq(i).find('input').eq(0).val(i + 1)
        }
    }
    // Event handler untuk membuka modal
    $(document).on('click', '#openFasilitasBarangModal', function() {

        var $fasilitasBarang = $(this).closest('#inputan_fasilitas_barang');
        var documentId = $fasilitasBarang.data('documentId');
        var rowIndex = $fasilitasBarang.data('rowIndex');
        console.log('Opening modal for document ID:', documentId, 'Row Index:', rowIndex);
        
        // Set data attributes to modal
        $('#fasilitasBarangModal').data('documentId', documentId);
        $('#fasilitasBarangModal').data('rowIndex', rowIndex);
        
        loadBarangDataIntoModal(documentId, rowIndex);
        $('#fasilitasBarangModal').modal('show');
    });

    // Event handler untuk menyimpan data barang yang dipilih dari modal
    $(document).on('click', '#saveFasilitasBarang', function() {
        var $modal = $('#fasilitasBarangModal');
        var documentId = $modal.data('documentId');
        var rowIndex = $modal.data('rowIndex');
        console.log('Saving selected barang for document ID:', documentId, 'Row Index:', rowIndex);
        saveSelectedBarangData(documentId, rowIndex);
        $('#fasilitasBarangModal').modal('hide'); // Close the modal
    });

    function loadBarangDataIntoModal(documentId, rowIndex) {
        var $tableBody = $('#barangTable tbody');
        $tableBody.empty();

        // Ambil data dari tabel barang di tab barang
        var table = $('#table').DataTable();
        var data = table.rows().data().toArray();

        console.log('Data from table:', data);

        // Get selected goods from hidden input
        var $currentRow = $('#inbound_documents').find('[data-repeater-item]').eq(rowIndex);
        var selectedGoodsString = $currentRow.find('input.barang-terpilih').val();
        var selectedGoods = selectedGoodsString ? JSON.parse(selectedGoodsString) : [];

        // Create a map of selected goods for the current document and rowIndex
        var selectedGoodsMap = selectedGoods.reduce(function(map, id) {
            map[id] = true;
            return map;
        }, {});

        data.forEach(function(item, index) {
            var isChecked = selectedGoodsMap[item.good_id] ? 'checked' : '';
            var row = '<tr>' +
                '<td><input type="checkbox" class="barang-checkbox" value="' + item.good_id + '" ' + isChecked + '></td>' +
                '<td>' + (index + 1) + '</td>' + // Adding serial number
                '<td>' + item.details.kode_barang + '</td>' +
                '<td>' + item.name + '</td>' +
                '<td>' + item.quantity + '</td>' +
                '</tr>';
            $tableBody.append(row);
        });
    }

    function saveSelectedBarangData(documentId, rowIndex) {
        var selectedIds = [];
        $('#barangTable tbody .barang-checkbox:checked').each(function() {
            selectedIds.push($(this).val());
        });

        var selectedBarang = selectedIds.map(function(id) {
            var row = $('#barangTable').find('input[value="' + id + '"]').closest('tr');
            return {
                good_id: id,
                details: {
                    kode_barang: row.find('td').eq(2).text()
                },
                name: row.find('td').eq(3).text(),
                quantity: row.find('td').eq(4).text(),
                serial_no: row.find('td').eq(1).text() // Adding serial number
            };
        });

        // Extract the names of the selected goods
        var selectedBarangNames = selectedBarang.map(function(good) {
            return good.serial_no + ' - ' + good.details.kode_barang + ' (' + good.name + ')';
        }).join(', ');

        // Update the hidden input with selected goods for the current row
        var $currentRow = $('#inbound_documents').find('[data-repeater-item]').eq(rowIndex);
        $currentRow.find('input.barang-terpilih').val(JSON.stringify(selectedIds));

        // Find the correct row and update its display
        var $selectedFasilitasBarangText = $currentRow.find('#selected_fasilitas_barang_text');
        $selectedFasilitasBarangText.empty();
        selectedBarang.forEach(function(good) {
            $selectedFasilitasBarangText.append('<div>' + good.serial_no + ' - ' + good.details.kode_barang + ' (' + good.name + ')</div>');
        });

    }
});


</script>
@endpush
 
