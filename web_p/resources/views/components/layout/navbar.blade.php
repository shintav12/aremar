<div >
    <div class="header-news">
      <div class="header-news-container">
        <div class="header-news-section first">
          <span class="info">
            <i class="fas fa-phone"></i> (+511) 946 651 539
          </span>
          <span class="info">|</span>
          <span class="info">
            <i class="far fa-envelope"></i> info@joyasaremar.com
          </span>
        </div>
        <div class="header-news-section middle">
          <strong>Delivery Gratis a partir de S/. 120.00</strong>
          <span class="ml-2 offer-link">Comprar ahora</span>
        </div>
        <div class="header-news-section last">
          <span>
            <a class="social-links" href="https://www.facebook.com/joyas.aremar" target="_blank"><i class="fab fa-facebook-square"></i></a>
          </span>
          <span>
            <a class="social-links" href="https://www.instagram.com/joyasaremar" target="_blank"><i class="fab fa-instagram-square"></i></a>
          </span>
        </div>
      </div>
    </div>
    <nav class="navbar sticky-top navbar-light d-none d-lg-block">
        <div class="nav-section-container">
            <div class="nav-section first d-flex" style="color: #B6AEAB;">
                @if(isset($user))
                <a class="category-link" href="{{url('profile')}}"><i class="fas fa-user mr-3"></i>{{$user->name}}</a>
                @else
                <a class="category-link" href="{{url('login')}}"><i class="fas fa-user mr-3"></i>Login / Registro</a>
                @endif
            </div>
            <div class="nav-section middle">
                <div class="row">
                    <div class="col-12 text-center mb-2">
                        <a class="home-link" href="{{url('/')}}">
                            <img width="35%" class="img-fluid" src="{{asset('img/logos/logo-color.svg')}}">
                        </a>
                        <div class="image-container sidebar-toggle justify-content-around">
                            <img width="35%" id="toggle-menu" class="img-fluid " src="{{asset('img/logos/logo-color.svg')}}">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="categories-container">
                            @if(isset($sections))
                                @foreach ($sections as $item)
                                <a class="category" href="{{url('store/'.$item->slug)}}">
                                    {{$item->name}}
                                </a>
                                @endforeach
                            @endif
                            <a class="category" href="{{url('us')}}">
                                Us
                            </a>
                            <a class="category" href="{{url('contact')}}">
                                Contact
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="nav-section last d-flex" style="color: #B6AEAB;">
                <span id="toggle-cart"><i  class="fas fa-shopping-bag"></i> Mi Carrito</span>
            </div>
        </div>
    </nav>
    <nav class="navbar sticky-top navbar-light d-block d-lg-none">
        <div class="nav-section-container">
            <div class="nav-section first">

            </div>
            <div class="nav-section middle">
                <div class="row">
                    <div class="col-12 text-center mb-2">
                        <img onclick="toggleMenu();"  id="toggle-menu" width="35%" class="img-fluid" src="{{asset('img/logos/logo-login-color.svg')}}">
                    </div>
                    <div class="col-12">
                        <div class="categories-container">
                            @if(isset($sections))
                                @foreach ($sections as $item)
                                <a class="category" href="{{url('tienda/'.$item->slug)}}">
                                    {{$item->name}}
                                </a>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="nav-section last">

            </div>
        </div>
    </nav>
  </div>
