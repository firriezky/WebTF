@extends('template.template')

@section('head-section')

@endsection

@section('script')

@endsection

@section('main')


@if (session()->has('success'))
<script>
    toastr.success('{{ session('
                        success ') }}', ' {{ Session::get('success')}}');

</script>
@elseif(session()-> has('error'))
<script>
    toastr.error('{{ session('
                        error ') }}', ' {{ Session::get('error')}}');

</script>

@endif

@endsection