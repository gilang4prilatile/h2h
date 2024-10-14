<div class="form-group row" style="margin-top:10px;">
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
                        {!! Form::hidden('inbound_id', null, []) !!}
                        {!! Form::hidden('inbound_container_id', null, []) !!}
                            <div class="col-md-3">
                                <label class="form-label required">Nomor</label>
                                {!! Form::text('nomor_peti_kemas', null, ['class' => 'form-control bg-secondary', 'disabled' => true, 'required' => true, 'placeholder' => 'Input', 'id' => 'nomor_peti_kemas','oninput' => 'this.value = this.value.toUpperCase()']) !!}
                            </div>
                            <div class="col-md-3">
                                <label class="form-label required">Ukuran</label>
                                {!! Form::select('ukuran_peti_kemas_id', $masterUkuranPetiKemas , null,  ['class' => 'form-select bg-secondary', 'disabled' => true, 'required' => true , 'placeholder' => '--Select--']) !!}
                            </div>
                            <div class="col-md-2">
                                <label class="form-label required">Jenis</label>                
                                {!! Form::select('jenis_peti_kemas', $jenisPetiKemas , null,  ['class' => 'form-select bg-secondary', 'disabled' => true, 'required' => true , 'placeholder' => '--Select--']) !!}
                            </div>
                            <div class="col-md-3">
                                <label class="form-label required">Tipe</label>
                                {!! Form::select('container_id', $masterTypePetiKemas , null,  ['class' => 'form-select bg-secondary', 'disabled' => true, 'required' => true , 'placeholder' => '--Select--']) !!}
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
    petikemasRepeater = $('#inbound_peti_kemas').repeater({
        initEmpty: true,
        show: function() {
            $(this).slideDown();
            $(this).find('select').select2();
            $petikemasid = $("[name='inbound_peti_kemas["+angka+"][container_id]']");
            angka++;
            if($petikemasid.val() == 0){
                $(this).find('select').val(3);
            }
            inboundDetails.forEach(function(v, i, array) {
                $('.peti_kemas_goods').append("<option value='"+v.good_id+"'>"+v.name+"</option>");
                $('.peti_kemas_goods').trigger('change');
            })
        },
        hide: function(deleteElement) {
            if (confirm('Are you sure you want to delete this element?')) {
                var idDoc = $(this).find('input')[1].value;
                if(idDoc != ''){
                    $.ajax({
                        type : 'GET',
                        url: `/inbound-peti-kemas/delete/${idDoc}`, 
                        success: function(res) {
                            if(res.status == 'success'){
                                $(this).slideUp(deleteElement);
                                Swal.fire('Success', 'Success to Delete Peti Kemas !', 'Success')
                            }else {
                                Swal.fire('Error', 'Failed to Delete Peti Kemas !', 'error')
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
 
    $('#add_peti_kemas').click(function(){       

    });

 
    // Function
    function initGetData()
    {
        var idDoc = inbound.id;
     
        $.ajax({
            type : 'GET',
            url: `/inbound-peti-kemas/data/${idDoc}`, 
            success: function(res) {
                //alert(JSON.stringify(res.inboundPetiKemas));
                petikemasRepeater.setList(res.inboundPetiKemas.map((v) => ({

                    inbound_container_id    : v.id,
                    container_id            : v.container_id,
                    nomor_peti_kemas        : v.details?.nomor_peti_kemas ?? "",
                    ukuran_peti_kemas_id    : v.details?.ukuran_peti_kemas_id ?? "",
                    jenis_peti_kemas        : v.details?.jenis_peti_kemas ?? "" 

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


