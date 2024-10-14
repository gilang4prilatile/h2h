<div class="form-group row" style="margin-top:10px;">
    <h2 class="fw-bolder mt-4">Pengangkutan</h2>

    <div class="col-md-6">
        <label class="form-label required">Jenis Sarana Pengangkutan</label>
        {!! Form::select('details[transport_line_id]', $transportLines, null, ['class' => 'form-select', 'required' => true, 'data-control' => 'select2', 'placeholder' => '-- Select --']) !!}
        @if($errors->has('details[transport_line_id]'))
            <span class="error text-danger">{{ $errors->first('details[transport_line_id]') }}</span>
        @endif
    </div>
</div>
@push('js')
<script>
    $(document).ready(function() {
    })
</script>
@endpush