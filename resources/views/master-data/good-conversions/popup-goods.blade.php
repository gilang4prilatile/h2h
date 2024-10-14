<div class="modal fade" id="pilih-produk-modal" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="addIntegration" tabindex="-1">
  <div class="modal-dialog modal-xl modal-dialog-centered ">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Daftar Produk</h3>
        <div class="d-flex align-items-center position-relative my-1">
          <span class="svg-icon svg-icon-1 position-absolute ms-6">
            <i class="fas fa-search"></i>
          </span>
          <input type="text" id="search-input" class="form-control form-control-sm form-control-solid ps-15 w-275px" placeholder="Cari Produk, SKU" data-kt-customer-table-filter="cari-produk">
        </div>
      </div>
      <div class="modal-body">
        <table class="table align-middle table-row-dashed fs-6 gy-5" id="table-prod">
          <thead>
            <tr class="text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
              <th class="w-50px">
                <div class="form-check text-right">
                  <input class="form-check-input" type="checkbox" value="" onchange="select_all(this.checked)" id="check_all">
                </div>
              </th>
              <th class="min-w-25px text-center">NO</th>
              <th class="min-w-125px text-start">Kode Barang</th>
              <th class="min-w-200px text-start">Name</th>
              <th class="min-w-50px text-start">Jenis Barang</th>
              <th class="min-w-50px text-start">Asal Barang</th>
            </tr>
          </thead>
          <tbody class="fw-bold">
            <?php $angka = 0;  ?>
            @foreach($data_goods as $index => $row)
            <?php $angka += 1; ?>
            <tr>
              <td class="w-50px">
                <div class="form-check text-right">
                  <input class="form-check-input" type="checkbox" value="{{$row->id}}" onchange="select_product('{{ $row->id }}', '{{ $row->kode_barang }}', '{{ $row->name }}', '{{ $row->uom }}', this.checked)">
                </div>
              </td>
              <td class="min-w-25px text-center">{{$angka}}</td>
              <td class="min-w-125px text-start">{{$row->kode_barang}}</td>
              <td class="min-w-200px text-start">{{$row->name}}</td>
              <td class="min-w-50px text-start">{{$row->details['jenis_barang'] ?? ''}}</td>
              <td class="min-w-50px text-start">{{$row->details['asal_barang'] ?? ''}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="modal-footer justify-content-end">
        <button type="button" class="btn btn-primary btn-pilih" onclick="confirm_select()">
          Pilih Produk {{-- (<span id="select_count">0</span>) --}}
        </button>
        <button type="button" class="btn btn-danger" onclick="close_modal()">Tutup</button>
      </div>
    </div>
  </div>
</div>