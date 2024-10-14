<h3 class="mb-3" style="margin-top: 10px;">Tarif & Fasilitas</h3>
<div class="form-group row">
    <div class="col-md-1">
        <label class="form-label">BM:</label>
    </div>
    <div class="col-md-3">
        {!! Form::select('details[bm_type]', $bmTypes, null, ['class' => 'form-select','placeholder' => '-- Select --', 'id' => 'bm_type', 'disabled' => true]) !!}
    </div>
    <div class="col-md-2">
        <div class="input-group mb-5">
        {!! Form::number('details[bm]', null, ['class' => 'form-control', 'required' => true, 'id' => 'bm', 'step' => 'any', 'disabled' => true]) !!}
        </div>
    </div>
    <div class="col-md-3">
        {!! Form::select('details[bm_tax_type]', $taxTypes, null, ['class' => 'form-select','placeholder' => '-- Select --', 'id' => 'bm_tax_type', 'disabled' => true]) !!}
    </div>
    <div class="col-md-2">
        <div class="input-group mb-5">
        {!! Form::number('details[bm_tax_value]', null, ['class' => 'form-control', 'required' => true, 'id' => 'bm_tax_value', 'step' => 'any', 'disabled' => true]) !!}
        </div>
    </div>
</div>

<div class="form-group row">
    <div class="col-md-1">
        <label class="form-label">PPN:</label>
    </div>
    <div class="col-md-3">
        <div class="input-group mb-5">
        {!! Form::number('details[ppn]', null, ['class' => 'form-control', 'required' => true, 'id' => 'ppn', 'step' => 'any', 'disabled' => true]) !!}
        </div>
    </div>
    <div class="col-md-3">
        {!! Form::select('details[ppn_tax_type]', $taxTypes, null, ['class' => 'form-select','placeholder' => '-- Select --', 'id' => 'ppn_tax_type', 'disabled' => true]) !!}
    </div>
    <div class="col-md-3">
        <div class="input-group mb-5">
        {!! Form::number('details[ppn_tax_value]', null, ['class' => 'form-control', 'required' => true, 'id' => 'ppn_tax_value', 'step' => 'any', 'disabled' => true]) !!}
        </div>
    </div>
</div>

<div class="form-group row">
    <div class="col-md-1">
        <label class="form-label">PPnBM:</label>
    </div>
    <div class="col-md-3">
        <div class="input-group mb-5">
        {!! Form::number('details[ppnbm]', null, ['class' => 'form-control', 'required' => true, 'id' => 'ppnbm', 'step' => 'any', 'disabled' => true]) !!}
        </div>
    </div>
    <div class="col-md-3">
        {!! Form::select('details[ppnbm_tax_type]', $taxTypes, null, ['class' => 'form-select','placeholder' => '-- Select --', 'id' => 'ppnbm_tax_type', 'disabled' => true]) !!}
    </div>
    <div class="col-md-3">
        <div class="input-group mb-5">
        {!! Form::number('details[ppnbm_tax_value]', null, ['class' => 'form-control', 'required' => true, 'id' => 'ppnbm_tax_value', 'step' => 'any', 'disabled' => true]) !!}
        </div>
    </div>
</div>

<div class="form-group row">
    <div class="col-md-1">
        <label class="form-label">PPh:</label>
    </div>
    <div class="col-md-3">
        <div class="input-group mb-5">
        {!! Form::number('details[pph]', null, ['class' => 'form-control', 'required' => true, 'id' => 'pph', 'step' => 'any', 'disabled' => true]) !!}
        </div>
    </div>
    <div class="col-md-3">
        {!! Form::select('details[pph_tax_type]', $taxTypes, null, ['class' => 'form-select','placeholder' => '-- Select --', 'id' => 'pph_tax_type', 'disabled' => true]) !!}
    </div>
    <div class="col-md-3">
        <div class="input-group mb-5">
        {!! Form::number('details[pph_tax_value]', null, ['class' => 'form-control', 'required' => true, 'id' => 'pph_tax_value', 'step' => 'any', 'disabled' => true]) !!}
        </div>
    </div>
</div>
