@extends('template.template')

@section('head-section')

<style>
       .select2 {
            width: 100% !important;
        }
</style>
<script src="{{ asset('library/ckeditor/ckeditor.js') }}"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css">
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
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Input</a>
                </li>
            </ul>
        </div>

        <div class="page-header row no-gutters">
            <div class="col-12 text-center text-sm-left mb-0">
                <span class="text-uppercase page-subtitle">Input Presensi Untuk Kelompok</span>
                <h3 class="page-title">{{$groupData->name}}</h3>
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
            <form action="{{url('/mentor/tahfidz/presensi/save')}}" method="post">
                @csrf
            
            <div class="card border-0 shadow rounded">
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Pilih Agenda Absensi</label>
                        {{--  --}}
                        <select class="form-control" name="id_agenda" required>
                            <option value="">Pilih Agenda Absensi</option>
                            @forelse ($agendas as $item)
                            <option value="{{$item->id}}">{{$item->title}} , <span class="badge badge-primary"> {{$item->start}}</span>
                            </option>
                            @empty

                            @endforelse
                        </select>
                    </div>


                    <div class="table-responsive">
                        <table id="datatables" class="table table-bordered table-responsive">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Siswa</th>
                                    <th scope="col">NISN</th>
                                    <th scope="col">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $counter = 0;
                                    $studentArray = array();
                                @endphp
                                @forelse ($students as $data)
                                @php
                                $counter++;
                                @endphp
                                <tr>
                                    <input type="hidden" name="student[{{$loop->iteration}}]" value="{{$data->id}}" />

                                    <td>{{$counter}}</td>
                                    <td>{{$data->name}}</td>
                                    <td>{{$data->nisn}}</td>
                                    <td>
                                        <div class="container-fluid">
                                        <label class="">
                                            <input type="radio" value="1" name="status[{{$loop->iteration}}]" checked><span class="badge badge-success mx-2">Hadir</span>
                                          </label>
                                          <label class="">
                                            <input type="radio" value="2" name="status[{{$loop->iteration}}]"><span class="badge badge-danger mx-2">Alfa</span>
                                          </label>
                                          <label class="mt-2">
                                            <input type="radio" value="3" name="status[{{$loop->iteration}}]"><span class="badge badge-dark mx-2">Sakit</span>
                                          </label>
                                          <label class="mt-2">
                                            <input type="radio" value="4" name="status[{{$loop->iteration}}]"><span class="badge mx-2">Izin ( Pulang/Lomba )</span>
                                          </label>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                    <div class="alert alert-danger">
                                        Siswa belum Tersedia.
                                    </div>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{-- Status Presensi
                    //status 0 = Alfa
                    //status 1 = Hadir
                    //status 2 = Terlambat
                    //status 3 = Sakit
                    //status 4 = Izin / Pulang--}}
                    <p>Total Santri : {{$counter}}</p>
                    <input type="hidden" name="counter" value="{{$counter}}">
                    <button type="submit" class="btn btn-primary mt-3">Input Presensi</button>
              

                    {{-- <ul class="mt-3">
                        <li>Pilih Kelompok Yang Ingin Dinilai Menggunakan Pilihan Diatas</li>
                        <li>Klik Tombol <strong>Input/Lihat</strong> Untuk Menginput atau Melihat Nilai Siswa</li>
                        <li>Untuk Mengupdate Pengumuman ke Kelompok , Masukkan dan simpan pengumuman pada kolom dibawah
                        </li>
                    </ul> --}}
                </div>
            </div>
        </form>

        </div>


        <div class="col-md-12">
            <div class="card border-0 shadow rounded">
                <div class="card-body">
                 
                </div>
            </div>
        </div>

        <div class="col-md-4">
         
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
	<!-- Select2 -->
    <script src="{{asset('atlantis/examples')}}/assets/js/plugin/select2/select2.full.min.js"></script>
    
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

