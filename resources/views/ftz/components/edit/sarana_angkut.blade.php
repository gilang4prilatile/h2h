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
                            {!! Form::hidden('inbound_id', null, []) !!}
                            {!! Form::hidden('inbound_transportation_id', null, []) !!}
                            <div class="col-md-1">
                                <label class="form-label">Seri:</label>
                                {!! Form::text('no_seri', null, ['class' => 'form-control number', 'required' => true,'oninput' => 'this.value = this.value.toUpperCase()', 'readonly' => 'readonly']) !!}
                            </div>        
                            <div class="col-md-3">
                                <label class="form-label required">Nama Sarana Angkut</label>
                                {!! Form::text('name', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Nama Sarana Angkut', 'id' => 'nomor_peti_kemas','oninput' => 'this.value = this.value.toUpperCase()']) !!}
                            </div>                
                            <div class="col-md-2">
                                <label class="form-label required">Cara Pengangkutan</label>
                                {!! Form::select('transportation_id', $transportations , null,  ['class' => 'form-select transportation_id' , 'required' => true , 'placeholder' => '--Select--']) !!}
                            </div>
                            <div class="col-md-3">
                                <label class="form-label required">Nomor Voy/Flight/No.Pol</label>
                                {!! Form::text('vehicle_number', null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Nama Sarana Angkut', 'id' => 'nomor_peti_kemas','oninput' => 'this.value = this.value.toUpperCase()']) !!}
                            </div>  
                            <div class="col-md-2">
                                <label class="form-label required">Bendera</label>
                                {!! Form::select('country_code', $country , null,  ['class' => 'form-select country_code' , 'required' => true , 'placeholder' => '--Select--']) !!}
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
                <a href="javascript:;" id="btn-update-transportations" class="btn btn-light-warning">
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
var modulNav = @json($moduleNav);
$(document).ready(function() {
    initGetData();
    let angka = 0;
    transportationRepeater = $('#inbound_transportations').repeater({
        initEmpty: true,
        show: function() {


            $('#sarana_angkut .select2-container').remove();
            $('#sarana_angkut .transportation_id').select2();
            $('#sarana_angkut .country_code').select2();

            angka++;
            $(this).slideDown();
            $(this).find('input').eq(2).val(angka);
        },
        hide: function(deleteElement) {
            if (confirm('Are you sure you want to delete this element?')) {
                var idDoc = $(this).find('input')[1].value;
                console.log(idDoc);
                if(idDoc != ''){
                    $.ajax({
                        type : 'GET',
                        url: `/inbound-transportations/delete/${idDoc}`, 
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

    $('#btn-update-transportations').click(function() {
        if (!confirm('are you sure you want to update these items?')) {
            return
        }
        const token     = "{{ csrf_token() }}"
        var formData    = new FormData();
        var inboundId   = inbound.id;

        $.each(transportationRepeater.repeaterVal().inbound_transportations, (i , vl) => {
            formData.append('inbound_id[]', inboundId);
            formData.append('inbound_transportation_id[]', vl.inbound_transportation_id);
            formData.append('name[]', vl.name); 
            formData.append('transportation_id[]', vl.transportation_id);
            formData.append('vehicle_number[]', vl.vehicle_number);
            formData.append('country_code[]', vl.country_code);
        });

        $.ajax({
            type : 'POST',
            headers: {'X-CSRF-TOKEN': token},
            url: `/inbound-transportations/insert-or-update`,
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
            url: `/inbound-transportations/data/${idDoc}`, 
            success: function(res) {
                //alert(JSON.stringify(res.inboundPackages));
                transportationRepeater.setList(res.inboundTransportations.map((v) => ({
                    inbound_transportation_id   : v.id,
                    no_seri                     : v.no_seri,
                    transportation_id           : v.transportation_id,
                    name                        : v.name,
                    vehicle_number              : v.vehicle_number,
                    country_code                : v.country_code

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
