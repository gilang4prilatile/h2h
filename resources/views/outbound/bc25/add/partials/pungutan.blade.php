
<h2 class="fw-bolder mt-4">Pungutan</h2>
<div class="border-dashed border-1 rounded p-3 d-flex flex-column " style="border-color: lightgrey">
    <div class="form-group row border-dashed border-0 border-bottom-1 " style="color: lightgrey; padding-bottom: 10px">
        <div class="col-md-1"></div>
        <div class="col-md-3 border-dashed border-0 border-right-1" >
            <label class="form-label" >Ditangguhkan (Rp)</label>
        </div>
        <div class="col-md-3 border-dashed border-0 border-right-1">
            <label class="form-label   " >Dibebaskan (Rp)</label>
        </div>
        <div class="col-md-3">
            <label class="form-label">Tidak Dipungut (Rp)</label>
        </div>
    </div>
    <div class="form-group row border-dashed border-0 border-bottom-1" style="margin-top:10px;padding-bottom:10px;color: lightgrey">
        <div class="col-md-1 my-auto">
            <span class="h5">BM</span>
        </div>
        <div class="col-md-3 border-dashed border-0 border-right-1">
            {!! Form::number('details[bm_ditangguhkan]', null, ['class' => 'form-control  bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'bm_ditangguhkan', 'step' => 'any' , 'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
            if(this.value<0){this.value='0'}", 'readonly' => 'readonly' ]) !!}
            @if($errors->has('details[bm_ditangguhkan]'))
                <span class="error text-danger">{{ $errors->first('details[bm_ditangguhkan]') }}</span>
            @endif
        </div>

        <div class="col-md-3 border-dashed border-0 border-right-1">
            {!! Form::number('details[bm_dibebaskan]', null, ['class' => 'form-control  bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'bm_dibebaskan',  'maxlength' => '18', 'min' => '0', 'step' => 'any', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
            if(this.value<0){this.value='0'}", 'readonly' => 'readonly' ]) !!}
            @if($errors->has('details[bm_dibebaskan]'))
                <span class="error text-danger">{{ $errors->first('details[bm_dibebaskan]') }}</span>
            @endif
        </div>
        <div class="col-md-3 ">
            {!! Form::number('details[bm_tidak_dipungut]', null, ['class' => 'form-control  bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'bm_tidak_dipungut',  'maxlength' => '18', 'min' => '0', 'step' => 'any', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
            if(this.value<0){this.value='0'}", 'readonly' => 'readonly' ]) !!}
            @if($errors->has('details[bm_tidak_dipungut]'))
                <span class="error text-danger">{{ $errors->first('details[bm_tidak_dipungut]') }}</span>
            @endif
        </div>
    </div>

    {{-- <div class="form-group row" style="margin-top:10px;"> --}}
    {{--     <div class="col-md-1 my-auto"> --}}
    {{--         <span class="h5">BMT</span> --}}
    {{--     </div> --}}
    {{--     <div class="col-md-3"> --}}
    {{--         {!! Form::number('details[bmt_ditangguhkan]', null, ['class' => 'form-control  bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'bmt_ditangguhkan']) !!} --}}
    {{--         @if($errors->has('details[bmt_ditangguhkan]')) --}}
    {{--             <span class="error text-danger">{{ $errors->first('details[bmt_ditangguhkan]') }}</span> --}}
    {{--         @endif --}}
    {{--     </div> --}}

    {{--     <div class="col-md-3"> --}}
    {{--         {!! Form::number('details[bmt_dibebaskan]', null, ['class' => 'form-control  bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'bmt_dibebaskan']) !!} --}}
    {{--         @if($errors->has('details[bmt_dibebaskan]')) --}}
    {{--             <span class="error text-danger">{{ $errors->first('details[bmt_dibebaskan]') }}</span> --}}
    {{--         @endif --}}
    {{--     </div> --}}
    {{--     <div class="col-md-3"> --}}
    {{--         {!! Form::number('details[bmt_tidak_dipungut]', null, ['class' => 'form-control  bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'bmt_tidak_dipungut']) !!} --}}
    {{--         @if($errors->has('details[bmt_tidak_dipungut]')) --}}
    {{--             <span class="error text-danger">{{ $errors->first('details[bmt_tidak_dipungut]') }}</span> --}}
    {{--         @endif --}}
    {{--     </div> --}}
    {{-- </div> --}}

    {{-- <div class="form-group row" style="margin-top:10px;"> --}}
    {{--     <div class="col-md-1 my-auto"> --}}
    {{--         <span class="h5">Cukai</span> --}}
    {{--     </div> --}}
    {{--     <div class="col-md-3"> --}}
    {{--         {!! Form::number('details[cukai_ditangguhkan]', null, ['class' => 'form-control  bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'cukai_ditangguhkan']) !!} --}}
    {{--         @if($errors->has('details[cukai_ditangguhkan]')) --}}
    {{--             <span class="error text-danger">{{ $errors->first('details[cukai_ditangguhkan]') }}</span> --}}
    {{--         @endif --}}
    {{--     </div> --}}

    {{--     <div class="col-md-3"> --}}
    {{--         {!! Form::number('details[cukai_dibebaskan]', null, ['class' => 'form-control  bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'cukai_dibebaskan']) !!} --}}
    {{--         @if($errors->has('details[cukai_dibebaskan]')) --}}
    {{--             <span class="error text-danger">{{ $errors->first('details[cukai_dibebaskan]') }}</span> --}}
    {{--         @endif --}}
    {{--     </div> --}}
    {{--     <div class="col-md-3"> --}}
    {{--         {!! Form::number('details[cukai_tidak_dipungut]', null, ['class' => 'form-control  bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'cukai_tidak_dipungut']) !!} --}}
    {{--         @if($errors->has('details[cukai_tidak_dipungut]')) --}}
    {{--             <span class="error text-danger">{{ $errors->first('details[cukai_tidak_dipungut]') }}</span> --}}
    {{--         @endif --}}
    {{--     </div> --}}
    {{-- </div> --}}

    <div class="form-group row border-dashed border-0 border-bottom-1" style="margin-top:10px;padding-bottom:10px;color: lightgrey">
        <div class="col-md-1 my-auto">
            <span class="h5">PPN</span>
        </div>
        <div class="col-md-3 border-dashed border-0 border-right-1">
            {!! Form::number('details[ppn_ditangguhkan]', null, ['class' => 'form-control  bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'ppn_ditangguhkan',  'maxlength' => '18', 'min' => '0', 'step' => 'any', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
            if(this.value<0){this.value='0'}", 'readonly' => 'readonly' ]) !!}
            @if($errors->has('details[ppn_ditangguhkan]'))
                <span class="error text-danger">{{ $errors->first('details[ppn_ditangguhkan]') }}</span>
            @endif
        </div>

        <div class="col-md-3 border-dashed border-0 border-right-1">
            {!! Form::number('details[ppn_dibebaskan]', null, ['class' => 'form-control  bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'ppn_dibebaskan',  'maxlength' => '18', 'min' => '0', 'step' => 'any', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
            if(this.value<0){this.value='0'}", 'readonly' => 'readonly' ]) !!}
            @if($errors->has('details[ppn_dibebaskan]'))
                <span class="error text-danger">{{ $errors->first('details[ppn_dibebaskan]') }}</span>
            @endif
        </div>
        <div class="col-md-3">
            {!! Form::number('details[ppn_tidak_dipungut]', null, ['class' => 'form-control  bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'ppn_tidak_dipungut',  'maxlength' => '18', 'min' => '0', 'step' => 'any', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
            if(this.value<0){this.value='0'}", 'readonly' => 'readonly' ]) !!}
            @if($errors->has('details[ppn_tidak_dipungut]'))
                <span class="error text-danger">{{ $errors->first('details[ppn_tidak_dipungut]') }}</span>
            @endif
        </div>
    </div>

    <div class="form-group row border-dashed border-0 border-bottom-1" style="margin-top:10px;padding-bottom:10px;color: lightgrey">
        <div class="col-md-1 my-auto">
            <span class="h5">PPnBM</span>
        </div>
        <div class="col-md-3 border-dashed border-0 border-right-1">
            {!! Form::number('details[ppnbm_ditangguhkan]', null, ['class' => 'form-control  bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'ppnbm_ditangguhkan',  'maxlength' => '18', 'min' => '0', 'step' => 'any', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
            if(this.value<0){this.value='0'}", 'readonly' => 'readonly' ]) !!}
            @if($errors->has('details[ppnbm_ditangguhkan]'))
                <span class="error text-danger">{{ $errors->first('details[ppnbm_ditangguhkan]') }}</span>
            @endif
        </div>

        <div class="col-md-3 border-dashed border-0 border-right-1">
            {!! Form::number('details[ppnbm_dibebaskan]', null, ['class' => 'form-control  bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'ppnbm_dibebaskan',  'maxlength' => '18', 'min' => '0', 'step' => 'any', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
            if(this.value<0){this.value='0'}", 'readonly' => 'readonly' ]) !!}
            @if($errors->has('details[ppnbm_dibebaskan]'))
                <span class="error text-danger">{{ $errors->first('details[ppnbm_dibebaskan]') }}</span>
            @endif
        </div>
        <div class="col-md-3 ">
            {!! Form::number('details[ppnbm_tidak_dipungut]', null, ['class' => 'form-control  bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'ppnbm_tidak_dipungut',  'maxlength' => '18', 'min' => '0', 'step' => 'any', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
            if(this.value<0){this.value='0'}", 'readonly' => 'readonly' ]) !!}
            @if($errors->has('details[ppnbm_tidak_dipungut]'))
                <span class="error text-danger">{{ $errors->first('details[ppnbm_tidak_dipungut]') }}</span>
            @endif
        </div>
    </div>

    <div class="form-group row border-dashed border-0 border-bottom-1" style="margin-top:10px;padding-bottom:10px;color: lightgrey">
        <div class="col-md-1 my-auto">
            <span class="h5">PPh</span>
        </div>
        <div class="col-md-3 border-dashed border-0 border-right-1">
            {!! Form::number('details[pph_ditangguhkan]', null, ['class' => 'form-control  bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'pph_ditangguhkan',  'maxlength' => '18', 'min' => '0', 'step' => 'any', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
            if(this.value<0){this.value='0'}", 'readonly' => 'readonly' ]) !!}
            @if($errors->has('details[pph_ditangguhkan]'))
                <span class="error text-danger">{{ $errors->first('details[pph_ditangguhkan]') }}</span>
            @endif
        </div>

        <div class="col-md-3 border-dashed border-0 border-right-1">
            {!! Form::number('details[pph_dibebaskan]', null, ['class' => 'form-control  bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'pph_dibebaskan',  'maxlength' => '18', 'min' => '0', 'step' => 'any', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
            if(this.value<0){this.value='0'}", 'readonly' => 'readonly' ]) !!}
            @if($errors->has('details[pph_dibebaskan]'))
                <span class="error text-danger">{{ $errors->first('details[pph_dibebaskan]') }}</span>
            @endif
        </div>
        <div class="col-md-3 ">
            {!! Form::number('details[pph_tidak_dipungut]', null, ['class' => 'form-control  bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'pph_tidak_dipungut',  'maxlength' => '18', 'min' => '0', 'step' => 'any', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
            if(this.value<0){this.value='0'}", 'readonly' => 'readonly' ]) !!}
            @if($errors->has('details[pph_tidak_dipungut]'))
                <span class="error text-danger">{{ $errors->first('details[pph_tidak_dipungut]') }}</span>
            @endif
        </div>
    </div>

    <div class="form-group row " style="margin-top:10px;padding-bottom:10px;color: lightgrey">
        <div class="col-md-1 my-auto">
            <span class="h5">Total</span>
        </div>
        <div class="col-md-3 border-dashed border-0 border-right-1">
            {!! Form::number('details[total_ditangguhkan]', null, ['class' => 'form-control  bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'total_ditangguhkan',  'maxlength' => '18', 'min' => '0', 'step' => 'any', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
            if(this.value<0){this.value='0'}", 'readonly' => 'readonly' ]) !!}
            @if($errors->has('details[total_ditangguhkan]'))
                <span class="error text-danger">{{ $errors->first('details[total_ditangguhkan]') }}</span>
            @endif
        </div>

        <div class="col-md-3 border-dashed border-0 border-right-1">
            {!! Form::number('details[total_dibebaskan]', null, ['class' => 'form-control  bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'total_dibebaskan',  'maxlength' => '18', 'min' => '0', 'step' => 'any', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
            if(this.value<0){this.value='0'}", 'readonly' => 'readonly' ]) !!}
            @if($errors->has('details[total_dibebaskan]'))
                <span class="error text-danger">{{ $errors->first('details[total_dibebaskan]') }}</span>
            @endif
        </div>
        <div class="col-md-3 ">
            {!! Form::number('details[total_tidak_dipungut]', null, ['class' => 'form-control  bg-secondary', 'required' => true, 'placeholder' => 'Input', 'id' => 'total_tidak_dipungut',  'maxlength' => '18', 'min' => '0', 'step' => 'any', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
            if(this.value<0){this.value='0'}", 'readonly' => 'readonly' ]) !!}
            @if($errors->has('details[total_tidak_dipungut]'))
                <span class="error text-danger">{{ $errors->first('details[total_tidak_dipungut]') }}</span>
            @endif
        </div>
    </div>
</div>