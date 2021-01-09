@extends('template.template')

@section('head-section')
@endsection



@section('main')


<div class="container-fluid">
    <div class="container mt-5">
        {{-- @include('blog.breadcumb') --}}
        <!-- Page Header -->

        {{-- Tambah Data Siswa --}}
        <form action="{{route('student.simpan')}}" method="post">
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Data Siswa</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            @csrf
                            @method('POST')
                            <div class="form-group">
                                <label for="">Nama Siswa</label>
                                <input type="text" value="{{ old('name') }}"
                                    class="form-control @error('name') is-invalid @enderror" name="name" id=""
                                    placeholder="Nama Siswa">
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
                                <label for="">NISN</label>
                                <input type="number" value="{{ old('nisn') }}"
                                    class="form-control @error('nisn') is-invalid @enderror" name="nisn" id=""
                                    placeholder="NISN Siswa">
                            </div>
                            <div class="form-group">
                                <label for="">Kelas Siswa</label>
                                <input type="text" value="{{ old('kelas') }}"
                                    class="form-control @error('kelas') is-invalid @enderror" name="kelas" id=""
                                    placeholder="Kelas Siswa">
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" value="{{ old('email') }}"
                                    class="form-control @error('email') is-invalid @enderror" name="email" id=""
                                    placeholder="Email Siswa">
                                <small class="form-text text-muted">Email Siswa ,
                                    Isi dengan nama-siswa@tahfidz.com jika siswa tidak memiliki email
                                </small>
                            </div>
                            <div class="form-group">
                                <label for="">Kontak Siswa</label>
                                <input type="text" value="{{ old('contact') }}"
                                    class="form-control @error('contact') is-invalid @enderror"
                                    class="form-control @error('contact') is-invalid @enderror" name="contact" id=""
                                    placeholder="Kontak Siswa">
                            </div>
                            <p>Password Default Siswa : Bismillah atau bismillah</p>

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
                <span class="text-uppercase page-subtitle">Lihat Siswa</span>
                <h3 class="page-title">Data Siswa</h3>
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
                                Tambah Siswa</button>
                            <div class="table-responsive">


                                <table id="basic-datatables" class="table table-bordered table-responsive">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Nama Siswa</th>
                                            <th scope="col">JK</th>
                                            <th scope="col">NISN</th>
                                            <th scope="col">No Telp</th>
                                            <th scope="col">Kelas</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($dayta as $data)


                                    
                                        <tr>
                                            <td>{{$loop->index+1}}</td>
                                            <td>{{ $data->name }}</td>
                                            <td>{{ $data->gender }}</td>
                                            <td>{{ $data->nisn }}</td>
                                            <td>{{ $data->contact }}</td>
                                            <td>{{ $data->kelas}}</td>
                                         
                                        
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

        </div>
    </div>
</div>