<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('company.index') }}" class="nav-link {{ Request::is('company.index') ? 'active' : '' }}">
        <i class="nav-icon fas fa-laptop-house"></i>
        <p>Companies</p>
    </a>
</li>
