@php
    $flashes = ["info","success","error"];
@endphp

@foreach($flashes as $flash)
    @if(session()->has($flash))
    <script>
            $(document).ready(function(){
                Swal.fire({
                    title: '{{ ucwords($flash) }}',
                    text: '{{ session()->get($flash) }}',
                    icon: '{{ $flash }}'
                });
            });
        </script>
    @endif

@endforeach

