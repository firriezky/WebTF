@if (Auth::guard('student')->check())
@include('template.nav_bar.student')
@endif

@if (Auth::guard('mentor')->check())
@include('template.nav_bar.mentor')
@endif

@if (Auth::guard('web')->check())
@include('template.nav_bar.admin')
@endif
