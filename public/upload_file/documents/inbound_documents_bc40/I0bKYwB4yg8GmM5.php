@extends('backend.layout')

@section('nav_button')
@endsection

@section('title-page')
  <p style="margin: 15px 0 0  !important;padding: 0px !important;font-weight: bold;font-size: 20px;">Produk</p>
@endsection

@section('content')
@if($status_onboarding<2)
<div class="row justify-content-center">
    <form method="post">
    <div class="card mb-5">
        <div class="card-body pb-0">
            <div class="wrap-step-checklist transaksi-lacak-pengiriman">
                <div class="col active">
                    <figure class="mb-4"><img src="{{url('image/checklist-white.png')}}" alt=""></figure>
                    <div class="text">
                        <p>Register</p>
                    </div>
                </div>
                <div class="col {{ ($status_users>1 ? "active" : "")}}">
                    <figure class="mb-4"><img src="{{url('image/checklist-white.png')}}" alt=""></figure>
                    <div class="text">
                        <p>Isi Data Produk</p>
                    </div>
                </div>
                <div class="col {{ ($status_users>2 ? "active" : "")}}">
                    <figure class="mb-4"><img src="{{url('image/checklist-white.png')}}" alt=""></figure>
                    <div class="text">
                        <p>Tambah Stok</p>
                    </div>
                </div>
                <div class="col {{ ($status_users>3 ? "active" : "")}}">
                    <figure class="mb-4"><img src="{{url('image/checklist-white.png')}}" alt=""></figure>
                    <div class="text">
                        <p>Buat Katalog</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
</div>
@endif
@include('backend.notif')

  <div class="alert alert-primary" style="display: none;">
    Untuk menggabungkan  produk, pastikan produk yang kamu pilih  adalah produk yang sama
  </div>
  <div class="card product-not-null">
    <!--begin::Card header-->
    <div class="card-header border-0 pt-3 pb-2">
      <!--begin::Search-->
      <div class="align-items-center product-search-bar">
        <div class ="">
          <form method="get">
            <div class="d-flex align-items-center position-relative my-1" style="width: 380px;">
              <span class="svg-icon svg-icon-1 position-absolute ms-6">
              <i class="fas fa-search"></i>
              </span>
              <input type="text" id="pd_search" name="nama_produk" class="form-control form-control-solid ps-15" placeholder="Cari produk, SKU, nama toko, nama gudang">
              <input type="submit" hidden/>
            </div>
          </form>
        </div>

        <div class = "search-bar-buttons">
          <button
            class="btn border border-primary text-primary ms-5"
            data-bs-toggle="modal"
            data-bs-target="#filter-modal" aria-expanded="false">
            <i class="fas fa-filter"></i>
            Filter
          </button>
          <!-- <button type="button" class="btn border border-primary text-primary ms-5" id="reset_filter">Reset</button> -->
        </div>
      </div>

      <!--end::Search-->

      <div class="card-toolbar">
        <!-- Begin: Tombol Mass Upload (Sementara masih di hide karena fitur backendnya belum ada) -->
        <!-- <a href="#" class="btn btn-sm border border-dark ms-5" id="btn-upload-marketplace">Mass Upload</a> -->
        <!-- End: Tombol Mass Upload -->
        @if(!Session::get('data_user')->view_only)
        <div class="dropdown dropdown-action">
          <button class="btn btn-sm border border-dark ms-5 dropdown-toggle" type="button" id="action-drop-0" data-bs-toggle="dropdown" aria-expanded="false">
            Tambah Produk
          </button>
          <ul class="dropdown-menu" aria-labelledby="action-drop-0">
            <li><a class="dropdown-item" href="{{ route('produk_add') }}">Tambah Produk Manual</a></li>
            <li style="margin-top: 15px;">
              <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#add-marketplace-integration">
                Import Dari Marketplace
              </a>
            </li>
          </ul>
        </div>
        @endif
        <!-- <div class="dropdown dropdown-large">
          <a class="" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="{{ asset('image/ico-box.png') }}" />
          </a>

          <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <li>
              <a class="dropdown-item" href="{{ route('produk_add') }}">
                + Tambah Manual
              </a>
            </li>
            @if(env('FITUR_MARKETPLACE')=="show")
            <li>
              <a class="dropdown-item" href="#"
                data-bs-toggle="modal"
                data-bs-target="#add-marketplace-integration">
                + Import Marketplace
              </a>
            </li>
            @endif
            
            <li>
              <a class="dropdown-item" href="#">
                Mass Upload
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="{{ url('/front/product/list-ex2') }}">Gabungkan SKU di Master produk</a>
            </li>
          </ul>
        </div> -->
      </div>
    </div>
    <!--end::Card header-->

    <div class="card-body" style="margin-top: -10px;">
      <div style="display: none; margin-bottom: 10px" id="filter-aktif">
        <a class="link-primary cursor-pointer" style="font-size: 1.2em" id="reset_filter"><strong>Hapus semua filter</strong></a>
        <div class="chip" id="filtergudang" style="display: none;">
          <span id="filtergudangtxt">Filter Gudang</span>
          <span class="closechip" id="clrFilterGudang">&times;</span>
        </div>
        <div class="chip" id="filterurutanstok" style="display: none;">
          <span id="filterurutanstoktxt">Filter Urutan Stok</span>
          <span class="closechip" id="clrFilterUrutanStok">&times;</span>
        </div>
      </div>
      <div class="wrap-sticky">
        <div class="d-flex align-items-center py-5">
          <div class="info-selected me-5">
            <span class="selected">0</span> /
            <span class="total">0</span>
            Produk Dipilih
          </div>
          @if(env('FITUR_MARKETPLACE')=="show")
          @if(!Session::get('data_user')->view_only)
          <button class="btn btn-sm border border-dark me-5" type="button" id="btn-upload-marketplace">
            <i class="fa fa-upload text-dark" aria-hidden="true"></i>
              Upload ke marketplace
          </button>
          @endif
          @endif
          <button class="btn btn-sm border border-dark me-5" onclick="shareLink()" id="btn-share-link">
            <i class="fa fa-share-alt text-dark" aria-hidden="true"></i>
            Share Link
          </button>
          @if(!Session::get('data_user')->view_only)
          <a href="#" class="fs-1 " onclick="bulkDelete();" id="btn-delete-product">
            <i class="fa fa-trash text-danger" aria-hidden="true"></i>
          </a>
          @endif
        </div>
      </div>
      <div class="overflow-scroll border-top">
      <table class="table table-sm align-middle table-row-solid fs-6 gy-5" id="table-product">
        <thead>
          <tr class="text-gray-400 fw-bolder fs-7 text-uppercase gs-0 ">
            <th class="text-start">
              <div class="checkbox-inline ">
                <label class="checkbox checkbox-lg">
                  <input type="checkbox" name="checkbox-all" id="checkbox-all">
                  <span></span>
                </label>
              </div>
            </th>
            <th class="text-start">No</th>
            <th class="min-w-125px text-start">Info Produk</th>
            <th class="min-w-125px text-start">Varian</th>
            <th class="min-w-60px text-start">SKU</th>
            <th class="min-w-75px text-start">Stok</th>
            <th class="min-w-175px text-start">Gudang</th>
            @if(env('FITUR_MARKETPLACE')=="show")
            <th class="min-w-175px text-start">Nama Toko</th>
            <th class="min-w-175px text-center">Status Upload Marketplace</th>
            @endif
            <th class="min-w-125px text-center">Aksi</th>
          </tr>
        </thead>
        <tbody class="overflow-scroll" id="pd-data">

        </tbody>
      </table>
