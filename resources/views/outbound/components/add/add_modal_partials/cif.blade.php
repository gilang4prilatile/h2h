<div class="form-group row" style="margin-top: 10px;">
    <div class="col-md-6">
        <label class="form-label required">Nilai CIF</label> <label id="s-harga-cif" name="s-harga-cif"></label>
        {!! Form::number('details[nilai_cif]', 0, ['class' => 'form-control', 'id' => 'detail-nilai-cif','step' => 'any' , 'required' => true,  'maxlength' => '18', 'min' => '0', 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
        if(this.value<0){this.value='0'}"]) !!}
    </div>
    <div class="col-md-6">
        <label class="form-label required">CIF Rp</label>
        {!! Form::number('details[cif_rp]', 0, ['class' => 'form-control bg-secondary', 'id' => 'detail-cif-rp', 'step' => 'any', 'required' => true, 'maxlength' => '18', 'min' => '0', 'readonly' , 'oninput' => "if(this.value.length > this.maxLength){this.value = this.value.slice(0, this.maxLength)}
        if(this.value<0){this.value='0'}"]) !!}
    </div>
</div>


<script>

    $(document).ready(function(){

            var ndpbm = $('#ndpbm');
            var detailCifRP = $('#detail-cif-rp');
            var detailNilaiCif = $('#detail-nilai-cif');

            ndpbm.on('change', function(){

                countHargaIf();

            });

            detailNilaiCif.on('keyup', function(){

                countHargaIf();

            });

            function countHargaIf()
            {
                totalNilaiCif   = Number(ndpbm.val()) * Number(detailNilaiCif.val());
                detailCifRP.val(totalNilaiCif);
            }

    })

</script>