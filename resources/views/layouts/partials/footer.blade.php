<!--begin::Footer-->
<div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
    <!--begin::Container-->
    <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
        <!--begin::Copyright-->
        <div class="text-dark order-2 order-md-1">
            <span class="text-muted fw-bold me-1">2022©</span>
            <a href="https://uniaircargo.co.id" target="_blank"
                class="text-gray-800 text-hover-primary">PT Uniair Indotama Cargo</a>
        </div>
        <!--end::Copyright-->
    </div>
    <!--end::Container-->
</div>
<!--end::Footer-->
</div>
<!--end::Wrapper-->
</div>
<!--end::Page-->
</div>
<!--end::Root-->
<!--begin::Javascript-->
<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="{{ asset('/') }}assets/plugins/global/plugins.bundle.js"></script>
<script src="{{ asset('/') }}assets/js/scripts.bundle.js"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Page Vendors Javascript(used by this page)-->
<script src="{{ asset('/') }}assets/plugins/custom/datatables/datatables.bundle.js"></script>
<script src="{{ asset('/') }}assets/plugins/custom/vis-timeline/vis-timeline.bundle.js"></script>
<!--end::Page Vendors Javascript-->
<!--begin::Page Custom Javascript(used by this page)-->
<script src="{{ asset('/') }}assets/js/widgets.bundle.js"></script>
<script src="{{ asset('/') }}assets/js/custom/widgets.js"></script>
<script src="{{ asset('/') }}assets/js/custom/apps/chat/chat.js"></script>
<script src="{{ asset('/') }}assets/js/custom/utilities/modals/upgrade-plan.js"></script>
<script src="{{ asset('/') }}assets/js/custom/utilities/modals/create-app.js"></script>
<script src="{{ asset('/') }}assets/js/custom/utilities/modals/users-search.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js"></script>
<script src="{{ asset('/') }}js/custome-me.js"></script>
<script>
    $(document).ready(function() {
        $(".datepicker").flatpickr();
    });

    function deleteData(url) {
        Swal.fire({
            title: 'Apakah Kamu Yakin?',
            text: "Kamu tidak akan dapat mengembalikan datanya lagi!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Iya, Hapus!',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        })
    }


    /* Fungsi */
    function formatRupiah(angka, prefix)
    {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split    = number_string.split(','),
            sisa     = split[0].length % 3,
            rupiah     = split[0].substr(0, sisa),
            ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
            
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

    
    function formatCurrencyLbl(value) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(value);
    }

    function formatNumber(value) {
        return new Intl.NumberFormat('id-ID', {
            minimumFractionDigits: 0
        }).format(value);
    }
    
</script>

{{-- ALL INPUT UPPERCASE --}}

@php
    $currentRoute = url()->current();
@endphp

@if (!Str::contains($currentRoute , 'user-administration'))
    <script>
        $(document).ready(function () {
            $("input[type='text']").on('input' , function(){
                this.value = this.value.toUpperCase();
            });

            $("textarea").on('input' , function(){
                this.value = this.value.toUpperCase();
            });
        });
    </script>
@endif

@stack("js")
@include('layouts.partials.js')

<x-global-flash />

<!--end::Page Custom Javascript-->
<!--end::Javascript-->
</body>
<!--end::Body-->

</html>
