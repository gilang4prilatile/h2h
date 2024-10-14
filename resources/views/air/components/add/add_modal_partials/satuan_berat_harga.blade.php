<h3 class="mb-3" style="margin-top: 10px; text-align: center;">SATUAN, BERAT, DAN HARGA</h3>
<hr class="mt-6 mb-6">
@if($bc == "BC20") 

<div class="form-group row">
    <div class="col-md-12">
        <label class="form-label">Incoterm</label>
        {!! Form::select('details[incoterm_id]', $masterIncoterms, null, ['class' => 'form-select bg-secondary', 'data-control' => 'select2', 'placeholder' => '-- Select --' , 'id' => 'incoterm_id']) !!}
    </div>
</div>

<div class="form-group row" style="margin-top: 10px;">
    <div class="col-md-{{ $bc == 'BC20' ? '6' : '6' }}">
        <label class="form-label required">Jumlah Satuan</label>
        {!! Form::number('quantity', 0, ['class' => 'form-control', 'id' => 'detail-quantity', 'step' => 'any', 'maxlength' => '18', 'min' => '0', 'onblur' => "formatToFourDecimals(this)" ]) !!}
    </div>
    <div class="col-md-{{ $bc == 'BC20' ? '6' : '6' }}">
        <label class="form-label required">Jenis Satuan</label>
        {!! Form::select('details[uom_id]', $uoms, null, ['class' => 'form-select', 'data-control' => 'select2', 'placeholder' => '-- Select --', 'id' => 'uom_id', 'required' => true]) !!}
    </div> 
   
</div> 
@endif 
<div id="div_kemasan" name="div_kemasan">   
    @include("air.components.add.add_modal_partials.kemasan")
