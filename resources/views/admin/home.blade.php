@extends('template.template')

@section('head-section')
    @include('mentor.script')
@endsection

@section('script')

@endsection

@section('main')

    <div class="panel-header bg-primary-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h2 class="text-white pb-2 fw-bold uppercase">Dashboard Admin Tahfidz</h2>
                    <h5 class="text-white op-7 mb-2">Ahlan wa Sahlan <br>
                    </h5>
                </div>

            </div>
        </div>
    </div>

    <div class="page-inner mt--5">
        <div class="row mt-2">
            <!-- Row Card No Padding -->
            <div class="row col-12">
                <div class="col-md-4">
                    <div class="card card-secondary">
                        <div class="card-body skew-shadow">
                            <h1>{{ $myStudent }}</h1>
                            <div class="pull-right">
                                <h3 class="fw-bold op-8">Jumlah Siswa Tahfidz</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-dark bg-secondary-gradient">
                        <div class="card-body bubble-shadow">
                            <h1>{{ $myGroup }}</h1>
                            <div class="pull-right">
                                <h3 class="fw-bold op-8">Kelompok Tahfidz</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-dark bg-secondary2">
                        <div class="card-body curves-shadow">
                            <h1>{{ $mentorCount }}</h1>
                            <div class="pull-right">
                                <h3 class="fw-bold op-8">Jumlah Guru</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt--2">

                <div class="row row-card-no-pd m-3">
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="icon-big text-center">
                                            <i class="flaticon-chart-pie text-warning"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Setoran Hafalan Masuk</p>
                                            <h4 class="card-title">{{ $allTahfidzTask }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="icon-big text-center">
                                            <i class="flaticon-check text-success"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Setoran<br>Sudah Dinilai</p>
                                            <h4 class="card-title">{{ $tahfidzTask1 }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="icon-big text-center">
                                            <i class="flaticon-error text-danger"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Setoran Belum Dinilai</p>
                                            <h4 class="card-title">{{ $tahfidzTask0 }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="icon-big text-center">
                                            <i class="flaticon-round text-primary"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Setoran Belum Dikoreksi</p>
                                            <h4 class="card-title">{{ $tahfidzTask3 }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-12">
                    <h1>Akses Menu</h1>
                </div>
                <div class="col-md-6">
                    <div class="card card-info card-annoucement card-round">
                        <div class="card-body text-center">
                            <div class="card-opening">Manage Siswa</div>
                            <div class="card-desc">
                                Klik Menu Ini Untuk Melihat, dan Mengedit Data Siswa
                            </div>
                            <div class="card-detail">
                                <a href="{{ url('admin/student/manage') }}">
                                    <div class="btn btn-light btn-rounded">Manage Siswa</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card card-info card-annoucement card-round">
                        <div class="card-body text-center">
                            <div class="card-opening">Manage Kelompok</div>
                            <div class="card-desc">
                                Klik Menu Ini Untuk Melihat dan Mengedit Data Kelompok
                            </div>
                            <div class="card-detail">
                                <a href="{{ url('admin/group/manage') }}">
                                    <div class="btn btn-light btn-rounded">Manage Kelompok</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xs-6">
                    <div class="card card-info card-annoucement card-round">
                        <div class="card-body text-center">
                            <div class="card-opening">Manage Data Guru</div>
                            <div class="card-desc">
                                Klik Menu Ini Untuk Melihat dan Mengedit Data Guru/Pembimbing
                            </div>
                            <div class="card-detail">
                                <a href="{{ url('mentor/profile') }}">
                                    <div class="btn btn-light btn-rounded">Edit Data Guru</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xs-6">
                    <div class="card card-info card-annoucement card-round">
                        <div class="card-body text-center">
                            <div class="card-opening">Lihat Setoran Siswa</div>
                            <div class="card-desc">
                                Klik Menu Ini Untuk Melihat dan Mendengarkan Setoran Siswa
                            </div>
                            <div class="card-detail">
                                <a href="{{ url('admin/task/manage') }}">
                                    <div class="btn btn-light btn-rounded">Manage Setoran Siswa</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card full-height">
                        <div class="card-header">
                            <div class="card-title">Aktivitas Terbaru Dari Kelompok Anda</div>
                            <a href="{{ url('mentor/tahfidz/task/') }}">Untuk Melihat Semua Setoran Terbaru Klik Disini</a>
                            </h4>
                            <br><br>
                        </div>
                        <div class="card-body">
                            <ol class="activity-feed">
                                <h4 data-aos="zoom-out">
                                    @forelse ($recent as $item)
                                        <li data-aos="zoom-out" class="feed-item 
                                @if ($item->id_submission % 3 == 0) feed-item-success @endif
                                            @if ($item->id_submission % 4 == 0)
                                                feed-item-secondary
                                            @endif
                                            @if ($item->id_submission % 5 == 0)
                                                feed-item-warning
                                            @endif
                                            @if ($item->id_submission % 2 == 0)
                                                feed-item-danger
                                            @endif
                                            ">
                                            <time class="date" datetime="9-25">{{ $item->created_at }}</time>
                                            <span class="text">{{ $item->student_name }} Menyetorkan <a
                                                    href="{{ url("mentor/tahfidz/task/$item->id_submission") }}">"{{ $item->start . ' ' . $item->end }}"</a></span><br>
                                            <div class="badge 
                                    @if ($item->status == 0) badge-warning @endif
                                                @if ($item->status == 1)
                                                    badge-success
                                                @endif
                                                ">{{ $item->status_text }}
                                            </div><br>
                                        </li>

                                    @empty
                                        <h2>Belum Ada Aktivitas Dari Siswa</h2>
                                    @endforelse
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if (session()->has('success'))
            <script>
                toastr.success('{{ session('
                    success ') }}', ' {{ Session::get('
                    success ') }}');

            </script>
        @elseif(session()-> has('error'))
            <script>
                toastr.error('{{ session('
                    error ') }}', ' {{ Session::get('
                    error ') }}');

            </script>

        @endif

    @endsection
