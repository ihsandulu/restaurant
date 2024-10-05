
<?php echo $this->include("template_front/header_v"); ?>

<?= $this->include('template_front/sosmed_v'); ?> 
        
        <?= $this->include('template_front/menu_v'); ?>
        <!-- menu overlay close -->

        <?php $background=$this->db->table("background")
            ->where("background_id","1")
            ->get();
            foreach($background->getResult() as $background){                                    
                if($background->background_picture!=""){
                    $background_picture="images/background_picture/".$background->background_picture;
                }else{
                    $background_picture="frontend/images/background/2.jpg";
                }
            }?>
        <div id="background" data-bgimage="url(<?=base_url($background_picture);?>) fixed"></div>
        <div id="content-absolute">
            
        <?php
        $about = $this->db
            ->table("about")
            ->get();
        // echo $this->db->getLastquery();die;
        $no = 1;
        foreach ($about->getResult() as $about) {
            if($about->about_picture1!=""){
                $about_picture1="images/about_picture1/".$about->about_picture1;
            }else{
                $about_picture1="frontend/images/misc/1.jpg";
            }
            if($about->about_picture2!=""){
                $about_picture2="images/about_picture2/".$about->about_picture2;
            }else{
                $about_picture2="frontend/images/misc/2.jpg";
            }
?>

            <!-- subheader -->
            <section id="subheader" class="no-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h4>We Are</h4>
                            <h1><?=session()->get("identity_name");?></h1>
                        </div>
                    </div>
                </div>
            </section>

            <section id="section-main" class="no-bg no-top" aria-label="section-menu">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-3 col-6">
                            <div class="spacer-double sm-hide"></div>
                            <img src="<?=base_url($about_picture1);?>" alt="" class="img-responsive wow fadeInUp" data-wow-duration="1s">
                        </div>

                        <div class="col-lg-3 col-6">
                            <img src="<?=base_url($about_picture2);?>" alt="" class="img-responsive wow fadeInUp" data-wow-duration="1.5s">
                        </div>
                        
                        <div class="col-lg-6 wow fadeIn">
                                <div class="padding20">
                                <h2 class="title mb10"><?=$about->about_title;?>
                                    <span class="small-border"></span>
                                </h2>

                                <p><?=$about->about_description;?></p>

                                <a href="<?=$about->about_url;?>" class="btn-line"><span><?=$about->about_urltitle;?></span></a>
                                
                                </div>
                        </div>
                        
                        <div class="clearfix"></div>
                    </div>


                    <div class="spacer-double"></div>

                    <div class="row gx-4">
                        <div class="col-lg-12 text-center">
                            <h2 class="title center">Hotel Facilities
                                <span class="small-border"></span>
                            </h2>
                        </div>
                    </div>

                    <div class="row">
                        <?php 
                        $facilities = $this->db
                            ->table("facilities")
                            ->get();
                        //echo $this->db->getLastquery();
                        $no = 1;
                        foreach ($facilities->getResult() as $facilities) {
                            if($facilities->facilities_picture!=""){
                                $facilities_picture="images/facilities_picture/".$facilities->facilities_picture;
                            }else{
                                $facilities_picture="frontend/images/svg/restaurant-svgrepo-com.svg";
                            }
                            ?>
                            <div class="col-md-4 mb-3">
                                <div class="box-icon">
                                    <span class="icon bg-color"><img src="<?=base_url($facilities_picture);?>" alt=""></span>
                                    <div class="text">
                                        <h3 class="style-1"><?=$facilities->facilities_title;?></h3>
                                        <p><?=$facilities->facilities_description;?></p>
                                    </div>
                                </div>
                            </div>
                        <?php }?>            
                    </div>

                </div>
            </section>
            
        <?php }?>

            

            

        <?= $this->include('template_front/footerd_v'); ?> 
