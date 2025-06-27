    <aside id="leftsidebar" class="sidebar">

        <!-- Menu -->
        <div class="menu">
            <ul class="list">

                <li class="header">Chức năng chính</li>
                
                <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="material-icons">dashboard</i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/sliders*') ? 'active' : '' }}">
                    <a href="{{ route('admin.sliders.index') }}">
                        <i class="material-icons">burst_mode</i>
                        <span>Quản lý banner</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/properties*') ? 'active' : '' }}">
                    <a href="{{ route('admin.properties.index') }}">
                        <i class="material-icons">home</i>
                        <span>Quản lý tài sản</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/features*') ? 'active' : '' }}">
                    <a href="{{ route('admin.features.index') }}">
                        <i class="material-icons">star</i>
                        <span>Quản lý tính năng đặc biệt</span>
                    </a>
                </li>

                <li class="{{ Request::is('admin/testimonials*') ? 'active' : '' }}">
                    <a href="{{ route('admin.testimonials.index') }}">
                        <i class="material-icons">view_carousel</i>
                        <span>Quản lý phản hồi khách hàng</span>
                    </a>
                </li> 

                <li class="{{ Request::is('admin/user-manager*') ? 'active' : '' }}">
                    <a href="{{ route('admin.user-manager.index') }}">
                        <i class="material-icons">supervised_user_circle</i>
                        <span>Quản lý người dùng</span>
                    </a>
                </li>

                 <li class="header">Bài</li>
                <li class="{{ Request::is('admin/categories*') ? 'active' : '' }}">
                    <a href="{{ route('admin.categories.index') }}">
                        <i class="material-icons">category</i>
                        <span>Quản lý thể loại bài viết</span>
                    </a>
                </li> 
                <li class="{{ Request::is('admin/tags*') ? 'active' : '' }}">
                    <a href="{{ route('admin.tags.index') }}">
                        <i class="material-icons">label</i>
                        <span>Quản lý thẻ tag</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/posts*') ? 'active' : '' }}">
                    <a href="{{ route('admin.posts.index') }}">
                        <i class="material-icons">library_books</i>
                        <span>Quản lý bài viết</span>
                    </a>
                </li>

                <li class="header"> Khác</li>
                <li class="{{ Request::is('admin/message*') ? 'active' : '' }}">
                    <a href="{{ route('admin.message') }}">
                        <i class="material-icons">message</i>
                        <span>Lịch hẹn</span>
                    </a>
                </li>
 
                <li class="{{ Request::is('admin/settings*') ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">settings</i>
                        <span>Cài đặt cá nhân</span>
                    </a>
                    <ul class="ml-menu">
                        <li class="{{ Request::is('admin/changepassword') ? 'active' : '' }}">
                            <a href="{{ route('admin.changepassword') }}">
                                <span>Đổi mật khẩu</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- #Menu -->
        
    </aside>