<div class="form-group row" style="margin-top:10px;">
    <h2 class="fw-bolder mt-4">Pengangkutan</h2>

    <div class="col-md-6">
        <label class="form-label required">Jenis Sarana Pengangkutan</label>
        <p>{{$outbound->outboundTransportLine->transportLine->name}}</p>
    </div>
</div>
@push('js')
<script>
    $(document).ready(function() {
    })
</script>
@endpush