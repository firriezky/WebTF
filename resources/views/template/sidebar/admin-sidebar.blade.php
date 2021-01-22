<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="https://www.lansweeper.com/wp-content/uploads/2018/05/ASSET-USER-ADMIN.png" alt="profile"
                        class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            {{ Auth::user()->name }}
                            <span style="text-transform: capitalize;" class="user-level">{{ Auth::user()->role }}</span>
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



                <li class="nav-item active">
                    <a data-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="dashboard">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ url('/admin') }}">
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

                <li class="nav-item  {{ (Request::is('admin/notification/*')) ? 'active' : ''}}">
                    <a data-toggle="collapse" href="#az">
                        <i class="fas fa-bullhorn"></i>
                        <p>Push Notification</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse  {{ (Request::is('admin/notification/*')) ? 'show' : ''}}" id="az">
                        <ul class="nav nav-collapse">
                            <li class="{{ (Request::is('admin/notification/broadcast')) ? 'active' : ''}}">
                                <a href="{{url('admin/notification/broadcast')}}">
                                    <span class="sub-item">Push Notification</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item  {{ (Request::is('admin/agenda/*')) ? 'active' : ''}}">
                    <a data-toggle="collapse" href="#agenda">
                        <i class="fas fa-calendar-check"></i>
                        <p>Buat Agenda/Jadwal</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse  {{ (Request::is('admin/agenda/*')) ? 'show' : ''}}" id="agenda">
                        <ul class="nav nav-collapse">
                            <li class="{{ (Request::is('admin/agenda/create')) ? 'active' : ''}}">
                                <a href="{{url('admin/agenda/create')}}">
                                    <span class="sub-item">Buat Agenda</span>
                                </a>
                            </li>
                            <li class="{{ (Request::is('admin/agenda/manage')) ? 'active' : ''}}">
                                <a href="{{url('admin/agenda/manage')}}">
                                    <span class="sub-item">Manage Agenda</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>


                <li class="nav-item  {{ (Request::is('admin/student/*')) ? 'active' : ''}}">
                    <a data-toggle="collapse" href="#arts">
                        <i class="fas fa-users"></i>
                        <p>Siswa</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse  {{ (Request::is('admin/student/*')) ? 'show' : ''}}" id="arts">
                        <ul class="nav nav-collapse">

                            <li class="{{ (Request::is('admin/student/create')) ? 'active' : ''}}">
                                <a href="{{url('admin/student/create')}}">
                                    <span class="sub-item">Import Data Siswa</span>
                                </a>
                            </li>
                            <li class="{{ (Request::is('admin/student/manage')) ? 'active' : ''}}">
                                <a href="{{url('admin/student/manage')}}">
                                    <span class="sub-item">Manage Data Siswa</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item  {{ (Request::is('admin/group/*')) ? 'active' : ''}}">
                    <a data-toggle="collapse" href="#groupz">
                        <i class="fas fa-cubes"></i>
                        <p>Kelompok</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse  {{ (Request::is('admin/group/*')) ? 'show' : ''}}" id="groupz">
                        <ul class="nav nav-collapse">

                            <li class="{{ (Request::is('admin/group/manage')) ? 'active' : ''}}">
                                <a href="{{url('admin/group/manage')}}">
                                    <span class="sub-item">Manage Data Kelompok</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item  {{ (Request::is('admnin/mentor/*')) ? 'active' : ''}}">
                    <a data-toggle="collapse" href="#mentorz">
                        <i class="fas fa-user-tie"></i>
                        <p>Pembimbing</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse  {{ (Request::is('admin/mentor/*')) ? 'show' : ''}}" id="mentorz">
                        <ul class="nav nav-collapse">

                            <li class="{{ (Request::is('admin/mentor/create')) ? 'active' : ''}}">
                                <a href="{{url('admin/mentor/create')}}">
                                    <span class="sub-item">Import Data Mentor</span>
                                </a>
                            </li>
                            <li class="{{ (Request::is('admin/mentor/manage')) ? 'active' : ''}}">
                                <a href="{{url('admin/mentor/manage')}}">
                                    <span class="sub-item">Manage Data Mentor</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item  {{ (Request::is('admin/task/manage*')) ? 'active' : ''}}">
                    <a href="{{ url('admin/task/manage') }}">
                        <i class="fas fa-book-open"></i>
                        <span class="link-collapse">Setoran Siswa</span>
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