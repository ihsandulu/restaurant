<?php echo $this->include("template_front/header_v"); ?>
        
<?= $this->include('template_front/menu_v'); ?>
        <?php $background=$this->db->table("background")
        ->where("background_id","8")
        ->get();
        foreach($background->getResult() as $background){                                    
            if($background->background_picture!=""){
                $background_picture="images/background_picture/".$background->background_picture;
            }else{
                $background_picture="frontend/images/background/5.jpg";
            }
        }?>
        <div id="background" data-bgimage="url(<?=base_url($background_picture);?>) fixed"></div>
        <div id="content-absolute">

        <?= $this->include('template_front/sosmed_v'); ?> 
            
            <!-- subheader -->
            <section id="subheader" class="no-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h4>Latest</h4>
                            <h1>Gallery</h1>
                        </div>
                    </div>
                </div>
            </section>

            <section id="section-main" class="no-bg no-top" aria-label="section-menu">
                <div class="container">
                    <div id="gallery" class="row g-4">
                    <?php $gallery=$this->db->table("gallery")->get();
                        foreach($gallery->getResult() as $gallery){ 
                            if($gallery->gallery_picture!=""){
                                $gallery_picture="images/gallery_picture/".$gallery->gallery_picture;
                            }else{
                                $gallery_picture="frontend/images/gallery/gallery-item-1.jpg";
                            }?>
                            <div class="col-md-4 item">
                                <div class="de-image-hover">
                                    <a href="<?=base_url($gallery_picture);?>" class="image-popup">                                
                                        <span class="dih-title-wrap">
                                            <span class="dih-title"><?=$gallery->gallery_title;?></span>
                                        </span>
                                        <span class="dih-overlay"></span>
                                        <img src="<?=base_url($gallery_picture);?>" class="lazy img-fluid" alt="">
                                    </a>
                                </div>
                            </div>                        
                        <?php }?>
                        
                    </div>
                </div>
            </section>

<?= $this->include('template_front/footerd_v'); ?> 
