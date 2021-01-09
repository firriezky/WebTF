@extends('template.template')

@section('head-section')
@endsection



@section('main')

    <div class="panel-header bg-primary-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h2 class="text-white pb-2 fw-bold uppercase">Fitur Ini Belum Tersedia</h2>
                    <h3 class="text-white pb-2 fw-bold uppercase">Import Kelompok Dari CSV</h3>
                </div>
                {{-- <div class="ml-md-auto py-2 py-md-0">
                    <a href="#" class="btn btn-white btn-border btn-round mr-2">Manage</a>
                    <a href="#" class="btn btn-secondary btn-round">Add Customer</a>
                </div> --}}
            </div>
        </div>
    </div>
    <div class="page-inner mt--5">

    </div>

    @if (session()->has('success'))
        <script>
            toastr.success('{{ session('
                success ') }}', ' {{ Session::get('
                success ') }}');

        </script>
    @elseif(session()-> has('error'))
        <script>
            toastr.error('{{ session('
                error ') }}', ' {{ Session::get('
                error ') }}');

        </script>

    @endif

@endsection
