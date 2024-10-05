<?php echo $this->include("template_front/header_v"); ?>

<?= $this->include('template_front/sosmed_v'); ?> 
        
<?= $this->include('template_front/menu_v'); ?>


        <?php $background=$this->db->table("background")
        ->where("background_id","12")
        ->get();
        foreach($background->getResult() as $background){                                    
            if($background->background_picture!=""){
                $background_picture="images/background_picture/".$background->background_picture;
            }else{
                $background_picture="frontend/images/background/10.jpg";
            }
        }?>
        <div id="background" data-bgimage="url(<?=base_url($background_picture);?>) fixed"></div>
        <div id="content-absolute">
            <?php
            $meeting=$this->db->table("meeting")->get();
            foreach($meeting->getResult() as $meeting){?>

            <!-- subheader -->
            <section id="subheader" class="no-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h4><?=$meeting->meeting_name;?></h4>
                            <h1>Meeting Rooms</h1>
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
                                        $namemeeting="meeting_picture".$i;
                                    if($meeting->$namemeeting!=""){?>
                                    <div class="item">
                                        <div class="picframe">
                                            <a class="image-popup-gallery" href="<?=base_url("images/$namemeeting/".$meeting->$namemeeting);?>">
                                                <span class="overlay">
                                                    <span class="pf_title">
                                                        <i class="icon_search"></i>
                                                    </span>
                                                    <!-- <span class="pf_caption">
                                                        King size bed
                                                    </span> -->
                                                </span>
                                            </a>

                                            <img src="<?=base_url("images/$namemeeting/".$meeting->$namemeeting);?>" alt="">
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
                                                <img src="frontend/images/ui/user.svg" alt=""><?=$meeting->meeting_guest;?> Guests
                                            </div>
                                            <div class="de-flex-col">
                                                <img src="frontend/images/ui/floorplan.svg" alt=""><?=$meeting->meeting_wide;?> m<sup>2</sup>
                                            </div>
                                            <div class="de-flex-col">
                                                <img src="frontend/images/ui/bed.svg" alt="">Rp<?=number_format($meeting->meeting_price,0,",",".");?> / Pax
                                            </div>
                                            <!-- <div class="de-flex-col">
                                                <a href="<?=base_url("booking?id=".$meeting->meeting_id);?>" class="btn-main"><span>Book Now</span></a>
                                            </div> -->
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h3>Meeting Overview</h3>
                                        <div style="text-align:justify;"><?=$meeting->meeting_description;?></div>
                                    </div>
                                    <div class="col-md-4">
                                        <h3>Meeting Facilities</h3>
                                        <ul class="ul-style-2">
                                        <?php 
                                        for($i=1;$i<13;$i++){
                                            $meetingfacilities="meeting_facilities".$i;
                                            if($meeting->$meetingfacilities!=""){?>
                                                <li><?=$meeting->$meetingfacilities;?></li>                                            
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