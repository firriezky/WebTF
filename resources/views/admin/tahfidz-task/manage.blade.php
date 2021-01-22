@extends('template.template')

@section('head-section')
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



                    <div class="card-body">
                        <a href="{{url('/admin/student/manage')}}">
                            <button class="btn btn-primary btn-border btn-round mb-3" data-toggle="modal"
                                data-target="#exampleModalCenter">
                                Tambah Siswa</button>
                        </a>
                        <div class="table-responsive">


                            <table id="datatables" class="table table-bordered table-responsive">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Siswa</th>
                                        <th scope="col">Foto</th>
                                        <th scope="col">NISN</th>
                                        <th scope="col">Asal Kelas</th>
                                        <th scope="col">Mulai</th>
                                        <th scope="col">Selesai</th>
                                        <th scope="col">Makhroj</th>
                                        <th scope="col">Hukum Bacaan</th>
                                        <th scope="col">Tajwid</th>
                                        <th scope="col">Kelancaran</th>
                                        <th scope="col">Nilai Akhir</th>
                                        <th scope="col">Pembimbing</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse ($dayta as $data)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{ $data->student_name }}</td>
                                        <td>
                                            <div class="avatar-sm float-left mr-2">
                                                <img onerror="this.src='{{asset('img/img-error.jpg')}}';"
                                                    src="{{ "http://tahfidz.sditwahdahbtg.com/student/" . $data->student_photo }}"
                                                    alt="image profile" class="avatar-img rounded-circle">
                                            </div>
                                        </td>
                                        
                                        <td>{{ $data->student_nisn }}</td>
                                        <td>{{ $data->group_name }}</td>
                                        <td>{{$data->start}}</td>
                                        <td>{{ $data->end}}</td>
                                        <td>{{$data->score_makhroj}}</td>
                                        <td>{{$data->score_ahkam}}</td>
                                        <td>{{$data->score_tajwid}}</td>
                                        <td>{{$data->score_itqan}}</td>
                                        <td>{{$data->score}}</td>
                                        <td>{{$data->mentor_name}}</td>
                                    </tr>


                             
                                    @empty
                                    <div class="alert alert-danger">
                                        Belum Ada Siswa Yang Mengirim Hafalan
                                    </div>
                                    @endforelse




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
    </div>
</div>

@endsection

@section('script')
{{-- Toastr --}}
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- Datatables -->
<script src="{{asset('atlantis/examples')}}/assets/js/plugin/datatables/datatables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#datatables').DataTable({
        });
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