<div class="row mb-10" id="api_form">
    <label class="form-label">API</label>
    <div class="col-md-6">
        {!! Form::select('details[tipe_api]', $tipe_api , null , ['class' => 'form-select', 'placeholder' => '-- Select --' , 'id' => 'tipe_api']) !!}
    </div>
    <div class="col-md-6">
        {!! Form::number('details[nomor_api]',  null, ['class' => 'form-control', 'id' => 'nomor_api']) !!}
    </div>
</div>
