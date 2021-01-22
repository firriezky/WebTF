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
            </div>
        </div>

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

                <form action="{{url('correction/save')}}" method="post">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="submission_id" value="{{$dayta->id_submission}}">
                    <input type="hidden" name="student_id" value="{{$dayta->id_student}}">
                    <input type="hidden" name="mentor_id" value="{{$dayta->mentor_id}}">
                    <div class="container p-4">
                        <div class="card border-primary">
                            <div class="avatar-sm float-left mt-4 ml-4">
                                <img onerror="this.src='{{asset('img/img-error.jpg')}}';"
                                    src="{{ "http://tahfidz.sditwahdahbtg.com/student/photo/".$dayta->student_photo }}"
                                    alt="image profile" class="avatar-img rounded-circle">
                            </div>
                            <div class="card-body">
                                <h4 class="card-title"> {{$dayta->student_name}}</h4>
                                <p class="card-text">{{$dayta->student_nisn}}</p>
                                <p class="card-text">Asal Kelas : {{$dayta->student_class}}</p>
                            </div>
                        </div>


                        <br>
                        <h4>Hafalan Yang Disetorkan : </h4>
                        <p>{{$dayta->start}} - {{$dayta->end}}</p>
                        <div class="col-lg-12">
                            <audio controls loop style="width: 100%;">
                                <source src="http://tahfidz.sditwahdahbtg.com/submission/{{$dayta->audio}}"
                                    type="audio/ogg">
                                Your browser doesnt not Support the audio Tag
                            </audio>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label>Nilai Hukum Bacaan</label>
                                <input type="number" required min="0" max="100" name="score_ahkam"
                                    class="form-control @error('score_ahkam') is-invalid @enderror" id="score-ahkam"
                                    placeholder="Nilai Hukum Bacaan"
                                    value="{{$dayta->score_ahkam .@old('score_ahkam')}}">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label>Nilai Makhorijul Huruf</label>
                                <input type="number" required min="0" max="100" name="score_makhroj"
                                    class="form-control @error('score_makhroj') is-invalid @enderror" id="score-makhroj"
                                    placeholder="Nilai Makhroj" " value="
                                    {{$dayta->score_makhroj .@old('score_makhroj')}}">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label>Nilai Kelancaran Hafalan</label>
                                <input type="number" required min="0" max="100" name="score_itqan"
                                    class="form-control @error('score_itqan') is-invalid @enderror" id="score-itqan"
                                    placeholder="Nilai Kelancaran"" value="
                                    {{$dayta->score_itqan .@old('score_itqan')}}">
                            </div>

                            <div class="form-group col-md-6 col-sm-12">
                                <label>Nilai Akhir</label>
                                <input type="text" required disabled class="form-control class=" form-control
                                    @error('score') is-invalid @enderror" id="score"
                                    value="{{$dayta->score,old('score')}}">
                                <input type="hidden" name="score" id="score-sent">
                            </div>
                            <script>
                                $(document).ready(function() {
                                        var calculateFinalScore = function() {
                                                var scoreItqan = parseFloat(document.getElementById("score-itqan").value);
                                                var scoreMakhroj = parseFloat(document.getElementById("score-makhroj").value);
                                                var scoreAhkam = parseFloat(document.getElementById("score-ahkam").value);
                                                if(isNaN(scoreItqan)){
                                                    scoreItqan=0;
                                                }
                                                if(isNaN(scoreMakhroj)){
                                                    scoreMakhroj=0;
                                                }
                                                if(isNaN(scoreAhkam)){
                                                    scoreAhkam=0;
                                                }
                                                var scoreTajwid = ((scoreMakhroj+scoreAhkam)/2.0);
                                            
                                                document.getElementById("v-score-tajwid").innerText = scoreTajwid;
                                                document.getElementById("v-score-itqan").innerText = scoreItqan;
                                                var scoreFinal = ((scoreTajwid*0.03)+(scoreItqan*0.07));
                                                scoreFinal = Math.floor(scoreFinal*10);
                                                document.getElementById("v-score-final").innerText = scoreFinal;
                                                document.getElementById("score").value = scoreFinal;
                                                document.getElementById("score-sent").value = scoreFinal;
                                            };
                            
                            
                                            $("#refreshCalculate").click(function() {
                                                calculateFinalScore();
                                            })
                            
                                            $("#score-ahkam").keyup(function() {
                                                calculateFinalScore();
                                            });
                                            $("#score-itqan").keyup(function() {
                                                calculateFinalScore();
                                            });
                                            $("#score-makhroj").keyup(function() {
                                                calculateFinalScore();
                                            });
                                });
                            </script>
                            <div class="col-12">
                                <strong>Pembagian Nilai : </strong>
                                <ul class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <li><strong>Nilai Tajwid : </strong> <span id="v-score-tajwid"></span></li>
                                        <li>Nilai Kelancaran : <span id="v-score-itqan">{{$dayta->score_itqan}}</span>
                                        </li>
                                        <li>Nilai Akhir : <span id="v-score-final">{{$dayta->score}}</span></li>
                                    </div>
                                </ul>
                                <button type="button" id="refreshCalculate" class="btn btn-primary btn-xs">
                                    Hitung Nilai Akhir</button><br>
                                <strong>Keterangan</strong>
                                <ul>
                                    <li>Nilai Tajwid Diambil dari rerata nilai hukum bacaan dan makhroj</li>
                                    <li>Nilai Akhir Diambil Dari Nilai Tajwid(30%) ditambah nilai kelancaran (70%)</li>
                                </ul>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="">Status</label>
                                <select class="form-control" name="status" id="">
                                    <option value="0" {{($dayta->status==0) ? 'selected' : ''}}>Menunggu Dinilai
                                    </option>
                                    <option value="1" {{($dayta->status==1) ? 'selected' : ''}}>Sudah Dinilai</option>
                                </select>
                            </div>
                            <div class="form-group col-12">
                                <label for="">Catatan Untuk Siswa</label>
                                <textarea class="form-control ckeditor @error('correction') is-invalid @enderror"
                                    name="correction" rows="5"
                                    placeholder="Masukkan Catatan Untuk Siswa">{{$dayta->correction,old('correction') }}</textarea>
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