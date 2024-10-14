
<h2 class="fw-bolder mt-4">Pungutan</h2>
<div class="border-dashed border-1 rounded p-3 d-flex flex-column " style="border-color: lightgrey">
    <div class="form-group row border-dashed border-0 border-bottom-1 " style="color: lightgrey; padding-bottom: 10px">
        <div class="col-md-2"></div>
        <div class="col-md-3 border-dashed border-0 border-right-1" >
            <label class="form-label" >Ditangguhkan (Rp)</label>
        </div>
        <div class="col-md-3 border-dashed border-0 border-right-1">
            <label class="form-label" >Dibebaskan (Rp)</label>
        </div>
        <div class="col-md-3">
            <label class="form-label">Tidak Dipungut (Rp)</label>
        </div>
    </div>
    <div class="form-group row border-dashed border-0 border-bottom-1" style="margin-top:10px;padding-bottom:10px;color: lightgrey">
        <div class="col-md-2 my-auto">
            <span class="h5">BM</span>
        </div>
        <div class="col-md-3 border-dashed border-0 border-right-1">
            {!! Form::number('detail_imports[bm_ditangguhkan]', 0, ['class' => 'form-control bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'bm_ditangguhkan_import',  'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
            if(this.value<0){this.value='0'}", 'readonly' => 'readonly' ]) !!}
            @if($errors->has('detail_imports[bm_ditangguhkan]'))
                <span class="error text-danger">{{ $errors->first('detail_imports[bm_ditangguhkan]') }}</span>
            @endif
        </div>

        <div class="col-md-3 border-dashed border-0 border-right-1">
            {!! Form::number('detail_imports[bm_dibebaskan]', 0, ['class' => 'form-control bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'bm_dibebaskan_import',  'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
            if(this.value<0){this.value='0'}", 'readonly' => 'readonly' ]) !!}
            @if($errors->has('detail_imports[bm_dibebaskan]'))
                <span class="error text-danger">{{ $errors->first('detail_imports[bm_dibebaskan]') }}</span>
            @endif
        </div>
        <div class="col-md-3 ">
            {!! Form::number('detail_imports[bm_tidak_dipungut]', 0, ['class' => 'form-control bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'bm_tidak_dipungut_import',  'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
            if(this.value<0){this.value='0'}", 'readonly' => 'readonly' ]) !!}
            @if($errors->has('detail_imports[bm_tidak_dipungut]'))
                <span class="error text-danger">{{ $errors->first('detail_imports[bm_tidak_dipungut]') }}</span>
            @endif
        </div>
    </div>


    <div class="form-group row border-dashed border-0 border-bottom-1" style="margin-top:10px;padding-bottom:10px;color: lightgrey">
        <div class="col-md-2 my-auto">
            <span class="h5">PPN</span>
        </div>
        <div class="col-md-3 border-dashed border-0 border-right-1">
            {!! Form::number('detail_imports[ppn_ditangguhkan]', 0, ['class' => 'form-control bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'ppn_ditangguhkan_import',  'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
            if(this.value<0){this.value='0'}", 'readonly' => 'readonly' ]) !!}
            @if($errors->has('detail_imports[ppn_ditangguhkan]'))
                <span class="error text-danger">{{ $errors->first('detail_imports[ppn_ditangguhkan]') }}</span>
            @endif
        </div>

        <div class="col-md-3 border-dashed border-0 border-right-1">
            {!! Form::number('detail_imports[ppn_dibebaskan]', 0, ['class' => 'form-control bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'ppn_dibebaskan_import',  'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
            if(this.value<0){this.value='0'}", 'readonly' => 'readonly' ]) !!}
            @if($errors->has('detail_imports[ppn_dibebaskan]'))
                <span class="error text-danger">{{ $errors->first('detail_imports[ppn_dibebaskan]') }}</span>
            @endif
        </div>
        <div class="col-md-3">
            {!! Form::number('detail_imports[ppn_tidak_dipungut]', 0, ['class' => 'form-control bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'ppn_tidak_dipungut_import',  'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
            if(this.value<0){this.value='0'}", 'readonly' => 'readonly' ]) !!}
            @if($errors->has('detail_imports[ppn_tidak_dipungut]'))
                <span class="error text-danger">{{ $errors->first('detail_imports[ppn_tidak_dipungut]') }}</span>
            @endif
        </div>
    </div>

    <div class="form-group row border-dashed border-0 border-bottom-1" style="margin-top:10px;padding-bottom:10px;color: lightgrey">
        <div class="col-md-2 my-auto">
            <span class="h5">PPnBM</span>
        </div>
        <div class="col-md-3 border-dashed border-0 border-right-1">
            {!! Form::number('detail_imports[ppnbm_ditangguhkan]', 0, ['class' => 'form-control bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'ppnbm_ditangguhkan_import',  'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
            if(this.value<0){this.value='0'}", 'readonly' => 'readonly' ]) !!}
            @if($errors->has('detail_imports[ppnbm_ditangguhkan]'))
                <span class="error text-danger">{{ $errors->first('detail_imports[ppnbm_ditangguhkan]') }}</span>
            @endif
        </div>

        <div class="col-md-3 border-dashed border-0 border-right-1">
            {!! Form::number('detail_imports[ppnbm_dibebaskan]', 0, ['class' => 'form-control bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'ppnbm_dibebaskan_import',  'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
            if(this.value<0){this.value='0'}", 'readonly' => 'readonly' ]) !!}
            @if($errors->has('detail_imports[ppnbm_dibebaskan]'))
                <span class="error text-danger">{{ $errors->first('detail_imports[ppnbm_dibebaskan]') }}</span>
            @endif
        </div>
        <div class="col-md-3 ">
            {!! Form::number('detail_imports[ppnbm_tidak_dipungut]', 0, ['class' => 'form-control bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'ppnbm_tidak_dipungut_import',  'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
            if(this.value<0){this.value='0'}", 'readonly' => 'readonly' ]) !!}
            @if($errors->has('detail_imports[ppnbm_tidak_dipungut]'))
                <span class="error text-danger">{{ $errors->first('detail_imports[ppnbm_tidak_dipungut]') }}</span>
            @endif
        </div>
    </div>

    <div class="form-group row border-dashed border-0 border-bottom-1" style="margin-top:10px;padding-bottom:10px;color: lightgrey">
        <div class="col-md-2 my-auto">
            <span class="h5">PPh</span>
        </div>
        <div class="col-md-3 border-dashed border-0 border-right-1">
            {!! Form::number('detail_imports[pph_ditangguhkan]', 0, ['class' => 'form-control bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'pph_ditangguhkan_import',  'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
            if(this.value<0){this.value='0'}", 'readonly' => 'readonly' ]) !!}
            @if($errors->has('detail_imports[pph_ditangguhkan]'))
                <span class="error text-danger">{{ $errors->first('detail_imports[pph_ditangguhkan]') }}</span>
            @endif
        </div>

        <div class="col-md-3 border-dashed border-0 border-right-1">
            {!! Form::number('detail_imports[pph_dibebaskan]', 0, ['class' => 'form-control bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'pph_dibebaskan_import',  'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
            if(this.value<0){this.value='0'}", 'readonly' => 'readonly' ]) !!}
            @if($errors->has('detail_imports[pph_dibebaskan]'))
                <span class="error text-danger">{{ $errors->first('detail_imports[pph_dibebaskan]') }}</span>
            @endif
        </div>
        <div class="col-md-3 ">
            {!! Form::number('detail_imports[pph_tidak_dipungut]', 0, ['class' => 'form-control bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'pph_tidak_dipungut_import',  'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
            if(this.value<0){this.value='0'}", 'readonly' => 'readonly' ]) !!}
            @if($errors->has('detail_imports[pph_tidak_dipungut]'))
                <span class="error text-danger">{{ $errors->first('detail_imports[pph_tidak_dipungut]') }}</span>
            @endif
        </div>
    </div>

    <!-- Jumlah Satuan -->

    <!-- <div class="form-group row border-dashed border-0 border-bottom-1" style="margin-top:10px;padding-bottom:10px;color: lightgrey">
        <div class="col-md-2 my-auto">
            <span class="h5">Jumlah Satuan</span>
        </div>
        <div class="col-md-3 border-dashed border-0 border-right-1">
            {!! Form::number('details[pph_ditangguhkan]', 0, ['class' => 'form-control bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'pph_ditangguhkan_import',  'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
            if(this.value<0){this.value='0'}", 'readonly' => 'readonly' ]) !!}
            @if($errors->has('details[pph_ditangguhkan]'))
                <span class="error text-danger">{{ $errors->first('details[pph_ditangguhkan]') }}</span>
            @endif
        </div>

        <div class="col-md-3 border-dashed border-0 border-right-1">
            {!! Form::number('details[pph_dibebaskan]', 0, ['class' => 'form-control bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'pph_dibebaskan_import',  'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
            if(this.value<0){this.value='0'}", 'readonly' => 'readonly' ]) !!}
            @if($errors->has('details[pph_dibebaskan]'))
                <span class="error text-danger">{{ $errors->first('details[pph_dibebaskan]') }}</span>
            @endif
        </div>
        <div class="col-md-3 ">
            {!! Form::number('details[pph_tidak_dipungut]', 0, ['class' => 'form-control bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'pph_tidak_dipungut_import',  'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
            if(this.value<0){this.value='0'}", 'readonly' => 'readonly' ]) !!}
            @if($errors->has('details[pph_tidak_dipungut]'))
                <span class="error text-danger">{{ $errors->first('details[pph_tidak_dipungut]') }}</span>
            @endif
        </div>
    </div> -->

    <!-- END Jumlah Satuan -->

    <div class="form-group row " style="margin-top:10px;padding-bottom:10px;color: lightgrey">
        <div class="col-md-2 my-auto">
            <span class="h5">Total</span>
        </div>
        <div class="col-md-3 border-dashed border-0 border-right-1">
            {!! Form::number('detail_imports[total_ditangguhkan]', 0, ['class' => 'form-control bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'total_ditangguhkan_import',  'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
            if(this.value<0){this.value='0'}", 'readonly' => 'readonly' ]) !!}
            @if($errors->has('detail_imports[total_ditangguhkan]'))
                <span class="error text-danger">{{ $errors->first('detail_imports[total_ditangguhkan]') }}</span>
            @endif
        </div>

        <div class="col-md-3 border-dashed border-0 border-right-1">
            {!! Form::number('detail_imports[total_dibebaskan]', 0, ['class' => 'form-control bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'total_dibebaskan_import',  'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
            if(this.value<0){this.value='0'}", 'readonly' => 'readonly' ]) !!}
            @if($errors->has('detail_imports[total_dibebaskan]'))
                <span class="error text-danger">{{ $errors->first('detail_imports[total_dibebaskan]') }}</span>
            @endif
        </div>
        <div class="col-md-3 ">
            {!! Form::number('detail_imports[total_tidak_dipungut]', 0, ['class' => 'form-control bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'total_tidak_dipungut_import',  'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
            if(this.value<0){this.value='0'}", 'readonly' => 'readonly' ]) !!}
            @if($errors->has('detail_imports[total_tidak_dipungut]'))
                <span class="error text-danger">{{ $errors->first('detail_imports[total_tidak_dipungut]') }}</span>
            @endif
        </div>
    </div>
    
    
</div>

