<nav class="sidebar vertical-scroll  ps-container ps-theme-default ps-active-y">
    <div class="logo d-flex justify-content-between">
        <a href="index-2.html"><img src="/admin/img/logo.png" alt></a>
        <div class="sidebar_close_icon d-lg-none">
            <i class="ti-close"></i>
        </div>
    </div>
    <ul id="sidebar_menu">
        <li class>
            <a href="{{ route('admin.dashboard') }}" aria-expanded="false">
                <div class="icon_menu">
                    <img src="/admin/img/menu-icon/dashboard.svg" alt>
                </div>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="mm-active">
            <a class="has-arrow" href="#" aria-expanded="false">
                <div class="icon_menu">
                    <img src="/admin/img/menu-icon/2.svg" alt>
                </div>
                <span>Quản lý</span>
            </a>
            <ul>
                <li><a class="active" href="{{ route('users.index') }}">Người dùng</a></li>
                <li><a href="{{ route('categories.index') }}">Danh mục</a></li>
                <li><a href="{{ route('posts.index') }}">Tin tức</a></li>
            </ul>
        </li>
    </ul>
</nav>
