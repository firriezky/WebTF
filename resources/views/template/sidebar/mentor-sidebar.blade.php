<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img onerror="this.src='{{asset('img/img-error.jpg')}}?n={{time()}}';"
                        src="{{ "http://tahfidz.sditwahdahbtg.com/mentor/" . Auth::guard('mentor')->user()->url_profile}}?n={{time()}}"
                        alt="image profile" class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            {{ Auth::guard('mentor')->user()->name }}
                            <span style="text-transform: capitalize;" class="user-level">Dashboard Guru</span>
                            <span class="caret"></span>
                        </span>
                    </a>
                    <div class="clearfix"></div>
                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();">
                                    <span class="link-collapse">Logout</span>
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
            <ul class="nav nav-primary">

                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Menu</h4>
                </li>

                <li class="nav-item {{ (Request::is('mentor')) ? 'active' : ''}}">
                    <a href="{{url('/mentor')}}" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                    <div class="collapse" id="dashboard">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ url('/student') }}">
                                    <span class="sub-item">Go to Dashboard</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item  {{ Request::is('mentor/tahfidz/*') ? 'active submenu' : '' }}">
                    <a data-toggle="collapse" href="#messages-app-nav">
                        <i class="far fa-paper-plane"></i>
                        <p>Tahfidz</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ Request::is('mentor/tahfidz/*') ? 'show' : '' }}" id="messages-app-nav">
                        <ul class="nav nav-collapse">
                            <li class="{{(Request::is('mentor/tahfidz/student')) ? 'active' : ''}}">
                                <a href="{{url('mentor/tahfidz/student')}}">
                                    <span class="sub-item">Daftar Siswa Saya</span>
                                </a>
                            </li>
                            <li class="{{(Request::is('mentor/tahfidz/task')) ? 'active' : ''}}">
                                <a href="{{url('mentor/tahfidz/task')}}">
                                    <span class="sub-item">Kelompok Tahfidz</span>
                                </a>
                            </li>
                            <li class="{{(Request::is('mentor/tahfidz/quiz')) ? 'active' : ''}}">
                                <a href="{{url('mentor/tahfidz/quiz')}}">
                                    <span class="sub-item">Quiz Hafalan</span>
                                </a>
                            </li>
                            {{-- <li class="{{ (Request::is('mentor/tahfidz/quiz')) ? 'active' : ''}}">
                                <a href="{{url('mentor/tahfidz/quiz')}}">
                                    <span class="sub-item">Kuis Hafalan</span>
                                </a>
                            </li>
                            <li class="{{(Request::is('mentor/tahfidz/announce')) ? 'active' : ''}}">
                                <a href="{{url('mentor/tahfidz/announce')}}">
                                    <span class="sub-item">Lihat Setoran Siswa</span>
                                </a>
                            </li> --}}
                        </ul>
                    </div>
                </li>


     
                <li class="nav-item   {{ (Request::is('mentor/profile')) ? 'active' : ''}}">
                    <a href="{{ url('mentor/profile') }}">
                        <i class="fas fa-user-circle"></i>
                        <span class="link-collapse">Profile</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i>
                        <span class="link-collapse">Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>




            </ul>
        </div>
    </div>
</div>