<div class="form-group row" style="margin-top:10px;">
    <div class="col-md-12">
        <h2 class="fw-bolder mt-4">Peti Kemas/Kontainer</h2>
        @if($errors->has('details[containers]'))
            <span class="error text-danger">{{ $errors->first('details[containers]') }}</span>
        @endif
        @if($errors->has('details[containers].*.*'))
            <span class="error text-danger">{{ $errors->first('details[containers].*.*') }}</span>
        @endif
        <!--begin::Repeater-->
        <div id="containers">
            <!--begin::Form group-->
            <div class="form-group">
                <div data-repeater-list="details[containers]">
                    <div data-repeater-item>
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label class="form-label">Nomor Kontainer:</label>
                                {!! Form::text('nomor', null, ['class' => 'form-control', 'required' => true,'oninput' => 'this.value = this.value.toUpperCase()']) !!}
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Ukuran:</label>
                                {!! Form::text('ukuran', null, ['class' => 'form-control', 'required' => true,'oninput' => 'this.value = this.value.toUpperCase()']) !!}
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Type:</label>
                                {!! Form::select('tipe', $containers, null, ['class' => 'form-select','placeholder' => '-- Select --']) !!}
                            </div>
                            <div class="col-md-3">
                                <a href="javascript:;" data-repeater-delete
                                    class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                    <i class="la la-trash-o"></i>Delete
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Form group-->

            <!--begin::Form group-->
            <div class="form-group mt-5">
                <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
                    <i class="la la-plus"></i>Add
                </a>
            </div>
            <!--end::Form group-->
        </div>
        <!--end::Repeater-->
    </div>
</div>

@push('js')
<script>
    $(document).ready(function() {
        containersRepeater = $('#containers').repeater({
            initEmpty: true,
            show: function() {
                $(this).slideDown();
            },

            hide: function(deleteElement) {
                $(this).slideUp(deleteElement);
            }
        });
    )}
</script>
@endpush