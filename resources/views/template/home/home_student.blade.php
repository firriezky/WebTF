@section('head-section')
    @include('main.home._styling_home_student')
@endsection

@section('script')
    @include('main.home.script_student')
@endsection

@section('main')

    <div class="panel-header bg-primary-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h2 class="text-white pb-2 fw-bold uppercase">Dashboard {{ Auth::user()->role }}</h2>
                    <h5 class="text-white op-7 mb-2">Welcome back, {{ Auth::user()->name }} <br>
                        {{ Auth::user()->motto }}
                    </h5>
                </div>
                <div class="ml-md-auto py-2 py-md-0">
                    <a href="#" class="btn btn-white btn-border btn-round mr-2">Manage</a>
                    <a href="#" class="btn btn-secondary btn-round">Add Customer</a>
                </div>
            </div>
        </div>
    </div>
    <div class="page-inner mt--5">

        <div class="row mt--2 border-primary">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Overall Statistic</div>
                        <div class="card-category">Daily information about statistics in system</div>
                        <div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
                            <div class="px-2 pb-2 pb-md-0 text-center">
                                <div id="circles-1"></div>
                                <h6 class="fw-bold mt-3 mb-0">Jumlah Kelas Yang Anda Ikuti</h6>
                            </div>
                            <div class="px-2 pb-2 pb-md-0 text-center">
                                <div id="circles-2"></div>
                                <h6 class="fw-bold mt-3 mb-0">Porfolio</h6>
                            </div>
                            <div class="px-2 pb-2 pb-md-0 text-center">
                                <div id="circles-3"></div>
                                <h6 class="fw-bold mt-3 mb-0">Blog Anda</h6>
                            </div>
                        </div>
                    </div>
                </div>


                <ul class="list-group list-group-bordered " style="max-height: 190px; overflow:scroll; overflow-x:hidden">
                    <li class="list-group-item active">Daftar Kelasku</li>
                    @forelse ($classRegistered as $data)
                        <div class="row list-group-item">
                            <div class="col-6">
                                <li class="list-group-item">{{ $data->course_title }}</li>
                            </div>
                            <div class="col-6">
                                <a href="{{ url("/lesson/$data->id") }}">
                                    <button type="submit" class="btn btn-outline-primary btn-block">Lanjutkan Belajar</button>
                                </a>
                            </div>
                        </div>

                    @empty
                        <div class="alert alert-primary" role="alert">
                            <strong>Anda Belum Mendaftar di Kelas Manapun</strong>
                        </div>
                    @endforelse
                </ul>


            </div>
            <div class="col-md-6">
                <div class="card ">
                    <div class="card-header">
                        <div class="card-head-row">
                            <div class="card-title">Statistik Anda</div>
                            <div class="card-tools">
                                <a href="#" class="btn btn-info btn-border btn-round btn-sm mr-2">
                                    <span class="btn-label">
                                        <i class="fa fa-pencil"></i>
                                    </span>
                                    Export
                                </a>
                                <a href="#" class="btn btn-info btn-border btn-round btn-sm">
                                    <span class="btn-label">
                                        <i class="fa fa-print"></i>
                                    </span>
                                    Print
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="statisticsChart"></canvas>
                        </div>
                        <div id="myChartLegend"></div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card"> {{-- card --}}
                    <div class="">{{-- card-header --}}
                        <h4 class="card-title d-none">Nav Pills Without Border (Horizontal Tabs)</h4>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-pills nav-secondary nav-pills-no-bd d-flex justify-content-center" id="pills-tab-without-border" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-home-tab-nobd" data-toggle="pill" href="#pills-home-nobd" role="tab" aria-controls="pills-home-nobd" aria-selected="true">Kelas Yang Sedang Anda Ikuti</a>
                            </li>
                            <li class="nav-item d-none">
                                <a class="nav-link" id="pills-profile-tab-nobd" data-toggle="pill" href="#pills-profile-nobd" role="tab" aria-controls="pills-profile-nobd" aria-selected="false">Detail Progress Kelas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-contact-tab-nobd" data-toggle="pill" href="#pills-contact-nobd" role="tab" aria-controls="pills-contact-nobd" aria-selected="false">Cari Kelas Baru</a>
                            </li>
                        </ul>
                        <div class="tab-content mt-2 mb-3" id="pills-without-border-tabContent">
                            <div class="tab-pane fade show active" id="pills-home-nobd" role="tabpanel" aria-labelledby="pills-home-tab-nobd">
                                <div class="">
                                    <div class="">
                                        <div class="card-head-row card-tools-still-right">
                                            <h4 class="card-title">Daftar Kelas Yang Sedang Anda Ikuti</h4>

                                        </div>
                                        <p class="card-category">
                                            Kelas Yang Saat Ini Anda Pelajari</p>
                                    </div>
                                    <div class="card-body">
                                        <div class="row row-eq-height">
                                            @forelse ($classRegistered as $data)
                                                <div class="col-lg-4 col-sm-6 my-2">
                                                    <div class="album-poster-parent" style="background-color: white !important">
                                                        <a href="javascript:void();" class="album-poster" data-switch="0">
                                                            <img class="fufufu" onerror="this.onerror=null; this.src='./assets/album/n5'" src="{{ Storage::url('public/class/cover/') . $data->course_cover_image }}" alt="La Noyee">
                                                        </a>
                                                        <br>
                                                        <div class="course-info">
                                                            <h4>{{ $data->course_title }}</h4>

                                                        </div>
                                                        <p><span class="badge badge-primary">{{ $data->course_category }}</span></p>

                                                        <div class="d-flex">
                                                            <div class="avatar">
                                                                <img src="{{ Storage::url('public/profile/') . $data->mentor_profile_url }}" alt="..." class="avatar-img rounded-circle">
                                                            </div>
                                                            <div class="info-post ml-2">
                                                                <p style="margin-bottom: 1px !important" class="username">{{ $data->mentor_name }}</p>
                                                                {{ $data->created_at }}
                                                            </div>
                                                        </div>

                                                        <div class="mt-2">
                                                            <a href="{{ url("/lesson/$data->id") }}">
                                                                <button type="submit" class="btn btn-outline-primary btn-xs btn-block mb-2">Lanjutkan Belajar</button>
                                                            </a>
                                                            <form action="{{ route('course.drop') }}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                <input class="d-none" type="text" name="course_id" value="{{ $data->id }}" id="">
                                                                <button type="submit" class="btn btn-outline-danger btn-xs">Arsipkan Kelas</button>
                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>

                                                {{-- <p>{{ $data->mentor_name }}</p> --}}
                                            @empty
                                                <div class="alert alert-primary" role="alert">
                                                    <strong>Anda Belum Mendaftar di Kelas Manapun</strong>
                                                </div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-profile-nobd" role="tabpanel" aria-labelledby="pills-profile-tab-nobd">
                                <h3>1. Bikin Rumah Lucu</h3>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped bg-warning progress-bar-animated" role="progressbar" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100" style="width: 15%"></div>
                                </div>
                                <h3>2. Belajar Bikin Rumah</h3>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-contact-nobd" role="tabpanel" aria-labelledby="pills-contact-tab-nobd">
                                <div class="">
                                    <div class="">
                                        <div class="card-head-row card-tools-still-right">
                                            <h4 class="card-title">Daftar Ke Kelas Lain</h4>

                                        </div>
                                        <p class="card-category">
                                            Cari Kelas Lain Yang Mungkin Menarik Untuk Dipelajari</p>
                                    </div>
                                    <div class="card-body">
                                        <div class="row row-eq-height">
                                            @forelse ($classes as $data)
                                                <div class="col-lg-4 col-sm-6 my-2">
                                                    <div class="album-poster-parent" style="background-color: white !important">
                                                        <a href="javascript:void();" class="album-poster" data-switch="0">
                                                            <img class="fufufu" onerror="this.onerror=null; this.src='./assets/album/n5'" src="{{ Storage::url('public/class/cover/') . $data->course_cover_image }}" alt="La Noyee">
                                                        </a>
                                                        <br>
                                                        <div class="course-info">
                                                            <h4>{{ $data->course_title }}</h4>

                                                        </div>
                                                        <p><span class="badge badge-primary">{{ $data->course_category }}</span></p>

                                                        <div class="d-flex">
                                                            <div class="avatar">
                                                                <img src="{{ Storage::url('public/profile/') . $data->profile_url }}" alt="..." class="avatar-img rounded-circle">
                                                            </div>
                                                            <div class="info-post ml-2">
                                                                <p style="margin-bottom: 1px !important" class="username">{{ $data->mentor_name }}</p>
                                                                {{ $data->created_at }}
                                                            </div>
                                                        </div>

                                                        <div class="mt-2">
                                                            <a href="{{ url("/lesson/$data->id") }}">
                                                                <button type="submit" class="btn btn-primary btn-xs btn-block mb-2">Lihat Kelas</button>
                                                            </a>
                                                            <form action="{{ route('course.register') }}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                <input class="d-none" type="text" name="course_id" value="{{ $data->id }}" id="">
                                                                <button type="submit" class="btn btn-outline-primary btn-xs">Daftar Kelas Ini</button>
                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>

                                                {{-- <p>{{ $data->mentor_name }}</p> --}}
                                            @empty
                                                <div class="alert alert-primary" role="alert">
                                                    <strong>Belum Ada Kelas Tersedia</strong>
                                                </div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-12">

            </div>

            <div class="row d-none">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Top Products</div>
                        </div>
                        <div class="card-body pb-0">
                            <div class="d-flex">
                                <div class="avatar">
                                    <img src="../assets/img/logoproduct.svg" alt="..." class="avatar-img rounded-circle">
                                </div>
                                <div class="flex-1 pt-1 ml-2">
                                    <h6 class="fw-bold mb-1">CSS</h6>
                                    <small class="text-muted">Cascading Style Sheets</small>
                                </div>
                                <div class="d-flex ml-auto align-items-center">
                                    <h3 class="text-info fw-bold">+$17</h3>
                                </div>
                            </div>
                            <div class="separator-dashed"></div>
                            <div class="d-flex">
                                <div class="avatar">
                                    <img src="../assets/img/logoproduct.svg" alt="..." class="avatar-img rounded-circle">
                                </div>
                                <div class="flex-1 pt-1 ml-2">
                                    <h6 class="fw-bold mb-1">J.CO Donuts</h6>
                                    <small class="text-muted">The Best Donuts</small>
                                </div>
                                <div class="d-flex ml-auto align-items-center">
                                    <h3 class="text-info fw-bold">+$300</h3>
                                </div>
                            </div>
                            <div class="separator-dashed"></div>
                            <div class="d-flex">
                                <div class="avatar">
                                    <img src="../assets/img/logoproduct3.svg" alt="..." class="avatar-img rounded-circle">
                                </div>
                                <div class="flex-1 pt-1 ml-2">
                                    <h6 class="fw-bold mb-1">Ready Pro</h6>
                                    <small class="text-muted">Bootstrap 4 Admin Dashboard</small>
                                </div>
                                <div class="d-flex ml-auto align-items-center">
                                    <h3 class="text-info fw-bold">+$350</h3>
                                </div>
                            </div>
                            <div class="separator-dashed"></div>
                            <div class="pull-in">
                                <canvas id="topProductsChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title fw-mediumbold">Suggested People</div>
                            <div class="card-list">
                                <div class="item-list">
                                    <div class="avatar">
                                        <img src="../assets/img/jm_denis.jpg" alt="..." class="avatar-img rounded-circle">
                                    </div>
                                    <div class="info-user ml-3">
                                        <div class="username">Jimmy Denis</div>
                                        <div class="status">Graphic Designer</div>
                                    </div>
                                    <button class="btn btn-icon btn-primary btn-round btn-xs">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                                <div class="item-list">
                                    <div class="avatar">
                                        <img src="../assets/img/chadengle.jpg" alt="..." class="avatar-img rounded-circle">
                                    </div>
                                    <div class="info-user ml-3">
                                        <div class="username">Chad</div>
                                        <div class="status">CEO Zeleaf</div>
                                    </div>
                                    <button class="btn btn-icon btn-primary btn-round btn-xs">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                                <div class="item-list">
                                    <div class="avatar">
                                        <img src="../assets/img/talha.jpg" alt="..." class="avatar-img rounded-circle">
                                    </div>
                                    <div class="info-user ml-3">
                                        <div class="username">Talha</div>
                                        <div class="status">Front End Designer</div>
                                    </div>
                                    <button class="btn btn-icon btn-primary btn-round btn-xs">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                                <div class="item-list">
                                    <div class="avatar">
                                        <img src="../assets/img/mlane.jpg" alt="..." class="avatar-img rounded-circle">
                                    </div>
                                    <div class="info-user ml-3">
                                        <div class="username">John Doe</div>
                                        <div class="status">Back End Developer</div>
                                    </div>
                                    <button class="btn btn-icon btn-primary btn-round btn-xs">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                                <div class="item-list">
                                    <div class="avatar">
                                        <img src="../assets/img/talha.jpg" alt="..." class="avatar-img rounded-circle">
                                    </div>
                                    <div class="info-user ml-3">
                                        <div class="username">Talha</div>
                                        <div class="status">Front End Designer</div>
                                    </div>
                                    <button class="btn btn-icon btn-primary btn-round btn-xs">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                                <div class="item-list">
                                    <div class="avatar">
                                        <img src="../assets/img/jm_denis.jpg" alt="..." class="avatar-img rounded-circle">
                                    </div>
                                    <div class="info-user ml-3">
                                        <div class="username">Jimmy Denis</div>
                                        <div class="status">Graphic Designer</div>
                                    </div>
                                    <button class="btn btn-icon btn-primary btn-round btn-xs">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-primary bg-primary-gradient">
                        <div class="card-body">
                            <h4 class="mt-3 b-b1 pb-2 mb-4 fw-bold">Active user right now</h4>
                            <h1 class="mb-4 fw-bold">17</h1>
                            <h4 class="mt-3 b-b1 pb-2 mb-5 fw-bold">Page view per minutes</h4>
                            <div id="activeUsersChart"></div>
                            <h4 class="mt-5 pb-3 mb-0 fw-bold">Top active pages</h4>
                            <ul class="list-unstyled">
                                <li class="d-flex justify-content-between pb-1 pt-1"><small>/product/readypro/index.html</small>
                                    <span>7</span>
                                </li>
                                <li class="d-flex justify-content-between pb-1 pt-1"><small>/product/atlantis/demo.html</small>
                                    <span>10</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row d-none">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Feed Activity</div>
                        </div>
                        <div class="card-body">
                            <ol class="activity-feed">
                                <li class="feed-item feed-item-secondary">
                                    <time class="date" datetime="9-25">Sep 25</time>
                                    <span class="text">Responded to need <a href="#">"Volunteer opportunity"</a></span>
                                </li>
                                <li class="feed-item feed-item-success">
                                    <time class="date" datetime="9-24">Sep 24</time>
                                    <span class="text">Added an interest <a href="#">"Volunteer Activities"</a></span>
                                </li>
                                <li class="feed-item feed-item-info">
                                    <time class="date" datetime="9-23">Sep 23</time>
                                    <span class="text">Joined the group <a href="single-group.php">"Boardsmanship
                                            Forum"</a></span>
                                </li>
                                <li class="feed-item feed-item-warning">
                                    <time class="date" datetime="9-21">Sep 21</time>
                                    <span class="text">Responded to need <a href="#">"In-Kind Opportunity"</a></span>
                                </li>
                                <li class="feed-item feed-item-danger">
                                    <time class="date" datetime="9-18">Sep 18</time>
                                    <span class="text">Created need <a href="#">"Volunteer Opportunity"</a></span>
                                </li>
                                <li class="feed-item">
                                    <time class="date" datetime="9-17">Sep 17</time>
                                    <span class="text">Attending the event <a href="single-event.php">"Some New
                                            Event"</a></span>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card full-height">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title">Support Tickets</div>
                                <div class="card-tools">
                                    <ul class="nav nav-pills nav-secondary nav-pills-no-bd nav-sm" id="pills-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-today" data-toggle="pill" href="#pills-today" role="tab" aria-selected="true">Today</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link active" id="pills-week" data-toggle="pill" href="#pills-week" role="tab" aria-selected="false">Week</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-month" data-toggle="pill" href="#pills-month" role="tab" aria-selected="false">Month</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="avatar avatar-online">
                                    <span class="avatar-title rounded-circle border border-white bg-info">J</span>
                                </div>
                                <div class="flex-1 ml-3 pt-1">
                                    <h6 class="text-uppercase fw-bold mb-1">Joko Subianto <span class="text-warning pl-3">pending</span></h6>
                                    <span class="text-muted">I am facing some trouble with my viewport. When i start my</span>
                                </div>
                                <div class="float-right pt-1">
                                    <small class="text-muted">8:40 PM</small>
                                </div>
                            </div>
                            <div class="separator-dashed"></div>
                            <div class="d-flex">
                                <div class="avatar avatar-offline">
                                    <span class="avatar-title rounded-circle border border-white bg-secondary">P</span>
                                </div>
                                <div class="flex-1 ml-3 pt-1">
                                    <h6 class="text-uppercase fw-bold mb-1">Prabowo Widodo <span class="text-success pl-3">open</span></h6>
                                    <span class="text-muted">I have some query regarding the license issue.</span>
                                </div>
                                <div class="float-right pt-1">
                                    <small class="text-muted">1 Day Ago</small>
                                </div>
                            </div>
                            <div class="separator-dashed"></div>
                            <div class="d-flex">
                                <div class="avatar avatar-away">
                                    <span class="avatar-title rounded-circle border border-white bg-danger">L</span>
                                </div>
                                <div class="flex-1 ml-3 pt-1">
                                    <h6 class="text-uppercase fw-bold mb-1">Lee Chong Wei <span class="text-muted pl-3">closed</span></h6>
                                    <span class="text-muted">Is there any update plan for RTL version near future?</span>
                                </div>
                                <div class="float-right pt-1">
                                    <small class="text-muted">2 Days Ago</small>
                                </div>
                            </div>
                            <div class="separator-dashed"></div>
                            <div class="d-flex">
                                <div class="avatar avatar-offline">
                                    <span class="avatar-title rounded-circle border border-white bg-secondary">P</span>
                                </div>
                                <div class="flex-1 ml-3 pt-1">
                                    <h6 class="text-uppercase fw-bold mb-1">Peter Parker <span class="text-success pl-3">open</span></h6>
                                    <span class="text-muted">I have some query regarding the license issue.</span>
                                </div>
                                <div class="float-right pt-1">
                                    <small class="text-muted">2 Day Ago</small>
                                </div>
                            </div>
                            <div class="separator-dashed"></div>
                            <div class="d-flex">
                                <div class="avatar avatar-away">
                                    <span class="avatar-title rounded-circle border border-white bg-danger">L</span>
                                </div>
                                <div class="flex-1 ml-3 pt-1">
                                    <h6 class="text-uppercase fw-bold mb-1">Logan Paul <span class="text-muted pl-3">closed</span></h6>
                                    <span class="text-muted">Is there any update plan for RTL version near future?</span>
                                </div>
                                <div class="float-right pt-1">
                                    <small class="text-muted">2 Days Ago</small>
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
