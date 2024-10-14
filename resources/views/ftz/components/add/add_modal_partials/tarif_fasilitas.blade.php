<h3 class="mb-3" style="margin-top: 10px;">Tarif & Fasilitas</h3>
<div class="form-group row">
    <div class="col-md-1">
        <label class="form-label">BM:</label>
    </div>
    <div class="col-md-2">
        {!! Form::select('details[bm_type]', $bmTypes, null, ['class' => 'form-select','placeholder' => '-- Select --', 'id' => 'bm_type']) !!}
    </div>
    <div class="col-md-2">
        <div class="input-group mb-5">
        {!! Form::number('details[bm]', 0, ['class' => 'form-control', 'required' => true, 'id' => 'bm', 'step' => 'any',  'maxlength' => '3', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
        if(this.value<0){this.value='0'}" ]) !!}
        <span class="input-group-text" id="bm_type_percen">%</span>
        </div>
    </div>
    <div class="col-md-3">
        {!! Form::select('details[bm_tax_type]', $taxTypes, null, ['class' => 'form-select','placeholder' => '-- Select --', 'id' => 'bm_tax_type']) !!}
    </div>
    <div class="col-md-2">
        <div class="input-group mb-5">
        {!! Form::number('details[bm_tax_value]', 0, ['class' => 'form-control', 'required' => true, 'id' => 'bm_tax_value', 'step' => 'any',  'maxlength' => '3', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
        if(this.value<0){this.value='0'}" ]) !!}
         <span class="input-group-text" id="">%</span>
        </div>
    </div>
</div>
<div class="form-group row">
    <div class="col-md-1">
        <label class="form-label">BMT:</label>
    </div>
    <div class="col-md-2">
        {!! Form::select('details[bmt_type]', $bmTypes, null, ['class' => 'form-select','placeholder' => '-- Select --', 'id' => 'bmt_type']) !!}
    </div>
    <div class="col-md-2">
        <div class="input-group mb-5">
        {!! Form::number('details[bmt]', 0, ['class' => 'form-control', 'required' => true, 'id' => 'bm', 'step' => 'any',  'maxlength' => '3', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
        if(this.value<0){this.value='0'}" ]) !!}
        <span class="input-group-text" id="bmt_type_percen">%</span>
        </div>
    </div>
    <div class="col-md-3">
        {!! Form::select('details[bmt_tax_type]', $taxTypes, null, ['class' => 'form-select','placeholder' => '-- Select --', 'id' => 'bmt_tax_type']) !!}
    </div>
    <div class="col-md-2">
        <div class="input-group mb-5">
        {!! Form::number('details[bmt_tax_value]', 0, ['class' => 'form-control', 'required' => true, 'id' => 'bmt_tax_value', 'step' => 'any',  'maxlength' => '3', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
        if(this.value<0){this.value='0'}" ]) !!}
         <span class="input-group-text" id="">%</span>
        </div>
    </div>
</div>
<div class="form-group row">
    <div class="col-md-1">
        <label class="form-label">PPN:</label>
    </div>
    <div class="col-md-2">
        <div class="input-group mb-5">
        {!! Form::number('details[ppn]', 11, ['class' => 'form-control', 'required' => true, 'id' => 'ppn', 'step' => 'any',  'maxlength' => '3', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
        if(this.value<0){this.value='0'}"]) !!}
        <span class="input-group-text" id="">%</span>
        </div>
    </div>
    <div class="col-md-3">
        {!! Form::select('details[ppn_tax_type]', $taxTypes, null, ['class' => 'form-select','placeholder' => '-- Select --', 'id' => 'ppn_tax_type']) !!}
    </div>
    <div class="col-md-3">
        <div class="input-group mb-5">
        {!! Form::number('details[ppn_tax_value]', 0, ['class' => 'form-control', 'required' => true, 'id' => 'ppn_tax_value', 'step' => 'any',  'maxlength' => '3', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
        if(this.value<0){this.value='0'}" ]) !!}
        <span class="input-group-text" id="">%</span>
        </div>
    </div>
</div>

<div class="form-group row">
    <div class="col-md-1">
        <label class="form-label">PPnBM:</label>
    </div>
    <div class="col-md-2">
        <div class="input-group mb-5">
        {!! Form::number('details[ppnbm]', 0, ['class' => 'form-control', 'id' => 'ppnbm', 'step' => 'any',  'maxlength' => '3', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
        if(this.value<0){this.value='0'}" ]) !!}
        <span class="input-group-text" id="">%</span>
        </div>
    </div>
    <div class="col-md-3">
        {!! Form::select('details[ppnbm_tax_type]', $taxTypes, null, ['class' => 'form-select','placeholder' => '-- Select --', 'id' => 'ppnbm_tax_type']) !!}
    </div>
    <div class="col-md-3">
        <div class="input-group mb-5">
        {!! Form::number('details[ppnbm_tax_value]', 0, ['class' => 'form-control', 'id' => 'ppnbm_tax_value', 'step' => 'any',  'maxlength' => '3', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
        if(this.value<0){this.value='0'}" ]) !!}
        <span class="input-group-text" id="">%</span>
        </div>
    </div>
</div>

<div class="form-group row">
    <div class="col-md-1">
        <label class="form-label">PPh:</label>
    </div>
    <div class="col-md-2">
        <div class="input-group mb-5">
        {!! Form::number('details[pph]', 0, ['class' => 'form-control', 'required' => true, 'id' => 'pph', 'step' => 'any',  'maxlength' => '3', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
        if(this.value<0){this.value='0'}" ]) !!}
        <span class="input-group-text" id="">%</span>
        </div>
    </div>
    <div class="col-md-3">
        {!! Form::select('details[pph_tax_type]', $taxTypes, null, ['class' => 'form-select','placeholder' => '-- Select --', 'id' => 'pph_tax_type']) !!}
    </div>
    <div class="col-md-3">
        <div class="input-group mb-5">
        {!! Form::number('details[pph_tax_value]', 0, ['class' => 'form-control', 'required' => true, 'id' => 'pph_tax_value', 'step' => 'any',  'maxlength' => '3', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
        if(this.value<0){this.value='0'}" ]) !!}
        <span class="input-group-text" id="">%</span>
        </div>
    </div>
</div>
<div class="form-group row">
    <div class="col-md-1">
        <label class="form-label">CUKAI:</label>
    </div>
    <div class="col-md-2">
        {!! Form::select('details[cukai_commodity]', $cukaiCommodity, null, ['class' => 'form-select','placeholder' => '-- Komoditi --', 'id' => 'cukai_commodity']) !!}
    </div>
    <div class="col-md-2">
        {!! Form::select('details[cukai_commodity_code]', $cukaiCommodityCode, null, ['class' => 'form-select','placeholder' => '-- Komoditi --', 'id' => 'cukai_commodity_code']) !!}
    </div>
    <div class="col-md-2">
        {!! Form::select('details[cukai_jenis_tarif]', $bmTypes, null, ['class' => 'form-select','placeholder' => '-- Jenis Tarif --', 'id' => 'cukai_jenis_tarif']) !!}
    </div>
    <div class="col-md-3">
        <div class="input-group mb-5">
        {!! Form::number('details[cukai_besar_tarif]', 0, ['class' => 'form-control','placeholder' => 'Besar Tarif', 'required' => true, 'id' => 'cukai_besar_tarif', 'step' => 'any',  'maxlength' => '3', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
        if(this.value<0){this.value='0'}" ]) !!}
         <span class="input-group-text" id="">RP</span>
        </div>
    </div>
</div>
<div class="form-group row">
    <div class="col-md-1">
        <label class="form-label"> </label>
    </div>
    <div class="col-md-2">
        <div class="input-group mb-5">
        {!! Form::number('details[cukai_jumlah]', 0, ['class' => 'form-control','placeholder' => 'Jumlah Satuan', 'required' => true, 'id' => 'cukai_jumlah', 'step' => 'any',  'maxlength' => '3', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
        if(this.value<0){this.value='0'}" ]) !!}
        </div>
    </div>
    <div class="col-md-4">
        {!! Form::select('details[cukai_jenis_satuan]', $uoms, null, ['class' => 'form-select', 'data-control' => 'select2', 'placeholder' => 'Satuan Barang', 'id' => 'cukai_jenis_satuan']) !!}
    </div>
    <div class="col-md-2">
        <div class="input-group mb-5">
        {!! Form::number('details[cukai_nilai]', 0, ['class' => 'form-control','placeholder' => 'Nilai Cukai', 'required' => true, 'id' => 'cukai_nilai', 'step' => 'any',  'maxlength' => '3', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
        if(this.value<0){this.value='0'}" ]) !!}
        </div>
    </div>
    <div class="col-md-2">
        {!! Form::select('details[cukai_jenis_tarif_dua]', $bmTypes, null, ['class' => 'form-select','placeholder' => 'Jenis Tarif', 'id' => 'cukai_jenis_tarif_dua']) !!}
    </div>
</div>
<div class="form-group row">
    <div class="col-md-1">
        <label class="form-label"> </label>
    </div>
    <div class="col-md-2">
        <div class="input-group mb-5">
        {!! Form::number('details[cukai_hjr_rp]', 0, ['class' => 'form-control','placeholder' => 'HJERP', 'required' => true, 'id' => 'cukai_hjr_rp', 'step' => 'any',  'maxlength' => '3', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
        if(this.value<0){this.value='0'}" ]) !!}
        </div>
    </div>
    <div class="col-md-2">
        <div class="input-group mb-5">
        {!! Form::number('details[cukai_satuan_kemasan]', 0, ['class' => 'form-control','placeholder' => 'Satuan Kemasan', 'required' => true, 'id' => 'cukai_satuan_kemasan', 'step' => 'any',  'maxlength' => '3', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
        if(this.value<0){this.value='0'}" ]) !!}
        </div>
    </div>
    <div class="col-md-2">
        {!! Form::select('details[cukai_jenis_satuan_kemasan]', $uoms, null, ['class' => 'form-select', 'data-control' => 'select2', 'placeholder' => 'Jenis Kemasan', 'id' => 'cukai_jenis_satuan_kemasan']) !!}
    </div> 
    <div class="col-md-2">
        <div class="input-group mb-5">
        {!! Form::number('details[cukai_isi_kemasan]', 0, ['class' => 'form-control','placeholder' => 'Isi/Kemasan', 'required' => true, 'id' => 'cukai_isi_kemasan', 'step' => 'any',  'maxlength' => '3', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
        if(this.value<0){this.value='0'}" ]) !!}
        </div>
    </div>
</div>
<div class="form-group row">
    <div class="col-md-1">
        <label class="form-label"> </label>
    </div>
    <div class="col-md-2">
        <div class="input-group mb-5">
        {!! Form::number('details[cukai_jumlah_pita]', 0, ['class' => 'form-control','placeholder' => 'Jumlah Pita', 'required' => true, 'id' => 'cukai_jumlah_pita', 'step' => 'any',  'maxlength' => '3', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
        if(this.value<0){this.value='0'}" ]) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="input-group mb-5">
        {!! Form::number('details[cukai_saldo_awal]', 0, ['class' => 'form-control','placeholder' => 'Saldo Awal', 'required' => true, 'id' => 'cukai_saldo_awal', 'step' => 'any',  'maxlength' => '3', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
        if(this.value<0){this.value='0'}" ]) !!}
        <span class="input-group-text" id="">Saldo Awal</span>
        </div>
    </div>
    <div class="col-md-4">
        <div class="input-group mb-5">
        {!! Form::number('details[cukai_saldo_akhir]', 0, ['class' => 'form-control','placeholder' => 'Saldo Akhir', 'required' => true, 'id' => 'cukai_saldo_akhir', 'step' => 'any',  'maxlength' => '3', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
        if(this.value<0){this.value='0'}" ]) !!}
        <span class="input-group-text" id="">Saldo Akhir</span>
        </div>
    </div>
</div>
