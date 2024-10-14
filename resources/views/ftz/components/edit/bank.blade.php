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
                        {!! Form::hidden('inbound_id', null, []) !!}
                        {!! Form::hidden('inbound_bank_id', null, []) !!}
                            <div class="col-md-1">
                                <label class="form-label">Seri:</label>
                                {!! Form::text('no_seri', null, ['class' => 'form-control number', 'required' => true,'oninput' => 'this.value = this.value.toUpperCase()', 'readonly' => 'readonly']) !!}
                            </div>
                            <div class="col-md-4">
                                <label class="form-label required">Bank:</label>
                                {!! Form::select('bank_id', $bankSelectBox , null,  ['class' => 'form-select bank_id' , 'required' => true , 'placeholder' => '--Select--']) !!}
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
                <a href="javascript:;" id="btn-update-banks" class="btn btn-light-warning">
                    <i class="la la-plus"></i>Update
                </a>
            </div>
            <!--end::Form group-->
        </div>
        <!--end::Repeater-->
    </div>
</div>
@push('js')
<script>
$(document).ready(function() {
    initGetData();
    let angka = 0;
    bankRepeater = $('#inbound_bank').repeater({
        initEmpty: true,
        show: function() {

            $('#bank .select2-container').remove();
            $('#bank .bank_id').select2();

            $(this).slideDown();
            $(this).find('select').select2();
            $bankid = $("[name='inbound_bank["+angka+"][bank_id]']");
            angka++;
            $(this).find('input').eq(2).val(angka);
            if($bankid.val() == 0){
                $(this).find('select').val(3);
            }
            inboundDetails.forEach(function(v, i, array) {
                $('.bank_goods').append("<option value='"+v.good_id+"'>"+v.name+"</option>");
                $('.bank_goods').trigger('change');
            })
        },
        hide: function(deleteElement) {
            if (confirm('Are you sure you want to delete this element?')) {
                var idDoc = $(this).find('input')[1].value;
                if(idDoc != ''){
                    $.ajax({
                        type : 'GET',
                        url: `/inbound-bank/delete/${idDoc}`, 
                        success: function(res) {
                            if(res.status == 'success'){
                                angka = 0;
                                initGetData();
                                $(this).slideUp(deleteElement);
                                Swal.fire('Success', 'Success to Delete Bank !', 'Success')
                            }else {
                                Swal.fire('Error', 'Failed to Delete Bank !', 'error')
                            }
                        },
                        error: function(res) {
                            console.log(res);
                        }
                    });

                }else {
                    $(this).slideUp(deleteElement, function () {
                        $(this).remove();
                        setSeri();
                        angka--;
                    });
                }

            }
        }
    });

    $('#btn-update-banks').click(function() {
        if (!confirm('are you sure you want to update these items?')) {
            return
        }
        const token     = "{{ csrf_token() }}"
        var formData    = new FormData();
        var inboundId   = inbound.id;

        $.each(bankRepeater.repeaterVal().inbound_bank, (i , vl) => {
            formData.append('inbound_id[]',     inboundId);
            formData.append('inbound_bank_id[]', vl.inbound_bank_id);
            formData.append('bank_id[]',   vl.bank_id); 
 
        });

        $.ajax({
            type : 'POST',
            headers: {'X-CSRF-TOKEN': token},
            url: `/inbound-bank/insert-or-update`,
            data:  formData,
            processData: false,  
            contentType: false, 
            success: function(res) {
                if(res.status == 'success'){
                    angka = 0;
                    initGetData();
                    Swal.fire('Success', 'Success to Add or Update Bank !', 'Success')
                }else {
                    Swal.fire('Error', 'Failed to Add or Update Bank !', 'error')
                }
            },
            error: function(res) {
                console.log(res);
            }
        });
    })


    // Function
    function initGetData()
    {
        var idDoc = inbound.id;
     
        $.ajax({
            type : 'GET',
            url: `/inbound-bank/data/${idDoc}`, 
            success: function(res) {
                //alert(JSON.stringify(res.inboundPackages));
                bankRepeater.setList(res.inboundBanks.map((v) => ({
                    inbound_bank_id    : v.id,
                    inbound_id         : v.inbound_id,
                    no_seri            : v.no_seri,
                    bank_id            : v.bank_id

                })))               
            },
            error: function(res) {
                console.log(res);
            }
        });

    }

    function setSeri(){
        console.log("TEST");
        var repeaterData = $('div[data-repeater-list="inbound_bank"] > div');
        for(var i = 0 ; i < repeaterData.length ; i++){
            repeaterData.eq(i).find('input').eq(2).val(i + 1)
        }
    }
})
</script>
@endpush
