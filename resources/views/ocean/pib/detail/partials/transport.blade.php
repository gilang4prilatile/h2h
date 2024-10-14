<div class=" bg-transparent border-dashed border-1  rounded p-3" style="border-color:lightgrey; margin-top:10px; ">
    <div class="form-group row" style="margin-top:10px;">
        <h2 class="fw-bolder mt-4">Pengangkutan</h2>

        <div class="col-md-3">
            <label class="form-label required">Sarana Pengangkutan</label>
            <p>{{$inbound->inboundTransportation->transportation->name}}</p>
        </div>
        <div class="col-md-3">
            <label class="form-label required">Cara Pengangkutan</label>
            <p>{{ $inbound->inboundTransportation->transportation->transportLine->name }}</p>
        </div>
        @if(isset($inbound->country->name))
        <div class="col-md-3">
            <label class="form-label required">Negara</label>
            <p>{{$inbound->country->name}}</p>
        </div>
        @endif

        <div class="col-md-3">
            <label class="form-label required">No. Voy/Flight</label>
            <p>{{$inbound->inboundTransportation->vehicle_number}}</p>
        </div>

    </div>
    <div class="form-group row" style="margin-top:10px;">
        <div class="col-md-4">
            <label class="form-label required">Pelabuhan Muat</label>
            <p>{{$inbound->muat}}</p>
        </div>
        <div class="col-md-4">
            <label class="form-label required">Pelabuhan Transit</label>
            <p>{{$inbound->transit}}</p>
        </div>
        <div class="col-md-4">
            <label class="form-label required">Pelabuhan Bongkar</label>
            <p>{{$inbound->bongkar}}</p>
        </div>
    </div>
    <div class="form-group row" style="margin-top:10px;">
        <div class="col-md-4">
            <label class="form-label required">Tempat Penimbunan</label>
            <p>{{$inbound->inboundTPS->masterTPS->name}} </p>
        </div>
    </div>
</div>
@push('js')
<script>
    $(document).ready(function() {
    })
</script>
@endpush