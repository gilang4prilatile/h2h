<div class="form-group row" style="margin-top:10px;" id="peti_kemas">
    <div class="col-md-12">
        <h2 class="fw-bolder mt-4">Peti Kemas</h2>
        @if($errors->has('inbound_peti_kemas'))
            <span class="error text-danger">{{ $errors->first('inbound_peti_kemas') }}</span>
        @endif
        @if($errors->has('inbound_peti_kemas.*.*'))
            <span class="error text-danger">{{ $errors->first('inbound_peti_kemas.*.*') }}</span>
        @endif
        <!--begin::Repeater-->
        <div id="inbound_peti_kemas">
            <!--begin::Form group-->
            <div class="form-group">
                <div data-repeater-list="inbound_peti_kemas">
                    <div data-repeater-item>
                        <div class="form-group row">
                            <div class="col-md-1">
                                <label class="form-label">Seri:</label>
                                {!! Form::text('no_seri', null, ['class' => 'form-control number',  'oninput' => 'this.value = this.value.toUpperCase()', 'readonly' => 'readonly']) !!}
                            </div>
                            <div class="col-md-2">
                                <label class="form-label required">Nomor</label>
                                {!! Form::text('nomor_peti_kemas', null, ['class' => 'form-control',   'placeholder' => 'Input', 'id' => 'nomor_peti_kemas','oninput' => 'this.value = this.value.toUpperCase()' , 'required' => true]) !!}
                            </div>
                            <div class="col-md-2">
                                <label class="form-label required">Ukuran</label>
                                {!! Form::select('ukuran_peti_kemas_id', $masterUkuranPetiKemas , null,  ['class' => 'form-select ukuran_peti_kemas_id' , 'placeholder' => '--Select--', 'required' => true]) !!}
                            </div>
                            <div class="col-md-2">
                                <label class="form-label required">Jenis</label>                
                                {!! Form::select('jenis_peti_kemas', $jenisPetiKemas , null,  ['class' => 'form-select jenis_peti_kemas' ,   'placeholder' => '--Select--', 'required' => true]) !!}
                            </div>
                            <div class="col-md-3">
                                <label class="form-label required">Tipe</label>
                                {!! Form::select('container_id', $masterTypePetiKemas , null,  ['class' => 'form-select container_id',   'placeholder' => '--Select--', 'required' => true]) !!}
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
        <!--end::Repeater-->
    </div>
</div>
@push('js')
<script>
    var modulNav = @json($moduleNav);
    $(document).ready(function() {
        let angka = 0;
        petiKemasRepeater = $('#inbound_peti_kemas').repeater({
            initEmpty: true,
            show: function() {

                $('#peti_kemas .select2-container').remove();
                $('#peti_kemas .ukuran_peti_kemas_id').select2();
                $('#peti_kemas .jenis_peti_kemas').select2();
                $('#peti_kemas .container_id').select2();

                angka++;
                $(this).slideDown();
                $(this).find('input').eq(0).val(angka);
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
            var repeaterData = $('div[data-repeater-list="inbound_peti_kemas"] > div');
            for(var i = 0 ; i < repeaterData.length ; i++){
                repeaterData.eq(i).find('input').eq(0).val(i + 1)
            }
        }
        
    })
</script>
@endpush
