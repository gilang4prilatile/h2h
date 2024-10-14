<!--begin::Modal - New Target-->
<div class="modal fade" id="upload-modal" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-lg-1000px">
        <!--begin::Modal content-->
        <div class="modal-content rounded">
            <!--begin::Modal header-->
            <div class="modal-header pb-0 border-0 justify-content-end">
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <!--begin::Svg Icon | path: icons/duotone/Navigation/Close.svg-->
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                            height="24px" viewBox="0 0 24 24" version="1.1">
                            <g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)"
                                fill="#000000">
                                <rect fill="#000000" x="0" y="7" width="16" height="2" rx="1" />
                                <rect fill="#000000" opacity="0.5"
                                    transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000)"
                                    x="0" y="7" width="16" height="2" rx="1" />
                            </g>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::Close-->
            </div>
            <!--begin::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                <!--begin:Form-->
                <form id="upload-form" action="#">
                @csrf
                <!--begin::Heading-->
                <div class="mb-13 text-center">
                    <!--begin::Title-->
                    <h1 class="mb-3">Upload Barang</h1>
                    <!--end::Title-->
                </div>
                <!--end::Heading-->
                <div class="form-group row">
                    <div class="col-md-12">
                            <label for="file" class="form-label">Excel File:</label>
                            <input type="file" class="form-control" id="file" name="file" required /> 
                            {!! Form::hidden('id_inbound', $id_inbound, ['id' => 'id_inbound']) !!}                   
                    </div>
                </div> 
                <div class="text-center" style="margin-top:20px;">
                    <button type="reset" id="button_cancel_modal_tambah__upload_barang" class="btn btn-light me-3">Cancel</button>
                    <button type="submit" id="button_tambah_upload_barang" class="btn btn-primary">
                        <span class="indicator-label">Submit</span>
                    </button>
                </div>
                <!--end::Actions-->
             </form>
                <!--end:Form-->
            </div>
            <div id="loadingSpinner" style="display:none;">
                <img src="path_to_spinner.gif" alt="Loading..."/>
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - New Target-->
@push('js')
<script src="https://cdn.jsdelivr.net/npm/form-data-json-convert/dist/form-data-json.min.js"></script>
@endpush
@push('js')
    <script>
        var goodOptions = [];
        var selectedHsCode = {};
        var type = `{{ isset($type) && $type == 'add' ? 'add' : 'edit' }}`;
        $(document).ready(function() {

            $('#upload-form').submit(function(e){
                e.preventDefault(); // Mencegah submit form default
                $('#loadingSpinner').show(); 
                $('#button_tambah_upload_barang').attr('disabled', true);
                let formData = new FormData(this); // Menggunakan FormData
                formData.append('type', type);
                $.ajax({
                    type: "POST",
                    url: `air/{{ $bc == '20' ? 'pib' : 'peb' }}/upload-inbound-detail-good`,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: formData,
                    processData: false,  // penting untuk file upload
                    contentType: false,  // penting untuk file upload
                    success: function(res) {
                        if(type == 'add'){
                            if(res.status == 'success'){
                                res.data.forEach((item) => {
                                    selectedGoods.push(item);
                                });
                                refreshGoodsInfo()
                            }
                        }
                        $('#button_tambah_upload_barang').removeAttr('disabled');
                        $('#loadingSpinner').hide(); 
                        Swal.fire("Success!", "Data berhasil diunggah.", "success");
                        $('#upload-form').trigger('reset');
                        $('#upload-form select').trigger('change');
                        $('#upload-modal').modal('hide');
                    },
                    error: function(xhr, status, error) {
                        $('#button_tambah_upload_barang').removeAttr('disabled');
                        var errorMessage = xhr.status + ': ' + xhr.statusText
                        if(xhr.responseJSON && xhr.responseJSON.error) {
                            errorMessage = xhr.responseJSON.error;
                        }
                        Swal.fire("Error!", errorMessage, "error");
                    }
                });
            }); 
        });
    </script>
@endpush
