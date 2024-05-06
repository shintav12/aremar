<!DOCTYPE html>
<html>
    <head>
        <title>Joyas Aremar</title>
        <link href="{{asset("plugin/bootstrap/css/bootstrap.min.css")}}" rel="stylesheet" type="text/css" />
        <link href="{{asset("plugin/toastr/toastr.min.css")}}" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="{{ asset('icons/favicon.png') }}" type="image/x-icon" />
        <link href="{{asset("styles.css")}}" rel="stylesheet" type="text/css" />
        <style>
            .container {
                position: relative;
            }
            .header_image {
                display: block;
                width: 100%;
            }
            .content_container {
                height: 90%;
            }
            .header-container-parent {
                padding: 0px 10%;
            }
            .content {
                float: left;
                position: absolute;
                left: 0px;
                top: 0px;
                z-index: 2;
                height: 100%;
                padding: 5px;
                color: #fff;
                font-weight: 500;
            }
            .pre_crumb {
                color: white;
            }
            .breadcrumb {
                display: flex;
                flex-wrap: wrap;
                padding: 0.75rem 0rem;
                margin-bottom: 1rem;
                list-style: none;
                background-color: transparent;
                border-radius: 0.25rem;
            }
            .title_container {
                display: flex;
                text-align: left;
                height: 100%;
                justify-content: space-around;
                flex-direction: column;
            }
            .centered-div {
                display: flex;
                justify-content: flex-start;
                flex-direction: column;
            }
            .primary_tile {
                color: #b3a0a2;
                font-size: 3.8rem;
                line-height: 80px;
                font-weight: 500;
            }
            .secondary_title {
                font-size: 1.4rem;
                color: #dfd0cb;
            }
            .btn-custom {
                margin-top: 15px;
                background-color: white;
                color: #b3a0a2;
                padding: 0.3rem 1.5rem !important;
                font-size: 1.5rem;
                font-weight: 500;
            }
            .btn-custom:hover {
                color: white;
                background-color: #b3a0a2;
            }
            @media (max-width: 1024px) {
                .primary_tile {
                    font-size: 2.3rem;
                    line-height: 1;
                }
                .header-container-parent {
                    padding: 0px;
                }
                .secondary_title {
                    font-size: 1.5rem;
                }
            }
            @media (max-width: 768px) {
                .content_container {
                    height: 100%;
                }
                .primary_tile {
                    font-size: 3rem;
                    line-height: 1;
                }
                .header-container-parent {
                    padding: 0px;
                }
                .secondary_title {
                    font-size: 2rem;
                }
                .breadcrumb_container {
                    display: none;
                }
            }
            @media (max-width: 425px) {
                .header_image {
                    display: block;
                    width: 100%;
                }
                .secondary_title {
                    font-size: 2rem;
                }
                .header-container-parent {
                    padding: 0px;
                }
                .primary_tile {
                    font-size: 3rem;
                }
                .btn-custom {
                    padding: 0.1rem 0.8rem !important;
                    font-size: 1rem;
                }
            }
            .content-carousel {
  width: 600px;
  display: block;
  margin: 0 auto;
}
.owl-carousel {
  width: calc(100% - 75px);
}
.owl-carousel div {
  width: 100%;
}
.owl-carousel .owl-controls .owl-dot {
  background-size: cover;
  margin-top: 10px;
}
.owl-carousel .owl-dots {
  position: absolute;
  top: 0;
  left: -75px;
  width: 70px;
  height: 100%;
}
.owl-carousel .owl-dot {
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}
html, body {
  height: 100%;
}
        </style>

        @yield('css')
    </head>
    <body>
        @include('components.layout.cart')
        <div id="overlay"></div>
        <div id="main" class="h-100">
            @include('components.layout.navbar')
            @yield('body')
            @include('components.layout.footer')
        </div>
        <script src="{{asset("plugin/jquery.min.js") }}" type="text/javascript"></script>
        <script src="{{asset("plugin/ladda/spin.min.js") }}" type="text/javascript"></script>
        <script src="https://kit.fontawesome.com/ba1e8590a0.js" type="text/javascript"></script>
        <script src="{{asset("plugin/ladda/ladda.min.js") }}" type="text/javascript"></script>
        <script src="{{asset("plugin/bootstrap/js/bootstrap.min.js")}}" type="text/javascript"></script>
        <script src="{{asset("plugin/jquery-validation/js/jquery.validate.min.js")}}" type="text/javascript"></script>
        <script src="{{asset("plugin/jquery-validation/js/additional-methods.min.js")}}" type="text/javascript"></script>
        <script src="{{asset("plugin/toastr/toastr.min.js") }}" type="text/javascript"></script>
        <script>
            $('#toggle-menu').click(function(){
                console.log('entro');
                if($('#mySidenav').hasClass('openNav')){
                    $('#mySidenav').removeClass('openNav')
                }else{
                    $('#mySidenav').addClass('openNav')
                }
            });
            function toggleMenu(){
                var element = document.getElementById('mySidenav');
                var overlay = document.getElementById('overlay');
                if(hasClass(element, 'openNav')){
                    element.classList.remove('openNav');
                    overlay.classList.remove('openOverlay');
                }else{
                    element.classList.add('openNav');
                    overlay.classList.add('openOverlay');
                }
            }


            function hasClass( target, className ) {
                return new RegExp('(\\s|^)' + className + '(\\s|$)').test(target.className);
            }

        </script>
        @yield('js')
    </body>
</html>
