<!DOCTYPE html>
<html>
    <head>
        <title>Joyas Aremar</title>
        <link href="{{asset("plugin/bootstrap/css/bootstrap.min.css")}}" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="{{ asset('icons/favicon.png') }}" type="image/x-icon" />
        <link href="{{asset("plugin/toastr/toastr.min.css")}}" rel="stylesheet" type="text/css" />
        <link href="{{asset("styles.css")}}" rel="stylesheet" type="text/css" />

        @yield('css')
    </head>
    <body>
        @include('components.layout.sidebar')
        @include('components.layout.cart')
        <div id="overlay"></div>
        <div id="main">
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

            $('#toggle-cart').click(function(){
                var overlay = document.getElementById('overlay');
                if($('#cartbar').hasClass('openNav')){
                    $('#cartbar').removeClass('openNav')
                    overlay.classList.remove('openOverlay');
                }else{
                    $('#cartbar').addClass('openNav')
                    overlay.classList.add('openOverlay');
                }
            });


            $('body').on('click','.removeCart',function(){

                var id = $(this).data('id');
                $("#" + id).remove();
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: "{{ url('remove-cart') }}/" + id,
                    data: new FormData($("#form")[0]),
                    contentType: false,
                    processData: false,
                    beforeSend: function () {
                        swal({
                            title: 'Cargando...',
                            timer: 10000,
                            showCancelButton: false,
                            showConfirmButton: false,
                            onOpen: function () {
                                swal.showLoading()
                            }
                        });
                    },
                    success: function (data) {
                        var error = data.error;
                        if (error == 0) {
                            var sum = 0;
                            var cart = data.cart;
                            for (const item of Object.entries(cart)) {
                                sum = sum + item[1].price;
                            }
                            if(sum === 0){
                                $("#cart-wrapper").html('No hay elementos en el carrito');
                                $(".actions-cart-container").hide();
                            }
                            $("#sum").html('');
                            $("#sum").html('S./' + sum);
                            swal.close();
                        }
                    }, error: function () {
                        swal.close();
                        toastr.error('Hubo un problema');
                    }
                });

            });

            function toggleCart(){
                var element = document.getElementById('cartbar');
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
