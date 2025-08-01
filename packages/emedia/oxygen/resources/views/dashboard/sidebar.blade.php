<div class="nav-headline">Menu</div>
<ul class="nav nav-pills nav-wide flex-column">
    <li><a href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
</ul>

<div class="nav-headline">Manage</div>
{{--@if ($user->can('view-permissions'))--}}
    <ul class="nav nav-pills nav-wide flex-column">
        @include('oxygen::dashboard.partials.menuBar', ['menuBarType' => 'sidebar.manage'])
        <li><a href="{{ route('manage.users.index') }}"><i class="fas fa-users"></i> Users</a></li>
        <li><a href="{{ route('access.index') }}"><i class="fas fa-user-shield"></i> Access Permissions</a></li>
    </ul>
{{--@endif--}}

{{--
<div class="nav-headline">Your Account</div>
<ul class="nav nav-pills nav-wide flex-column">
    <li><a href="{{ route('account.profile') }}"><i class="fas fa-user"></i> My Profile</a></li>
    <li><a href="{{ route('account.email') }}"><em class="fas fa-envelope"></em> Edit Email</a></li>
    <li><a href="{{ route('account.password') }}"><em class="fas fa-lock"></em> Edit Password</a></li>
    <li><a href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
</ul>
--}}