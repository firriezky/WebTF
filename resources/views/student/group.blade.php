@extends('template.template')

@section('head-section')
<link href="{{ asset('css') }}/additional.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

@endsection

@section('script')
@endsection

@section('main')



<div class="container-fluid">
    <div class="container mt-5">
        @if ($group==null)
        <div class="row h-100">
            <div class="col-sm-12 my-auto">
                <!-- 404 Error Text -->
                <div class="text-center">
                    <div class="error mx-auto" data-text="404">404</div>
                    <p class="lead text-gray-800 nunito">Anda Belum Memiliki Kelompok Tahfidz</p>
                    <p class="lead text-gray-800 mb-5 nunito">Hubungi Admin/Penanggung Jawab Tahfidz Untuk Mendapatkan Kelompok</p>
                </div>
            </div>
        </div>
        @else
        <!-- Page Header -->
        <div class="page-header row no-gutters">
            <div class="col-12 text-center text-sm-left mb-0">
                <h2 class="pb-2 fw-bold uppercase">Anda Berada di Kelompok Tahfidz</h2>
                <h5 class="text-white ">
                    <h1>{{$group->name}}</h1> <br>
                </h5>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">

                    <div class="card-body">
                        <h3>{{$group->name}}</h3>
                        <div class="avatar-sm float-left mr-2">
                            
                            <img onerror="this.src='{{asset('img/img-error.jpg')}}';"
                            src="{{ "http://tahfidz.sditwahdahbtg.com/student/photo/" . $mentor->photo_url }}"
                            alt="image profile" class="avatar-img rounded-circle">
                        </div>
                        <h4>Pembimbing Tahfidz : {{$mentor->name}}</h4>
                        <h4>Kontak Pembimbing : {{$mentor->contact_mentor}}</h4>
                        <table id="datatables" class="table table-bordered table-responsive">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">NISN</th>
                                    <th scope="col">Foto</th>
                                    <th scope="col">Asal Kelas</th>
                                    <th scope="col">Kontak</th>
                                    <th scope="col">JK</th>
                                    <th scope="col">Pembimbing</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($groupMember as $item)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->nisn}}</td>
                                    <td>
                                        <div class="avatar-sm float-left mr-2">
                                            <img onerror="this.src='{{asset('img/img-error.jpg')}}';"
                                            src="{{ "http://tahfidz.sditwahdahbtg.com/student/" . $item->student_photo }}"
                                            alt="image profile" class="avatar-img rounded-circle">
                                        </div>
                                    </td>
                                    <td>{{$item->class}}</td>
                                    <td>{{$item->student_contact}}</td>
                                    <td>{{$item->student_gender}}</td>
                                    <td>{{$item->mentor}}</td>
                                </tr>
                                @empty
                                <p>Belum Ada Data Siswa di Kelompok Ini</p>
                                @endforelse


                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            @endif
        </div>
    </div>
</div>

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



@if (session()->has('success'))
<script>
    toastr.success('{{ session('
                        success ') }}', ' {{ Session::get('success')}}');

</script>
@elseif(session()-> has('error'))
<script>
    toastr.error('{{ session('
                        error ') }}', ' {{ Session::get('error')}}');

</script>

@endif

@endsection