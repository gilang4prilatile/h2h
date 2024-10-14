<div class="form-group row" style="margin-top:10px;" id="bank">
    <div class="col-md-12">
        <h2 class="fw-bolder mt-4">Bank</h2>
        @if($errors->has('inbound_bank'))
            <span class="error text-danger">{{ $errors->first('inbound_bank') }}</span>
        @endif
        @if($errors->has('inbound_bank.*.*'))
            <span class="error text-danger">{{ $errors->first('inbound_bank.*.*') }}</span>
        @endif
        <!--begin::Repeater-->
        <div id="inbound_bank">
            <!--begin::Form group-->
            <div class="form-group">
                <div data-repeater-list="inbound_bank">
                    <div data-repeater-item>
                        <div class="form-group row">
                            <div class="col-md-1">
                                <label class="form-label">Seri:</label>
                                {!! Form::text('no_seri', null, ['class' => 'form-control number', 'required' => true,'oninput' => 'this.value = this.value.toUpperCase()', 'readonly' => 'readonly']) !!}
                            </div>                        
                            <div class="col-md-4">
                                <label class="form-label required">BANK:</label>
                                {!! Form::select('bank_id', $bankSelectBox , null,  ['class' => 'form-select bank_id','required' => true , 'placeholder' => '--Select--']) !!}
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
        bankRepeater = $('#inbound_bank').repeater({
            initEmpty: true,
            show: function() {

                $('#bank .select2-container').remove();
                $('#bank .bank_id').select2();

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
            var repeaterData = $('div[data-repeater-list="inbound_bank"] > div');
            for(var i = 0 ; i < repeaterData.length ; i++){
                repeaterData.eq(i).find('input').eq(0).val(i + 1)
            }
        }
    })
</script>
@endpush
