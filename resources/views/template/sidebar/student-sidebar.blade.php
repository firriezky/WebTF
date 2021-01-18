<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-lg"> <img
                    onerror="this.src='{{asset('img/img-error.jpg')}}?n={{time()}}';"
                    src="{{ "http://tahfidz.sditwahdahbtg.com/student/" . Auth::guard('student')->user()->url_profile }}?n={{time()}}"
                    alt="image profile" class="avatar-img rounded-circle"></div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            {{ Auth::guard('student')->user()->name }}
                            <span style="text-transform: capitalize;" class="user-level">Student</span>
                            <span class="caret"></span>
                        </span>
                    </a>
                    <div class="clearfix"></div>


                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            {{-- <li>
                                <a href="{{ url('/profile') }}" class="active">
                                    <span class="link-collapse">My Profile</span>
                                </a>
                            </li> --}}
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



                <li class="nav-item {{ (Request::is('student')) ? 'active' : ''}}">
                    <a data-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                        <span class="caret"></span>
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

                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Menu</h4>
                </li>

                <li class="nav-item {{ (Request::is('student/task/create')) ? 'active' : ''}}">
                    <a href="{{ url('/student/task/create') }}">
                        <i class="fas fas fa-tasks"></i>
                        <span class="link-collapse">Kirim Bacaan/Setoran</span>
                    </a>
                </li>

                <li class="nav-item {{ (Request::is('student/task')) ? 'active' : ''}}">
                    <a href="{{ url('/student/task') }}">
                        <i class="fas fas fa-book-open"></i>
                        <span class="link-collapse">Lihat Nilai Setoran</span>
                    </a>
                </li>

                <li class="nav-item {{ (Request::is('student/group')) ? 'active' : ''}}">
                    <a href="{{ url('/student/group') }}">
                        <i class="fas fa-shapes"></i>
                        <span class="link-collapse">Kelompok Tahfidz</span>
                    </a>
                </li>

                <li class="nav-item   {{ (Request::is('student/profile')) ? 'active' : ''}}">
                    <a href="{{ url('student/profile') }}">
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