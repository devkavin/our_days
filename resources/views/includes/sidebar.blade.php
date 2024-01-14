<div class="sidebar">
    <div class="sidebar-inner">
        <div class="sidebar-close d-block d-lg-none">
            <i class="far fa-times-circle"></i>
        </div>
        <div class="logo-wrap">
            {{-- <img src="{{ asset('images/SLTMobitel_Logo.png') }}" alt="logo" /> --}}
        </div>
        <div class="link-item-wrap">
            <a href="{{ route('profile.index') }}" class="item-link {{ request()->is('profile') ? 'active' : '' }}">
                <i class="fas fa-book"></i>
                <span>Profile</span>
            </a>
        </div>
    </div>
</div>
