@extends('template.template')

@section('head-section')

@endsection

@section('script')

@endsection

@section('main')
<div class="page-inner">
    <h4 class="page-title">User Profile</h4>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <script>
                $(function() { //ready
                        toastr.error('{{ session('
                            $error ') }}', '{{ $error }}');
                    });

            </script>
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="row p-3">
        <div class="col-md-8 row">
            <div class="card card-with-nav col-12">
                <div class="card-header">
                    <div class="row row-nav-line">
                        <ul class="nav nav-tabs nav-line nav-color-secondary w-100 pl-3" role="tablist">
                            <li class="nav-item"> <a class="nav-link active show" data-toggle="tab" href="#home"
                                    role="tab" aria-selected="true">Profile</a> </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{url('student/profile/update')}}" method="post" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label>Nama Siswa</label>
                            <input type="text" class="form-control @error('contact') is-invalid has-error @enderror"
                                name="name" placeholder="Name"
                                value="{{old('name',Auth::guard('student')->user()->name)}}">
                        </div>
                        <div class="form-group">
                            <label>NISN</label>
                            <input type="text" class="form-control @error('nisn') is-invalid has-error @enderror"
                                value="{{old('contact',Auth::guard('student')->user()->nisn)}}" name="nisn"
                                placeholder="contact" disabled>
                            <label class="text-muted">Gunakan NISN Ini Untuk Login</label>
                        </div>
                        <div class="form-group">
                            <label>Contact</label>
                            <input type="text" class="form-control @error('contact') is-invalid has-error @enderror"
                                value="{{old('contact',Auth::guard('student')->user()->contact)}}" name="contact"
                                placeholder="contact">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control @error('email') is-invalid has-error @enderror"
                                value="{{old('email',Auth::guard('student')->user()->email)}}" name="email"
                                placeholder="contact">
                        </div>
                        <div class="form-group">
                            <label for="">Ganti Foto Profile</label>
                            <input type="file" accept="image/*" class="form-control-file" name="photo" id="" placeholder=""
                                aria-describedby="fileHelpId">
                            <small id="fileHelpId" class="form-text text-muted">Klik Disini Untuk Upload/Ganti Foto
                                Profile</small>
                        </div>
                        <div class="text-right mt-3 mb-3">
                            <button class="btn btn-success">Save</button>
                            <button class="btn btn-danger">Reset</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card card-with-nav col-md-12">
                <form action="{{url('/student/profile/update-pass')}}" method="post">
                    @csrf
                    <div class="card-header">
                        <div class="row row-nav-line">
                            <ul class="nav nav-tabs nav-line nav-color-secondary w-100 pl-3" role="tablist">
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#settings" role="tab"
                                        aria-selected="false">Ganti Password</a> </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mt-12">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Password Lama</label>
                                    <input type="text"
                                        class="form-control @error('old_pass') is-invalid has-error @enderror"
                                        name="old_pass" placeholder="Password Lama">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-12">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Password Baru</label>
                                    <input type="text"
                                        class="form-control @error('new_pass') is-invalid has-error @enderror"
                                        name="new_pass" placeholder="Password Baru">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-12">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Ulangi Password Baru</label>
                                    <input type="text"
                                        class="form-control @error('new_pass_confirmation') is-invalid has-error @enderror"
                                        name="new_pass_confirmation" placeholder="Masukan Ulang Password Baru">
                                </div>
                            </div>
                        </div>

                        <div class="text-right mt-3 mb-3">
                            <button class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
        <div class="col-md-4">
            <div class="card card-profile">
                <div class="card-header" style="background-image: url('../assets/img/blogpost.jpg')">
                    <div class="profile-picture">
                        <div class="avatar avatar-xl">
                            <img onerror="this.src='{{asset('img/img-error.jpg')}}?n={{time()}}';"
                                src="{{ "http://tahfidz.sditwahdahbtg.com/student/" . Auth::guard('student')->user()->url_profile}}?n={{time()}}"
                                alt="image profile" class="avatar-img rounded-circle">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="user-profile text-center">
                        <div class="name">{{Auth::guard('student')->user()->name}}</div>
                    </div>
                </div>
                <div class="card-footer d-none">
                    <div class="row user-stats text-center">
                        <div class="col">
                            <div class="number">125</div>
                            <div class="title">Post</div>
                        </div>
                        <div class="col">
                            <div class="number">25K</div>
                            <div class="title">Followers</div>
                        </div>
                        <div class="col">
                            <div class="number">134</div>
                            <div class="title">Following</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>

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