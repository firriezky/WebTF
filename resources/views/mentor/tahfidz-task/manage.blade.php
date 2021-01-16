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
                <h3 class="page-title">Setoran Tahfidz {{$groupName}}</h3>
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
        <div class="col-md-12">
            <div class="card border-0 shadow rounded">
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Filter Kelas</label>
                        <select class="form-control" onchange="location = this.value">
                            <option value="{{url('/mentor/tahfidz/task')}}">Pilih Kelompok</option>
                            <option value="{{url('/mentor/tahfidz/task')}}"></a>Semua Siswa Yang Saya Bimbing</option>
                            @forelse ($groupData as $item)
                            <option value="{{url("/mentor/tahfidz/task/group/$item->group_id")}}">{{$item->group_name}}
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
                    <h5>Komposisi Nilai</h5>
                    <ul>
                        <li>Nilai Tajwid = Nilai Hukum Bacaan + Nilai Makhroj / 2</li>
                        <li>Nilai Akhir = 70% Nilai Kelancaran + 30% Nilai Tajwid</li>
                    </ul>
                </div>
            </div>
        </div>

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
                    <h2 class="card-title"><strong>Daftar Hafalan dari Kelompok {{$groupName}}</strong></h2>
                    <div class="d-none">
                        <label class="">Gunakan Tombol dibawah untuk menyembunyikan/menampilkan kolom tertentu</label>
                        <div class=" container row">
                            <button type="button" data-column="1"
                                class="v-filter btn btn-outline-primary btn-xs col-2">Kolom 1</button>
                            <button type="button" data-column="2"
                                class="v-filter btn btn-outline-primary btn-xs col-2">Kolom 2</button>
                            <button type="button" data-column="3"
                                class="v-filter btn btn-outline-primary btn-xs col-2">Kolom 3</button>
                            <button type="button" data-column="4"
                                class="v-filter btn btn-outline-primary btn-xs col-2">Kolom 4</button>
                            <button type="button" data-column="5"
                                class="v-filter btn btn-outline-primary btn-xs col-2">Kolom 5</button>
                            <button type="button" data-column="6"
                                class="v-filter btn btn-outline-primary btn-xs col-2">Kolom 6</button>
                            <button type="button" data-column="7"
                                class="v-filter btn btn-outline-primary btn-xs col-2">Kolom 7</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="datatables" class="table table-bordered table-responsive">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Edit</th>
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
                                        <div class="form-button-action">
                                            <a href="{{url("mentor/tahfidz/task/$data->id_submission")}}"><button
                                                    type="button" data-toggle="tooltip" title=""
                                                    class="btn btn-link btn-primary btn-lg"
                                                    data-original-title="Edit Nilai">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                            </a>
                                            <form action="{{url("tahfidz/task/$data->id_submission/delete")}}"
                                                onsubmit="return confirm('Anda Yakin Ingin Menghapus Setoran Ini ?');">
                                                @csrf
                                                <button type="submit"  title='' class="btn btn-link btn-danger" data-original-title="Remove">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                    <td>{{ $data->student_name }}</td>
                                    {{-- <td>
                                        <div class="avatar-sm float-left mr-2">
                                            <img onerror="this.src='{{asset('img/img-error.jpg')}}';"
                                    src="{{ "http://tahfidz.sditwahdahbtg.com/student/" . $data->student_photo }}"
                                    alt="image profile" class="avatar-img rounded-circle">
                    </div>
                    </td> --}}
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



                    <div class="modal fade" id="modalInputScore{{$loop->index+1}}" tabindex="-1" role="dialog"
                        aria-hidden="true">
                        <div class="modal-dialog  modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalCenterTitle">
                                        Nilai Hafalan Siswa</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Nama Siswa : <br>
                                    {{$data->student_name}} <br>
                                    Hafalan yang disetorkan :
                                    <p>{{$data->start}} - {{$data->end}}</p>
                                    <div class="col-lg-12">
                                        <audio controls loop style="width: 100%;">
                                            <source src="http://tahfidz.sditwahdahbtg.com/submission/{{$data->audio}}"
                                                type="audio/ogg">
                                            Your browser dose not Support the audio Tag
                                        </audio>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label>Nilai Tajwid</label>
                                            <input type="text" class="form-control" name="score-tajwid"
                                                id="score-tajwid" placeholder="Nilai Tajwid">
                                        </div>
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label>Nilai Makhorijul Huruf</label>
                                            <input type="text" class="form-control" name="score-makhroj"
                                                id="score-makhroj" placeholder="Nilai Makhroj">
                                        </div>
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label>Nilai Kelancaran Hafalan</label>
                                            <input type="text" class="form-control" name="score-itqan" id="score-itqan"
                                                placeholder="Nilai Kelancaran">
                                        </div>
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label>Nilai Akhir</label>
                                            <input type="text" disabled class="form-control" name="score" id="score"
                                                aria-describedby="helpId" placeholder="Nilai Kelancaran">
                                        </div>
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label for="">Status</label>
                                            <select class="form-control" name="status" id="">
                                                <option value="0">Menunggu Dinilai</option>
                                                <option value="1">Sudah Dinilai</option>
                                            </select>
                                        </div>
                                    </div>
                                    <label for="">Jika status diset menunggu dinilai, maka nilai tidak
                                        ditampilkan di
                                        siswa</label>
                                    <div class="form-group col-12">
                                        <label for="">Catatan Untuk Siswa</label>
                                        <textarea
                                            class="form-control ckeditor @error('correction') is-invalid @enderror"
                                            name="content" rows="5"
                                            placeholder="Masukkan Catatan Untuk Siswa">{{ $data->correction,old('correction') }}</textarea>
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