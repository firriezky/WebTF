<nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
    <div class="container-fluid">
        <div class="collapse d-none" id="search-nav">
            <form class="navbar-left navbar-form nav-search mr-md-3 d-none">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <button type="submit" class="btn btn-search pr-1">
                            <i class="fa fa-search search-icon"></i>
                        </button>
                    </div>
                    <input type="text" placeholder="Search ..." class="form-control">
                </div>
            </form>
        </div>
        <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
            <li class="nav-item dropdown hidden-caret">
                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                    <div class="row">
                        <div class="avatar-sm">
                            <img onerror="this.src='{{asset('img/img-error.jpg')}}?n={{time()}}';"
                                src="{{ "http://tahfidz.sditwahdahbtg.com/mentor/" . Auth::guard('web')->user()->url_profile }}?n={{time()}}"
                                alt="image profile" class="avatar-img rounded-circle">
                        </div>
                        <span class="text-white">{{Auth::guard('web')->user()->name}}</span>
                    </div>

                </a>
                <ul class="dropdown-menu dropdown-user animated fadeIn">
                    <div class="dropdown-user-scroll scrollbar-outer">
                        <li>
                            <div class="user-box">
                                <div class="avatar-lg"> <img
                                        onerror="this.src='{{asset('img/img-error.jpg')}}?n={{time()}}';"
                                        src="{{ "http://tahfidz.sditwahdahbtg.com/mentor/" . Auth::guard('web')->user()->url_profile }}"
                                        alt="image profile" class="avatar-img rounded-circle"></div>
                                <div class="u-text">
                                    <h4>{{Auth::guard('web')->user()->name}}</h4>
                                    <h4>{{Auth::guard('web')->user()->contact}}</h4>
                                    <p class="text-muted">{{ Auth::guard('web')->user()->email }}</p>
                                    <a href="{{url('mentor/profile')}}" class="btn btn-xs btn-secondary btn-sm">View
                                        Profile</a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                <span class="link-collapse">Logout</span>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </div>
                </ul>
            </li>

        </ul>

    </div>
</nav>