<h3 class="mb-3" style="margin-top: 10px;">SATUAN, BERAT, DAN HARGA</h3>
<div class="form-group row" style="margin-top: 10px;">
    <div class="col-md-6">
        <label class="form-label required">Netto</label>
        {!! Form::number('nett_weight', 0, ['class' => 'form-control', 'id' => 'nett_weight', 'step' => 'any', 'required' => true,  'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
        if(this.value<0){this.value='0'}" ]) !!}
    </div>
    <div class="col-md-6">
        <label class="form-label required">Volume</label>
        {!! Form::number('volume', 0, ['class' => 'form-control', 'id' => 'volume', 'required' => true, 'step' => 'any', 'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
        if(this.value<0){this.value='0'}" ]) !!}
    </div>
    {{-- <div class="col-md-4" style="display:none;">
        <label class="form-label required">Bruto</label>
        {!! Form::number('details[bruto]', 0, ['class' => 'form-control', 'id' => 'bruto', 'step' => 'any' ,  'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
        if(this.value<0){this.value='0'}" ]) !!}
    </div> --}}

</div>
<hr class="mt-6 mb-6">
@if($bc == 'BC23')
    <div class="form-group row">
        <div class="col-md-12">
            <label class="form-label">Incoterm</label>
            {!! Form::select('details[incoterm_id]', $masterIncoterms, null, ['class' => 'form-select', 'data-control' => 'select2', 'placeholder' => '-- Select --' , 'id' => 'incoterm_id']) !!}
        </div>
    </div>
@endif
<div class="form-group row" style="margin-top: 10px;">
    <div class="col-md-4">
        <label class="form-label required">Jumlah Satuan</label>
        {!! Form::number('quantity', 0, ['class' => 'form-control', 'id' => 'detail-quantity' ,'step' => 'any', 'maxlength' => '18', 'min' => '0' , 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
        if(this.value<0){this.value='0'}" ]) !!}
    </div>
    <div class="col-md-4">
        <label class="form-label required">Jenis Satuan</label>
        {!! Form::select('uom_id', $uoms, null, ['class' => 'form-select', 'data-control' => 'select2', 'placeholder' => '-- Select --', 'id' => 'uom_id', 'required' => true]) !!}
    </div>
    @if($bc == 'BC23')
        <div class="col-md-4">
            <label class="form-label required" id="label-harga-barang">Harga Barang</label> <label id="s-biaya-harga-barang" name="s-biaya-harga-barang"></label>
            {!! Form::number('details[harga_barang]', 0, ['class' => 'form-control', 'id' => 'detail-amount','step' => 'any', 'required' => true,  'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
            if(this.value<0){this.value='0'}" ]) !!}
        </div>

    @else

        <div class="col-md-4">
            <label class="form-label required" id="label-harga-barang">Harga Penyerahan</label> <label id="s-harga-penyerahan" name="s-harga-penyerahan"></label>
            {!! Form::number('details[harga_penyerahan]', 0, ['class' => 'form-control', 'id' => 'detail-harga-penyerahan','step' => 'any', 'required' => true,  'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
            if(this.value<0){this.value='0'}" ]) !!}
        </div>

    @endif

</div>

@if( $bc == "BC23")
<div class="form-group row" style="margin-top: 10px;">
    <div class="col-md-4">
        <label class="form-label">Biaya Penambah</label> <label id="s-biaya-penambah" name="s-biaya-penambah"></label>
        {!! Form::number('details[biaya_penambah]', 0, ['class' => 'form-control', 'id' => 'detail-biaya-penambah','step' => 'any',  'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
        if(this.value<0){this.value='0'}" ]) !!}
    </div>
    <div class="col-md-4">
        <label class="form-label">Biaya Pengurang</label> <label id="s-biaya-pengurang" name="s-biaya-pengurang"></label>
        {!! Form::number('details[biaya_pengurang]', 0, ['class' => 'form-control', 'id' => 'detail-biaya-pengurang','step' => 'any',  'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
        if(this.value<0){this.value='0'}" ]) !!}
    </div>
    <div class="col-md-4">
        <label class="form-label required">Freight</label>
        {!! Form::number('details[freight]', 0, ['class' => 'form-control', 'id' => 'detail-freight' ,'step' => 'any', 'required' => true,  'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
        if(this.value<0){this.value='0'}" ]) !!}
    </div>
</div>
@endif

@if( $bc == "BC23")
<div class="form-group row" style="margin-top: 10px;">
    <div class="col-md-8">
        <label class="form-label required">Asuransi</label> <label id="s-biaya-asuransi" name="s-biaya-asuransi"></label>
        <div class="form-group row">
            <div class="col-md-6">
                {!! Form::select('details[type_asuransi]', [0 => 'Dalam Negeri', 1 => 'Luar Negeri'], null, ['class' => 'form-select', 'data-control' => 'select2', 'placeholder' => '-- Select --', 'id' => 'type-asuransi', 'required' => true]) !!}
            </div>
            <div class="col-md-6">
                {!! Form::number('details[asuransi]', 0, ['class' => 'form-control', 'id' => 'detail-asuransi', 'readonly' , 'required' => true,  'maxlength' => '18', 'min' => '0','step' => 'any', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                if(this.value<0){this.value='0'}" ]) !!}
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <label class="form-label required">FOB / Harga Detil</label>
        {!! Form::number('details[fob]', 0, ['class' => 'form-control bg-secondary', 'id' => 'detail-fob', 'required' => true, 'readonly', 'step' => 'any',  'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
        if(this.value<0){this.value='0'}" ]) !!}
    </div>
</div>
@endif

@if($bc == "BC23")
<div class="form-group row" style="margin-top: 10px;">
    <div class="col-md-4">
        <label class="form-label required">Harga Satuan</label>
        {!! Form::number('details[harga_satuan]', 0, ['class' => 'form-control bg-secondary', 'id' => 'detail-harga-satuan', 'step' => 'any','required' => true, 'readonly' , 'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
        if(this.value<0){this.value='0'}" ]) !!}
    </div>
    <div class="col-md-4">
        <label class="form-label required">Nilai CIF</label>
        {!! Form::number('details[nilai_cif]', 0, ['class' => 'form-control bg-secondary', 'id' => 'detail-nilai-cif','step' => 'any', 'required' => true,  'maxlength' => '18', 'min' => '0', 'readonly' , 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
        if(this.value<0){this.value='0'}" ]) !!}
    </div>
    <div class="col-md-4">
        <label class="form-label required">CIF Rp</label>
        {!! Form::number('details[cif_rp]', 0, ['class' => 'form-control bg-secondary', 'id' => 'detail-cif-rp', 'step' => 'any','required' => true,  'maxlength' => '18', 'min' => '0', 'readonly', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
        if(this.value<0){this.value='0'}" ]) !!}
    </div>
</div>
@endif

 