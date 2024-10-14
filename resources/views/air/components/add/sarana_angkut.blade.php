<div class="form-group row" style="margin-top:10px;" id="sarana_angkut">
    <div class="col-md-12">
        <h2 class="fw-bolder mt-4">Sarana Angkut</h2>
        @if($errors->has('inbound_transportations'))
            <span class="error text-danger">{{ $errors->first('inbound_transportations') }}</span>
        @endif
        @if($errors->has('inbound_transportations.*.*'))
            <span class="error text-danger">{{ $errors->first('inbound_transportations.*.*') }}</span>
        @endif
        <!--begin::Repeater-->
        <div id="inbound_transportations">
            <!--begin::Form group-->
            <div class="form-group">
                <div data-repeater-list="inbound_transportations">
                    <div data-repeater-item>
                        <div class="form-group row">
                            <div class="col-md-1">
                                <label class="form-label">Seri:</label>
                                {!! Form::text('no_seri', null, ['class' => 'form-control number', 'required' => true,'oninput' => 'this.value = this.value.toUpperCase()', 'readonly' => 'readonly']) !!}
                            </div>        
                            <div class="col-md-3">
                                <label class="form-label required">Nama Sarana Angkut</label>
                                {!! Form::text('name', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Nama Sarana Angkut', 'id' => 'nomor_peti_kemas', 'oninput' => 'this.value = this.value.toUpperCase()']) !!}
                            </div>                
                            <div class="col-md-2">
                                <label class="form-label required">Cara Pengangkutan</label>
                                {!! Form::select('transportation_id', $transportations , null,  ['class' => 'form-select transportation_id' , 'required' => true , 'placeholder' => '--Select--']) !!}
                            </div>
                            <div class="col-md-2">
                                <label class="form-label required">Nomor Voy/Flight/No.Pol</label>
                                {!! Form::text('vehicle_number', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Nama Sarana Angkut', 'id' => 'nomor_peti_kemas','oninput' => 'this.value = this.value.toUpperCase()']) !!}
                            </div>  
                            <div class="col-md-3">
                                <label class="form-label required">Bendera</label>
                                {!! Form::select('country_code', $country , null,  ['class' => 'form-select country_code' , 'required' => true ,  'placeholder' => '--Select--']) !!}
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
        transportationRepeater = $('#inbound_transportations').repeater({
            initEmpty: true,
            show: function() {

                $('#sarana_angkut .select2-container').remove();
                $('#sarana_angkut .transportation_id').select2();
                $('#sarana_angkut .country_code').select2();

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
            var repeaterData = $('div[data-repeater-list="inbound_transportations"] > div');
            for(var i = 0 ; i < repeaterData.length ; i++){
                repeaterData.eq(i).find('input').eq(0).val(i + 1)
            }
        }
    })
</script>
@endpush
