<div class=" bg-transparent border-dashed border-1  rounded p-3" style="border-color:lightgrey; margin-top:10px; ">
    <h2 class="fw-bolder mt-4">Pengangkutan</h2>
    <div class="form-group row" style="margin-top:10px;">
         
        <div class="col-md-2">
            <label class="form-label required">Cara </label>
            {!! Form::select('details[transportation_id]', $transportations, null, ['class' => 'form-select', 'required' => true, 'data-control' => 'select2', 'placeholder' => '-- Select --' , 'id' => 'transportation_id']) !!}
            @if($errors->has('details[transportation_id]'))
                <span class="error text-danger">{{ $errors->first('details[transportation_id]') }}</span>
            @endif
        </div>
        <div class="col-md-3">
            <label class="form-label required">Sarana </label>
            {!! Form::text('transport_lines_id', null, ['class' => 'form-control', 'placeholder' => 'Sarana Pengangkutan' , 'id' => 'transport_lines_id']) !!}
            @if($errors->has('transport_lines_id'))
                <span class="error text-danger">{{ $errors->first('transport_lines_id') }}</span>
            @endif
        </div>
        
        <div class="col-md-3">
            <label class="form-label required">No. Voy/Flight</label>
            {!! Form::text('vehicle_number', null, ['class' => 'form-control', 'required' => true, 'id' => 'vehicle_number']) !!}
            @if($errors->has('vehicle_number'))
                <span class="error text-danger">{{ $errors->first('vehicle_number') }}</span>
            @endif
        </div>
        <div class="col-md-2">
            <label class="form-label">Bendera</label>
            {!! Form::select('country_id', $country, null, ['class' => 'form-select', 'data-control' => 'select2', 'placeholder' => '-- Select --' ,  'id' => 'country_id']) !!}
            @if($errors->has('country_id'))
                <span class="error text-danger">{{ $errors->first('country_id') }}</span>
            @endif
        </div> 
        <div class="col-md-2">
            <label class="form-label required">Estimasi Tgl Tiba</label>
            {!! Form::text('details[estimated_arrival_date]', null, ['class' => 'form-control datepicker', 'required' => true, 'placeholder' => 'input Tanggal', 'id' => 'estimated_arrival_date']) !!}
            @if($errors->has('details[estimated_arrival_date]'))
                <span class="error text-danger">{{ $errors->first('details[estimated_arrival_date]') }}</span>
            @endif
        </div>

    </div>
</div>   
<div class=" bg-transparent border-dashed border-1  rounded p-3" style="border-color:lightgrey; margin-top:10px; ">
    <h2 class="fw-bolder mt-4">Pelabuhan & tempat Penimbunan</h2>    
    <div class="form-group row" style="margin-top:10px;">
        <div class="col-md-3">
            <label class="form-label ">Pelabuhan Muat</label>
            {!! Form::select('loading_port_id', [], null, ['class' => 'form-select', 'data-control' => 'select2', 'placeholder' => '-- Select --', 'id' => 'loading_port_id']) !!}
            @if($errors->has('loading_port_id'))
                <span class="error text-danger">{{ $errors->first('loading_port_id') }}</span>
            @endif
        </div>
        <div class="col-md-3">
            <label class="form-label ">Pelabuhan Transit</label>
            {!! Form::select('transit_port_id', [], null, ['class' => 'form-select', 'data-control' => 'select2', 'placeholder' => '-- Select --', 'id' => 'transit_port_id']) !!}
            @if($errors->has('transit_port_id'))
                <span class="error text-danger">{{ $errors->first('transit_port_id') }}</span>
            @endif
        </div> 
        <div class="col-md-3">
            <label class="form-label ">Pelabuhan Bongkar</label>
            {!! Form::select('unloading_port_id', [], null, ['class' => 'form-select', 'data-control' => 'select2', 'placeholder' => '-- Select --', 'id' => 'unloading_port_id']) !!}
            @if($errors->has('unloading_port_id'))
                <span class="error text-danger">{{ $errors->first('unloading_port_id') }}</span>
            @endif
        </div>
        <div class="col-md-3">
            <label class="form-label required">Tempat Penimbunan</label>
            {!! Form::select('master_tps_id', $tps, null, ['class' => 'form-select', 'required' => true,'placeholder' => '-- Select --', 'data-control' => 'select2', 'id' => 'master_tps_id']) !!}
            @if($errors->has('master_tps_id'))
                <span class="error text-danger">{{ $errors->first('master_tps_id') }}</span>
            @endif
        </div>
    </div>
    </div>    
@push('js')
<script>
    $(document).ready(function() {

        
        
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
             //   $('#transport_lines_id').val(res['transport_line_name']);
              //  $('#country_id').val(res['country_name']);
            },
            error: function(res) {
                Swal.fire("Error!", res.responseJSON.message, "error");
            }
        })
    });
</script>
@endpush