</div>
      <!--end::Table-->
      <div style="float:right;">
        <nav>
            <ul class="pagination" id="pd-pagination">

            </ul>
        </nav>
      </div>
    </div>
    <!--end::Card body-->

    <!-- <div class="col-sm-12 col-md-7 d-flex mb-2">
        <div class="dataTables_paginate paging_simple_numbers" id="table-prod_paginate">
            <ul class="pagination">
                <li class="paginate_button page-item previous disabled" id="table-prod_previous"><a href="#" aria-controls="table-prod" data-dt-idx="0" tabindex="0" class="page-link"><i class="previous"></i></a></li>
                <li class="paginate_button page-item active"><a href="#" aria-controls="table-prod" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                <li class="paginate_button page-item"><a href="#" aria-controls="table-prod" data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
                <li class="paginate_button page-item"><a href="#" aria-controls="table-prod" data-dt-idx="3" tabindex="0" class="page-link">3</a></li>
                <li class="paginate_button page-item next disabled" id="table-prod_next"><a href="#" aria-controls="table-prod" data-dt-idx="2" tabindex="0" class="page-link"><i class="next"></i></a></li>
            </ul>
        </div>
    </div> -->
  </div>
  
  <div class="row justify-content-center product-null" style="display: none">
    <div class="card mb-5 mb-xl-10">
      <div class="card-body pt-20 pb-10">
        <div class="text-center">
          <h2>Belum ada produk</h2>
          <p class="text-muted mb-10">
            Tidak ada produk apapun.
            Yuk, masukkan produkmu agar bisa berjualan
          </p>
        </div>
        <div class="row justify-content-center">
          <!-- hide mp -->
          {{-- <div class="col-auto">
            <button
              class="btn border border-dark"
              data-bs-toggle="modal"
              data-bs-target="#upload-modal">
              <i class="fa fa-upload fs-2 text-dark" aria-hidden="true"></i>
              Mass Upload
            </button>
          </div>
          --}}
          <!-- hide mp -->
          {{-- <div class="col-auto">
            <button
              class="btn btn-light-primary"
              data-bs-toggle="modal"
              data-bs-target="#add-marketplace-integration">
              + Import Marketplace
            </button>
          </div> --}}
          <div class="col-auto">
            <a href="{{ route('produk_add') }}" class="btn btn-primary">Tambah Produk</a>
          </div>
        </div>
        <div class="row justify-content-center">
          <figure class="col-auto placeholder-image">
            <img src="{{ asset('image/empty-product.jpg') }}" alt="" />
          </figure>
        </div>
      </div>
    </div>
  </div>
  

  {{-- Modal--}}
  @include('backend.produk.partial.popup-import-marketplace')
  @include('backend.produk.partial.popup-upload')
  @include('backend.produk.partial.popup-share')
  @include('backend.produk.partial.popup-filter')

@endsection

@section('css')
  <link rel="stylesheet" type="text/css" href="{{ asset('css/product.css')}}" preload>
  <link rel="stylesheet" type="text/css" href="{{ asset('css/general.css')}}" preload>
@endsection

@section('js')
@if($status_onboarding<2)
<script type="text/javascript">
  $(document).ready(function () {
    // $("#add-marketplace-integration").modal("show");
  });
</script>
@endif

