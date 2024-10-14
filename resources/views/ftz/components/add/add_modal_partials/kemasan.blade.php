<h3 class="mb-3" style="margin-top: 10px;">KEMASAN</h3>
<div class="form-group row" style="margin-top: 10px">
    <div class="col-md-6">
        <label class="form-label">Jumlah:</label>
        {!! Form::number('package_details[jumlah]', 0, ['class' => 'form-control', 'required' => true, 'id' => 'jumlah',  'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
        if(this.value<0){this.value='0'}" ]) !!}
    </div>
    <div class="col-md-6">
        <label class="form-label required">Jenis Kemasan:</label>
        {!! Form::select('package_id', $packageSelectBox, null, ['class' => 'form-select','placeholder' => '-- Select --', 'id' => 'package_id', 'data-control' => 'select2', 'required' => true]) !!}
    </div>
</div>
