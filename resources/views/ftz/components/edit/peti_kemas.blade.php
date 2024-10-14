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
                        {!! Form::hidden('inbound_id', null, []) !!}
                        {!! Form::hidden('inbound_container_id', null, []) !!}
                            <div class="col-md-1">
                                <label class="form-label">Seri:</label>
                                {!! Form::text('no_seri', null, ['class' => 'form-control number',  'oninput' => 'this.value = this.value.toUpperCase()', 'readonly' => 'readonly']) !!}
                            </div>
                            <div class="col-md-2">
                                <label class="form-label required">Nomor</label>
                                {!! Form::text('nomor_peti_kemas', null, ['class' => 'form-control',  'placeholder' => 'Input', 'id' => 'nomor_peti_kemas','oninput' => 'this.value = this.value.toUpperCase()', 'required' => true]) !!}
                            </div>
                            <div class="col-md-2">
                                <label class="form-label required">Ukuran</label>
                                {!! Form::select('ukuran_peti_kemas_id', $masterUkuranPetiKemas , null,  ['class' => 'form-select ukuran_peti_kemas_id' ,  'placeholder' => '--Select--', 'required' => true]) !!}
                            </div>
                            <div class="col-md-2">
                                <label class="form-label required">Jenis</label>                
                                {!! Form::select('jenis_peti_kemas', $jenisPetiKemas , null,  ['class' => 'form-select jenis_peti_kemas' , 'placeholder' => '--Select--', 'required' => true]) !!}
                            </div>
                            <div class="col-md-3">
                                <label class="form-label required">Tipe</label>
                                {!! Form::select('container_id', $masterTypePetiKemas , null,  ['class' => 'form-select container_id' ,  'placeholder' => '--Select--', 'required' => true]) !!}
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
                <a href="javascript:;" id="btn-update-peti-kemass" class="btn btn-light-warning">
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
    petikemasRepeater = $('#inbound_peti_kemas').repeater({
        initEmpty: true,
        show: function() {
            
            $('#peti_kemas .select2-container').remove();
            $('#peti_kemas .ukuran_peti_kemas_id').select2();
            $('#peti_kemas .jenis_peti_kemas').select2();
            $('#peti_kemas .container_id').select2();

            $(this).slideDown();
            $(this).find('select').select2();
            $petikemasid = $("[name='inbound_peti_kemas["+angka+"][container_id]']");
            angka++;
            $(this).find('input').eq(2).val(angka);
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
                                angka = 0;
                                initGetData();
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
                    $(this).slideUp(deleteElement, function () {
                        $(this).remove();
                        setSeri();
                        angka--;
                    });
                }

            }
        }
    });

    $('#btn-update-peti-kemass').click(function() {
        if (!confirm('are you sure you want to update these items?')) {
            return
        }
        const token     = "{{ csrf_token() }}"
        var formData    = new FormData();
        var inboundId   = inbound.id;

        $.each(petikemasRepeater.repeaterVal().inbound_peti_kemas, (i , vl) => {
            
            
            formData.append('inbound_id[]',             inboundId);
            formData.append('inbound_container_id[]',   vl.inbound_container_id);
            formData.append('container_id[]',           vl.container_id); 
            formData.append('nomor_peti_kemas[]',       vl.nomor_peti_kemas);
            formData.append('jenis_peti_kemas[]',       vl.jenis_peti_kemas);
            formData.append('ukuran_peti_kemas_id[]',   vl.ukuran_peti_kemas_id);
 
        });

        $.ajax({
            type : 'POST',
            headers: {'X-CSRF-TOKEN': token},
            url: `/inbound-peti-kemas/insert-or-update`,
            data:  formData,
            processData: false,  
            contentType: false, 
            success: function(res) {
                if(res.status == 'success'){
                    angka = 0;
                    initGetData();
                    Swal.fire('Success', 'Success to Add or Update Peti Kemas !', 'Success')
                }else {
                    Swal.fire('Error', 'Failed to Add or Update Peti Kemas !', 'error')
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
            url: `/inbound-peti-kemas/data/${idDoc}`, 
            success: function(res) {

                //alert(JSON.stringify(res.inboundPetiKemas));
                petikemasRepeater.setList(res.inboundPetiKemas.map((v) => ({

                    inbound_container_id    : v.id,
                    no_seri                 : v.no_seri,
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

    function setSeri(){
        var repeaterData = $('div[data-repeater-list="inbound_peti_kemas"] > div');
        for(var i = 0 ; i < repeaterData.length ; i++){
            repeaterData.eq(i).find('input').eq(2).val(i + 1)
        }
    }
})
</script>
@endpush


