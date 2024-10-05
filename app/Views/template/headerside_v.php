<div class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar hidebar" style="overflow:auto;">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-devider"></li>
                <li class="nav-label">Home</li>
                <li>
                    <a class="" href="<?= base_url("utama"); ?>" aria-expanded="false">
                        <i class="fa fa-tachometer"></i><span class="hide-menu">Dashboard</span>
                    </a>

                </li>
                <?php 
                if (
                    (
                        isset(session()->get("position_administrator")[0][0]) 
                        && (
                            session()->get("position_administrator") == "1" 
                            || session()->get("position_administrator") == "2"
                        )
                    ) ||
                    (
                        isset(session()->get("halaman")['1']['act_read']) 
                        && session()->get("halaman")['1']['act_read'] == "1"
                    )
                ) { ?>
                <li class="nav-label">Master</li>
                <?php 
                if (
                    (
                        isset(session()->get("position_administrator")[0][0]) 
                        && (
                            session()->get("position_administrator") == "1" 
                            || session()->get("position_administrator") == "2"
                        )
                    ) ||
                    (
                        isset(session()->get("halaman")['28']['act_read']) 
                        && session()->get("halaman")['28']['act_read'] == "1"
                    )
                ) { ?>
                <li> 
                    <a class="  " href="<?= base_url("midentity"); ?>" aria-expanded="false"><i class="fa fa-building"></i><span class="hide-menu">Identitas</span></a>
                </li>
                <?php }?>
                <?php 
                if (
                    (
                        isset(session()->get("position_administrator")[0][0]) 
                        && (
                            session()->get("position_administrator") == "1" 
                            || session()->get("position_administrator") == "2"
                        )
                    ) ||
                    (
                        isset(session()->get("halaman")['34']['act_read']) 
                        && session()->get("halaman")['34']['act_read'] == "1"
                    )
                ) { ?>
                <li> 
                    <a class="  " href="<?= base_url("mbackground"); ?>" aria-expanded="false"><i class="fa fa-bookmark-o"></i><span class="hide-menu">Background</span></a>
                </li>
                <?php }?>
                <?php 
                if (
                    (
                        isset(session()->get("position_administrator")[0][0]) 
                        && (
                            session()->get("position_administrator") == "1" 
                            || session()->get("position_administrator") == "2"
                        )
                    ) ||
                    (
                        isset(session()->get("halaman")['29']['act_read']) 
                        && session()->get("halaman")['29']['act_read'] == "1"
                    )
                ) { ?>
                <li> 
                    <a class="  " href="<?= base_url("mslider"); ?>" aria-expanded="false"><i class="fa fa-bullseye"></i><span class="hide-menu">Slider</span></a>
                </li>
                <?php }?>
                <?php 
                if (
                    (
                        isset(session()->get("position_administrator")[0][0]) 
                        && (
                            session()->get("position_administrator") == "1" 
                            || session()->get("position_administrator") == "2"
                        )
                    ) ||
                    (
                        isset(session()->get("halaman")['30']['act_read']) 
                        && session()->get("halaman")['30']['act_read'] == "1"
                    )
                ) { ?>
                <li> 
                    <a class="  " href="<?= base_url("mabout"); ?>" aria-expanded="false"><i class="fa fa-question"></i><span class="hide-menu">About</span></a>
                </li>
                <?php }?>
                <?php 
                if (
                    (
                        isset(session()->get("position_administrator")[0][0]) 
                        && (
                            session()->get("position_administrator") == "1" 
                            || session()->get("position_administrator") == "2"
                        )
                    ) ||
                    (
                        isset(session()->get("halaman")['31']['act_read']) 
                        && session()->get("halaman")['31']['act_read'] == "1"
                    )
                ) { ?>
                <li> 
                    <a class="  " href="<?= base_url("msosmed"); ?>" aria-expanded="false"><i class="fa fa-star"></i><span class="hide-menu">Sosmed</span></a>
                </li>
                <?php }?>
                <?php 
                if (
                    (
                        isset(session()->get("position_administrator")[0][0]) 
                        && (
                            session()->get("position_administrator") == "1" 
                            || session()->get("position_administrator") == "2"
                        )
                    ) ||
                    (
                        isset(session()->get("halaman")['32']['act_read']) 
                        && session()->get("halaman")['32']['act_read'] == "1"
                    )
                ) { ?>
                <li> 
                    <a class="  " href="<?= base_url("mfacilities"); ?>" aria-expanded="false"><i class="fa fa-building"></i><span class="hide-menu">Facilities</span></a>
                </li>
                <?php }?>
                <?php 
                if (
                    (
                        isset(session()->get("position_administrator")[0][0]) 
                        && (
                            session()->get("position_administrator") == "1" 
                            || session()->get("position_administrator") == "2"
                        )
                    ) ||
                    (
                        isset(session()->get("halaman")['36']['act_read']) 
                        && session()->get("halaman")['36']['act_read'] == "1"
                    )
                ) { ?>
                <li> 
                    <a class="  " href="<?= base_url("moffer"); ?>" aria-expanded="false"><i class="fa fa-bookmark-o"></i><span class="hide-menu">Special Offer</span></a>
                </li>
                <?php }?>
                <?php 
                if (
                    (
                        isset(session()->get("position_administrator")[0][0]) 
                        && (
                            session()->get("position_administrator") == "1" 
                            || session()->get("position_administrator") == "2"
                        )
                    ) ||
                    (
                        isset(session()->get("halaman")['37']['act_read']) 
                        && session()->get("halaman")['37']['act_read'] == "1"
                    )
                ) { ?>
                <li> 
                    <a class="  " href="<?= base_url("mblog"); ?>" aria-expanded="false"><i class="fa fa-address-book"></i><span class="hide-menu">News</span></a>
                </li>
                <?php }?>
                <?php 
                if (
                    (
                        isset(session()->get("position_administrator")[0][0]) 
                        && (
                            session()->get("position_administrator") == "1" 
                            || session()->get("position_administrator") == "2"
                        )
                    ) ||
                    (
                        isset(session()->get("halaman")['38']['act_read']) 
                        && session()->get("halaman")['38']['act_read'] == "1"
                    )
                ) { ?>
                <li> 
                    <a class="  " href="<?= base_url("mgallery"); ?>" aria-expanded="false"><i class="fa fa-address-book"></i><span class="hide-menu">Gallery</span></a>
                </li>
                <?php }?>
                <?php 
                if (
                    (
                        isset(session()->get("position_administrator")[0][0]) 
                        && (
                            session()->get("position_administrator") == "1" 
                            || session()->get("position_administrator") == "2"
                        )
                    ) ||
                    (
                        isset(session()->get("halaman")['39']['act_read']) 
                        && session()->get("halaman")['39']['act_read'] == "1"
                    )
                ) { ?>
                <li> 
                    <a class="  " href="<?= base_url("mcontact"); ?>" aria-expanded="false"><i class="fa fa-address-book"></i><span class="hide-menu">Contact</span></a>
                </li>
                <?php }?>

                <?php 
                if (
                    (
                        isset(session()->get("position_administrator")[0][0]) 
                        && (
                            session()->get("position_administrator") == "1" 
                            || session()->get("position_administrator") == "2"
                        )
                    ) ||
                    (
                        isset(session()->get("halaman")['33']['act_read']) 
                        && session()->get("halaman")['33']['act_read'] == "1"
                    )
                ) { ?>
                <li> 
                    <a class="  " href="<?= base_url("mroom"); ?>" aria-expanded="false"><i class="fa fa-bookmark"></i><span class="hide-menu">Rooms</span></a>
                </li>
                <?php }?>
                
                <?php 
                if (
                    (
                        isset(session()->get("position_administrator")[0][0]) 
                        && (
                            session()->get("position_administrator") == "1" 
                            || session()->get("position_administrator") == "2"
                        )
                    ) ||
                    (
                        isset(session()->get("halaman")['40']['act_read']) 
                        && session()->get("halaman")['40']['act_read'] == "1"
                    )
                ) { ?>
                <li> 
                    <a class="  " href="<?= base_url("mmeetingrooms"); ?>" aria-expanded="false"><i class="fa fa-bookmark"></i><span class="hide-menu">Meeting Rooms</span></a>
                </li>
                <?php }?>
                
                <?php 
                if (
                    (
                        isset(session()->get("position_administrator")[0][0]) 
                        && (
                            session()->get("position_administrator") == "1" 
                            || session()->get("position_administrator") == "2"
                        )
                    ) ||
                    (
                        isset(session()->get("halaman")['2']['act_read']) 
                        && session()->get("halaman")['2']['act_read'] == "1"
                    )
                ) { ?>
                <li> 
                    <a class="has-arrow  " href="#" aria-expanded="false" data-toggle="collapse" data-target="#demo"><i class="fa fa-user"></i><span class="hide-menu">Manajemen User <span class="label label-rouded label-warning pull-right">2</span></span></a>
                    <ul aria-expanded="false" id="demo" class="collapse">
                        <?php 
                        if (
                            (
                                isset(session()->get("position_administrator")[0][0]) 
                                && (
                                    session()->get("position_administrator") == "1" 
                                    || session()->get("position_administrator") == "2"
                                )
                            ) ||
                            (
                                isset(session()->get("halaman")['3']['act_read']) 
                                && session()->get("halaman")['3']['act_read'] == "1"
                            )
                        ) { ?>
                        <li><a href="<?= base_url("mposition"); ?>"><i class="fa fa-caret-right"></i> &nbsp;Posisi</a></li>
                        <?php }?>
                        <?php 
                        if (
                            (
                                isset(session()->get("position_administrator")[0][0]) 
                                && (
                                    session()->get("position_administrator") == "1" 
                                    || session()->get("position_administrator") == "2"
                                )
                            ) ||
                            (
                                isset(session()->get("halaman")['5']['act_read']) 
                                && session()->get("halaman")['5']['act_read'] == "1"
                            )
                        ) { ?>
                        <li><a href="<?= base_url("muser"); ?>"><i class="fa fa-caret-right"></i> &nbsp;User</a></li>
                        <?php }?>
                    </ul>
                </li>
                <?php }?>

                
               

                <!-- <?php 
                if (
                    (
                        isset(session()->get("position_administrator")[0][0]) 
                        && (
                            session()->get("position_administrator") == "1" 
                            || session()->get("position_administrator") == "2"
                        )
                    ) ||
                    (
                        isset(session()->get("halaman")['10']['act_read']) 
                        && session()->get("halaman")['10']['act_read'] == "1"
                    )
                ) { ?>
                <li> 
                    <a class="  " href="<?= base_url("mcategory"); ?>" aria-expanded="false"><i class="fa fa-cubes"></i><span class="hide-menu">Kategori</span></a>
                </li>
                <?php }?> -->

                


                <?php }?>

               


                <!-- //Transaction// -->
                <?php 
                if (
                    (
                        isset(session()->get("position_administrator")[0][0]) 
                        && (
                            session()->get("position_administrator") == "1" 
                            || session()->get("position_administrator") == "2"
                        )
                    ) ||
                    (
                        isset(session()->get("halaman")['9']['act_read']) 
                        && session()->get("halaman")['9']['act_read'] == "1"
                    )
                ) { ?>
                <li class="nav-label">Transaksi</li>

                <?php 
                if (
                    (
                        isset(session()->get("position_administrator")[0][0]) 
                        && (
                            session()->get("position_administrator") == "1" 
                            || session()->get("position_administrator") == "2"
                        )
                    ) ||
                    (
                        isset(session()->get("halaman")['35']['act_read']) 
                        && session()->get("halaman")['35']['act_read'] == "1"
                    )
                ) { ?>
                <li> 
                    <a class="  " href="<?= base_url("tbooking?report=OK"); ?>" aria-expanded="false"><i class="fa fa-handshake-o"></i><span class="hide-menu">Booking</span></a>
                </li>
                <?php }?>


                <?php }?>

                <!-- //Report// -->
                <!-- <?php 
                if (
                    (
                        isset(session()->get("position_administrator")[0][0]) 
                        && (
                            session()->get("position_administrator") == "1" 
                            || session()->get("position_administrator") == "2"
                        )
                    ) ||
                    (
                        isset(session()->get("halaman")['14']['act_read']) 
                        && session()->get("halaman")['14']['act_read'] == "1"
                    )
                ) { ?>
                <li class="nav-label">Laporan</li>

                

                <?php }?> -->

            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</div>