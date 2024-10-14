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
                            <div class="col-md-4">
                                <label class="form-label">Type:</label>
                                {!! Form::select('document_id', $documentSelectBox , null,  ['class' => 'form-select' , 'required' => true , 'placeholder' => '--Select--']) !!}
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Tanggal:</label>
                                {!! Form::text('date', null, ['class' => 'form-control datepicker', 'required' => true, 'placeholder' => 'Pilih Tanggal']) !!}
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Nomor:</label>
                                {!! Form::text('nomor_dokumen', null, ['class' => 'form-control number', 'required' => true, 'placeholder' => 'Nomor','oninput' => 'this.value = this.value.toUpperCase()']) !!}
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">File:</label>
                                {!! Form::file('file', ['class' => 'form-control', 'placeholder' => 'File' , 'id' => 'inputfile',  'required' => true]) !!}
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
        var index = 0;
   
        documentRepeater = $('#inbound_documents').repeater({
            initEmpty: true,
            show: function() {
                $(this).slideDown();
                $(this).find('select').val(3);
                $(this).find("select").select2({});
                $(this).find(".datepicker").flatpickr();
                selectedGoods.forEach(function(v, i, array) {
                    $('.document_goods').append("<option value='"+v.good_id+"'>"+v.name+"</option>");
                    $('.document_goods').trigger('change');
                })
            },
            hide: function(deleteElement) {

                let valueRepeater = $('#inbound_documents').repeaterVal().inbound_documents;
                let valueDelete = $(this).find('input')[1].value;
                $.each(valueRepeater, (i, vi) => {
                    if(vi.nomor_dokumen == valueDelete){
                        $.each(selectedGoods, (v, vx) => {
                           vx.good_documents = vx.good_documents.filter(item => item != i)
                        })
                    }

                })
                $(this).slideUp(deleteElement);
            }
        });
        
    })
</script>
@endpush
