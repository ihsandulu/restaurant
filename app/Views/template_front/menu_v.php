<?php 
    $identity = $this->db
        ->table("identity")
        ->get();
    //echo $this->db->getLastquery();
    $no = 1;
    foreach ($identity->getResult() as $identity) { 
        if($identity->identity_logo!=""){
            $logo="images/identity_logo/".$identity->identity_logo;
        }else{
            $logo="images/identity_logo/no_image.png";
        }
        if($identity->identity_name!=""){
            $name=$identity->identity_name;
        }else{
            $name="Hotel";
        }
    }
?>
<div id="wrapper">
    <!-- header begin -->
    <header class="header-fullwidth menu-expand transparent">
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="col-md-12">
                    <!-- logo begin -->
                    <div id="logo">
                        <a href="<?= base_url(); ?>">
                            <img class="logo" src="<?= base_url($logo); ?>" alt="">
                        </a>
                    </div>
                    <!-- logo close -->

                    <div id="sosmedd">
                    <?php 
                    $sosmed = $this->db
                        ->table("sosmed")
                        ->get();
                    //echo $this->db->getLastquery();
                    $no = 1;
                    foreach ($sosmed->getResult() as $sosmed) {?>
                        <a href="<?=$sosmed->sosmed_url;?>"><i class="fa fa-<?=strtolower($sosmed->sosmed_name);?> fa-lg"></i></a>
                    <?php }?>
                    </div>
                    <!-- small button begin -->                    
                    <div id="mo-button-open" class="mo-bo-s1">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                    <!-- small button close -->
                </div>
            </div>
        </div>
    </header>
    <!-- header close -->

    <!-- menu overlay begin -->
    <div id="menu-overlay" class="slideDown">
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="col-md-12">
                    <div id="mo-button-close">
                        <div class="line-1"></div>
                        <div class="line-2"></div>
                    </div>

                    <div class="pt80 pb80">
                        <div class="mo-nav text-center">
                            <a href="<?= base_url(); ?>">
                                <img class="logo" src="<?= base_url($logo); ?>" alt="">
                            </a>

                            <div class="spacer-single"></div>

                            <!-- mainmenu begin -->
                            <ul id="mo-menu">
                                <li><a href="<?= base_url(); ?>">Home</a></li>
                                <li><a href="<?= base_url("about"); ?>">About</a></li>
                                <li><a href="<?= base_url("rooms"); ?>">Rooms</a></li>
                                <li><a href="<?= base_url("booking"); ?>">Booking</a></li>
                                <li><a href="<?= base_url("offer"); ?>">Special Offers</a></li>
                                <li><a href="<?= base_url("meetingrooms"); ?>">Meeting Rooms</a></li>
                                <li><a href="<?= base_url("blog"); ?>">News</a></li>
                                <li><a href="<?= base_url("gallery"); ?>">Gallery</a></li>
                                <li><a href="<?= base_url("contact"); ?>">Contact</a></li>
                            </ul>
                            <!-- mainmenu close -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>