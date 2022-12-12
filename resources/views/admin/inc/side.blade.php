<aside id="sidebar-left" class="sidebar-left">

    <div class="sidebar-header">
        <div class="sidebar-title">
            Navigation
        </div>
        <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html"
            data-fire-event="sidebar-left-toggle">
            <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>

    <div class="nano">
        <div class="nano-content">
            <nav id="menu" class="nav-main" role="navigation">
                <ul class="nav nav-main">
                    <li class="nav-active">
                        <a href="{{route('dashboard.index')}}">
                            <i class="fa fa-dashboard" aria-hidden="true"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('dashboard.create')}}">
                            <i class="fa fa-share" aria-hidden="true"></i>
                            <span>Create New Post</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('adminpost')}}">
                            <i class="fa fa-list-alt" aria-hidden="true"></i>
                            <span>Admin Posts</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('subscriber')}}">
                            <i class="fa fa-list" aria-hidden="true"></i>
                            <span>Subscriber Lists</span>
                        </a>
                    </li>
                    <li class="nav-parent">
                        <a>
                            <i class="fa fa-users" aria-hidden="true"></i>
                            <span>Users</span>
                        </a>
                        <ul class="nav nav-children">
                            <li>
                                <a href="{{route('user-post.index')}}">
                                    User Posts
                                </a>
                            </li>
                            <li>
                                <a href="{{route('users')}}">
                                    User Accounts
                                </a>
                            </li>
                           
                        </ul>
                    </li>
                    {{--  --}}
               
                  
                    <li>
                        <a href="/"
                            target="_blank">
                            <i class="fa fa-external-link" aria-hidden="true"></i>
                            <span>Go To Website</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

    </div>

</aside>