<script type="text/javascript">
  var chosenWH_id   = []; //Variable global untuk menampung id gudang yang terpilih
  var chosenWH_name = []; //Variable global untuk menampung nama gudang yang terpilih

  $(document).ready(function () {

    var pd_page = 1;
    pd_page = Number(pd_page);
    var pd_search = '';

    var pd_tipe_gudang = '';
    var pd_urutan_stok = '';

    loadPd(pd_page,pd_search,pd_tipe_gudang,pd_urutan_stok);

    $(document).on('click','.btn-pd-page',function(){
          pd_page = $(this).attr('pd-page');
          pd_search = $("#pd_search").val();
          pd_tipe_gudang = $('input[name="pd_tipe_gudang"]:checked').val();
          pd_urutan_stok = $('input[name="pd_urutan_stok"]:checked').val();
          loadPd(pd_page,pd_search,pd_tipe_gudang,pd_urutan_stok);
    });

    $("#pd_search").on('keyup',function(){
          pd_search = $(this).val();
          pd_tipe_gudang = $('input[name="pd_tipe_gudang"]:checked').val();
          pd_urutan_stok = $('input[name="pd_urutan_stok"]:checked').val();
          loadPd(1,pd_search,pd_tipe_gudang,pd_urutan_stok);
          gOverlay.hide();
    });

    $("#terapkan_filter").on('click',function(){
          pd_search             = $("#pd_search").val();
          pd_tipe_gudang        = $('input[name="pd_tipe_gudang"]:checked').val();
          pd_tipe_gudang_label  = $('#cb_filter_tipe_gudang input[type="radio"]:checked').next("label").text();
          pd_urutan_stok        = $('input[name="pd_urutan_stok"]:checked').val();
          pd_urutan_stok_label  = $('#cb_filter_urutan_stok input[type="radio"]:checked').next("label").text();

          if(pd_tipe_gudang==undefined){
            pd_tipe_gudang = '';
          }
          else {
            $("#filtergudangtxt").text(pd_tipe_gudang_label);
            $("#filtergudang").show();
          }

          if(pd_urutan_stok==undefined){
            pd_urutan_stok = '';
          }
          else {
            $("#filterurutanstoktxt").text(pd_urutan_stok_label);
            $("#filterurutanstok").show();
          }

          loadPd(1,pd_search,pd_tipe_gudang,pd_urutan_stok);
          gOverlay.hide();
          $("#filter-modal").modal("hide");

          if(pd_tipe_gudang != '' || pd_urutan_stok != '') {
            $('#filter-aktif').show();
          }
    });

    function resetFilter() {
      $('input[type="radio"]').prop('checked', false); 
      pd_search = '';
      pd_tipe_gudang = '';
      pd_urutan_stok = '';
      loadPd(1,pd_search,pd_tipe_gudang,pd_urutan_stok);
      gOverlay.hide();
      $('#filter-aktif').hide();
    }

    $("#clrFilterGudang").on('click', function() {
      pd_search       = $("#pd_search").val();
      pd_tipe_gudang  = '';
      pd_urutan_stok  = $('input[name="pd_urutan_stok"]:checked').val();

      if(pd_urutan_stok == undefined) {
        resetFilter();
      }
      else {
        $('input[name="pd_tipe_gudang"]').prop('checked', false); 
        loadPd(1,pd_search,pd_tipe_gudang,pd_urutan_stok);
        $("#filtergudang").hide();
      }
    });

    $("#clrFilterUrutanStok").on('click', function() {
      pd_search       = $("#pd_search").val();
      pd_tipe_gudang  = $('input[name="pd_tipe_gudang"]:checked').val();
      pd_urutan_stok  = '';

      if(pd_tipe_gudang == undefined) {
        resetFilter();
      }
      else {
        $('input[name="pd_urutan_stok"]').prop('checked', false); 
        loadPd(1,pd_search,pd_tipe_gudang,pd_urutan_stok);
        $("#filterurutanstok").hide();
      }
    });

    $("#reset_filter").on('click',function(){
      resetFilter();
    });

    $(document).on('click','#btn-upload-marketplace',function(){
      var id = [];

      //Clear select dropdown agar gudang yang muncul hanya sesuai pada produk yang dicentang saja
      $('#selectWH').find('option').remove();

      $('.data_checkbox:checked').each(function(){
          id.push($(this).val());
      });

      //Tambahkan id dan nama gudang sesuai produk yang terpilih
      if(chosenWH_name[0] != 'null') {
        $('#selectWH').append(
          $('<option>', {
            text: 'Pilih Gudang'
          })
        );

        for(iWH = 0; iWH < chosenWH_id.length; iWH++) {
          $('#selectWH').append(
            $('<option>', {
              value: chosenWH_id[iWH],
              text: chosenWH_name[iWH]
            })
          );
        }
      }
      else {
        $('#selectWH').append(
          $('<option>', {
            text: 'Pilih Gudang'
          })
        );
      }

      if(id.length > 0){ 
        $("#upload-modal").modal("show");
      }else{
        Swal.fire({
                icon: 'error',
                title: 'Upload marketplace',
                text: 'Harap pilih produk'                
            })
      }

      //Disable toko yang sudah terhubung dengan gudang lain
      $.each($('#listmp').find('tr'), function(i, data) {
        var checkboxmp        = $($(data).find('#checkboxmp'));
        var logomp            = $($(data).find('#logomp'));
        var detailinfogudang  = $($(data).find('#detail-info-gudang'));

        checkboxmp.hide();
        detailinfogudang.show();
        logomp.css("filter","grayscale(100%)");
        $(this).removeClass('mpenabled');
        $(this).addClass('mpdisabled');
      });
    });
  });
