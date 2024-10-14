@extends("layouts.main")
@section('content')
    @include("components.toolbar", ['parentMenuName' => 'Outbound', 'menuName' => 'BC27'])
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container">
                <!--begin::Card-->
                <div class="card ">
                    <div class="card-header card-header-stretch">
                        <h3 class="card-title">Detail BC27</h3>
                        <div class="card-toolbar">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="form-group row">
                                <div class="col-md-5"></div>
                                <div class="col-md-5"></div>
                                @if($canDone)
                                <div class="col-md-1"><p>Ubah Status:</p></div>
                                <div class="col-md-1">
                                    <a href="{{ $mainUrl . '/done/' . $outbound->id }}" type="button" id="btn-sppd" class="btn btn-primary">
                                        <span class="indicator-label">SPPD</span>
                                    </a>
                                </div>
                                @endif
                            </div>
                            <div class="form-group row" style="margin-top:10px;">
                                <div class="col-md-4">
                                    <label class="form-label required">Nomor Pengajuan</label>
                                    <p>{{ $outbound->request_number }}</p>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label required">Nomor Pendaftaran</label>
                                    <p>{{ $outbound->details['nomor_pendaftaran'] }}</p>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label required">Tanggal Pendaftaran</label>
                                    <p>{{ $outbound->details['tanggal_pendaftaran'] }}</p>
                                </div>
                            </div>
                            <div class="form-group row" style="margin-top:10px;">
                                <div class="col-md-6">
                                    <label class="form-label required">Kantor Pabean Asal</label>
                                    <p>{{ $outbound->outboundKppbcAsal->masterKppbc->description }}</p>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label required">Kantor Pabean Tujuan</label>
                                    <p>{{ $outbound->outboundKppbcTujuan->masterKppbc->description }}</p>
                                </div>
                            </div>
                            <div class="form-group row" style="margin-top:10px;">
                                <div class="col-md-6">
                                    <label class="form-label required">Jenis TPB Asal</label>
                                    <p>{{ $outbound->outboundJenisTpbAsal->masterJenisTpb->name }}</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label required">Jenis TPB Tujuan</label>
                                    <p>{{ $outbound->outboundJenisTpbTujuan->masterJenisTpb->name }}</p>
                                </div>
                            </div>
                            <div class="form-group row" style="margin-top:10px;">
                                <div class="col-md-4">
                                    <label class="form-label required">TPB Asal Barang</label>
                                    <p>{{ $outbound->outboundTpbAsal->profile->name }}</p>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label required">TPB Tujuan Barang</label>
                                    <p>{{ $outbound->outboundTpbTujuan->profile->name }}</p>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label required">Tujuan Pengiriman</label>
                                    <p>{{ $outbound->outboundTujuanPengiriman->masterTujuanPengiriman->name }}</p>
                                </div>
                            </div>
                            <div class="form-group row" style="margin-top:10px;">
                                <h2 class="fw-bolder mt-4">Pengangkutan</h2>

                                <div class="col-md-6">
                                    <label class="form-label required">Jenis Sarana Pengangkutan Darat</label>
                                    <p>{{ $outbound->outboundTransportation->transportation->name }}</p>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label required">Nomor Polisi</label>
                                    <p>{{ $outbound->outboundTransportation->vehicle_number }}</p>
                                </div>
                            </div>

                            <div class="form-group row" style="margin-top:10px;">
                                <div class="col-md-4">
                                    <label class="form-label required">Valuta</label>
                                    <p>{{ $outbound->outboundValas->masterValas->name }}</p>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label required">Nilai CIF</label>
                                    <p>{{ $outbound->details['cif'] }}</p>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label required">Harga Penyerahan</label>
                                    <p>{{ $outbound->details['harga_penyerahan'] }}</p>
                                </div>
                            </div>

                            <div class="form-group row" style="margin-top:10px;">
                                <h2 class="fw-bolder mt-4">Peti Kemas</h2>
                                <div class="col-md-4">
                                    <label class="form-label required">Nomor</label>
                                    <p>{{ $outbound->details['nomor_peti_kemas'] }}</p>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label required">Ukuran</label>
                                    <p>{{ $outbound->details['ukuran_peti_kemas'] }}</p>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label required">Tipe</label>
                                    <p>{{ $outbound->details['tipe_peti_kemas'] }}</p>
                                </div>
                            </div>

                            <div class="form-group row" style="margin-top:10px;">
                                <div class="col-md-12">
                                    <h2 class="fw-bolder mt-4">Dokumen</h2>
                                    @include('outbound.components.detail.documents_table')
                                </div>
                            </div>

                            <div class="form-group row" style="margin-top:10px;">
                                <div class="col-md-12">
                                    <h2 class="fw-bolder mt-4">Barang</h2>
                                    @include('outbound.components.detail.goods_table')
                                </div>
                            </div>

                            <div class="form-group row" style="margin-top:10px;">
                                <div class="col-md-6">
                                    <label class="form-label">Volume (m3)</label>
                                    <p>{{ $outbound->details['volume'] }}</p>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Berat Kotor (Kg)</label>
                                    <p>{{ $outbound->details['berat_kotor'] }}</p>
                                </div>
                            </div>

                            <div class="form-group row" style="margin-top:10px;">
                                <div class="col-md-6">
                                    <label class="form-label">Berat Bersih (Kg)</label>
                                    <p>{{ $outbound->details['berat_bersih'] }}</p>
                                </div>
                            </div>

                            <hr class="mt-8">
                            <div class="row mt-4">
                                <div class="col">
                                    <p>
                                        Dengan ini saya menyatakan bertanggung jawab atas kebenaran hal-hal yang diberitahukan dalam
                                        pemberitahuan pabean ini
                                    </p>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label class="form-label required">Tempat</label>
                                        <p>{{ $outbound->details['pabean_tempat'] }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label required">Tanggal</label>
                                        <p>{{ $outbound->details['pabean_tanggal'] }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-4">
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label class="form-label required">Pemberitahu</label>
                                        <p>{{ $outbound->details['pabean_pemberitahu'] }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label required">Jabatan</label>
                                        <p>{{ $outbound->details['pabean_jabatan'] }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- {!! Form::close() !!} --}}
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
    <!--end::Content-->
@endsection

@push('js')
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.js"
        integrity="sha512-bZAXvpVfp1+9AUHQzekEZaXclsgSlAeEnMJ6LfFAvjqYUVZfcuVXeQoN5LhD7Uw0Jy4NCY9q3kbdEXbwhZUmUQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
    </script>
@endpush

@push('js')
    <script>
        const outbound = @json($outbound);
        const outboundDetails = outbound.outbound_details;
        const outboundDocuments = outbound.outbound_documents;
    </script>
@endpush
