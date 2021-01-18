@extends('template.template')

@section('head-section')
<script src="{{ asset('library/ckeditor/ckeditor.js') }}"></script>

@endsection

@section('main')
<div class="container-fluid">
    <div class="container mt-5">
        {{-- @include('blog.breadcumb') --}}
        <!-- Page Header -->

        <div class="page-header row no-gutters">
            <div class="col-12 text-center text-sm-left mb-0">
                <span class="text-uppercase page-subtitle">Manage Setoran Tahfidz</span>
            </div>
        </div>
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

    <div class="row">
        @if (isset($group_id) && $group_id !=null)

        <div class="col-md-12">
            <form action="{{url('tahfidz/group/announcement/save')}}" method="post">
                @csrf
                @method('POST')
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <h3>Pengumuman Untuk Kelompok</h3>
                        <div class="form-group">
                            <textarea class="form-control" name="announce" @error('announce') is-invalid @enderror
                                rows="3">@if ($announcement==null)"Belum Ada Pengumuman"@endif{{old('announce',$announcement)}}</textarea>
                        </div>
                        <input type="hidden" name="group_id" value="{{$group_id}}">
                        <button type="submit" class="btn btn-primary">Update Pengumuman</button>
                    </div>
                </div>
            </form>
        </div>
        @endif
    </div>


    <div class="row">
        <div class="col-md-12">

            <div class="card border-0 shadow rounded">



                <div class="card-body">
                    <h2 class="card-title"><strong>Daftar Hafalan dari {{Auth::guard('student')->user()->name}}</strong>
                    </h2>
                    <div class="table-responsive">
                        <table id="datatables" class="table table-bordered table-responsive">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Tipe</th>     <th scope="col">Tipe</th>
                                    <th scope="col">Koreksi Dari Guru</th>
                                    <th scope="col">Dengar Rekaman</th>
                                    <th scope="col">Hapus Setoran</th>
                                    <th scope="col">Nama Siswa</th>
                                    <th scope="col">NISN</th>
                                    <th scope="col">Asal Kelas</th>
                                    <th scope="col">Mulai</th>
                                    <th scope="col">Selesai</th>
                                    <th scope="col">Hukum Bacaan</th>
                                    <th scope="col">Makhorijul Huruf</th>
                                    <th scope="col">Tajwid</th>
                                    <th scope="col">Kelancaran</th>
                                    <th scope="col">Nilai Akhir</th>
                                    <th scope="col">Tanggal Setoran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($dayta != null)
                                @forelse ($dayta as $data)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td><span class="badge badge-{{ ($data->status==0) ? 'danger' : 'success'  }}
                                        ">{{ $data->status_text }}</span></td>

                                    <td>
                                        <span class="badge badge-primary">{{$data->type}}</span>
                                    </td>
                                    <td>
                                        <button class="badge badge-primary" data-toggle="modal"
                                            data-target="#modalPreviewCorrection{{$loop->index+1}}">
                                            Lihat Koreksi Bacaan
                                        </button>
                                    </td>
                                    <td>
                                        <button class="btn btn-success btn-border btn-round" data-toggle="modal"
                                            data-target="#modalPreviewRecord{{$loop->index+1}}">
                                            Dengar Rekaman
                                        </button>
                                    </td>
                                    <td>
                                        <div class="form-button-action">
                                            <form action="{{url("tahfidz/task/$data->id_submission/deleteFromStudent")}}"
                                                onsubmit="return confirm('Anda Yakin Ingin Menghapus Setoran Ini ?');">
                                                @csrf
                                                <button type="submit" title='' class="btn btn-link btn-danger"
                                                    data-original-title="Remove">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                    <td>{{ $data->student_name }}</td>
                                    <td>{{ $data->student_nisn }}</td>
                                    <td>{{ $data->group_name }}</td>
                                    <td>
                                        {{$data->start}}
                                    </td>
                                    <td>
                                        {{ $data->end}}
                                    </td>
                                    @php
                                    $scoreAhkam = $data->score_ahkam;
                                    $scoreMakhroj = $data->score_makhroj;
                                    $scoreItqan = $data->score_itqan;
                                    if ($scoreAhkam == null || $scoreAhkam == "") {
                                    $scoreAhkam=0;
                                    }
                                    if ($scoreItqan == null || $scoreItqan == "") {
                                    $scoreItqan=0;
                                    }
                                    if ($scoreMakhroj == null || $scoreMakhroj == "") {
                                    $scoreMakhroj=0;
                                    }

                                    $scoreTajwid=($scoreAhkam+$scoreMakhroj)/2;

                                    @endphp
                                    <td>{{$scoreAhkam}}</td>
                                    <td>{{$scoreMakhroj}}</td>
                                    <td>{{$scoreTajwid}}</td>
                                    <td>{{$scoreItqan}}</td>
                                    <td>{{$data->score}}</td>

                                    <td>{{$data->created_at}}</td>


                                </tr>


                                <div class="modal fade" id="modalPreviewRecord{{$loop->index+1}}" tabindex="-1"
                                    role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalCenterTitle">Dengarkan
                                                    Rekaman Siswa</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>{{$data->student_name}}</p>
                                                <p>{{$data->start}} - {{$data->end}}</p>
                                                <div class="col-lg-12">
                                                    <audio controls loop style="width: 100%;">
                                                        <source
                                                            src="http://tahfidz.sditwahdahbtg.com/submission/{{$data->audio}}"
                                                            type="audio/ogg">
                                                        Your browser dose not Support the audio Tag
                                                    </audio>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="modal fade" id="modalPreviewCorrection{{$loop->index+1}}" tabindex="-1"
                                    role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalCenterTitle">Koreksi Hafalan
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>{{$data->student_name}}</p>
                                                <p>{{$data->start}} - {{$data->end}}</p>
                                                <hr>
                                                <div class="col-lg-12">
                                                    <audio controls loop style="width: 100%;">
                                                        <source
                                                            src="http://tahfidz.sditwahdahbtg.com/submission/{{$data->correction_audio}}"
                                                            type="audio/ogg">
                                                        Your browser dose not Support the audio Tag
                                                    </audio>
                                                </div>
                                                <div class="col-lg-12">
                                                    @if ($data->correction == null || $data->correction == "")
                                                    <h4>Belum Ada Data Koreksi</h4>
                                                    @endif
                                                    {!!$data->correction!!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @empty
                                <div class="alert alert-danger">
                                    Data Setoran belum Tersedia.
                                </div>
                                @endforelse

                                @else
                                <div class="alert alert-danger">
                                    Data Setoran belum Tersedia.
                                </div>
                                @endif


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            {{-- {{ $blogs->links() }} --}}
        </div>
    </div>

    @endsection

    @section('script')



    {{-- Toastr --}}
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
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

    <script>
        //message with toastr
            @if(session()-> has('success'))
                toastr.success('{{ session('success') }}', 'BERHASIL!'); 
            @elseif(session()-> has('error'))
                toastr.error('{{ session('error') }}', 'GAGAL!'); 
            @endif
    </script>


    @endsection