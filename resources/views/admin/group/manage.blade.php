@extends('template.template')

@section('head-section')
@endsection



@section('main')

<div class="modal fade" id="modalCreateGroup" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Buat Kelompok Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('admin.group.create')}}" method="post">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="">Nama Kelompok/Kelas</label>
                        <input type="text" value="{{ old('name') }}"
                            class="form-control @error('name') is-invalid @enderror" name="name" id=""
                            placeholder="Nama Kelompok/Kelas">
                    </div>

                    <div class="form-group">
                        <label for="">Jenis Kelompok</label>
                        <select class="form-control" name="category" id="">
                            <option value="G">Gabungan</option>
                            <option value="L">Ikhwan</option>
                            <option value="P">Akhwat</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Pilih Pembimbing</label>
                        <select class="form-control" name="mentor" id="">
                            @forelse ($mentor as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                            @empty
                            <option value="" disabled selected>Belum Ada Data Kelompok</option>
                            @endforelse
                        </select>
                    </div>

                    <h5><strong>Untuk Menginput Anggota Kelompok <br> </strong>
                        cari kelompok pada tabel dibawah dan klik edit setelah membuat kelompok
                    </h5>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-warning">Tambah Kelompok</button>
                    </div>
                </form>
            </div>


        </div>
    </div>
</div>


<div class="container-fluid">
    <div class="container mt-5">
        {{-- @include('blog.breadcumb') --}}
        <!-- Page Header -->



        <div class="page-header row no-gutters">
            <div class="col-12 text-center text-sm-left mb-0">
                <span class="text-uppercase page-subtitle">Manage Kelompok</span>
                <h3 class="page-title">Manage Data Kelompok</h3>
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
                        <strong>{{Session::get( 'error' )}}</strong> You should check in on some of those fields below.
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
                </div>
                @endif





                <div class="card-body">
                    <button class="btn btn-primary btn-border btn-round mb-3" data-toggle="modal"
                        data-target="#modalCreateGroup">
                        Buat Kelompok Baru</button>
                    <div class="table-responsive">


                        <table id="basic-datatables" class="table table-bordered table-responsive">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Kelompok/Kelas</th>
                                    <th scope="col">Pembimbing</th>
                                    <th scope="col">Kontak Pembimbing</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($dayta as $data)


                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{ $data->group_name }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->contact }}</td>
                                    <td>
                                        <a href="{{route('group.update',$data->group_id)}}">
                                            <button type="button" title="" class="btn btn-link btn-primary btn-lg"
                                                data-toggle="modal" data-target="#updateModal{{$loop->index+1}}"
                                                data-original-title="Edit Task">
                                                <i class="fa fa-edit"></i>
                                            </button></a>

                                    </td>

                                    <form id="delete-post-form" action="{{ route('group.destroy', $data->group_id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <td>
                                            <button type="submit"
                                                onclick="return confirm('Apakah Anda Yakin ? Ini Akan Menghapus Data Kelompok')"
                                                class="btn btn-warning btn-border btn-round mb-3" data-toggle="tooltip">
                                                Hapus Kelompok
                                            </button>
                                        </td>
                                    </form>



                                </tr>
                                @empty
                                <div class="alert alert-danger">
                                    Data Siswa belum Tersedia.
                                </div>
                                @endforelse
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
</div>

@endsection

@section('script')

<!-- SELECT2 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>



{{-- Toastr --}}
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- Datatables -->
<script src="{{asset('atlantis/examples')}}/assets/js/plugin/datatables/datatables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#basic-datatables').DataTable({
        });

            $("#select-student").change(function() {
                last_valid_selection = $(this).val();
                $('#counter').text($(this).val().length);
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