<?php echo $this->include("template_front/header_v"); ?>

<?= $this->include('template_front/sosmed_v'); ?> 
        
<?= $this->include('template_front/menu_v'); ?>


        <?php $room=$this->db->table("room")
        ->where("room_id",$this->request->getGet('id'))
        ->get();
        foreach($room->getResult() as $room){                                    
            if($room->room_picture1!=""){
                $room_picture1="images/room_picture1/".$room->room_picture1;
            }else{
                $room_picture1="frontend/images/room-single/bg.jpg";
            }
        }?>
        <div id="background" data-bgimage="url(<?=base_url($room_picture1);?>) fixed"></div>
        <div id="content-absolute">
            <?php
            $room=$this->db->table("room")->where("room_id",$this->request->getGet('id'))->get();
            foreach($room->getResult() as $room){?>

            <!-- subheader -->
            <section id="subheader" class="no-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h4><?=$room->room_name;?></h4>
                            <h1>Room</h1>
                        </div>
                    </div>
                </div>
            </section>

            <section id="section-main" class="no-bg no-top" aria-label="section-menu">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="de-content-overlay">
                            <div class="d-carousel wow fadeInRight" data-wow-delay="2s">
                                <div id="carousel-rooms" class="owl-carousel owl-theme">
                                    <?php 
                                    for($i=1;$i<7;$i++){
                                        $nameroom="room_picture".$i;
                                    if($room->$nameroom!=""){?>
                                    <div class="item">
                                        <div class="picframe">
                                            <a class="image-popup-gallery" href="<?=base_url("images/$nameroom/".$room->$nameroom);?>">
                                                <span class="overlay">
                                                    <span class="pf_title">
                                                        <i class="icon_search"></i>
                                                    </span>
                                                    <!-- <span class="pf_caption">
                                                        King size bed
                                                    </span> -->
                                                </span>
                                            </a>

                                            <img src="<?=base_url("images/$nameroom/".$room->$nameroom);?>" alt="">
                                        </div>
                                    </div>
                                    <?php }}?>

                                </div>

                                <div class="d-arrow-left mod-a"><i class="fa fa-angle-left"></i></div>
                                <div class="d-arrow-right mod-a"><i class="fa fa-angle-right"></i></div>

                            </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="d-room-details de-flex">
                                            <div class="de-flex-col">
                                                <img src="frontend/images/ui/user.svg" alt=""><?=$room->room_guest;?> Guests
                                            </div>
                                            <div class="de-flex-col">
                                                <img src="frontend/images/ui/floorplan.svg" alt=""><?=$room->room_wide;?> m<sup>2</sup>
                                            </div>
                                            <div class="de-flex-col">
                                                <img src="frontend/images/ui/bed.svg" alt="">Rp<?=number_format($room->room_price,0,",",".");?> / Night
                                            </div>
                                            <div class="de-flex-col">
                                                <a href="<?=base_url("booking?id=".$room->room_id);?>" class="btn-main"><span>Book Now</span></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h3>Room Overview</h3>
                                        <div style="text-align:justify;"><?=$room->room_description;?></div>
                                    </div>
                                    <div class="col-md-4">
                                        <h3>Room Facilities</h3>
                                        <ul class="ul-style-2">
                                        <?php 
                                        for($i=1;$i<13;$i++){
                                            $roomfacilities="room_facilities".$i;
                                            if($room->$roomfacilities!=""){?>
                                                <li><?=$room->$roomfacilities;?></li>                                            
                                            <?php }}?>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <?php }?>
            

            

            <?= $this->include('template_front/footerd_v'); ?> 