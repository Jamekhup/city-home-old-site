
{{-- end --}}

    <div class="mobile">
        <div class="icons">
            <div class="one"></div>
            <div class="two"></div>
            <div class="three"></div>
        </div>
        <div class="m-logo">
            <img src="{{asset('img/logo.png')}}" alt="">
        </div>
        <li class="m-signin"><a href="{{route('login')}}">Sign in</a></li>
    </div>
    <nav class="mainNav">
        <ul class="mainUl">
            <li class="home"><a href="/">Home</a></li>
            <li class="buy"><a href="javascript:void(0)" class="buya">Buy</a>
                <div class="buyDrop">
                    <div class="row">
                        <div>
                            <a href="/property-for-sale/private-house/">Private House For Sale</a>
                            <a href="/property-for-sale/condo/">Condo For Sale</a>
                            <a href="/property-for-sale/apartment/">Apartment For Sale</a>
                        </div>
                        <div>
                            <a href="/property-for-sale/shop-and-store/">Shop and Store For Sale</a>
                            <a href="/property-for-sale/land/">Land For Sale</a>
                            <a href="/property-for-sale/industrial-zone-and-warehouse/">Industrial Zone and Warehouse For Sale</a>
                        </div>
                    </div>
                </div>
            </li>
            <li class="rent"><a href="javascript:void(0)" class="renta">Rent</a>
                <div class="rentDrop">
                    <div class="row">
                        <div>
                            <a href="/property-for-rent/private-house/">Private House For Rent</a>
                            <a href="/property-for-rent/condo/">Condo For Rent</a>
                            <a href="/property-for-rent/apartment/">Apartment For Rent</a>
                        </div>
                        <div>
                            <a href="/property-for-rent/shop-and-store/">Shop and Store For Rent</a>
                            <a href="/property-for-rent/land/">Land For Rent</a>
                            <a href="/property-for-rent/industrial-zone-and-warehouse/">Industrial Zone and Warehouse For Rent</a>
                        </div>
                    </div>
                </div>
            </li>
            <div class="logo">
                <img src="{{asset('img/logo.png')}}" alt="">
            </div>
            @if (Auth::check())
                
                <li class="advertise"><a href="javascript:void(0)" class="adsa">My Account</a>
                    <div class="adsDrop">
                        <div>
                            <a href="{{route('dashboard')}}" class="reg">Profile</a>
                            <form action="{{route('logout')}}" method="POST">
                                @csrf
                                <button>Logout</button>
                            </form>
                        </div>
                    </div>
                </li>
                <li class="signin"><a href="{{route('upload')}}">Upload</a></li>
                
            @else
                <li class="advertise"><a href="javascript:void(0)" class="adsa">Advertise</a>
                    <div class="adsDrop">
                        <div>
                            <a href="{{route('register')}}" class="reg">Register</a>
                            <a href="{{route('login')}}" class="log">Log in</a>
                        </div>
                    </div>
                </li>
                <li class="signin"><a href="{{route('login')}}">Sign in</a></li>
            @endif
        </ul>
    </nav>

