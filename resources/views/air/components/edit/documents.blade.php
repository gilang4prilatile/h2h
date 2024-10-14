<div class="form-group row" style="margin-top:10px;">
    <div class="col-md-12">
        <h2 class="fw-bolder mt-4">Dokumen</h2>
        @if($errors->has('inbound_documents'))
            <span class="error text-danger">{{ $errors->first('inbound_documents') }}</span>
        @endif
        @if($errors->has('inbound_documents.*.*'))
            <span class="error text-danger">{{ $errors->first('inbound_documents.*.*') }}</span>
        @endif
        <!--begin::Repeater-->
        <div id="inbound_documents">
            <!--begin::Form group-->
            <div class="form-group">
                <div data-repeater-list="inbound_documents">
                    <div data-repeater-item>
                        <div class="form-group row">
                            {!! Form::hidden('inbound_id', null, []) !!}
                            {!! Form::hidden('inbound_document_id', null, []) !!}
                            <div class="col-md-1">
                                <label class="form-label">Seri:</label>
                                {!! Form::text('no_seri', null, ['class' => 'form-control number', 'required' => true,'oninput' => 'this.value = this.value.toUpperCase()', 'readonly' => 'readonly']) !!}
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Type:</label>
                                {!! Form::select('document_id', $documentSelectBox, null, ['class' => 'form-select', 'placeholder' => '-- Select --',  'required' => true]) !!}
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Tanggal:</label>
                                {!! Form::text('date', null, ['class' => 'form-control datepicker', 'required' => true, 'placeholder' => 'Pilih Tanggal']) !!}
                            </div>
                            <div class="col-md-1">
                                <label class="form-label">Nomor:</label>
                                {!! Form::text('nomor_dokumen', null, ['class' => 'form-control number', 'required' => true, 'placeholder' => 'Nomor','oninput' => 'this.value = this.value.toUpperCase()']) !!}
                            </div>
                            <div class="col-md-3 col-file">
                                <label class="form-label">File:</label>
                                {!! Form::file('file' , ['class' => 'form-control form_input', 'placeholder' => 'File']) !!}
                            </div>
                            <div class="col-md-2 col-file-action">
                                <div class="btn-block">
                                    <a href="javascript:;" class="btn_link btn btn-sm btn-light-success mt-3 mt-md-8" style="display: none;">
                                        {!! Form::hidden('file_document_preview' , null ,['class' => 'file_document']) !!}
                                        <i class="la la-file"></i>
                                    </a>
                                    <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                        <i class="la la-trash-o"></i>
                                    </a>
                                </div>
                                <span class="text_document" style="font-size: 9px;color:gray;"></span>
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
                <a href="javascript:;" id="btn-update-documents" class="btn btn-light-warning">
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
    documentRepeater = $('#inbound_documents').repeater({
        initEmpty: true,
        show: function() {
            
            $(this).slideDown();
            $(this).find('select').select2();
            $(this).find(".datepicker").flatpickr({ dateFormat: 'd-m-Y' });
            $documentid = $("[name='inbound_documents["+angka+"][document_id]']");
            angka++;
            $(this).find('input').eq(2).val(angka);
            if($documentid.val() == 0){
                $(this).find('select').val(5);
            }
            inboundDetails.forEach(function(v, i, array) {
                $('.document_goods').append("<option value='"+v.good_id+"'>"+v.name+"</option>");
                $('.document_goods').trigger('change');
            })
        },
        hide: function(deleteElement) {
            if (confirm('Are you sure you want to delete this element?')) {
                var idDoc = $(this).find('input')[1].value;
                if(idDoc != ''){
                    $.ajax({
                        type : 'GET',
                        url: `/inbound-documents/delete/${idDoc}`, 
                        success: function(res) {
                            if(res.status == 'success'){
                                angka = 0;
                                initGetData();
                                $(this).slideUp(deleteElement);
                                Swal.fire('Success', 'Success to Delete Document !', 'Success')
                            }else {
                                Swal.fire('Error', 'Failed to Delete Document !', 'error')
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
 
    $('#add_document').click(function(){

        $('.file_document').last().css('display', 'none');

    });


    $('#btn-update-documents').click(function() {
        if (!confirm('are you sure you want to update these items?')) {
            return
        }
        const token     = "{{ csrf_token() }}"
        var formData    = new FormData();
        var inboundId   = inbound.id;

        $.each(documentRepeater.repeaterVal().inbound_documents, (i , vl) => {

            var filesArr = vl.file != "" ? $(`input[name="inbound_documents[${i}][file]"]`)[0].files[0] : null;

            formData.append('inbound_id[]', inboundId);
            formData.append('date[]', vl.date);
            formData.append('document_id[]', vl.document_id);
            formData.append(`file_document[${i}]`, filesArr);
            formData.append('inbound_document_id[]', vl.inbound_document_id);
            formData.append('nomor_dokument[]', vl.nomor_dokumen);
 
        });

        $.ajax({
            type : 'POST',
            headers: {'X-CSRF-TOKEN': token},
            url: `/inbound-documents/insert-or-update`,
            data:  formData,
            processData: false,  
            contentType: false, 
            success: function(res) {
                if(res.status == 'success'){
                    angka = 0;
                    initGetData();
                    Swal.fire('Success', 'Success to Add or Update Document !', 'Success')
                }else {
                    Swal.fire('Error', 'Failed to Add or Update Document !', 'error')
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
            url: `/inbound-documents/data/${idDoc}`, 
            success: function(res) {
                
                documentRepeater.setList(res.inboundDocuments.map((v) => ({

                    inbound_document_id: v.id,
                    no_seri : v.seri_document,
                    document_id: v.document_id,
                    date: v.details?.date ?? "",
                    nomor_dokumen: v.details?.nomor_dokumen ?? "",
                    file_document_preview : v.file?.name ?? ""

                })))
       
                setFileDocument(res.inboundDocuments);
               
            },
            error: function(res) {
                console.log(res);
            }
        });

     
    }

    function setFileDocument(inboundDocuments)
    {

        $('.file_document').each((ind, vl) => {

            $('.btn_link')[ind].style.display = "inline-block";

            let colFile = $('.col-file')[ind];
            let colActionFile = $('.col-file-action')[ind];

            if(colFile.classList.contains('col-md-4')){

                colFile.classList.remove('col-md-4');
                colFile.classList.add('col-md-3');

                colActionFile.classList.remove('col-md-1');
                colActionFile.classList.add('col-md-2');

            }

            inboundDocuments.map((v) => {
                if (vl.value != "" && vl.value === v.file.name) {
                    $('.text_document')[ind].innerText = "File : " + v.file.name;
                }

            });

        });

        $('.btn_link').click(function() {
            inboundDocuments.map((v) => {

                if ($(this).children('input').val() === v.file.name) {

                    var win = window.open(`${v.file.path}`, '_blank');
                    if (win) {
                        win.focus();
                    }

                }

            });


        });


    }

    function setSeri(){
        var repeaterData = $('div[data-repeater-list="inbound_documents"] > div');
        for(var i = 0 ; i < repeaterData.length ; i++){
            repeaterData.eq(i).find('input').eq(2).val(i + 1)
        }
    }
 
})
</script>
@endpush
