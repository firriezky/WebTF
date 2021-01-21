@extends('template.template')

@section('head-section')
@endsection



@section('main')

<div class="container mt-5 mb-3">
    <div class="page-header">
        <h4 class="page-title">Push Notification</h4>
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
                <a href="#">Notification</a>
            </li>
        </ul>
    </div>
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

    <div class="alert alert-warning alert-dismissible fade show mx-2 my-2" role="alert">
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
</div>

    <div class="page-with-aside mail-wrapper bg-white">
     
        <div class="page-content mail-content">
            <div class="email-head d-lg-flex d-block">
                <h3>
                    <i class="flaticon-pen mr-1"></i>
                    Compose new broadcast push notification to all Mobile user
                </h3>
            </div>
            <div class="email-compose-fields">
                <form action="{{url('notification/broadcast/send')}}" method="post">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="to" class="col-form-label col-md-1">Push Notification Target</label>
                        <div class="col-md-11">
                            <select class="form-control" name="topic" id="">
                                <option>Choose Broadcast Service Target</option>
                                <option value="all">All User</option>
                                <option value="student">Student</option>
                                <option value="teacher">Teacher</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="to" class="col-form-label col-md-1">Type/Redirect Intent To</label>
                        <div class="col-md-11">
                            <select class="form-control" name="redirect" id="">
                                <option>Choose Intent Action When User Open/Click Notification</option>
                                <option value="all">Playstore/New Update</option>
                                <option value="all">Announcement Page</option>
                                <option value="all">Profile Page</option>
                                <option value="all">Nothing</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="subject" class="col-form-label col-md-1">Judul Notifikasi:</label><br>
                        <div class="col-md-11">
                            <input type="text" autocomplete="title_notif" class="form-control" placeholder="Title of Notification" id="subject"
                                name="title">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="subject" class="col-form-label col-md-1">Isi Notifikasi :</label><br>
                        <div class="col-md-11">
                            <textarea class="form-control" placeholder="Notification Content" name="content" id=""
                                rows="3"></textarea>
                        </div>
                    </div>

            </div>
            <div class="email-editor">
                <div id="editor"></div>
                <div class="email-action">
                    <button type="submit" class="btn btn-primary btn-border btn-round">Broadcast Message</button>
                    <button type="reset" class="btn btn-warning btn-border btn-round">Reset Form</button>
                </div>
                <form>

            </div>
        </div>

        <div class="page-aside bg-grey1">
            <div class="aside-header">
                <div class="title">Broadcast Notification</div>
                <div class="description">Service Description</div>
                <hr> <br>
                <p>Gunakan Fitur Ini Untuk Mengirimkan Pengumuman Ke Seluruh Pengguna Mobile,
                    semisal notifikasi untuk pembaruan aplikasi, update fitur,maintenacance, dan lain-lain
                </p>
            </div>
        </div>

    </div>


  

@endsection


@section('script')



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