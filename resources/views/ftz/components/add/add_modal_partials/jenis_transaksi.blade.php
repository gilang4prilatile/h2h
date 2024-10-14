<div class="form-group row" style="margin-top:10px;" id="j_transaksi">
    <div class="col-md-12">
        <h2 class="fw-bolder mt-4">Jenis Transaksi</h2>
        <div id="barang_jenis_transaksi">
            <!--begin::Form group-->
            <div class="form-group">
                <div data-repeater-list="barang_jenis_transaksi">
                    <div data-repeater-item>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="form-label">	
                                Jenis Transaksi</label>
                                {!! Form::select('jenis_transaksi', $jenisTransaksi , null,  ['class' => 'form-select' ,   'placeholder' => '--Select--']) !!}
                            </div> 
                            <div class="col-md-3">
                                <label class="form-label ">Jatuh Tempo Royalti</label> 
                                {!! Form::text('jatuh_tempo_royalti', $tanggalHariIni, ['class' => 'form-control datepicker',   'placeholder' => 'Pilih Tanggal']) !!}
                            </div>
                            
                            <div class="col-md-3">
                                <label class="form-label ">	
                                Nilai Barang Vd</label>
                                {!! Form::text('nilai_barang_vd', null, ['class' => 'form-control',   'placeholder' => 'Input', 'id' => 'nilai_barang_vd']) !!}
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
            <!--end::Form group-->

            <!--begin::Form group-->
            <div class="form-group mt-5">
                <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
                    <i class="la la-plus"></i>Add
                </a>
            </div>
            <!--end::Form group-->
        </div>
    </div>
</div>
@push('js')
<script>
    var modulNav = @json($moduleNav);
    $(document).ready(function() {
        petiKemasRepeater = $('#barang_jenis_transaksi').repeater({
            initEmpty: true,
            show: function() {

                $('#j_transaksi .select2-container').remove();
                $('#j_transaksi .jenis_transaksi').select2(); 
 
                $(this).slideDown();
                $(this).find('input').eq(0).val("-");
            },
            hide: function(deleteElement) {
                $(this).slideUp(deleteElement, function () {
                    $(this).remove();
                    setSeri(); 
                });
            }
        });

        function setSeri(){
            var repeaterData = $('div[data-repeater-list="barang_jenis_transaksi"] > div');
            for(var i = 0 ; i < repeaterData.length ; i++){
                repeaterData.eq(i).find('input').eq(0).val(i + 1)
            }
        }
        
    })
</script>
@endpush
