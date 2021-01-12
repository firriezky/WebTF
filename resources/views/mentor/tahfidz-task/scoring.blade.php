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
                        <li>Pilih Kelompok Yang Ingin Dinilai Menggunakan Pilihan Diatas</li>
                        <li>Klik Tombol <strong>Input/Lihat</strong> Untuk Menginput atau Melihat Nilai Siswa</li>
                        <li>Untuk Mengimport Data Setoran, Silakan Klik Tombol
                            <strong>Sembunyikan Kolom Untuk Import</strong> terlebih dahulu jika ingin menyembunyikan
                            Kolom
                        </li>
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

                <div class="container p-4">
                    Nama Siswa : {{$dayta->student_name}}<br>
                     <br>
                    Hafalan yang disetorkan :
                    <p>{{$dayta->start}} - {{$dayta->end}}</p>
                    <div class="col-lg-12">
                        <audio controls loop style="width: 100%;">
                            <source src="http://tahfidz.sditwahdahbtg.com/submission/" type="audio/ogg">
                            Your browser dose not Support the audio Tag
                        </audio>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6 col-sm-12">
                            <label>Nilai Tajwid</label>
                            <input type="text" class="form-control" name="score-tajwid" id="score-tajwid"
                                placeholder="Nilai Tajwid">
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label>Nilai Makhorijul Huruf</label>
                            <input type="text" class="form-control" name="score-makhroj" id="score-makhroj"
                                placeholder="Nilai Makhroj">
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
                        <div class="form-group col-12">
                            <label for="">Catatan Untuk Siswa</label>
                            <textarea class="form-control ckeditor @error('correction') is-invalid @enderror" name="content"
                                rows="5"
                                placeholder="Masukkan Catatan Untuk Siswa">{{old('correction') }}</textarea>
                        </div>
    
                    </div>
                    <label for="">Jika status diset menunggu dinilai, maka nilai tidak ditampilkan di
                        siswa</label>
                 

                </div>





                </tbody>
                </table>


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
</div>

@endsection

@section('script')



{{-- Toastr --}}
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- Datatables -->
<script>
    $.calculateFinalScore = function() {
                    var scoreItqan = $.trim($("#score-itqan").val())
                    var scoreMakhroj = $.trim($("#score-makhroj").val())
                    var scoreTajwid = $.trim($("#score-tajwid").val())

                    finalScore = (scoreItqan+scoreMakhroj+scoreTajwid)/3;
                    $("#score").text(finalScore);
                };

                $("#score-tajwid").keyup(function() {
                    $.calculateFinalScore();
                });
                $("#score-itqan").keyup(function() {
                    $.calculateFinalScore();
                });
                $("#score-makhroj").keyup(function() {
                    $.calculateFinalScore();
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

</div>
</div>
</div>