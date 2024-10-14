<h3 class="mb-3" style="margin-top: 10px;">KEMASAN</h3>
<div class="form-group row">
    <div class="col-md-4">
        <label class="form-label">Jenis Kemasan:</label>
        {!! Form::select('package_id', $packageSelectBox, null, ['class' => 'form-select','placeholder' => '-- Select --', 'id' => 'package_id', 'required' => true]) !!}
    </div>
    <div class="col-md-4">
        <label class="form-label">Jumlah:</label>
        {!! Form::number('package_details[jumlah]', null, ['class' => 'form-control', 'required' => true, 'id' => 'jumlah',  'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
        if(this.value<0){this.value='0'}" ]) !!}
    </div>
    <div class="col-md-4">
        <label class="form-label">Merek:</label>
        {!! Form::text('package_details[merk]', null, ['class' => 'form-control', 'required' => true, 'id' => 'merk_kemasan','oninput' => 'this.value = this.value.toUpperCase()']) !!}
    </div>
</div>
