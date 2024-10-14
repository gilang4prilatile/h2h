<div class="row mb-10 parent-forms">
    <div class="col-md-3 bag-form" style="display: none;">
    <label class="form-label">Bag</label>
        {!! Form::select('bag_id', [], null, ['class' => 'form-select', 'placeholder' => '-- Select --', 'id' => 'bag-options', 'data-control' => 'select2',"required"=>"true", 'disabled']) !!}
    </div>
    <div class="col-md-3 bab-form" style="display: none;">
        <label class="form-label">Bab</label>
        {!! Form::select('bab_id', [], null, ['class' => 'form-select', 'placeholder' => '-- Select --', 'id' => 'bab-options', 'data-control' => 'select2',"required"=>"true", 'disabled']) !!}
    </div>
    <div class="col-md-3 pos-form" style="display: none;">
    <label class="form-label">Sub</label>
        {!! Form::select('pos_id', [], null, ['class' => 'form-select', 'placeholder' => '-- Select --', 'id' => 'pos-options', 'data-control' => 'select2',"required"=>"true", 'disabled']) !!}
    </div>

    <div class="col-md-3 sub-pos-form" style="display: none;">
    <label class="form-label">Sub Pos</label>
    {!! Form::select('sub_pos_id', [], null, ['class' => 'form-select', 'placeholder' => '-- Select --', 'id' => 'sub-pos-options', 'data-control' => 'select2',"required"=>"true", 'disabled']) !!}
    </div>
</div>
<div class="sub-pos-asean-form">
    <div class="row mb-10">

        <div class="col-md-3">
        <label class="form-label">BM</label>
            {!! Form::number('details[bm]', null, ['class' => 'form-control', 'step' => 'any']) !!}
        </div>

        <div class="col-md-3">
        <label class="form-label">PPN</label>
            {!! Form::number('details[ppn]', null, ['class' => 'form-control', 'step' => 'any']) !!}
        </div>

        <div class="col-md-3">
        <label class="form-label">PPnBM</label>
            {!! Form::number('details[ppnbm]', null, ['class' => 'form-control', 'step' => 'any']) !!}
        </div>

        <div class="col-md-3">
        <label class="form-label">Cukai</label>
            {!! Form::number('details[cukai]', null, ['class' => 'form-control', 'step' => 'any']) !!}
        </div>
    </div>
    <div class="row mb-10">

        <div class="col-md-3">
        <label class="form-label">BM AD</label>
            {!! Form::number('details[bm_ad]', null, ['class' => 'form-control', 'step' => 'any']) !!}
        </div>

        <div class="col-md-3">
        <label class="form-label">BM TP</label>
            {!! Form::number('details[bm_tp]', null, ['class' => 'form-control', 'step' => 'any']) !!}
        </div>

        <div class="col-md-3">
        <label class="form-label">BM IM</label>
            {!! Form::number('details[bm_im]', null, ['class' => 'form-control', 'step' => 'any']) !!}
        </div>

        <div class="col-md-3">
        <label class="form-label">BK</label>
            {!! Form::number('details[bk]', null, ['class' => 'form-control', 'step' => 'any']) !!}
        </div>
    </div>
    <div class="row mb-10">

        <div class="col-md-3">
            <label class="form-label">PPH API</label>
            {!! Form::number('details[pph_api]', null, ['class' => 'form-control', 'step' => 'any']) !!}
        </div>

        <div class="col-md-3">
            <label class="form-label">PPH NON-API</label>
            {!! Form::number('details[pph_non_api]', null, ['class' => 'form-control', 'step' => 'any']) !!}
        </div>

        <div class="col-md-3">
            <label class="form-label">Note</label>
            {!! Form::text('details[note]', null, ['class' => 'form-control']) !!}
        </div>

        <div class="col-md-3">
            <label class="form-label">Status Lartas</label>
            {!! Form::select('details[status_lartas]', [0 => 'Tidak', 1 => 'Iya'] , null, ['class' => 'form-select', 'placeholder' => '-- Select --' ,'data-control' => 'select2']) !!}
        </div>

    </div>
</div>
@push('js')
    <script>
        $(document).ready(function() {
            $('#bag-options').select2({
                ajax: {
                    url: '{{url('/')}}/master-data/hscode/options',
                    dataType: 'json',
                    data: function(param) {
                        var query = {
                            type: 'bag',
                            code: param.term,
                        }
                        console.log(param.term);

                        return query;
                    },
                    processResults: function (data) {
                        return {
                            results: data.map(v => ({id: v.id, text: `BAGIAN ${v.code} - ${v.details.description_id}`}))
                        }
                    }
                }
            })

            $('#bab-options').select2({
                ajax: {
                    url: '{{url('/')}}/master-data/hscode/options',
                    dataType: 'json',
                    data: function(param) {
                        var query = {
                            type: 'bab',
                            code: param.term,
                            parent_id: $('#bag-options').val()
                        }

                        return query;
                    },
                    processResults: function (data) {
                        return {
                            results: data.map(v => ({id: v.id, text: `BAB ${v.code} - ${v.details.description_id}`}))
                        }
                    }
                }
            })

            $('#pos-options').select2({
                ajax: {
                    url: '{{url('/')}}/master-data/hscode/options',
                    dataType: 'json',
                    data: function(param) {
                        var query = {
                            type: 'pos',
                            code: param.term,
                            parent_id: $('#bab-options').val()
                        }

                        return query;
                    },
                    processResults: function (data) {
                        return {
                            results: data.map(v => ({id: v.id, text: `${v.code} - ${v.details.description_id}`}))
                        }
                    }
                }
            })

            $('#sub-pos-options').select2({
                ajax: {
                    url: '{{url('/')}}/master-data/hscode/options',
                    dataType: 'json',
                    data: function(param) {
                        var query = {
                            type: 'sub-pos',
                            code: param.term,
                            parent_id: $('#pos-options').val()
                        }

                        return query;
                    },
                    processResults: function (data) {
                        return {
                            results: data.map(v => ({id: v.id, text: `${v.code} - ${v.details.description_id}`}))
                        }
                    }
                }
            })
        })
    </script>
@endpush
