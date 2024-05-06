<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                    <span></span>
                </div>
            </li>
            <li class="heading">
                <h3 class="uppercase">Menu de Navegación</h3>
            </li>
            <?php foreach($permissions as $k => $v){ ?>
                <li class="nav-item <?php echo ($active == $v['menu_active'] || $parent == $v['menu_active']) ? 'start active open' : ' ' ?>">
                    <a href="<?php echo (count($v['children'])) ? '#' : URL::route($v['location']) ?>" class="nav-link nav-toggle">
                        <?php
                        if( strpos($v["icon"],"png") !==false){
                            ?>
                        <img src="<?php echo asset("icons/".$v["icon"]); ?>" />
                        <?php
                        }else{
                        ?>
                        <i class="fa <?php echo $v['icon']?>"></i>
                        <?php

                        } ?>

                        <span class="title"><?php echo $v['name'] ?> <?php echo $v["location"] == "ticket" && $tickets >0 ? '<span class="label label-warning pull-right">'.$tickets.'</span>' : "" ?></span>
                        @if(count($v['children']))
                            <span class="arrow"></span>
                        @endif
                    </a>
                    <?php if(count($v['children'])){?>
                        <ul class="sub-menu">
                            <?php foreach($v['children'] as $k2 => $v2) {?>
                                <li class="nav-item  <?php if($active == $v2['menu_active']) echo 'start open active' ?>">
                                    <a href="{{ route($v2['location']) }}" class="nav-link ">
                                        <i class="fa <?php echo $v2['icon']?>"></i>
                                        <span class="title"><?php echo $v2['name'];?></span>
                                    </a>
                                </li>
                            <?php }?>
                        </ul>
                    <?php }?>
                </li>
            <?php }?>
        </ul>
    </div>
</div>