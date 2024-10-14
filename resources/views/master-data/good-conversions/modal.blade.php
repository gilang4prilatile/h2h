<!--begin::Modal - New Target-->
<div class="modal fade" id="detail-modal" aria-hidden="true">
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
                        <span class="mr-2">Tutup</span>
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
                <form id="add-form" action="#">
                {{-- {!! Form::hidden('auth_token', $authToken ?? '', ['id' => 'auth_token']) !!} --}}
                <!--begin::Heading-->
                <div class="mb-13 text-center">
                    <!--begin::Title-->
                    <h1 class="mb-3">Detail Goods Conversions</h1>
                    <!--end::Title-->
                </div>
                <!--end::Heading-->
                <div class="form-group row mt-5">
                    <div class="col-md-12" id="container-detail-barang">
                        <h4 class="mb-3">Detail Good Converions</h4>
                        <div class="form-group row mb-3">
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="search-barang" placeholder="Search Data Barang">
                            </div>
                        </div>
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="table-detail-barang">
                            <!--begin::Table head-->
                            <thead>
                                <!--begin::Table row-->
                                <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                    <th class="min-w-40px">No</th>
                                    <th class="min-w-125px">Kode Barang</th>
                                    <th class="min-w-125px">Nama Barang</th>
                                    <th class="min-w-125px">Jenis Barang</th>
                                    <th class="min-w-125px">QTY</th>
                                    <th class="min-w-125px">Satuan Barang</th>
                                </tr>
                                <!--end::Table row-->
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody class="text-gray-600 fw-bold">

                            </tbody>
                            <!--end::Table body-->
                        </table>
                    </div>
                </div>
                <!--begin::Actions-->
                <!-- <div class="text-center m-auto" style="margin-top:20px;">
                    <button type="reset" data-bs-dismiss="modal" class="btn btn-light me-3">Tutup</button>
                </div> -->
                <!--end::Actions-->
            </form>
                <!--end:Form-->
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
        $(document).ready(function(){
            function float(equation, precision = 9) {
                return Math.floor(equation * (10 ** precision)) / (10 ** precision);
            }
            
            //triggered when modal is about to be shown
            var tableDetailBarang = $('#table-detail-barang').DataTable();

            $('#detail-modal').on('show.bs.modal', function(e) {

                tableDetailBarang.clear();

                var rowDetails = [];

                $.each(dataDetailGoods.good_conversions, (i, vi) => {

                    rowDetails[i] = [
                        (i + 1),
                        vi.raw_good.details.kode_barang,
                        vi.raw_good.name,
                        vi.raw_good.details.jenis_barang,
                        float(vi.quantity),
                        vi.raw_good.uom.name
                    ];

                });
         
                tableDetailBarang.rows.add(rowDetails).draw();
                
            
                $('#search-barang').keyup(function() {
                
                    var searchText = $(this).val().toLowerCase();
                    tableDetailBarang.search(searchText);
                    tableDetailBarang.draw();

                });  

            });

            $('#detail-modal').on('hide.bs.modal', function(e){

                dataDetailGoods = [];

            });

        })
    </script>
@endpush
