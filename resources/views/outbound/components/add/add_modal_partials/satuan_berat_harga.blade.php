<div>

    <h3 class="mb-3" style="margin-top: 10px;">SATUAN, BERAT, DAN HARGA</h3>

    <div class="form-group row">
        <div class="col-md-4" id="jumlah-satuan-container">
            <label class="form-label required">Jumlah Satuan</label>
            {!! Form::number('quantity', 0, ['class' => 'form-control', 'id' => 'quantity', 'required' => true,  'step' => 'any' , 'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
            if(this.value<0){this.value='0'}"]) !!}
        </div>
        <div class="col-md-4" id="jenis-satuan-container">
            <label class="form-label required">Jenis Satuan</label>
            {!! Form::select('uom_id', $uoms, null, ['class' => 'form-select', 'data-control' => 'select2', 'placeholder' => '-- Select --', 'id' => 'uom_id', 'required' => true]) !!}
        </div>
        <div class="col-md-4 harga-penyerahan-container">
            <label class="form-label required" id="label-harga-barang">Harga Penyerahan</label> <label id="s-harga-penyerahan" name="s-harga-penyerahan"></label>
            {!! Form::number('details[harga_penyerahan]', 0, ['class' => 'form-control', 'id' => 'detail-harga-penyerahan','step' => 'any' , 'required' => true,  'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
            if(this.value<0){this.value='0'}"]) !!}
        </div>
    </div>

    <div class="netto-volume-bruto-container">
        <div class="form-group row" style="margin-top: 10px;">
            <div class="col-md-6">
                <label class="form-label required">Netto</label>
                {!! Form::number('nett_weight', 0, ['class' => 'form-control', 'id' => 'nett_weight', 'required' => true, 'step' => 'any' , 'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                if(this.value<0){this.value='0'}"]) !!}
            </div>
            <div class="col-md-6">
                <label class="form-label required">Volume</label>
                {!! Form::number('volume', 0, ['class' => 'form-control', 'id' => 'volume', 'required' => true, 'step' => 'any' , 'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                if(this.value<0){this.value='0'}"]) !!}
            </div>
            {{-- <div class="col-md-4">
                <label class="form-label required">Bruto</label>
                {!! Form::number('details[bruto]', 0, ['class' => 'form-control', 'id' => 'bruto', 'required' => true, 'step' => 'any' , 'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
                if(this.value<0){this.value='0'}"]) !!}
            </div> --}}
        </div>
    </div>

    @if($bc == "BC25")
        <div id="satuan-berat-harga-conversion">
            
        </div>
    @endif


</div>
