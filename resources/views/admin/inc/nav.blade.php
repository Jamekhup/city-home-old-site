<div class="logo-container">
    <a href="" class="logo">
        <img src="{{asset('img/logo.png')}}" height="35"/>
    </a>
    <div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html"
        data-fire-event="sidebar-left-opened">
        <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
    </div>
</div>

<!-- start: search & user box -->
<div class="header-right">

    <span class="separator"></span>

    <div id="userbox" class="userbox">
        <a href="#" data-toggle="dropdown">
        
            <div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@JSOFT.com">
                <span class="name">City Home Property</span>
                <span class="role">administrator</span>
            </div>

            <i class="fa custom-caret"></i>
        </a>

        <div class="dropdown-menu">
            <ul class="list-unstyled">
                <li class="divider"></li>
               
                <li>
                    <a onclick="event.preventDefault();document.getElementById('logoutForm').submit();" role="menuitem" tabindex="-1" href="#"><i class="fa fa-power-off"></i> Logout</a>
                    <form action="{{route('adminLogout')}}" method="POST" id="logoutForm">@csrf</form>
                </li>
            </ul>
        </div>
    </div>
</div>