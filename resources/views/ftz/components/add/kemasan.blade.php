<div class="form-group row" style="margin-top:10px;" id="kemasan">
    <div class="col-md-12">
        <h2 class="fw-bolder mt-4">Kemasan</h2>
        @if($errors->has('inbound_kemasan'))
            <span class="error text-danger">{{ $errors->first('inbound_kemasan') }}</span>
        @endif
        @if($errors->has('inbound_kemasan.*.*'))
            <span class="error text-danger">{{ $errors->first('inbound_kemasan.*.*') }}</span>
        @endif
        <!--begin::Repeater-->
        <div id="inbound_kemasan">
            <!--begin::Form group-->
            <div class="form-group">
                <div data-repeater-list="inbound_kemasan">
                    <div data-repeater-item>
                        <div class="form-group row"> 
                            <div class="col-md-1">
                                <label class="form-label">Seri:</label>
                                {!! Form::text('no_seri', null, ['class' => 'form-control number', 'oninput' => 'this.value = this.value.toUpperCase()', 'readonly' => 'readonly']) !!}
                            </div>
                            <div class="col-md-2">
                                <label class="form-label required">Jumlah:</label>
                                {!! Form::text('jumlah_kemasan', null, ['class' => 'form-control number', 'required' => true,'oninput' => 'this.value = this.value.toUpperCase()']) !!}
                            </div>
                            <div class="col-md-4">
                                <label class="form-label required">Kemasan:</label>
                                {!! Form::select('packaging_id', $packageSelectBox , null,  ['class' => 'form-select packaging_id', 'required' => true , 'placeholder' => '--Select--']) !!}
                            </div>
                            <div class="col-md-2">
                                <label class="form-label required">Merek:</label>
                                {!! Form::text('merek', null, ['class' => 'form-control number', 'required' => true, 'placeholder' => '','oninput' => 'this.value = this.value.toUpperCase()']) !!}
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
        kemasanRepeater = $('#inbound_kemasan').repeater({
            initEmpty: true,
            show: function() {
                
                $('#kemasan .select2-container').remove();
                $('#kemasan .packaging_id').select2();

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
            var repeaterData = $('div[data-repeater-list="inbound_kemasan"] > div');
            for(var i = 0 ; i < repeaterData.length ; i++){
                repeaterData.eq(i).find('input').eq(0).val(i + 1)
            }
        }

    })
</script>
@endpush