</div>
@if($bc == "BC20")
<div class="form-group row" style="margin-top: 10px;">
    <div class="col-md-12 flex-container">
        <label class="form-label required" id="label-harga-barang">Amount</label>
        <label id="s-biaya-harga-barang" name="s-biaya-harga-barang" class="text-muted-right"></label>
    </div>
    <div class="col-md-12">        
        {!! Form::number('details[harga_barang]', 0, ['class' => 'form-control', 'id' => 'detail-amount','step' => 'any', 'required' => true,  'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
        if(this.value<0){this.value='0'}" ]) !!}
    </div>

</div>
<div class="form-group row" style="margin-top: 10px;">
  
    <div class="col-md-12">
        <label class="form-label">(Biaya Tambahan - Diskon)</label> <label id="s-biaya-penambah-diskon" name="s-biaya-penambah-diskon"></label>
        {!! Form::number('details[biaya_penambah_diskon]', 0, ['class' => 'form-control bg-secondary', 'id' => 'detail-biaya-penambah-diskon','step' => 'any', 'readonly',  'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
        if(this.value<0){this.value='0'}" ]) !!}
    </div>
    <div class="col-md-12">
        <label class="form-label required">FOB</label>
        {!! Form::number('details[fob]', 0, ['class' => 'form-control bg-secondary', 'id' => 'detail-fob', 'required' => true, 'readonly', 'step' => 'any',  'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
        if(this.value<0){this.value='0'}" ]) !!}
    </div> 
    <div class="col-md-12">
        <label class="form-label required">Harga Satuan</label>
        {!! Form::number('details[harga_satuan]', 0, ['class' => 'form-control bg-secondary', 'id' => 'detail-harga-satuan', 'step' => 'any','required' => true, 'readonly' , 'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
        if(this.value<0){this.value='0'}" ]) !!}
    </div>
</div>
<div class="form-group row" style="margin-top: 10px;">
    <div class="col-md-12">
        <label class="form-label">Freight</label>
        {!! Form::number('details[freight]', 0, ['class' => 'form-control bg-secondary', 'id' => 'detail-freight' ,'step' => 'any', 'readonly',  'required' => true,  'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
        if(this.value<0){this.value='0'}" ]) !!}
    </div> 
    <div class="col-md-12">
        <label class="form-label">Asuransi</label> <label id="s-biaya-asuransi" name="s-biaya-asuransi"></label>
            {!! Form::number('details[asuransi]', 0, ['class' => 'form-control bg-secondary', 'id' => 'detail-asuransi', 'readonly' , 'required' => true,  'maxlength' => '18', 'min' => '0','step' => 'any', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
            if(this.value<0){this.value='0'}" ]) !!} 
    </div> 
    <div class="col-md-12">
        <label class="form-label required">CIF Rp</label>
        {!! Form::number('details[cif_rp]', 0, ['class' => 'form-control bg-secondary', 'id' => 'detail-cif-rp', 'step' => 'any','required' => true,  'maxlength' => '18', 'min' => '0', 'readonly', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
        if(this.value<0){this.value='0'}" ]) !!}
    </div>
</div> 
@endif 
@if($bc == "BC30")
<div class="form-group row" style="margin-top: 10px;">
    <div class="col-md-6">
        <label class="form-label required">Negara</label>
        {!! Form::select('details[item_country]', $country, null, ['class' => 'form-select', 'data-control' => 'select2', 'placeholder' => '-- Select --' , 'id' => 'detail-country-bc30', 'required' => true]) !!}
    </div>
    <div class="col-md-6">
        <label class="form-label">
            <span>Daerah Asal Barang</span>
        </label>
        <div id="select-detail-place-of-origin-bc30">
                {!! Form::select('details[item_place_of_origin]', $placeOfOrigin, null, ['class' => 'form-select', 'data-control' => 'select2', 'id' => 'detail-place-of-origin-bc30' ,  'placeholder' => '-- Select --']) !!}
        </div>
        {!! Form::text('', '', ['class' => 'form-control bg-secondary', 'readonly', 'id' => 'input-detail-place-of-origin-bc30']) !!}
    </div>
</div>

<div class="form-group row" style="margin-top: 10px;">
    <div class="col-md-6">
        <label class="form-label required">Jumlah Satuan</label>
        {!! Form::number('quantity', 0, ['class' => 'form-control', 'id' => 'detail-quantity-bc30' ,'step' => 'any', 'maxlength' => '18', 'min' => '0' , 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
        if(this.value<0){this.value='0'}" ]) !!}
    </div>
    <div class="col-md-6">
        <label class="form-label required">Jenis Satuan</label>
        {!! Form::select('details[uom_id]', $uoms, null, ['class' => 'form-select', 'data-control' => 'select2', 'placeholder' => '-- Select --', 'id' => 'uom-id-bc30', 'required' => true]) !!}
    </div>
</div>

<div class="form-group row" style="margin-top: 10px;">
    <div class="col-md-6">
        <label class="form-label">Harga FOB</label>
        {!! Form::number('details[fob]', 0, ['class' => 'form-control', 'id' => 'detail-fob-bc30', 'step' => 'any',  'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
        if(this.value<0){this.value='0'}" ]) !!}
    </div>
    <div class="col-md-6">
        <label class="form-label">Volume</label> <label id="s-biaya-pengurang" name="s-biaya-pengurang"></label>
        {!! Form::number('details[volume]', 0, ['class' => 'form-control', 'id' => 'detail-volume-bc30','step' => 'any',  'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
        if(this.value<0){this.value='0'}" ]) !!}
    </div>
</div>

<div class="form-group row" style="margin-top: 10px;">
    <div class="col-md-6">
        <label class="form-label">Berat Bersih (Kg)</label>
        {!! Form::number('details[netto]', 0, ['class' => 'form-control', 'id' => 'detail-netto-bc30',   'step' => 'any',  'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
        if(this.value<0){this.value='0'}" ]) !!}
    </div>
    <div class="col-md-6">
        <label class="form-label">Harga Satuan FOB</label> <label id="s-biaya-pengurang" name="s-biaya-pengurang"></label>
        {!! Form::text('details[fob_unit]', 0, ['class' => 'form-control bg-secondary', 'readonly' ,'step' => 'any',  'maxlength' => '18', 'min' => '0', 'id' => 'detail-fob-unit-bc30']) !!}
    </div>
</div>

@endif