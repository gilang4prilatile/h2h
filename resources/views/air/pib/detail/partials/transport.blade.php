<div class=" bg-transparent border-dashed border-1  rounded p-3" style="border-color:lightgrey; margin-top:10px; ">
    <h2 class="fw-bolder mt-4">Pengangkutan</h2>
<div class="form-group row" style="margin-top:10px;">
    

<div class="col-md-2">
        <label class="form-label required">Sarana Pengangkutan</label>
        {!! Form::select('transportation_id', $transportations, $inbound->inboundTransportation->pluck('transportation_id'), ['class' => 'form-select', 'required' => true, 'disabled' => true,'data-control' => 'select2', 'placeholder' => '-- Select --' , 'id' => 'transportation_id']) !!}
        @if($errors->has('transportation_id'))
            <span class="error text-danger">{{ $errors->first('transportation_id') }}</span>
        @endif
    </div>
    <div class="col-md-3">
        <label class="form-label required">Cara Pengangkutan</label>
        {!! Form::text(null, $inbound->inboundTransportation->pluck('name')->first(), ['class' => 'form-control bg-secondary','readonly' => 'readonly','disabled' => true, 'placeholder' => 'Pilih Sarana Pengangkutan' , 'id' => 'transport_lines_id']) !!}
    </div>

    <div class="col-md-3">
        <label class="form-label">Bendera</label>
        {!! Form::select('country_id', $country, $inbound->inboundTransportation->pluck('country_code'), ['class' => 'form-select', 'disabled' => true, 'data-control' => 'select2', 'placeholder' => '-- Select --' ,  'id' => 'country_id']) !!}
        @if($errors->has('country_id'))
            <span class="error text-danger">{{ $errors->first('country_id') }}</span>
        @endif
    </div>

    <div class="col-md-2">
        <label class="form-label required">No. Voy/Flight</label>
        {!! Form::text('vehicle_number', $inbound->inboundTransportation->pluck('vehicle_number')->first(), ['class' => 'form-control', 'disabled' => true,'required' => true]) !!}
        @if($errors->has('vehicle_number'))
            <span class="error text-danger">{{ $errors->first('vehicle_number') }}</span>
        @endif
    </div>
    <div class="col-md-2">
        <label class="form-label required">Tanggal</label>
        {!! Form::text('details[estimated_arrival_date]', @$inbound->details['estimated_arrival_date'] ?: null, ['class' => 'form-control datepicker', 'required' => true, 'disabled' => true,'placeholder' => 'input Tanggal']) !!}
        @if($errors->has('details[estimated_arrival_date]'))
            <span class="error text-danger">{{ $errors->first('details[estimated_arrival_date]') }}</span>
        @endif
    </div>
</div>
<div class="form-group row" style="margin-top:10px;">
    <div class="col-md-3">
        <label class="form-label required">Pelabuhan Muat</label>
        {!! Form::select('loading_port_id',  [], null, ['class' => 'form-select bg-secondary', 'disabled' => true,  'data-control' => 'select2', 'placeholder' => '-- Select --', 'id' => 'loading_port_id']) !!}
        @if($errors->has('loading_port_id'))
            <span class="error text-danger">{{ $errors->first('loading_port_id') }}</span>
        @endif
    </div>
    <div class="col-md-3">
        <label class="form-label">Pelabuhan Transit</label>
        {!! Form::select('transit_port_id',  [], null, ['class' => 'form-select bg-secondary', 'disabled' => true,  'data-control' => 'select2', 'placeholder' => '-- Select --', 'id' => 'transit_port_id']) !!}
        @if($errors->has('transit_port_id'))
            <span class="error text-danger">{{ $errors->first('transit_port_id') }}</span>
        @endif
    </div>
    <div class="col-md-3">
        <label class="form-label required">Pelabuhan Bongkar</label>
        {!! Form::select('unloading_port_id',  [], null, ['class' => 'form-select bg-secondary', 'disabled' => true,  'data-control' => 'select2', 'placeholder' => '-- Select --', 'id' => 'unloading_port_id']) !!}
        @if($errors->has('unloading_port_id'))
            <span class="error text-danger">{{ $errors->first('unloading_port_id') }}</span>
        @endif
    </div>
    <div class="col-md-3">
        <label class="form-label required">Tempat Penimbunan</label>
        {!! Form::select('master_tps_id', $tps, $inbound->inboundTPS->master_tps_id ?? '', ['class' => 'form-select bg-secondary', 'disabled' => true,  'placeholder' => '-- Select --', 'data-control' => 'select2']) !!}
        @if($errors->has('master_tps_id'))
            <span class="error text-danger">{{ $errors->first('master_tps_id') }}</span>
        @endif
    </div>
</div>
</div>
@push('js')
<script>
    $(document).ready(function() {
        
        $('#loading_port_id, #transit_port_id, #unloading_port_id').select2({
                ajax : {
                    url : "{{url('/')}}/master-data/port/search",
                    dataType : "json",
                    cache: true,
                    data : function(params){
                        var query = {
                            search : params.term
                        }

                        return query;   
                    },
                    processResults : function(data){
                        return {
                            results : data
                        }
                    }
                },
                placeholder : "Search for port",
                minimumInputLength : 2

            });
             
            
            var optionLoadingPort = new Option(`${inbound.muat.code} - ${inbound.muat.name}`, inbound.muat.id, true, true);
            $('#loading_port_id').append(optionLoadingPort).trigger("change");

            var optionTransitPort = new Option(`${inbound.transit.code} - ${inbound.transit.name}`, inbound.transit.id, true, true);
            $('#transit_port_id').append(optionTransitPort).trigger("change");

            var optionUnloadingPort = new Option(`${inbound.bongkar.code} - ${inbound.bongkar.name}`, inbound.bongkar.id, true, true);
            $('#unloading_port_id').append(optionUnloadingPort).trigger("change");
            
    })
    $('#transportation_id').on('change', function() {
        $('#transport_lines_id').val("");
        $('#country_id').val("");
        var value_transportation_id = this.value;
        $.ajax({
            type: "GET",
            url: '{{url('/')}}/master-data/transportations/detail/'+value_transportation_id,
            success: function(res) {
                console.log(res);
                $('#transport_lines_id').val(res['transport_line_name']);
                $('#country_id').val(res['country_name']);
            },
            error: function(res) {
                Swal.fire("Error!", res.responseJSON.message, "error");
            }
        })
    });
</script>
@endpush
