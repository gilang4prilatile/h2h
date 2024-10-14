<!--begin::Modal - New Target-->
<div class="modal fade" id="detail-modal" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered modal-fullscreen">
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
                    <h1 class="mb-3">Sumber Detail Barang</h1>
                    <!--end::Title-->
                </div>
                <!--end::Heading-->
                @if($bc == 'BC25')
                <div class="form-group row">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <nav class="nav nav-pills flex-column flex-sm-row">
                                <button class="flex-sm-fill text-sm-center nav-link active" aria-current="page" type="button" id="btn-barang-local">Local</button>
                                <button class="flex-sm-fill text-sm-center nav-link" type="button" id="btn-barang-import">Import</button>
                              </nav>
                        </div>
                    </div>
                @endif
                <div class="form-group row mt-5">
                    <div class="col-md-12" id="container-detail-barang-local">
                        <h4 class="mb-3">Barang Local</h4>
                        <div class="form-group row mb-3">
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="search-barang-local" placeholder="Search Data Barang Local">
                            </div>
                        </div>
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="table-detail-barang-local">
                            <!--begin::Table head-->
                            <thead>
                                <!--begin::Table row-->
                                <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                    <th class="min-w-40px">No</th>
                                    <th class="min-w-100px">SKU/KODE BARANG</th>
                                    <th class="min-w-125px">Nama Barang</th>
                                    <th class="min-w-125px">Jenis Barang</th>
                                    <th class="min-w-125px">BC</th>
                                    <th class="min-w-125px">No Pendaftaran</th>
                                    <th class="min-w-125px">Tanggal Pendaftaran</th>
                                    <th class="min-w-125px">Tanggal Masuk</th>
                                    <th class="min-w-125px">No. Pengajuan</th>
                                    <th class="min-w-125px">No. Faktur</th>
                                    <th class="min-w-125px">Parsial Masuk</th>
                                    <th class="min-w-50px">QTY</th>
                                    <th class="min-w-125px">Netto</th>
                                    <th class="min-w-125px">Volume</th>
                                    <th class="min-w-125px">HS Code</th>
                                    <th class="min-w-125px">Jenis Satuan</th>
                                    <th class="min-w-125px">Jenis Kemasan</th>
                                    <th class="min-w-125px">Merek</th>
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
                    @if($bc == 'BC25')
                        <div class="col-md-12" id="container-detail-barang-import">
                            <h4 class="mb-3">Barang Import</h4>
                            <div class="form-group row mb-3">
                                <div class="col-md-12 form-group">
                                    <input type="text" class="form-control" id="search-barang-import" placeholder="Search Data Barang Import">
                                </div>
                            </div>
                            <table class="table align-middle table-row-dashed fs-6 gy-5" id="table-detail-barang-import">
                                <!--begin::Table head-->
                                <thead>
                                    <!--begin::Table row-->
                                    <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                                        <th class="min-w-40px">No</th>
                                        <th class="min-w-100px">SKU/KODE BARANG</th>
                                        <th class="min-w-125px">Nama Barang</th>
                                        <th class="min-w-125px">Jenis Barang</th>
                                        <th class="min-w-125px">BC</th>
                                        <th class="min-w-125px">No Pendaftaran</th>
                                        <th class="min-w-125px">Tanggal Pendaftaran</th>
                                        <th class="min-w-125px">Tanggal Masuk</th>
                                        <th class="min-w-125px">No. Pengajuan</th>
                                        <th class="min-w-125px">No. Faktur</th>
                                        <th class="min-w-125px">Parsial Masuk</th>
                                        <th class="min-w-50px">QTY</th>
                                        <th class="min-w-125px">Netto</th>
                                        <th class="min-w-125px">Volume</th>
                                        <th class="min-w-125px">HS Code</th>
                                        <th class="min-w-125px">Jenis Satuan</th>
                                        <th class="min-w-125px">Jenis Kemasan</th>
                                        <th class="min-w-125px">Merek</th>
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
                    @endif
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
            
            $('#container-detail-barang-import').hide();
            $('#btn-barang-local').on('click', function(){

                if($('#btn-barang-import').hasClass('active')){
                    $('#btn-barang-import').removeClass('active');
                    $('#btn-barang-local').addClass('active');

                    // Show Table
                    $('#container-detail-barang-local').show();
                    $('#container-detail-barang-import').hide();

                }
                

            });

            $('#btn-barang-import').on('click', function(){

                if($('#btn-barang-local').hasClass('active')){
                    $('#btn-barang-local').removeClass('active');
                    $('#btn-barang-import').addClass('active');

                    // Show Table
                    $('#container-detail-barang-local').hide();
                    $('#container-detail-barang-import').show();
                }

            });

            
            //triggered when modal is about to be shown
            var tableDetailBarangLocal = $('#table-detail-barang-local').DataTable();
            var tableDetailBarangImport = $('#table-detail-barang-import').DataTable();
     

            var goodConversions = [];
            $('#detail-modal').on('show.bs.modal', function(e) {
                console.log(inventoryOutboundDetails);
                tableDetailBarangLocal.clear();
                tableDetailBarangImport.clear();

                //get data-id attribute of the clicked element
                var kodeBarang = $(e.relatedTarget).data('detail-kode-barang');
             
                var dataLocal = [];
                var dataImport = [];
                var indexLocal = 0;
                var indexImport = 0;
                $.each(inventoryOutboundDetails, (i, vi) => {

                    if(vi.good_conversion.details.kode_barang == kodeBarang){

                         if(vi.inbound.bc_form.name == 'BC40'){
                                var noFaktur = '-';

                                $.each(vi.inbound.inbound_documents, (z, vz) => {
                                    if(vz.master_document.id == 3){
                                        noFaktur = vz.details.nomor_dokumen;
                                    }
                                });
                                
                                var tanggalMasuk =  '';
                                var quantityGood = (Math.abs(vi.quantity_good_conversion * 100) / 100);
                                if(vi.inbound.created_at != '')
                                    tanggalMasuk = new Date(vi.inbound.created_at).toLocaleString();

                                dataLocal[indexLocal] = [
                                    ( indexLocal + 1 ),
                                    vi.good.details.kode_barang ?? '', 
                                    vi.good.name ?? '', 
                                    vi.good.details.jenis_barang ?? '',
                                    vi.inbound.bc_form.name ?? '',
                                    vi.inbound.details.nomor_pendaftaran ?? '',
                                    vi.inbound.details.tanggal_pendaftaran ?? '',
                                    tanggalMasuk,
                                    vi.inbound.request_number ?? '',
                                    noFaktur, 
                                    vi.inbound.details.partial == 1 ? 'Ya' : 'Tidak',
                                    quantityGood ?? '',
                                    vi.inbound_detail.nett_weight ?? '',
                                    vi.inbound_detail.volume ?? '',
                                    vi.inbound_detail.hs_code_id != null ? vi.inbound_detail.hs_code.code : '',
                                    vi.good.uom.name,
                                    vi.inbound_detail.package.name ?? '',
                                    vi.good.details.merk ?? '',
                                ];
                                indexLocal++;
                            }else {

                                var noFaktur = '-';
                                $.each(vi.inbound.inbound_documents, (z, vz) => {
                                    if(vz.master_document.id == 3){
                                        noFaktur = vz.details.nomor_dokumen;
                                    }
                                });

                                var tanggalMasuk =  '';
                                var quantityGood = (Math.abs(vi.quantity_good_conversion * 100) / 100);
                                if(vi.inbound.created_at != '')
                                    tanggalMasuk = new Date(vi.inbound.created_at).toLocaleString();

                                dataImport[indexImport] = [
                                    ( indexImport + 1 ),
                                    vi.good.details.kode_barang ?? '', 
                                    vi.good.name ?? '', 
                                    vi.good.details.jenis_barang ?? '',
                                    vi.inbound.bc_form.name ?? '',
                                    vi.inbound.details.nomor_pendaftaran ?? '',
                                    vi.inbound.details.tanggal_pendaftaran ?? '',
                                    tanggalMasuk,
                                    vi.inbound.request_number ?? '',
                                    noFaktur, 
                                    vi.inbound.details.partial == 1 ? 'Ya' : 'Tidak',
                                    quantityGood ?? '',
                                    vi.inbound_detail.nett_weight ?? '',
                                    vi.inbound_detail.volume ?? '',
                                    vi.inbound_detail.hs_code_id != null ? vi.inbound_detail.hs_code.code : '',
                                    vi.good.uom.name,
                                    vi.inbound_detail.package.name ?? '',
                                    vi.good.details.merk ?? '',
                                ];
                                indexImport++;
                            }

                      
                    }
                    

                });

                console.log("DATA LOCAL");
                console.log(dataLocal);
                tableDetailBarangLocal.rows.add(dataLocal).draw();
                tableDetailBarangImport.rows.add(dataImport).draw();
                
            
                $('#search-barang-local').keyup(function() {
                  
                    var searchText = $(this).val().toLowerCase();
                    tableDetailBarangLocal.search(searchText);
                    tableDetailBarangLocal.draw();

                });

                $('#search-barang-import').keyup(function() {
                  
                  var searchText = $(this).val().toLowerCase();
                  tableDetailBarangImport.search(searchText);
                  tableDetailBarangImport.draw();

              });
          
            

            });
        })
    </script>
@endpush
