@if (Auth::guard('student')->check())
@include('template.sidebar.student-sidebar')
@endif

@if (Auth::guard('mentor')->check())
@include('template.sidebar.mentor-sidebar')
@endif

@if (Auth::guard('web')->check())
@include('template.sidebar.admin-sidebar')
@endif