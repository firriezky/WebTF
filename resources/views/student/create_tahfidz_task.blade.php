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
                <h3 class="page-title">Setoran Tahfidz</h3>
                <a href="{{url('mentor/tahfidz/task')}}">
                    <h3>Kembali/Lihat Semua Setoran</h3>
                </a>
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

        <div class="alert alert-danger alert-dismissible fade show mx-2 my-2" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
            <strong>{{Session::get( 'error' )}}</strong>
        </div>
        @endif

        @error('score')
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          Score Akhir Masih Kosong
          <strong>Silakan Klik Hitung Nilai Terlebih Dahulu</strong> 
        </div>
        
        <script>
          $(".alert").alert();
        </script>
        @enderror

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
                        <label for="">Petunjuk Penilaian</label>
                    </div>
                    <ul class="mt-1">
                        <li>Masukkan Nilai Siswa Berdasarkan Hafalan Yang Disetorkan Siswa</li>
                        <li><strong>Ubah Status ke Sudah Dinilai</strong> untuk menampilkan nilai di akun siswa</li>
                        <li>Komponen Penilaian Dapat Dilihat dibawah kolom pengisian nilai</li>
                        <li>Klik Simpan Jika Nilai Sudah Diinputkan</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
                <form action="{{url('task/save')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="student_id" value="{{$student->id}}">
                    <div class="container p-4">


                        <div class="row">
                            <div class="card border-primary col-12">
                                <div class="avatar-sm float-left mt-4 ml-4">
                                    <img onerror="this.src='{{asset('img/img-error.jpg')}}';"
                                        src="{{ "http://tahfidz.sditwahdahbtg.com/student/photo/".$student->photo_url }}"
                                        alt="image profile" class="avatar-img rounded-circle">
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title"> {{$student->name}}</h4>
                                    <p class="card-text">{{$student->name}}</p>
                                    <p class="card-text">Asal Kelas : {{$student->kelas}}</p>
                                    <div class="col-lg-12">
                                        <audio controls loop style="width: 100%;">
                                            <source src=""
                                                type="audio/ogg">
                                            Your browser doesnt not Support the audio Tag
                                        </audio>
                                    </div>

                                    <div class="form-group">
                                      <label for="">Jenis Setoran</label>
                                      <select class="form-control @error('type') is-invalid @enderror" name="type" id="">
                                        <option value="Ziyadah / Hafalan Baru">Ziyadah / Hafalan Baru</option>
                                        <option value="Muroja'ah / Pengulangan">Muroja'ah / Pengulangan</option>
                                        <option value="Ujian Kenaikan Juz">Ujian Kenaikan Juz</option>
                                      </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Upload File Hafalan</label>
                                        <input type="file" class="form-control-file" accept="audio/*" name="file_audio" id="" placeholder="" aria-describedby="fileHelpId">
                                        <small id="fileHelpId" class="form-text text-muted">Rekam atau Upload File Hafalan</small>
                                      </div>
                                      <div class="row col-12">
                                        <div class="form-group col-md-6 col-12">
                                            <label for="">Surat Mulai</label>
                                            <select 
                                            placeholder="Surat Mulai Setoran"
                                            class="form-control" name="surat_mulai" @error('surat_mulai')
                                                is-invalid
                                            @enderror id="">
                                            @include('util.surah_option')
                                            </select>
                                        </div>  

                                        </select>
    
                                          <div class="form-group  col-md-6 col-12">
                                            <label for="">Ayat Mulai</label>
                                            <input min="0"
                                            placeholder="Ayat Mulai Setoran"
                                            type="number" required class="form-control @error('ayat_mulai') @enderror" 
                                               name="ayat_mulai" id="" aria-describedby="helpId" placeholder="">
                                          </div>
                                    </div>
    
                                    <div class="row col-12">
                                        <div class="form-group  col-md-6 col-12">
                                            <label for="">Surat Selesai</label>
                                            <select 
                                            placeholder="Surat Selesai Setoran"
                                            class="form-control" name="surat_selesai" 
                                            @error('surat_selesai')
                                                is-invalid
                                            @enderror
                                            id="">
                                            @include('util.surah_option')
                                            </select>
                                        </div>  
    
                                          <div class="form-group col-md-6 col-12">
                                            <label for="">Ayat Selesai</label>
                                            <input min="0" 
                                            placeholder="Ayat Selesai Setoran"
                                            type="number" required 
                                              class="form-control" name="ayat_selesai" id="" aria-describedby="helpId" placeholder="">
                                          </div>
                                    </div>
                                </div>

                             
                            </div>

                    
                        <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                    </div>
                </form>



                {{-- Next Page Link --}}
                {{-- {{ $dayta->links() }} --}}
                <br>
            </div>
        </div>
    </div>
</div>

<div class="row">
    {{-- {{ $blogs->links() }} --}}
</div>

@endsection

@section('script')



{{-- <<-- Toastr -->> --}}
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