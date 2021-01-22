@extends('template.template')

@section('head-section')
@endsection



@section('main')

    <div class="page-inner py-5">

        <!-- Page Header -->


        <div class="page-header">
            <h4 class="page-title">Agenda</h4>
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
                    <a href="#">Admin</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Agenda</a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Buat Agenda</a>
                </li>
            </ul>
        </div>

        <!-- End Page Header -->
        <div class="row">
            <div class="col-lg-8 col-md-12">
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

                <form action="{{url('admin/agenda/save')}}" method="post">
                    @csrf
                    @method('POST')


                <!-- Add New Agenda Form -->
                <div class="card card-small mb-3">
                    <div class="card-body">
                        <div class="col-12">
                            <span class="text-uppercase page-subtitle">Buat Agenda</span>
                            <h3 class="page-title">Buat Agenda Tahfidz Baru</h3>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">JUDUL</label>
                            <input id="inputTitle" type="text" class="form-control " name="title" value=""
                                placeholder="Masukkan Judul Agenda">
                          <small id="helpId" class="form-text text-muted"><strong>Contoh Judul : Halaqoh Tahfidz SMP 25 November 2020</strong></small>
                        </div>



                        <div class="form-group">
                            <label>Waktu Mulai</label>
                            <div class="input-group">
                                <input type="datetime-local" class="form-control @error('start') is-invalid @enderror" id="datetime" name="start">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Waktu Selesai</label>
                            <div class="input-group">
                                <input type="datetime-local" class="form-control @error('start') is-invalid @enderror" id="datetime" name="end">
                            </div>
                        </div>


                        <div class="form-group">
                          <label for="">Jenis Agenda</label>
                          <select class="form-control" name="type" id="">
                            <option value="1">Halaqoh Tahfidz SMP</option>
                            <option value="2">Halaqoh Tahfidz SMA</option>
                            <option value="3">Halaqoh Tahfidz SD</option>
                            <option value="3">Ujian</option>
                          </select>
                        </div>

                 
                        
                        <div class="form-group">
                          <label for="">Deskripsi Agenda</label>
                          <textarea class="form-control" name="description" id="" rows="3"></textarea>
                        </div>

                        <hr>
                        <button type="submit" class="btn btn-primary mt-3">Buat Agenda</button>
                        <button type="reset" class="btn btn-primary mt-3">Reset</button>
                    </form>

                    </div>
                </div>

              
            </div>

            <div class="col-lg-4 col-12">
                <div class="card card-small mb-3">
                    <div class="card-body">

                        <strong>
                            <h2>Petunjuk : </h2>
                        </strong>
                        <div class="mt-4">
                            <ul>
                                <li>Agenda Ini Akan Digunakan Untuk Presensi Kehadiran Santri dan Laporan dari Pembimbing</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('script')
	<!-- DateTimePicker -->
	<script src="{{asset('atlantis/examples')}}/assets/js/plugin/datepicker/bootstrap-datetimepicker.min.js"></script>
    {{-- Toastr --}}
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- Datatables -->
    <script src="{{asset('atlantis/examples')}}/assets/js/plugin/datatables/datatables.min.js"></script>
    <script>
      
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
