<?php echo $this->include("template_front/header_v"); ?>

<?= $this->include('template_front/sosmed_v'); ?> 
        
<?= $this->include('template_front/menu_v'); ?>

        <?php $background=$this->db->table("background")
        ->where("background_id","10")
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

            <!-- subheader -->
            <section id="subheader" class="no-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h4>Select</h4>
                            <h1>Rooms</h1>
                        </div>
                    </div>
                </div>
            </section>

            <section id="section-main" class="no-bg no-top" aria-label="section-menu">
                <div class="container">
                    <div class="row g-4">
                        <?php $room=$this->db->table("room")->get();
                        foreach($room->getResult() as $room){                            
                            if($room->room_picture1!=""){
                                $room_picture1="images/room_picture1/".$room->room_picture1;
                            }else{
                                $room_picture1="frontend/images/room/1.jpg";
                            }
                            if($room->room_picture2!=""){
                                $room_picture2="images/room_picture2/".$room->room_picture2;
                            }else{
                                $room_picture2="frontend/images/room/1-alt.jpg";
                            }
                        ?>
                        <div class="col-lg-4">
                            <div class="de-room">
                                <div class="d-image">
                                    <div class="d-label">only <?=$room->room_count-$room->room_terisi;?> room left</div>
                                    <div class="d-details">
                                        <span class="d-meta-1">
                                            <img src="frontend/images/ui/user.svg" alt=""><?=$room->room_guest;?> Guests
                                        </span>
                                        <span class="d-meta-2">
                                            <img src="frontend/images/ui/floorplan.svg" alt=""><?=$room->room_wide;?> m<sup>2</sup>
                                        </span>
                                    </div>
                                    <a href="<?=base_url("roomsingle?id=".$room->room_id);?>">
                                        <img src="<?=base_url($room_picture1);?>" class="img-fluid" alt="">
                                        <img src="<?=base_url($room_picture2);?>" class="d-img-hover img-fluid" alt="">
                                    </a>
                                </div>
                                
                                <div class="d-text">
                                    <h3><?=$room->room_name;?></h3>
                                    <p><?=$room->room_description;?></p>
                                    <a href="<?=base_url("roomsingle?id=".$room->room_id);?>" class="btn-line"><span>Book Now For Rp. <?=$room->room_price;?></span></a>
                                </div>
                            </div>
                        </div>
                        <?php }?>
                    </div>
                </div>
            </section>

            

            

<?= $this->include('template_front/footerd_v'); ?> 
