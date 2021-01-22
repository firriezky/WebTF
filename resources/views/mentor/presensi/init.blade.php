@extends('template.template')

@section('head-section')
<script src="{{ asset('library/ckeditor/ckeditor.js') }}"></script>

@endsection

@section('main')
<div class="container-fluid">
    <div class="container mt-5">
        {{-- @include('blog.breadcumb') --}}
        <!-- Page Header -->
        <div class="page-header">
            <h4 class="page-title">Input Presensi</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="#">
                        <i class="flaticon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Tahfidz</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Presensi</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="{{url('mentor/tahfidz/presensi')}}">Pilih Kelompok</a>
                </li>
            </ul>
        </div>

        <div class="page-header row no-gutters">
            <div class="col-12 text-center text-sm-left mb-0">
                <span class="text-uppercase page-subtitle">Silakan Pilih Kelompok Yang Akan Diabsen</span>
            </div>
        </div>

     
    </div>

    <div class="row">
        <div class="col-md-12">

            <div class="card border-0 shadow rounded">
                @if(session() -> has('success'))
                <div class="alert alert-primary alert-dismissible fade show mx-2 my-2" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>

                    <script>
                        var notify = $.notify('<strong>Saving</strong> Do not close this page...', { allow_dismiss: false });
                            notify.update({ type: 'success', '<strong>Success</strong> Your page has been saved!' });
                    </script>

                    <strong>{{Session::get( 'success' )}}</strong>
                </div>


                @elseif(session() -> has('error'))

                <div class="alert alert-primary alert-dismissible fade show mx-2 my-2" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <strong>{{Session::get( 'error' )}}</strong>
                </div>
                @endif

                @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>

                    {!! implode('', $errors->all('<div>:message</div>')) !!}
                </div>
                @endif
            </div>
        </div>

        <div class="col-md-12">
            <div class="card border-0 shadow rounded">
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Filter Kelas</label>
                        {{--  --}}
                        <select class="form-control" onchange="location = this.value">
                            <option value="#">Pilih Kelompok</option>
                            @forelse ($groupData as $item)
                            <option value="{{url("/mentor/tahfidz/presensi/$item->id")}}">{{$item->name}}
                            </option>
                            @empty

                            @endforelse
                        </select>
                    </div>

                    <div>

                    </div>
                    <ul class="mt-3">
                        <li>Pilih Kelompok Yang Ingin Dinilai Menggunakan Pilihan Diatas</li>
                        <li>Klik Tombol <strong>Input/Lihat</strong> Untuk Menginput atau Melihat Nilai Siswa</li>
                        <li>Untuk Mengupdate Pengumuman ke Kelompok , Masukkan dan simpan pengumuman pada kolom dibawah
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        
    </div>

    @endsection

    @section('script')

<!-- Datatables -->
    <script>
        $(document).ready(function() {
            var table = $('#datatables').DataTable( {
            // dom: '<"bottom"i>rt<"top"flp><"clear">',
            dom: 'T<"clear">lfrtip<"bottom"B>',
            // "scrollY": "1000px",
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "bPaginate": true,
            "lengthChange": true,
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
            });
            $(".v-filter").click(function(){
            var column = table.column( $(this).attr('data-column') );
            column.visible( ! column.visible() );
            });
            $('a.toggle-v').on( 'click', function (e) {
            e.preventDefault();
            column.visible( ! column.visible() );
        } );

        });
    </script>

    {{-- Toastr --}}
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        //message with toastr
            @if(session()-> has('success'))
                toastr.success('{{ session('success') }}', 'BERHASIL!'); 
            @elseif(session()-> has('error'))
                toastr.error('{{ session('error') }}', 'GAGAL!'); 
            @endif
    </script>


    @endsection

</div>
</div>
</div>