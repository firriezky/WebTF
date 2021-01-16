@extends('template.template')

@section('head-section')
@endsection



@section('main')


<div class="container-fluid">
    <div class="container mt-5">
        {{-- @include('blog.breadcumb') --}}
        <!-- Page Header -->

        {{-- Tambah Data Mentor --}}
        <form action="{{route('admin.mentor.create')}}" method="post">
            @csrf
            @method('POST')
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Data Pembimbing</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label for="">Nama Guru</label>
                                <input type="text" value="{{ old('name') }}"
                                    class="form-control @error('name') is-invalid @enderror" name="name" id=""
                                    placeholder="Nama Pembimbing">
                            </div>
                            <div class="form-group">
                                <label for="">Jenis Kelamin</label>
                                <select class="form-control" name="gender" id="">
                                    <option value="L">Ikhwan/Laki-laki</option>
                                    <option value="P">Perempuan/Akhwat</option>
                                    <option></option>
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" value="{{ old('email') }}"
                                    class="form-control @error('email') is-invalid @enderror" name="email" id=""
                                    placeholder="Email Guru">
                                <small class="form-text text-muted">Email Guru ,
                                    Isi dengan nama-guru@tahfidz.com jika guru tidak memiliki email
                                </small>
                            </div>
                            <div class="form-group">
                                <label for="">Kontak Guru</label>
                                <input type="text" value="{{ old('contact') }}"
                                    class="form-control @error('contact') is-invalid @enderror"
                                    class="form-control @error('contact') is-invalid @enderror" name="contact" id=""
                                    placeholder="Kontak Guru">
                                <small class="form-text text-muted">
                                    <strong>Nomor Telepon Ini Digunakan Untuk Login Guru</strong>
                                </small>
                            </div>

                            <div class="form-group">
                                <label for="">
                                    <h4>Password Default Pembimbing : Wahdah Islamiyah</h4>
                                </label>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>

                    </div>
                </div>
            </div>
        </form>



        <div class="page-header row no-gutters">
            <div class="col-12 text-center text-sm-left mb-0">
                <span class="text-uppercase page-subtitle">Manage Pembimbing</span>
                <h3 class="page-title">Manage Data Pembimbing</h3>
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
                    @endif



                    <div class="card-body">
                        <button class="btn btn-primary btn-border btn-round mb-3" data-toggle="modal"
                            data-target="#exampleModalCenter">
                            Tambah Guru/Pembimbing Baru</button>
                        <div class="table-responsive">


                            <table id="basic-datatables" class="table table-bordered table-responsive">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Mentor</th>
                                        <th scope="col">JK</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">No Telepon</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Reset Password</th>
                                        <th scope="col">Hapus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($dayta as $data)


                                    <div class="modal fade" id="modalResetPassword{{$loop->index+1}}" tabindex="-1"
                                        role="dialog" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalCenterTitle">Reset
                                                        Password Guru</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('mentor.reset-password')}}" method="post">
                                                        @csrf
                                                        @method('POST')
                                                        <input type="text" value="{{ $data->id}}" name="id"
                                                            class="d-none">
                                                        <div class="form-group">
                                                            <label for="">Masukkan Password Baru Untuk
                                                                {{$data->name}}</label>
                                                            <input type="text" value="{{ old('password') }}"
                                                                class="form-control @error('password') is-invalid @enderror"
                                                                name="password" id="" placeholder="Password Baru">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-warning">Reset
                                                                Password</button>
                                                        </div>
                                                    </form>
                                                </div>


                                            </div>
                                        </div>
                                    </div>


                                    <div class="modal fade" id="updateModal{{$loop->index+1}}" tabindex="-1"
                                        role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalCenterTitle">Update
                                                        Data Guru</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('admin.mentor.edit',$data->id)}}"
                                                        method="get">
                                                        @csrf
                                                        @method('GET')
                                                        <input type="text" value="{{ $data->id}}" name="id"
                                                            class="d-none">
                                                        <div class="form-group">
                                                            <label for="">Nama Pembimbing</label>
                                                            <input type="text" value="{{ $data->name, old('name') }}"
                                                                class="form-control @error('name') is-invalid @enderror"
                                                                name="name" id="" placeholder="Nama Guru">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Jenis Kelamin</label>
                                                            <select class="form-control" name="gender" id="">
                                                                <option value="L">Ikhwan/Laki-laki</option>
                                                                <option value="P">Perempuan/Akhwat</option>
                                                                <option></option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Kontak Guru ( Digunakan Untuk Login )</label>
                                                            <input type="number"
                                                                value="{{ $data->contact, old('contact') }}"
                                                                class="form-control @error('contact') is-invalid @enderror"
                                                                name="contact" id="" placeholder="Kontak Guru">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">Email</label>
                                                            <input type="email" value="{{$data->email, old('email') }}"
                                                                class="form-control @error('email') is-invalid @enderror"
                                                                name="email" id="" placeholder="Email Guru">
                                                            <small class="form-text text-muted">Email Guru ,
                                                                Isi dengan nama-guru@tahfidz.com jika Guru tidak
                                                                memiliki email
                                                            </small>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">Kontak Guru</label>
                                                            <input type="text"
                                                                value="{{ $data->contact,old('contact') }}"
                                                                class="form-control @error('contact') is-invalid @enderror"
                                                                name="contact" id="" placeholder="Kontak Guru">
                                                        </div>
                                                        <p>Password Default Guru : Wahdah Islamiyah</p>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Update
                                                                Data
                                                                Guru</button>
                                                        </div>
                                                    </form>
                                                </div>


                                            </div>
                                        </div>
                                    </div>


                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->gender }}</td>
                                        <td>{{ $data->email}}</td>
                                        <td>{{ $data->contact }}</td>
                                        <td>
                                            <button type="button" title="" class="btn btn-link btn-primary btn-lg"
                                                data-toggle="modal" data-target="#updateModal{{$loop->index+1}}"
                                                data-original-title="Edit Task">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                        </td>
                                        <td>
                                            <button class="btn btn-danger btn-border btn-round mb-3" data-toggle="modal"
                                                data-target="#modalResetPassword{{$loop->index+1}}">
                                                Reset Password
                                            </button>
                                        </td>
                                        <form id="delete-post-form"
                                            action="{{ route('admin.mentor.destroy', $data->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <td>
                                                <button type="submit"
                                                    onclick="return confirm('Apakah Anda Yakin ? Ini Akan Menghapus Pembimbing dan Kelompok Yang Sedang Diasuh')"
                                                    class="btn btn-warning btn-border btn-round mb-3"
                                                    data-toggle="tooltip">
                                                    Hapus Pembimbing
                                                </button>
                                            </td>
                                        </form>



                                    </tr>
                                    @empty
                                    <div class="alert alert-danger">
                                        Data Guru belum Tersedia.
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
</div>

@endsection

@section('script')



{{-- Toastr --}}
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- Datatables -->
<script src="{{asset('atlantis/examples')}}/assets/js/plugin/datatables/datatables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#basic-datatables').DataTable({
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