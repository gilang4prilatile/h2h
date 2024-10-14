<div class="form-group row" style="margin-top:10px;">
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
                            <div class="col-md-2">
                                <label class="form-label">Jumlah:</label>
                                {!! Form::text('jumlah_kemasan', null, ['class' => 'form-control number bg-secondary', 'disabled' => true, 'required' => true,'oninput' => 'this.value = this.value.toUpperCase()']) !!}
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Kemasan:</label>
                                {!! Form::select('packaging_id', $packageSelectBox , null,  ['class' => 'form-select bg-secondary', 'disabled' => true, 'required' => true , 'placeholder' => '--Select--']) !!}
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Merek:</label>
                                {!! Form::text('merek', null, ['class' => 'form-control number bg-secondary', 'disabled' => true, 'required' => true, 'placeholder' => '','oninput' => 'this.value = this.value.toUpperCase()']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
            $(this).slideDown();
            $(this).find('select').select2();
            $kemasanid = $("[name='inbound_kemasan["+angka+"][packaging_id]']");
            angka++;
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
                    $(this).slideUp(deleteElement);
                }

            }
        }
    }); 
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

                    inbound_package_id    : v.id,
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
})
</script>
@endpush