</script>
<script type="text/javascript">
  window.addEventListener('load', (event) => {
    const checkboxs = $("#table-product tbody input[name='checkbox-list[]']")
    $(".info-selected .total").text(checkboxs.length)
    $("#table-product input[name=checkbox-all]").on('change',function(){
      const toggle = $(this);
      if(toggle.is(":checked")){
        checkboxs.each(function(){
          $(this).prop('checked',true)
        })
      }else{
        checkboxs.each(function(){
          $(this).prop('checked',false)
        })
      }
    $(".selected-checkbox span").html($("#table-product tbody input[name='checkbox-list[]']:checked").length)
    $(".info-selected .selected").text($("#table-product tbody input[name='checkbox-list[]']:checked").length)

    })

    checkboxs.on('change',function(){
      let flag = true
      checkboxs.each(function(){
        if(!$(this).is(':checked')){
          flag = false
        }
      })

    $(".selected-checkbox span").html($("#table-product tbody input[name='checkbox-list[]']:checked").length)
    $(".info-selected .selected").text($("#table-product tbody input[name='checkbox-list[]']:checked").length)

      if(flag)
        $("#table-product  input[name=checkbox-all]").prop('checked',true)
      else
        $("#table-product  input[name=checkbox-all]").prop('checked',false)
    })

    $(".selected-checkbox span").html($("#table-product tbody input[name='checkbox-list[]']:checked").length)
    $(".info-selected .selected").text($("#table-product tbody input[name='checkbox-list[]']:checked").length)


    //sticky info
    $(window).on('scroll',function(){
      const scrollTop = $(this).scrollTop() + 65
      const offsetTop = $(".wrap-sticky").offset().top

      if(scrollTop >= offsetTop)
        $(".wrap-sticky").children('div').addClass('sticky')
      else
        $(".wrap-sticky").children('div').removeClass('sticky')

    })

  });
  $("#tipe_gudang").removeAttr("checked");
  $("#status_produk").removeAttr("checked");
  $("#urutan_stok").removeAttr("checked");
  $(document).on('click','#table-product #checkbox-all',function(){
    const checkboxs = $("#table-product tbody input[name='checkbox-list[]']")
    $(".info-selected .total").text(checkboxs.length)
    $("#table-product input[name=checkbox-all]").on('change',function(){
      const toggle = $(this);
      if(toggle.is(":checked")){
        checkboxs.each(function(){
          $(this).prop('checked',true)
        })
      }else{
        checkboxs.each(function(){
          $(this).prop('checked',false)
        })
      }
    $(".selected-checkbox span").html($("#table-product tbody input[name='checkbox-list[]']:checked").length)
    $(".info-selected .selected").text($("#table-product tbody input[name='checkbox-list[]']:checked").length)

    })

    checkboxs.on('change',function(){
      let flag = true
      checkboxs.each(function(){
        if(!$(this).is(':checked')){
          flag = false
        }
      })

    $(".selected-checkbox span").html($("#table-product tbody input[name='checkbox-list[]']:checked").length)
    $(".info-selected .selected").text($("#table-product tbody input[name='checkbox-list[]']:checked").length)

      if(flag)
        $("#table-product  input[name=checkbox-all]").prop('checked',true)
      else
        $("#table-product  input[name=checkbox-all]").prop('checked',false)
    })

    $(".selected-checkbox span").html($("#table-product tbody input[name='checkbox-list[]']:checked").length)
    $(".info-selected .selected").text($("#table-product tbody input[name='checkbox-list[]']:checked").length)


    //sticky info
    $(window).on('scroll',function(){
      const scrollTop = $(this).scrollTop() + 65
      const offsetTop = $(".wrap-sticky").offset().top

      if(scrollTop >= offsetTop)
        $(".wrap-sticky").children('div').addClass('sticky')
      else
        $(".wrap-sticky").children('div').removeClass('sticky')

    });

    // if($('#checkbox-all').is(':checked')){
      // $('#btn-upload-marketplace').show();
      // $('#btn-share-link').show();
      // $('#btn-delete-product').show();
    // }else{
      // $('#btn-upload-marketplace').hide();
      // $('#btn-share-link').hide();
      // $('#btn-delete-product').hide();
    // }
  });
  $(document).on('click','#table-product .data_checkbox',function(){
      var id = [];
      var gudang_id;
      var gudang_nama;
      chosenWH_id   = [];
      chosenWH_name = [];

      $.each($('#table-product').find('tr'), function(i, data) {
        if($($(data).find('input[type="checkbox"]')).is(':checked')) {
          gudang_id     = $(data).find('#gudang_id').val().split(',');
          gudang_nama   = $(data).find('#gudang_nama').val().split(',');

          for(xWH = 0; xWH < gudang_id.length; xWH++) {
            if($.inArray(gudang_id[xWH], chosenWH_id) == -1) {
              chosenWH_id.push(gudang_id[xWH]);
            }
            
            if($.inArray(gudang_nama[xWH], chosenWH_name) == -1) {
              chosenWH_name.push(gudang_nama[xWH]);
            }
          }
        }
      });

      $('.data_checkbox:checked').each(function(){
          id.push($(this).val());
      });

      if(id.length > 0){ 
        $("#idproduk").val(id);
        // $('#btn-upload-marketplace').show();
        // $('#btn-share-link').show();
        // $('#btn-delete-product').show();
      }else{
        // $('#btn-upload-marketplace').hide();
        // $('#btn-share-link').hide();
        // $('#btn-delete-product').hide();
      }
  });

  function loadPd(pd_page,pd_search,pd_tipe_gudang,pd_urutan_stok){
          $.ajax({
              type : "GET",
              url : "{{route('produk.get_product_all')}}?",
              data: { 
                  pd_page : pd_page,
                  pd_search : pd_search,
                  pd_tipe_gudang : pd_tipe_gudang,
                  pd_urutan_stok : pd_urutan_stok
              },
              success : function(result) {
                  var pd_data = result.pd_data;
                  var html_pd_data = ``;
                  var no = (pd_page*10)-10;
                  if(pd_data.length>0){
                    if(pd_search==''){
                      $(".product-not-null").show();
                      $(".product-null").hide();
                    }
                  }else{
                    if(pd_search==''){
                      $(".product-not-null").hide();
                      $(".product-null").show();
                    }else{
                      $(".product-not-null").show();
                      html_pd_data += `<tr><td>Produk tidak ditemukan</td></tr>`;
                      $(".product-null").hide();
                    }
                  }
                  for(i=0;i<pd_data.length;i++){
                    rowspan = pd_data[i].list_variasi.length;
                    no++;
                    
                    html_pd_data += `<tr class = "">
                        <td class="align-top" rowspan="`+rowspan+`">
                          <div class="checkbox-inline ">
                            <label class="checkbox checkbox-lg">
                              <input type="checkbox" name="checkbox-list[]" class="data_checkbox" value="`+pd_data[i].id+`">
                              <span></span>
                            </label>
                          </div>
                        </td>
                        <td class="align-top" rowspan="`+rowspan+`">`+no+`</td>
                        <td class="align-top" rowspan="`+rowspan+`">
                          <div class="gudang-card">
                            <figure>
                              <img src="`+pd_data[i].gambar_master+`" alt="gudang">
                            </figure>

                            <div class="caption">
                              <span class="fw-bold">`+pd_data[i].nama_produk+`</span>
                              <br>
                              <span style="color: #aeaaa8 !important; font-size: 0.8em;">Total: `+pd_data[i].total_stok+` Pcs</span>`;

              if(pd_data[i].list_variasi[0].value_variasi_1 != null) {val_var_1 = pd_data[i].list_variasi[0].value_variasi_1;} else {val_var_1 = '';}
              if(pd_data[i].list_variasi[0].value_variasi_2 != null) {val_var_2 = pd_data[i].list_variasi[0].value_variasi_2;} else {val_var_2 = '';}

              html_pd_data+=`</div>
                          </div>
                        </td>
                        <td class="align-top fw-bold" style="padding-left: 0 !important;">`+val_var_1+` `+val_var_2+`</td>
                        <td class="align-top fw-bold">`;
                    
                    if(pd_data[i].list_variasi.length>0){
                      if(pd_data[i].list_variasi[0]["sku_manual"]!=null){
                        html_pd_data += pd_data[i].list_variasi[0]["sku_manual"];
                      }else{
                        html_pd_data += pd_data[i].sku;
                      }
                    }else{
                      if(pd_data[i].sku_manual!=''){
                        html_pd_data += pd_data[i].sku_manual;
                      }else{
                        html_pd_data += pd_data[i].sku;
                      }
                    }
                    
                    html_pd_data += `</td>
                        <td class="align-top fw-bold">`;

                    if(pd_data[i].list_variasi[0].gudang_variasi != null) {
                      for(igv_stok = 0; igv_stok < pd_data[i].list_variasi[0].gudang_variasi.length; igv_stok++) {
                        html_pd_data += `<span style="display: block; font-size: 0.8em">`+pd_data[i].list_variasi[0].gudang_variasi[igv_stok].stok_variasi+` Pcs</span>`;
                      }
                    }
                    
                    html_pd_data += `<input type="hidden" id="prod_qty" value="`+pd_data[i].total_stok+`">
                        </td>
                        <td class="align-top fw-bold" id="gudang_stok">`;

                    if(pd_data[i].list_variasi[0].gudang_variasi != null){
                      for(igv = 0;igv < pd_data[i].list_variasi[0].gudang_variasi.length; igv++) {
                        html_pd_data += `<span style="display: block; font-size: 0.8em"><img src="{{ asset('image/gudang-logo.jpg') }}" style="width: 20px; height: 20px;" /> `+pd_data[i].list_variasi[0].gudang_variasi[igv].nama_gudang_variasi+`</span>`;
                      }
                    }
                    else {
                      html_pd_data += `&nbsp`;
                    }

                    html_pd_data += `<input type="hidden" id="gudang_id" value="`+pd_data[i].gudang_id+`">
                    <input type="hidden" id="gudang_nama" value="`+pd_data[i].gudang_stok+`"></td>`;
                    
                    @if(env('FITUR_MARKETPLACE')=="show")

                    html_pd_data += `<td class="align-top">`;

                    if(pd_data[i].list_variasi[0].toko_variasi != null) {
                      for(itv = 0; itv < pd_data[i].list_variasi[0].toko_variasi.length; itv++) {
                        html_pd_data += `<div class="row align-items-center mb-5">
                          <div class="col-auto">
                            <img src="`+pd_data[i].list_variasi[0].toko_variasi[itv].logo_marketplace_variasi+`" style="width: 20px; height: 20px;" />
                            <span class="fw-bold ms-1" style="font-size: 0.8em;">`+pd_data[i].list_variasi[0].toko_variasi[itv].nama_toko_variasi+`</span>
                          </div>
                          </div>`;
                      }
                    }

                    html_pd_data +=`</td>
                        <td class="align-top text-center">`;

                    var url_detail = "{!! url('/') !!}/produk/detail/"+pd_data[i].id;
                    var url_edit = "{!! url('/') !!}/produk/edit/"+pd_data[i].id;

                    if(pd_data[i].list_variasi[0].gudang_variasi != null) {
                      for(igv = 0;igv < pd_data[i].list_variasi[0].gudang_variasi.length; igv++) {
                        if(pd_data[i].list_variasi[0].gudang_variasi[igv].id_gudang_variasi != null || pd_data[i].list_variasi[0].gudang_variasi[igv].stok_variasi != null) {
                          if(pd_data[i].list_variasi[0].toko_variasi != null) {
                            for(itv = 0; itv < pd_data[i].list_variasi[0].toko_variasi.length; itv++) {
                              if(pd_data[i].list_variasi[0].toko_variasi[itv].key_variasi_utama != null){
                                html_pd_data += `<div class="row align-items-center mb-5">
                                    <div class="col text-center">
                                    <span class="text-success" class="fw-bold ms-1" style="font-size: 0.8em;">&#10004;</span>
                                    </div>
                                    </div>`;
                              } else {
                                if(pd_data[i].list_variasi[0].toko_variasi[itv].nama_toko_variasi != null && pd_data[i].list_variasi[0].gudang_variasi[igv].stok_variasi > 0){
                                  if(pd_data[i].list_variasi[0].toko_variasi[itv].key_variasi_utama == null) {
                                    html_pd_data += `<div class="row align-items-center mb-5">
                                        <div class="col text-center">
                                        <a href="`+url_detail+`" class="text-primary fw-bold ms-1" style="font-size: 0.8em;">Lengkapi Data</a>
                                        </div>
                                        </div>`;
                                  }else{
                                    html_pd_data += `<div class="row align-items-center mb-5">
                                        <div class="col text-center">
                                        <span class="text-success" class="fw-bold ms-1" style="font-size: 0.8em;">&#10004;</span>
                                        </div>
                                        </div>`;
                                  }  
                                }
                              }
                            }
                          }
                        }
                      }
                    }

                    html_pd_data += `</td>`;
                    @endif
                    html_pd_data+=`<td class="align-top text-center" rowspan="`+rowspan+`">`;
                    @if(!Session::get('data_user')->view_only)
                      html_pd_data+=`<div class="dropdown dropdown-action">
                        <button class="btn border border-secondary dropdown-toggle" style="color: #8a8a8a !important;" type="button" id="action-drop-0" data-bs-toggle="dropdown" aria-expanded="false">
                          Atur
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="action-drop-0">
                          <li><a class="dropdown-item" href="`+url_detail+`">Lihat</a></li>
                          <li><a class="dropdown-item" href="`+url_edit+`">Edit</a></li>`;
                          @if(env('FITUR_MARKETPLACE')=="show")
                          if(pd_data[i].list_toko.length>0 && pd_data[i].total_stok >0){
                            html_pd_data += `<li><a class="dropdown-item" href="`+url_detail+`">Edit Marketplace</a></li>`;
                          }
                          @endif
                          html_pd_data += `<li><a class="dropdown-item text-danger" href="#" onclick="deleteData('`+pd_data[i].id+`')">Hapus</a></li>
                        </ul>
                      </div>`;
                  @endif
                  html_pd_data+=`</td>
                      </tr>`;
                    
                    if(rowspan > 1) {
                      for(n=1;n<rowspan;n++) {
                        if(pd_data[i].list_variasi[n].value_variasi_1 != null) {val_var_1 = pd_data[i].list_variasi[n].value_variasi_1;} else {val_var_1 = '';}
                        if(pd_data[i].list_variasi[n].value_variasi_2 != null) {val_var_2 = pd_data[i].list_variasi[n].value_variasi_2;} else {val_var_2 = '';}

                        html_pd_data += `<tr>
                          <td class="align-top fw-bold" style="border-top: hidden !important;">`+val_var_1+` `+val_var_2+`</td>
                          <td class="align-top fw-bold" style="border-top: hidden !important;">`;

                          if(pd_data[i].list_variasi[n]["sku_manual"]!=null){
                            html_pd_data += pd_data[i].list_variasi[n]["sku_manual"];
                          }else{
                            html_pd_data += pd_data[i].sku;
                          }
                        
                        html_pd_data += `</td>
                        <td class="align-top fw-bold" style="border-top: hidden !important;">`;

                        if(pd_data[i].list_variasi[n].gudang_variasi != null) {
                          for(igv_stok = 0; igv_stok < pd_data[i].list_variasi[n].gudang_variasi.length; igv_stok++) {
                            html_pd_data += `<span style="display: block; font-size: 0.8em">`+pd_data[i].list_variasi[n].gudang_variasi[igv_stok].stok_variasi+` Pcs</span>`;
                          }
                        }

                        html_pd_data += `</td>
                        <td class="align-top fw-bold" style="border-top: hidden !important;">`;

                        if(pd_data[i].list_variasi[n].gudang_variasi != null) {
                          for(igv = 0;igv < pd_data[i].list_variasi[n].gudang_variasi.length; igv++) {
                            html_pd_data += `<span style="display: block; font-size: 0.8em"><img src="{{ asset('image/gudang-logo.jpg') }}" style="width: 20px; height: 20px;" /> `+pd_data[i].list_variasi[n].gudang_variasi[igv].nama_gudang_variasi+`</span>`;
                          }
                        }
                        else {
                          html_pd_data += `&nbsp`;
                        }

                        html_pd_data += `</td><td class="align-top" style="border-top: hidden !important;">`;
                        if(pd_data[i].list_variasi[n].toko_variasi != null) {
                          for(itv = 0; itv < pd_data[i].list_variasi[n].toko_variasi.length; itv++) {
                            html_pd_data += `<div class="row align-items-center mb-5">
                              <div class="col-auto">
                                <img src="`+pd_data[i].list_variasi[n].toko_variasi[itv].logo_marketplace_variasi+`" style="width: 20px; height: 20px;" />
                                <span class="fw-bold ms-1" style="font-size: 0.8em">`+pd_data[i].list_variasi[n].toko_variasi[itv].nama_toko_variasi+`</span>
                              </div>
                            </div>`;
                          }
                        }

                        html_pd_data +=`</td>
                        <td class="align-top text-center" style="border-top: hidden !important;">`;

                        if(pd_data[i].list_variasi[n].gudang_variasi != null) {
                          for(igv = 0;igv < pd_data[i].list_variasi[n].gudang_variasi.length; igv++) {
                            if(pd_data[i].list_variasi[n].gudang_variasi[igv].id_gudang_variasi != null || pd_data[i].list_variasi[n].gudang_variasi[igv].stok_variasi != null) {
                              if(pd_data[i].list_variasi[n].toko_variasi != null) {
                                for(itv = 0; itv < pd_data[i].list_variasi[n].toko_variasi.length; itv++) {
                                  if(pd_data[i].list_variasi[n].toko_variasi[itv].key_variasi_utama != null){
                                    html_pd_data += `<div class="row align-items-center mb-5">
                                    <div class="col text-center">
                                    <span class="text-success" class="fw-bold ms-1" style="font-size: 0.8em;">&#10004;</span>
                                    </div>
                                    </div>`;
                                  } else {
                                    if(pd_data[i].list_variasi[n].toko_variasi[itv].nama_toko_variasi != null && pd_data[i].list_variasi[n].gudang_variasi[igv].stok_variasi > 0){
                                      if(pd_data[i].list_variasi[n].toko_variasi[itv].key_variasi_utama == null) {
                                      html_pd_data += `<div class="row align-items-center mb-5">
                                        <div class="col text-center">
                                        <a href="`+url_detail+`" class="text-primary fw-bold ms-1" style="font-size: 0.8em;">Lengkapi Data</a>
                                        </div>
                                        </div>`;
                                      }else{
                                        html_pd_data += `<div class="row align-items-center mb-5">
                                        <div class="col text-center">
                                        <span class="text-success" class="fw-bold ms-1" style="font-size: 0.8em;">&#10004;</span>
                                        </div>
                                        </div>`;
                                      }  
                                    }
                                  }
                                }
                              }
                            }
                          }
                        }

                        html_pd_data += `</td></tr>`;
                      }
                    }
                  }
                  
                  $("#pd-data").html(html_pd_data);
                  var pd_total_page = Number(result.pd_total_page);
                  if(pd_total_page>1){
                    loadPdPagination(pd_page,pd_total_page);
                  }else{
                    $("#pd-pagination").empty();
                  }
              },
                error : function(xhr, status, error) {
                    gOverlay.hide();
                    var err = eval("(" + xhr.responseText + ")");
                },
                beforeSend: function(){
                    createOverlay("Proses...");
                },
                complete: function(){
                    gOverlay.hide();
                }
          });

    }

    function loadPdPagination(pd_page,pd_total_page){
        $("#pd-pagination").empty();
        if(pd_page==1){
            html=`<li class="page-item disabled" aria-disabled="true" aria-label="&laquo; Previous"><span class="page-link" aria-hidden="true">&lsaquo;</span></li>`;
            if(pd_total_page>2){
                var plus_page = 2;
            }else{
                 var plus_page = 1;
            }
            var end_page = Number(pd_total_page);
            for(i=1;i<=end_page;i++){
                if(pd_page==i){
                    var active = 'active';
                }else{
                    var active = '';
                }
                 html += `<li class="page-item `+active+`"><button class="page-link btn-pd-page" pd-page="`+i+`">`+i+`</button></li>`;
            }
        }else{
            if(Number(pd_page)<Number(pd_total_page)){
              var previous_page = pd_page-1;
              html=`<li class="page-item"><button class="page-link btn-pd-page" pd-page="`+previous_page+`" rel="prev" aria-label="« Previous">‹</button></li>`;
            }else{
              var previous_page = pd_page-2;
              var previous_page2 = pd_page-1;
              html=`<li class="page-item"><button class="page-link btn-pd-page" pd-page="`+previous_page2+`" rel="prev" aria-label="« Previous">‹</button></li>`;
            }
            if(pd_total_page>2){
                var plus_page = 1;
            }else{
                 var plus_page = 0;
            }
            if(Number(pd_page)<Number(pd_total_page)){
              var end_page = Number(pd_total_page);
            }else{
              var end_page = Number(pd_total_page);
            }
             for(i=1;i<=end_page;i++){
                if(pd_page==i){
                    var active = 'active';
                }else{
                    var active = '';
                }
                 html += `<li class="page-item `+active+`"><button class="page-link btn-pd-page" pd-page="`+i+`">`+i+`</button></li>`;
            }
        }
        if(Number(pd_page)<Number(end_page)){
            var next_page = Number(pd_page)+1;
            html+=`<li class="page-item"><button class="page-link btn-pd-page" pd-page="`+next_page+`" rel="next" aria-label="Next »">›</button></li>`;
        }else{
            html+=`<li class="page-item disabled" aria-disabled="true" aria-label="&laquo; Next"><span class="page-link" aria-hidden="true">&rsaquo;</span></li>`;
        }
        $("#pd-pagination").html(html);
    }

    function loadPdPaginationOld(pd_page,pd_total_page){
        $("#pd-pagination").empty();
        if(pd_page==1){
            html=`<li class="page-item disabled" aria-disabled="true" aria-label="&laquo; Previous"><span class="page-link" aria-hidden="true">&lsaquo;</span></li>`;
            if(pd_total_page>2){
                var plus_page = 2;
            }else{
                 var plus_page = 1;
            }
            var end_page = Number(pd_page)+Number(plus_page);
            for(i=1;i<=end_page;i++){
                if(pd_page==i){
                    var active = 'active';
                }else{
                    var active = '';
                }
                 html += `<li class="page-item `+active+`"><button class="page-link btn-pd-page" pd-page="`+i+`">`+i+`</button></li>`;
            }
        }else{
            if(Number(pd_page)<Number(pd_total_page)){
              var previous_page = pd_page-1;
              html=`<li class="page-item"><button class="page-link btn-pd-page" pd-page="`+previous_page+`" rel="prev" aria-label="« Previous">‹</button></li>`;
            }else{
              var previous_page = pd_page-2;
              var previous_page2 = pd_page-1;
              html=`<li class="page-item"><button class="page-link btn-pd-page" pd-page="`+previous_page2+`" rel="prev" aria-label="« Previous">‹</button></li>`;
            }
            if(pd_total_page>2){
                var plus_page = 1;
            }else{
                 var plus_page = 0;
            }
            if(Number(pd_page)<Number(pd_total_page)){
              var end_page = Number(pd_page)+Number(plus_page);
            }else{
              var end_page = Number(pd_page);
            }
             for(i=previous_page;i<=end_page;i++){
                if(pd_page==i){
                    var active = 'active';
                }else{
                    var active = '';
                }
                 html += `<li class="page-item `+active+`"><button class="page-link btn-pd-page" pd-page="`+i+`">`+i+`</button></li>`;
            }
        }
        if(Number(pd_page)<Number(end_page)){
            var next_page = Number(pd_page)+1;
            html+=`<li class="page-item"><button class="page-link btn-pd-page" pd-page="`+next_page+`" rel="next" aria-label="Next »">›</button></li>`;
        }else{
            html+=`<li class="page-item disabled" aria-disabled="true" aria-label="&laquo; Next"><span class="page-link" aria-hidden="true">&rsaquo;</span></li>`;
        }
        $("#pd-pagination").html(html);
    }


  function bulkDelete() {
        var id = [];
        $('.data_checkbox:checked').each(function(){
            id.push($(this).val());
        });

        if(id.length > 0)
        {
            Swal.fire({
              title: "Konfirmasi",
              text: "Hapus data ini ?",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Ya",
              cancelButtonText: "Batal",
              timer:3000,
              closeOnConfirm: false,
              closeOnCancel: true
          }).then(function(result) {
              if (result.value) {
                  ajaxBulkDelete(id);
                  // result.dismiss can be "cancel", "overlay",
                  // "close", and "timer"
              } else if (result.dismiss === "cancel") {
                  Swal.fire(
                      "Cancelled",
                      "Batal :)",
                      "error"
                  )
              }
          });
        }
        else
        {
            Swal.fire({
                icon: 'error',
                title: 'Hapus produk error',
                text: 'Harap pilih produk',                
            })
        }
      }
      function ajaxBulkDelete(id){
        Swal.fire({
            title: "Process . . .",
            text: "loading . . .",
            type: "success",
            timer:3000,
            closeOnConfirm: false,
            closeOnCancel: false,
            showConfirmButton: false
        }).then(function(result) {
            $.ajax({
                type  : "delete",
                url   : "{{ route('produk.delete') }}",
                data  : {
                    "_token": "{{ csrf_token() }}",
                    "id" : id
                    },
                dataType: 'json',
                cache: false,
                success : function(result) {
                var results = JSON.stringify(result);
                var data = JSON.parse(results);
                    if(data["success"] == true) {
                        Swal.fire({
                            title: "Berhasil!",
                            text: "Data berhasil dihapus",
                            type: "success",
                            timer:3000,
                            closeOnConfirm: true,
                            closeOnCancel: true
                        }).then(function(result) {
                            window.location = "{{ route('produk') }}";
                        });
                    }
                    else {
                        Swal.fire("Failed!", data["message"], "error");
                    }
                },
                error : function(error) {
                    alert("Network/server error\r\n" + error);
                }
            });
        });
    }
  function deleteData(id) {
        var ids = [];
        ids.push(id);
        Swal.fire({
            title: "Konfirmasi",
            text: "Hapus data ini ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ya",
            cancelButtonText: "Batal",
            timer:3000,
            closeOnConfirm: false,
            closeOnCancel: true
        }).then(function(result) {
            if (result.value) {
                ajaxDelete(ids);
                // result.dismiss can be "cancel", "overlay",
                // "close", and "timer"
            } else if (result.dismiss === "cancel") {
                Swal.fire(
                    "Cancelled",
                    "Batal :)",
                    "error"
                )
            }
        });
    }
    function ajaxDelete(id){
        Swal.fire({
            title: "Process . . .",
            text: "loading . . .",
            type: "success",
            timer:3000,
            closeOnConfirm: false,
            closeOnCancel: false,
            showConfirmButton: false
        }).then(function(result) {
            $.ajax({
                type  : "delete",
                url   : "{{ route('produk.delete') }}",
                data  : {
                    "_token": "{{ csrf_token() }}",
                    "id" : id
                    },
                dataType: 'json',
                cache: false,
                success : function(result) {
                var results = JSON.stringify(result);
                var data = JSON.parse(results);
                    if(data["success"] == true) {
                        Swal.fire({
                            title: "Berhasil!",
                            text: "Data berhasil dihapus",
                            type: "success",
                            timer:3000,
                            closeOnConfirm: true,
                            closeOnCancel: true
                        }).then(function(result) {
                            window.location = "{{ route('produk') }}";
                        });
                    }
                    else {
                        Swal.fire("Failed!", data["message"], "error");
                    }
                },
                error : function(error) {
                    alert("Network/server error\r\n" + error);
                }
            });
        });
    }
    function shareLink()
    {
        var checked_checkboxs = $("tbody input[type=checkbox]:checked");
        //alert(checked_checkboxs.length);
        if(checked_checkboxs.length == 1)
        {
            let id = checked_checkboxs.val()
            let qty = checked_checkboxs.closest('tr').find('#prod_qty').val();            
            if(qty != null && qty > 0)
            {
              let url = "{{ route('sharelink_sku_edit', ':id') }}";
              url = url.replace(':id', id);
              document.location.href=url;
            }
            else
            {
              Swal.fire({
                icon: 'error',
                title: 'Sharelink Error',
                text: 'Produk yang anda pilih belum ada stok, silahkan proses masukkan stok',                
              })
            }                    
        }
        else
        {
            Swal.fire({
                icon: 'error',
                title: 'Sharelink Error',
                text: 'Harap memilih satu jenis produk',                
            })
        }
    }
</script>
@endsection