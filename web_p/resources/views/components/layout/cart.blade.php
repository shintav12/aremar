<div id="cartbar" class="sidenav right-bar">
    <a onclick="toggleCart()" style="cursor: pointer" class="closebtn">&times;</a>
    <a href="/" style="font-weight: 700;color:#818181;">
        Carrito de Compras
    </a>
    <hr>
    <div id="cart-wrapper" class="cart-wrapper">
        @if(isset($cart) && count($cart) > 0)
            @foreach ($cart as $item)
            <div id="{{$item->uuid}}" class="cart-wrapper-item">
                <div class="cart-image">
                    <img src="{{config('app.IMAGE_URL').$item->path}}" class="img-fluid" alt="">
                </div>
                <div class="cart-info ml-2">
                    <div class="item-name">
                        {{$item->name}}
                        <a data-id="{{$item->uuid}}" class="removeCart" style="cursor: pointer; padding: 0px">&times;</a>
                    </div>
                    <div class="item-metal">
                        M / {{$item->metal_name}}
                    </div>
                    <div class="item-price">
                        S/. {{$item->price}}
                    </div>
                </div>
            </div>
            @endforeach
        @else
        <div class="p-5">
            No hay elementos en el carrito
        </div>
        @endif
    </div>

    <div <?php if(!isset($cart) || count($cart) < 1) echo 'style="display:none;"';?> class="actions-cart-container">
        <hr>
        <div class="finaltotal">
            <div class="subtotal">
                Subtotal
            </div>
            <div id="sum" class="sum">
                <?php
                    if(isset($cart)){
                        $subtotal = 0;
                        foreach ($cart as $value) {
                            $subtotal  = $subtotal + $value->price;
                        }
                        echo 'S/.'.$subtotal;
                    }
                    else{
                        echo 0;
                    }
                ?>
            </div>
        </div>

        <div class="cart-buttons">
            <div class="button-item">
                <a onclick="toggleCart()" class="btn btn-custom btn-cart" style="border-color: #b3a0a2;" style="font-size: 1.2rem">
                    Seguir Viendo
                </a>
            </div>
            <div class="button-item">
            <?php if($user){?>
            <a href="{{url('checkout')}}" class="btn btn-primary" style="text-transform: none;font-size: 1.2rem;">
                Comprar
            </a>
            <?php } else{?>
            <div class="p-5" style="font-size: 18px">
                Debes estar logueado para poder comprar
            </div>
            <?php }?>
            </div>
        </div>
    </div>

</div>
