<h3 class="mb-3" style="margin-top: 10px;">Tarif & Fasilitas</h3>


@if($from == 'import')

<div class="form-group row" style="margin-top: 10px;">
    <div class="col-md-2">
        <label class="form-label">BM Brg Baku:</label>
    </div>
    <div class="col-md-3">
        {!! Form::select('details[bm_type]', $bmTypes, null, ['class' => 'form-select','placeholder' => '-- Select --', 'id' => 'bm_type']) !!}
    </div>
    <div class="col-md-2">
        <div class="input-group mb-5">
        {!! Form::number('details[bm]', 0, ['class' => 'form-control', 'required' => true, 'id' => 'bm', 'step' => 'any',  'maxlength' => '3', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
        if(this.value<0){this.value='0'}"]) !!}
          <span class="input-group-text" id="bm_type_percen">%</span>
        </div>
    </div>
    <div class="col-md-3">
        {!! Form::select('details[bm_tax_type]', $taxTypes, null, ['class' => 'form-select','placeholder' => '-- Select --', 'id' => 'bm_tax_type']) !!}
    </div>
    <div class="col-md-2">
        <div class="input-group mb-5">
        {!! Form::number('details[bm_tax_value]', 0, ['class' => 'form-control', 'required' => true, 'id' => 'bm_tax_value', 'step' => 'any',  'maxlength' => '3', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
        if(this.value<0){this.value='0'}"]) !!}
        <span class="input-group-text" id="">%</span>
        </div>
    </div>
</div>


@endif

@if($from == 'import')

<div class="form-group row">
    <div class="col-md-2">
        <label class="form-label">PPN:</label>
    </div>
    <div class="col-md-3">
        <div class="input-group mb-5">
        {!! Form::number('details[ppn]', 11, ['class' => 'form-control bg-secondary', 'required' => true, 'id' => 'ppn_import', 'step' => 'any',  'maxlength' => '3', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
        if(this.value<0){this.value='0'}", 'readonly' => 'readonly']) !!}
          <span class="input-group-text" id="">%</span>
        </div>
    </div>
    <div class="col-md-4">
        {!! Form::select('details[ppn_tax_type]', $taxTypes, null, ['class' => 'form-select','placeholder' => '-- Select --', 'id' => 'ppn_tax_type_import']) !!}
    </div>
    <div class="col-md-3">
        <div class="input-group mb-5">
        {!! Form::number('details[ppn_tax_value]', 0, ['class' => 'form-control', 'required' => true, 'id' => 'ppn_tax_value_import', 'step' => 'any',  'maxlength' => '3', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
        if(this.value<0){this.value='0'}"]) !!}
          <span class="input-group-text" id="">%</span>
        </div>
    </div>
</div>


@endif

@if($from != 'import')


<div class="form-group row">
    <div class="col-md-2">
        <label class="form-label">PPN:</label>
    </div>
    <div class="col-md-3">
        <div class="input-group mb-5">
        {!! Form::number('details[ppn]', 11, ['class' => 'form-control', 'required' => true, 'id' => 'ppn_local', 'step' => 'any',  'maxlength' => '3', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
        if(this.value<0){this.value='0'}", 'readonly' => 'readonly']) !!}
          <span class="input-group-text" id="">%</span>
        </div>
    </div>
    <div class="col-md-4">
        {!! Form::select('details[ppn_tax_type]', $taxTypes, null, ['class' => 'form-select','placeholder' => '-- Select --', 'id' => 'ppn_tax_type_local']) !!}
    </div>
    <div class="col-md-3">
        <div class="input-group mb-5">
        {!! Form::number('details[ppn_tax_value]', 0, ['class' => 'form-control', 'required' => true, 'id' => 'ppn_tax_value_local', 'step' => 'any',  'maxlength' => '3', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
        if(this.value<0){this.value='0'}"]) !!}
          <span class="input-group-text" id="">%</span>
        </div>
    </div>
</div>

@endif

@if($from == 'import')


<div class="form-group row">
    <div class="col-md-2">
        <label class="form-label">PPnBM:</label>
    </div>
    <div class="col-md-3">
        <div class="input-group mb-5">
        {!! Form::number('details[ppnbm]', 0, ['class' => 'form-control', 'id' => 'ppnbm', 'step' => 'any',  'maxlength' => '3', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
        if(this.value<0){this.value='0'}"]) !!}
        <span class="input-group-text" id="">%</span>
        </div>
    </div>
    <div class="col-md-4">
        {!! Form::select('details[ppnbm_tax_type]', $taxTypes, null, ['class' => 'form-select','placeholder' => '-- Select --', 'id' => 'ppnbm_tax_type']) !!}
    </div>
    <div class="col-md-3">
        <div class="input-group mb-5">
        {!! Form::number('details[ppnbm_tax_value]', 0, ['class' => 'form-control', 'id' => 'ppnbm_tax_value', 'step' => 'any',  'maxlength' => '3', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
        if(this.value<0){this.value='0'}"]) !!}
        <span class="input-group-text" id="">%</span>
        </div>
    </div>
</div>

<div class="form-group row">
    <div class="col-md-2">
        <label class="form-label">PPh:</label>
    </div>
    <div class="col-md-3">
        <div class="input-group mb-5">
        {!! Form::number('details[pph]', 0, ['class' => 'form-control', 'id' => 'pph', 'step' => 'any',  'maxlength' => '3', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
        if(this.value<0){this.value='0'}"]) !!}
        <span class="input-group-text" id="">%</span>
        </div>
    </div>
    <div class="col-md-4">
        {!! Form::select('details[pph_tax_type]', $taxTypes, null, ['class' => 'form-select','placeholder' => '-- Select --', 'id' => 'pph_tax_type']) !!}
    </div>
    <div class="col-md-3">
        <div class="input-group mb-5">
        {!! Form::number('details[pph_tax_value]', 0, ['class' => 'form-control', 'id' => 'pph_tax_value', 'step' => 'any',  'maxlength' => '3', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
        if(this.value<0){this.value='0'}"]) !!}
        <span class="input-group-text" id="">%</span>
        </div>
    </div>
</div>
@endif
