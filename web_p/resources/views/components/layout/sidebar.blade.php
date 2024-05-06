<div id="mySidenav" class="sidenav left-bar">
    <a onclick="toggleMenu()" style="cursor: pointer" class="closebtn">&times;</a>
    <a href="/">
        <img class="logo img-fluid" width="250px" src="{{asset('img/logos/logo-color.svg')}}"/>
    </a>
    @if(isset($sections))
        @foreach ($sections as $item)
        <a class="category-link" href="{{url('store/'.$item->slug)}}">
            {{$item->name}}
        </a>
        @endforeach
    @endif
    @if(isset($user))
    <a class="category-link" href="{{url('perfil')}}">{{$user->name}}</a>
    @else
    <a class="category-link" href="{{url('login')}}">Login / Registro</a>
    @endif
    <a class="category-link" href="{{url('about')}}">
        Us
    </a>
    <a class="category-link" href="{{url('contact')}}">
        Contact
    </a>
  </div>
