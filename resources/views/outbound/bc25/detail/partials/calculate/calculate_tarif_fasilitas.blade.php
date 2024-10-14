<h3 class="mb-3" style="margin-top: 10px;">Tarif & Fasilitas</h3>


@if($from == 'import')

<!-- Bahan Baku -->

    <!-- <div class="form-group row">
        <div class="col-md-2">
            <label class="form-label">BM Brg Jdi:</label>
        </div>
        <div class="col-md-5">
            {!! Form::number('details[bm_barang_jadi]', null, ['class' => 'form-control', 'required' => true, 'id' => 'bm_barang_jadi', 'step' => 'any',  'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
            if(this.value<0){this.value='0'}"]) !!}
        </div>
    </div> -->

<!-- END Bahan Baku -->

<div class="form-group row" style="margin-top: 10px;">
    <div class="col-md-2">
        <label class="form-label">BM Brg Baku:</label>
    </div>
    <div class="col-md-3">
        {!! Form::select('details[bm_type]', $bmTypes, null, ['class' => 'form-select','placeholder' => '-- Select --', 'id' => 'bm_type']) !!}
    </div>
    <div class="col-md-2">
        <div class="input-group mb-5">
        {!! Form::number('details[bm]', null, ['class' => 'form-control', 'required' => true, 'id' => 'bm', 'step' => 'any',  'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
        if(this.value<0){this.value='0'}"]) !!}
        </div>
    </div>
    <div class="col-md-3">
        {!! Form::select('details[bm_tax_type]', $taxTypes, null, ['class' => 'form-select','placeholder' => '-- Select --', 'id' => 'bm_tax_type']) !!}
    </div>
    <div class="col-md-2">
        <div class="input-group mb-5">
        {!! Form::number('details[bm_tax_value]', null, ['class' => 'form-control', 'required' => true, 'id' => 'bm_tax_value', 'step' => 'any',  'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
        if(this.value<0){this.value='0'}"]) !!}
        </div>
    </div>
</div>


@endif

<div class="form-group row">
    <div class="col-md-2">
        <label class="form-label">PPN:</label>
    </div>
    <div class="col-md-3">
        <div class="input-group mb-5">
        {!! Form::number('details[ppn]', 11, ['class' => 'form-control', 'required' => true, 'id' => 'ppn', 'step' => 'any',  'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
        if(this.value<0){this.value='0'}", 'readonly' => 'readonly']) !!}
        </div>
    </div>
    <div class="col-md-4">
        {!! Form::select('details[ppn_tax_type]', $taxTypes, null, ['class' => 'form-select','placeholder' => '-- Select --', 'id' => 'ppn_tax_type']) !!}
    </div>
    <div class="col-md-3">
        <div class="input-group mb-5">
        {!! Form::number('details[ppn_tax_value]', null, ['class' => 'form-control', 'required' => true, 'id' => 'ppn_tax_value', 'step' => 'any',  'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
        if(this.value<0){this.value='0'}"]) !!}
        </div>
    </div>
</div>

@if($from == 'import')


<div class="form-group row">
    <div class="col-md-2">
        <label class="form-label">PPnBM:</label>
    </div>
    <div class="col-md-3">
        <div class="input-group mb-5">
        {!! Form::number('details[ppnbm]', null, ['class' => 'form-control', 'required' => true, 'id' => 'ppnbm', 'step' => 'any',  'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
        if(this.value<0){this.value='0'}"]) !!}
        </div>
    </div>
    <div class="col-md-4">
        {!! Form::select('details[ppnbm_tax_type]', $taxTypes, null, ['class' => 'form-select','placeholder' => '-- Select --', 'id' => 'ppnbm_tax_type']) !!}
    </div>
    <div class="col-md-3">
        <div class="input-group mb-5">
        {!! Form::number('details[ppnbm_tax_value]', null, ['class' => 'form-control', 'required' => true, 'id' => 'ppnbm_tax_value', 'step' => 'any',  'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
        if(this.value<0){this.value='0'}"]) !!}
        </div>
    </div>
</div>

<div class="form-group row">
    <div class="col-md-2">
        <label class="form-label">PPh:</label>
    </div>
    <div class="col-md-3">
        <div class="input-group mb-5">
        {!! Form::number('details[pph]', null, ['class' => 'form-control', 'required' => true, 'id' => 'pph', 'step' => 'any',  'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
        if(this.value<0){this.value='0'}"]) !!}
        </div>
    </div>
    <div class="col-md-4">
        {!! Form::select('details[pph_tax_type]', $taxTypes, null, ['class' => 'form-select','placeholder' => '-- Select --', 'id' => 'pph_tax_type']) !!}
    </div>
    <div class="col-md-3">
        <div class="input-group mb-5">
        {!! Form::number('details[pph_tax_value]', null, ['class' => 'form-control', 'required' => true, 'id' => 'pph_tax_value', 'step' => 'any',  'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
        if(this.value<0){this.value='0'}"]) !!}
        </div>
    </div>
</div>

<!-- Cukai -->

    <!-- <div class="form-group row">
        <div class="col-md-2">
            <label class="form-label">Cukai:</label>
        </div>
        <div class="col-md-7">
            {!! Form::select('details[pph_tax_type]', $taxTypes, null, ['class' => 'form-select','placeholder' => '-- Select --', 'id' => 'pph_tax_type']) !!}
        </div>
    </div>

    <div class="form-group row" style="margin-top: 10px;">
        <div class="col-md-2"> </div>
        <div class="col-md-3">
            {!! Form::select('details[bm_type]', $bmTypes, null, ['class' => 'form-select','placeholder' => '-- Select --', 'id' => 'bm_type']) !!}
        </div>
        <div class="col-md-2">
            <div class="input-group mb-5">
            {!! Form::number('details[bm]', null, ['class' => 'form-control', 'required' => true, 'id' => 'bm', 'step' => 'any',  'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
            if(this.value<0){this.value='0'}"]) !!}
            </div>
        </div>
        <div class="col-md-3">
            {!! Form::select('details[bm_tax_type]', $taxTypes, null, ['class' => 'form-select','placeholder' => '-- Select --', 'id' => 'bm_tax_type']) !!}
        </div>
        <div class="col-md-2">
            <div class="input-group mb-5">
            {!! Form::number('details[bm_tax_value]', null, ['class' => 'form-control', 'required' => true, 'id' => 'bm_tax_value', 'step' => 'any',  'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
            if(this.value<0){this.value='0'}"]) !!}
            </div>
        </div>
    </div> -->

<!-- END Cukai -->

<!-- Jumlah Satuan -->

<!-- <div class="form-group row">
    <div class="col-md-2">
        <label class="form-label">Jumlah Satuan:</label>
    </div>
    <div class="col-md-3">
        <div class="input-group mb-5">
        {!! Form::number('details[pph]', null, ['class' => 'form-control', 'required' => true, 'id' => 'pph', 'step' => 'any',  'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
        if(this.value<0){this.value='0'}"]) !!}
        </div>
    </div>
    <div class="col-md-4">
        {!! Form::select('details[pph_tax_type]', $taxTypes, null, ['class' => 'form-select','placeholder' => '-- Select --', 'id' => 'pph_tax_type']) !!}
    </div>
    <div class="col-md-3">
        <div class="input-group mb-5">
        {!! Form::number('details[pph_tax_value]', null, ['class' => 'form-control', 'required' => true, 'id' => 'pph_tax_value', 'step' => 'any',  'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
        if(this.value<0){this.value='0'}"]) !!}
        </div>
    </div>
</div> -->

<!-- END Jumlah Satuan -->



@endif
