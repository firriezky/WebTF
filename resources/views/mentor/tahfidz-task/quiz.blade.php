@extends('template.template')

@section('head-section')
<script src="{{ asset('library/ckeditor/ckeditor.js') }}"></script>

@endsection

@section('main')
<div class="container-fluid">
    <div class="container mt-5">

        <div class="page-header row no-gutters">
            <div class="col-12 text-center text-sm-left mb-0">
                <span class="text-uppercase page-subtitle">Manage Quiz Kelompok Tahfidz</span>
                <h3 class="page-title">Quiz via Google Form </h3>
            </div>
        </div>
        @if(session() -> has('success'))
        <div class="alert alert-primary alert-dismissible fade show mx-2 my-2" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>

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
                    <form action="{{url('/mentor/tahfidz/quiz/save')}}" method="post">
                        @csrf

                        <h3>Buat Kuis Baru</h3>
                        <div class="form-group">
                            <label for="">Judul Kuis</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                                placeholder="Judul Kuis" required value="{{old('title')}}" id=""
                                aria-describedby="helpId" placeholder="">
                        </div>

                        <div class="form-group">
                            <label for="">Deskripsi Singkat Kuis</label>
                            <input type="text" placeholder="Deskripsi Singkat Kuis" required
                                class="form-control @error('description') is-invalid @enderror" name="description" id=""
                                aria-describedby="helpId" placeholder="" value="{{old('description')}}">
                        </div>

                        <div class="form-group">
                            <label for="">Link Google Form</label>
                            <input type="text" class="form-control @error('link') is-invalid @enderror" name="link"
                                id="" aria-describedby="helpId" placeholder="Link Google Form" required
                                value="{{old('link')}}">
                            <small id="helpId" class="form-text text-muted">Link Google Form Lengkap, termasuk https://
                                juga diinputkan</small>
                        </div>

                        <div class="form-group">
                            <label for="">Kuis Untuk Kelompok</label>
                            <select class="form-control" name="group_id" id="">
                                </option>
                                @forelse ($groupData as $item)
                                <option value="{{$item->group_id}}">
                                    {{$item->group_name}}
                                </option>
                                @empty
                                <option disabled value="">Anda Belum Memiliki Kelompok</option>
                                @endforelse
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Tambahkan Quiz</button>
                </div>
                <ul class="mt-3">
                    <li>Pilih Kelompok Yang Ingin Dinilai Menggunakan Pilihan Diatas</li>
                    <li>Klik Tombol <strong>Input/Lihat</strong> Untuk Menginput atau Melihat Nilai Siswa</li>
                    <li>Untuk Mengupdate Pengumuman ke Kelompok , Masukkan dan simpan pengumuman pada kolom
                        dibawah
                    </li>
                </ul>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow rounded">
                <div class="card-body">
                    <h2 class="card-title"><strong>Daftar Kuis di Kelompok Yang Anda Asuh</strong></h2>
                    <div class="table-responsive">
                        <table id="datatables" class="table table-bordered table-responsive">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Judul Quiz</th>
                                    <th scope="col">Deskripsi</th>
                                    <th scope="col">Nama Kelompok</th>
                                    <th scope="col">Link Quiz</th>
                                    <th scope="col">Dibuat Pada</th>
                                    <th scope="col">Hapus</th>
                                    <th scope="col">Edit Quiz</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($quizData as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->title}}</td>
                                    <td>{{$item->description}}</td>
                                    <td>{{$item->group_name}}</td>
                                    <td>
                                        <a href="{{$item->gform_link}}">
                                            {{$item->gform_link}}
                                        </a>
                                    </td>
                                    <td>{{$item->created_at}}</td>
                                    <td>
                                        <form action="{{url('/mentor/tahfidz/quiz/delete')}}" method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$item->id}}">
                                            <button type="submit" onclick="confirm('Anda yakin ?')"
                                                class="btn btn-border btn-round btn-xs btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                    <td>
                                        <button class="btn btn-success btn-border btn-round btn-xs" data-toggle="modal"
                                            data-target="#modalUpdateQuiz{{$loop->index+1}}">
                                            Input/Lihat Quiz
                                        </button></td>
                                    </td>
                                </tr>

                                <div class="modal fade" id="modalUpdateQuiz{{$loop->index+1}}" tabindex="-1"
                                    role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalCenterTitle">Update Quiz</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{url('/mentor/tahfidz/quiz/update')}}" method="post">
                                                    @csrf
                                                    @method('POST')
                                                    <input type="hidden" name="u_id" value="{{$item->id}}">
                                                    <div class="form-group">
                                                        <label for="">Judul Quiz</label>
                                                        <input required type="text"
                                                            value="{{ old('u_title',$item->title) }}"
                                                            class="form-control @error('u_title') is-invalid @enderror"
                                                            name="u_title" id=""
                                                            placeholder="Masukkan Judul Quiz Yang Baru">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Deskripsi Singkat Kuis</label>
                                                        <input required type="text"
                                                            value="{{ old('u_description',$item->description) }}"
                                                            class="form-control @error('u_description') is-invalid @enderror"
                                                            name="u_description"
                                                            placeholder="Masukkan Deskripsi Quiz Yang Baru">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Link Quiz</label>
                                                        <textarea required class="form-control" name="u_link"
                                                            placeholder="Link Quiz" rows="2"
                                                            class="form-control @error('u_link') is-invalid @enderror">{{old('u_link',$item->gform_link)}}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Kuis Untuk Kelompok</label>
                                                        <select class="form-control" name="u_group_id" id="" required>
                                                            </option>
                                                            @forelse ($groupData as $item)
                                                            <option value="">---Pilih Kelompok Kuis---</option>
                                                            <option value="{{$item->group_id}}">
                                                                {{$item->group_name}}
                                                            </option>
                                                            @empty
                                                            <option disabled value="">Anda Belum Memiliki Kelompok
                                                            </option>
                                                            @endforelse
                                                        </select>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
                                                    </div>

                                                </form>
                                            </div>


                                        </div>
                                    </div>
                                </div>


                                @empty

                                @endforelse

                            </tbody>
                        </table>
                    </div>
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