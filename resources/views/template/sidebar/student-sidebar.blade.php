
<li class="nav-item {{ (Request::is('blog/*')) ? 'active' : ''}}">
    <a data-toggle="collapse" href="#base">
        <i class="fas fa-pen-alt"></i>
        <p>Blogs</p>
        <span class="caret"></span>
    </a>
    <div class="collapse  {{ (Request::is('blog/*')) ? 'show' : ''}}" id="base">
        <ul class="nav nav-collapse">
            <li>
                <a href="{{url('/blogs')}}">
                    <span class="sub-item">Lihat Blog</span>
                </a>
            </li>
            <li class="{{ (Request::is('blog/manage')) ? 'active' : ''}}">
                <a href="{{url('/blog/manage')}}">
                    <span class="sub-item">Manage Blog</span>
                </a>
            </li>
            <li class="{{ (Request::is('blog/create')) ? 'active' : ''}}">
                <a href="{{url('/blog/create')}}">
                    <span class="sub-item">Tulis Blog</span>
                </a>
            </li>
        </ul>
    </div>
</li>

<li class="nav-item  {{ (Request::is('portfolio/*')) ? 'active' : ''}}">
    <a data-toggle="collapse" href="#arts">
        <i class="fas fa-cubes"></i>
        <p>Karyaku</p>
        <span class="caret"></span>
    </a>
    <div class="collapse  {{ (Request::is('portfolio/*')) ? 'show' : ''}}" id="arts">
        <ul class="nav nav-collapse">
            <li>
                <a href="{{url('/portfolios')}}">
                    <span class="sub-item">Lihat Karya</span>
                </a>
            </li>
            <li class="{{ (Request::is('portfolio/create')) ? 'active' : ''}}">
                <a href="{{url('/portfolio/create')}}">
                    <span class="sub-item">Upload Karya</span>
                </a>
            </li>
            <li class="{{ (Request::is('portfolio/manage')) ? 'active' : ''}}">
                <a href="{{url('/portfolio/manage')}}">
                    <span class="sub-item">Manage Karya</span>
                </a>
            </li>
        </ul>
    </div>
</li>
{{-- <li class="nav-item {{ Request::is('submission') ? 'active' : '' }}">
    <a href="{{ url('/submission') }}">
        <i class="fas fa-tasks"></i>
        <p>Tugas/Project Kelas</p>
    </a>
</li> --}}
    