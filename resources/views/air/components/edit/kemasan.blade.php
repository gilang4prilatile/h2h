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
                        {!! Form::hidden('inbound_id', null, []) !!}
                        {!! Form::hidden('inbound_package_id', null, []) !!}
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
                                {!! Form::select('packaging_id', $packageSelectBox , null,  ['class' => 'form-select packaging_id' , 'required' => true , 'placeholder' => '--Select--']) !!}
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
                <a href="javascript:;" id="btn-update-kemasans" class="btn btn-light-warning">
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
    kemasanRepeater = $('#inbound_kemasan').repeater({
        initEmpty: true,
        show: function() {

            $('#kemasan .select2-container').remove();
            $('#kemasan .packaging_id').select2()

            $(this).slideDown();
            $(this).find('select').select2();
            $kemasanid = $("[name='inbound_kemasan["+angka+"][packaging_id]']");
            angka++;
            $(this).find('input').eq(2).val(angka);
            if($kemasanid.val() == 0){
                $(this).find('select').val(3);
            }
            inboundDetails.forEach(function(v, i, array) {
                $('.kemasan_goods').append("<option value='"+v.good_id+"'>"+v.name+"</option>");
                $('.kemasan_goods').trigger('change');
            })
        },
        hide: function(deleteElement) {
            if (confirm('Are you sure you want to delete this element?')) {
                var idDoc = $(this).find('input')[1].value;
                if(idDoc != ''){
                    $.ajax({
                        type : 'GET',
                        url: `/inbound-packages/delete/${idDoc}`, 
                        success: function(res) {
                            if(res.status == 'success'){
                                angka = 0;
                                initGetData();
                                $(this).slideUp(deleteElement);
                                Swal.fire('Success', 'Success to Delete Kemasan !', 'Success')
                            }else {
                                Swal.fire('Error', 'Failed to Delete Kemasan !', 'error')
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
 
    $('#btn-update-kemasans').click(function() {
        if (!confirm('are you sure you want to update these items?')) {
            return
        }
        const token     = "{{ csrf_token() }}"
        var formData    = new FormData();
        var inboundId   = inbound.id;

        $.each(kemasanRepeater.repeaterVal().inbound_kemasan, (i , vl) => {
            formData.append('inbound_id[]',     inboundId);
            formData.append('inbound_package_id[]', vl.inbound_package_id);
            formData.append('packaging_id[]',   vl.packaging_id); 
            formData.append('jumlah_kemasan[]', vl.jumlah_kemasan);
            formData.append('merek[]',          vl.merek);
 
        });

        $.ajax({
            type : 'POST',
            headers: {'X-CSRF-TOKEN': token},
            url: `/inbound-packages/insert-or-update`,
            data:  formData,
            processData: false,  
            contentType: false, 
            success: function(res) {
                if(res.status == 'success'){
                    angka = 0;
                    initGetData();
                    Swal.fire('Success', 'Success to Add or Update Kemasan !', 'Success')
                }else {
                    Swal.fire('Error', 'Failed to Add or Update Kemasan !', 'error')
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
            url: `/inbound-packages/data/${idDoc}`, 
            success: function(res) {
                //alert(JSON.stringify(res.inboundPackages));
                kemasanRepeater.setList(res.inboundPackages.map((v) => ({

                    inbound_package_id      : v.id,
                    no_seri                 : v.no_seri,
                    packaging_id            : v.packaging_id,
                    jumlah_kemasan          : v.details?.jumlah_kemasan ?? "",
                    merek                   : v.details?.merek ?? "" 

                })))               
            },
            error: function(res) {
                console.log(res);
            }
        });

    }

    function setSeri(){
        var repeaterData = $('div[data-repeater-list="inbound_kemasan"] > div');
        for(var i = 0 ; i < repeaterData.length ; i++){
            repeaterData.eq(i).find('input').eq(2).val(i + 1)
        }
    }
})
</script>
@endpush
