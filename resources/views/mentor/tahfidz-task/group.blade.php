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
                <span class="text-uppercase page-subtitle">Daftar Siswa Tahfidz Yang Anda Asuh</span>
                <h3 class="page-title">Siswa Tahfidz Anda</h3>
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



                <div class="card-body">
                    <h2 class="card-title"><strong>Daftar Siswa</strong></h2>
                    <div class="table-responsive">
                        <table id="datatables" class="table table-bordered table-responsive">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Siswa</th>
                                    <th scope="col">NISN</th>
                                    <th scope="col">JK</th>
                                    <th scope="col">Foto</th>
                                    <th scope="col">Asal Kelas</th>
                                    <th scope="col">Kelompok Tahfidz</th>
                                    <th scope="col">Pembimbing</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($dayta as $data)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->nisn }}</td>
                                    <td>{{ $data->student_gender }}</td>
                                    <td>
                                        <div class="profile-picture">
                                            <div class="avatar avatar-xl">
                                                <img onerror="this.src='{{asset('img/img-error.jpg')}}?n={{time()}}';"
                                                    src="http://tahfidz.sditwahdahbtg.com/student/{{$data->student_photo}}?n={{time()}}"
                                                    alt="image profile" class="avatar-img rounded-circle">
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $data->class }}</td>
                                    <td>{{$data->group_name}}</td>
                                    <td>{{$data->mentor}}</td>


                                </tr>
                                @empty
                                <div class="alert alert-danger">
                                    Anda Belum Memiliki Siswa Tahfidz.
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