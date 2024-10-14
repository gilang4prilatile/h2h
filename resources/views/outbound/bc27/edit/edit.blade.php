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
                        <h3 class="card-title">Input BC27</h3>
                        <div class="card-toolbar">
                        </div>
                    </div>
                    {{-- {!! Form::model($model,["id" => "form"]) !!} --}}
                    <div class="card-body">
                        {{ Form::open(['url' => $mainUrl . '/update/' . $outbound->id, 'method' => 'POST', 'id' => 'create-form', 'enctype' => 'multipart/form-data']) }}
                        <div class="form-group">
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label class="form-label required">Nomor Pengajuan</label>
                                    {!! Form::text('request_number', $outbound->request_number, ['class' => 'form-control ', 'required' => true, 'placeholder' => 'Input No Pengajuan']) !!}
                                    @if($errors->has('request_number'))
                                        <span class="error text-danger">{{ $errors->first('request_number') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label required">Nomor Pendaftaran</label>
                                    {!! Form::text('details[nomor_pendaftaran]', @$outbound->details['nomor_pendaftaran'] ?: null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Input No Pendaftaran']) !!}
                                    @if($errors->has('details[nomor_pendaftaran]'))
                                        <span class="error text-danger">{{ $errors->first('details[nomor_pendaftaran]') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label required">Tanggal Pendaftaran</label>
                                    {!! Form::text('details[tanggal_pendaftaran]', @$outbound->details['tanggal_pendaftaran'] ?: null, ['class' => 'form-control datepicker', 'required' => true, 'placeholder' => 'Pilih Tanggal']) !!}
                                    @if($errors->has('details[tanggal_pendaftaran]'))
                                        <span class="error text-danger">{{ $errors->first('details[tanggal_pendaftaran]') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row" style="margin-top:10px;">
                                <div class="col-md-6">
                                    <label class="form-label required">Kantor Pabean Asal</label>
                                    {!! Form::select('kppbc_asal_id', $kppbcSelectBox, $outbound->outboundKppbcAsal->kppbc_id, ['class' => 'form-select', 'required' => true, 'placeholder' => '-- Select --', 'data-control' => 'select2']) !!}
                                    @if($errors->has('kppbc_asal_id'))
                                        <span class="error text-danger">{{ $errors->first('kppbc_asal_id') }}</span>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label required">Kantor Pabean Tujuan</label>
                                    {!! Form::select('kppbc_tujuan_id', $kppbcSelectBox, $outbound->outboundKppbcTujuan->kppbc_id, ['class' => 'form-select', 'required' => true, 'placeholder' => '-- Select --', 'data-control' => 'select2']) !!}
                                    @if($errors->has('kppbc_tujuan_id'))
                                        <span class="error text-danger">{{ $errors->first('kppbc_tujuan_id') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row" style="margin-top:10px;">
                                <div class="col-md-6">
                                    <label class="form-label required">Jenis TPB Asal</label>
                                    {!! Form::select('jenis_tpb_asal_id', $jenisTpbSelectBox, $outbound->outboundJenisTpbAsal->jenis_tpb_id, ['class' => 'form-select', 'required' => true, 'data-control' => 'select2', 'placeholder' => '-- Select --']) !!}
                                    @if($errors->has('jenis_tpb_asal_id'))
                                        <span class="error text-danger">{{ $errors->first('jenis_tpb_asal_id') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label required">Jenis TPB Tujuan</label>
                                    {!! Form::select('jenis_tpb_tujuan_id', $jenisTpbSelectBox, $outbound->outboundJenisTpbTujuan->jenis_tpb_id, ['class' => 'form-select', 'required' => true, 'data-control' => 'select2', 'placeholder' => '-- Select --']) !!}
                                    @if($errors->has('jenis_tpb_tujuan_id'))
                                        <span class="error text-danger">{{ $errors->first('jenis_tpb_tujuan_id') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row" style="margin-top:10px;">
                                <div class="col-md-4">
                                    <label class="form-label required">TPB Asal Barang</label>
                                    {!! Form::select('tpb_asal_id', $tpbSelectBox, $outbound->outboundTpbAsal->profile_id, ['class' => 'form-select', 'required' => true, 'data-control' => 'select2', 'placeholder' => '-- Select --']) !!}
                                    @if($errors->has('tpb_asal_id'))
                                        <span class="error text-danger">{{ $errors->first('tpb_asal_id') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label required">TPB Tujuan Barang</label>
                                    {!! Form::select('tpb_tujuan_id', $tpbSelectBox, $outbound->outboundTpbTujuan->profile_id, ['class' => 'form-select', 'required' => true, 'data-control' => 'select2', 'placeholder' => '-- Select --']) !!}
                                    @if($errors->has('tpb_tujuan_id'))
                                        <span class="error text-danger">{{ $errors->first('tpb_tujuan_id') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label required">Tujuan Pengiriman</label>
                                    {!! Form::select('tujuan_pengiriman_id', $tujuanPengirimanSelectBox, $outbound->outboundTujuanPengiriman->tujuan_pengiriman_id, ['class' => 'form-select', 'required' => true, 'data-control' => 'select2', 'placeholder' => '-- Select --']) !!}
                                    @if($errors->has('tujuan_pengiriman_id'))
                                        <span class="error text-danger">{{ $errors->first('tujuan_pengiriman_id') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row" style="margin-top:10px;">
                                <h2 class="fw-bolder mt-4">Pengangkutan</h2>

                                <div class="col-md-6">
                                    <label class="form-label required">Jenis Sarana Pengangkutan Darat</label>
                                    {!! Form::select('transportation_id', $transportations, @$outbound->outboundTransportation->transportation_id ?: null, ['class' => 'form-select', 'required' => true, 'data-control' => 'select2', 'placeholder' => '-- Select --']) !!}
                                    @if($errors->has('transportation_id'))
                                        <span class="error text-danger">{{ $errors->first('transportation_id') }}</span>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label required">Nomor Polisi</label>
                                    {!! Form::text('vehicle_number', @$outbound->outboundTransportation->vehicle_number ?: null, ['class' => 'form-control', 'required' => true]) !!}
                                    @if($errors->has('vehicle_number'))
                                        <span class="error text-danger">{{ $errors->first('vehicle_number') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row" style="margin-top:10px;">
                                <div class="col-md-4">
                                    <label class="form-label required">Valuta</label>
                                    {!! Form::select('valas_id', $valas, $outbound->outboundValas->valas_id, ['class' => 'form-select', 'required' => true, 'placeholder' => '-- Select --', 'data-control' => 'select2']) !!}
                                    @if($errors->has('valas_id'))
                                        <span class="error text-danger">{{ $errors->first('valas_id') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Nilai CIF</label>
                                    {!! Form::number('details[cif]', @$outbound->details['cif'] ?: null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Input', 'id' => 'cif']) !!}
                                    @if($errors->has('details[cif]'))
                                        <span class="error text-danger">{{ $errors->first('details[cif]') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label required">Harga Penyerahan</label>
                                    {!! Form::number('details[harga_penyerahan]', @$outbound->details['harga_penyerahan'] ?: null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Input Harga Penyerahan']) !!}
                                    @if($errors->has('details[harga_penyerahan]'))
                                        <span class="error text-danger">{{ $errors->first('details[harga_penyerahan]') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row" style="margin-top:10px;">
                                <h2 class="fw-bolder mt-4">Peti Kemas</h2>
                                <div class="col-md-4">
                                    <label class="form-label required">Nomor</label>
                                    {!! Form::text('details[nomor_peti_kemas]', @$outbound->details['nomor_peti_kemas'] ?: null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Input', 'id' => 'nomor_peti_kemas']) !!}
                                    @if($errors->has('details[nomor_peti_kemas]'))
                                        <span class="error text-danger">{{ $errors->first('details[nomor_peti_kemas]') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label required">Ukuran</label>
                                    {!! Form::number('details[ukuran_peti_kemas]', @$outbound->details['ukuran_peti_kemas'] ?: null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Input', 'id' => 'ukuran_peti_kemas']) !!}
                                    @if($errors->has('details[ukuran_peti_kemas]'))
                                        <span class="error text-danger">{{ $errors->first('details[ukuran_peti_kemas]') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label required">Tipe</label>
                                    {!! Form::select('details[tipe_peti_kemas]', $containers, @$outbound->details['tipe_peti_kemas'] ?: null, ['class' => 'form-select', 'required' => true, 'placeholder' => '-- Select --', 'data-control' => 'select2']) !!}
                                    @if($errors->has('details[tipe_peti_kemas]'))
                                        <span class="error text-danger">{{ $errors->first('details[tipe_peti_kemas]') }}</span>
                                    @endif
                                </div>
                            </div>

                            @include('outbound.components.edit.documents')

                            <div class="form-group row" style="margin-top:10px;">
                                <div class="col-md-12">
                                    <h2 class="fw-bolder mt-4">Barang</h2>
                                    @if($errors->has('list_barang'))
                                        <span class="error text-danger">{{ $errors->first('list_barang') }}</span>
                                    @endif
                                    <div class="form-group row">
                                        <div class="form-group mt-5">
                                            <a href="javascript:void(0);" id="btn-tambah-barang" data-bs-toggle="modal" data-bs-target="#add-modal" class="btn btn-light-primary">
                                                <i class="la la-plus"></i>Add
                                            </a>
                                        </div>
                                    </div>
                                    @include('outbound.components.edit.goods_table')
                                </div>
                            </div>

                            <div class="form-group row" style="margin-top:10px;">
                                <div class="col-md-6">
                                    <label class="form-label">Volume (m3)</label>
                                    {!! Form::number('details[volume]', @$outbound->details['volume'] ?: null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Input', 'id' => 'total_volume']) !!}
                                    @if($errors->has('details[volume]'))
                                        <span class="error text-danger">{{ $errors->first('details[volume]') }}</span>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Berat Kotor (Kg)</label>
                                    {!! Form::number('details[berat_kotor]', @$outbound->details['berat_kotor'] ?: null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Input', 'id' => 'berat_kotor']) !!}
                                    @if($errors->has('details[berat_kotor]'))
                                        <span class="error text-danger">{{ $errors->first('details[berat_kotor]') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row" style="margin-top:10px;">
                                <div class="col-md-6">
                                    <label class="form-label">Berat Bersih (Kg)</label>
                                    {!! Form::number('details[berat_bersih]', @$outbound->details['berat_bersih'] ?: null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Input', 'id' => 'berat_bersih']) !!}
                                    @if($errors->has('details[berat_bersih]'))
                                        <span class="error text-danger">{{ $errors->first('details[berat_bersih]') }}</span>
                                    @endif
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
                                        {!! Form::text('details[pabean_tempat]', @$outbound->details['pabean_tempat'] ?: null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Input Nama']) !!}
                                        @if($errors->has('details[pabean_tempat]'))
                                            <span class="error text-danger">{{ $errors->first('details[pabean_tempat]') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label required">Tanggal</label>
                                        {!! Form::text('details[pabean_tanggal]', @$outbound->details['pabean_tanggal'] ?: null, ['class' => 'form-control datepicker', 'required' => true, 'placeholder' => 'input Tanggal']) !!}
                                        @if($errors->has('details[pabean_tanggal]'))
                                            <span class="error text-danger">{{ $errors->first('details[pabean_tanggal]') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-4">
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label class="form-label required">Pemberitahu</label>
                                        {!! Form::text('details[pabean_pemberitahu]', @$outbound->details['pabean_pemberitahu'] ?: null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Input Pemberi Tahu']) !!}
                                        @if($errors->has('details[pabean_pemberitahu]'))
                                            <span class="error text-danger">{{ $errors->first('details[pabean_pemberitahu]') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label required">Jabatan</label>
                                        {!! Form::text('details[pabean_jabatan]', @$outbound->details['pabean_jabatan'] ?: null, ['class' => 'form-control', 'required' => true, 'placeholder' => 'Input Jabatan']) !!}
                                        @if($errors->has('details[pabean_jabatan]'))
                                            <span class="error text-danger">{{ $errors->first('details[pabean_jabatan]') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!--begin::Actions-->
                            <div class="text-center" style="margin-top:20px;">
                                <button type="reset" id="" class="btn btn-light me-3">Cancel</button>
                                <button type="submit" id="" class="btn btn-primary">
                                    <span class="indicator-label">Submit</span>
                                </button>
                            </div>
                            <!--end::Actions-->
                        </div>
                        {!! Form::close() !!}
                        @include('outbound.components.edit.edit_modal')
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
        var outboundDetails = outbound.outbound_details;
        var selectedOutboundDetail = {};
        const refreshGoodsInfo = () => {
            let totalVolume = outboundDetails.reduce(function(total, v) {
                return parseFloat(total) + parseFloat(v.volume)
            }, 0)
            let totalBeratBersih = outboundDetails.reduce(function(total, v) {
                return parseFloat(total) + parseFloat(v.nett_weight)
            }, 0)
            $('#total_volume').val(totalVolume)
            $('#berat_bersih').val(totalBeratBersih)
            $('#table').DataTable().clear().rows.add(outboundDetails).draw()
        }

        $(document).ready(function() {
            $('#create-form').submit(function(e){
                if (outboundDetails.length == 0) {
                    e.preventDefault();
                    Swal.fire('Error', 'Goods is required', 'error')
                }
            })
        })
    </script>
@endpush
