<?php echo $this->include("template_front/header_v"); ?>
        
<?= $this->include('template_front/menu_v'); ?>
            <?php $background=$this->db->table("background")
            ->where("background_id","6")
            ->get();
            foreach($background->getResult() as $background){                                    
                if($background->background_picture!=""){
                    $background_picture="images/background_picture/".$background->background_picture;
                }else{
                    $background_picture="frontend/images/background/3.jpg";
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
                                <h1>News</h1>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="section-main" class="no-bg no-top" aria-label="section-menu" >
                        <div class="container">
                        <div class="row g-4">
                            <?php $blog=$this->db->table("blog")
                            ->where("blog_date<=",date("Y-m-d"))
                            ->orderBy("blog_date","DESC")
                            ->get();
                            foreach($blog->getResult() as $blog){                                   
                                if($blog->blog_picture!=""){
                                    $room_picture="images/blog_picture/".$blog->blog_picture;
                                }else{
                                    $blog="frontend/images/blog/1.jpg";
                                }
                                ?>
                                <div class="col-lg-4 col-md-6">
                                    <div class="d-items">
                                       <div class="card-image-1 mod-b">
                                           <a href="<?=base_url("blogsingle?id=".$blog->blog_id);?>" class="d-text">
                                               <div class="d-inner">
                                                    <span class="atr-date"><?=date("d, M Y",strtotime($blog->blog_date));?></span>
                                                    <h3><?=$blog->blog_title;?></h3>
                                                    <p><?=$blog->blog_short;?></p>
                                                    <!-- <h5 class="d-tag">Vacation</h5> -->
                                                </div>
                                           </a>
                                           <img src="<?=base_url($room_picture);?>" class="img-fluid" alt="">
                                       </div>
                                    </div>
                                </div>
                                <?php }?>

                                

                                <div class="clearfix"></div>
                                        
                                <!-- <nav aria-label="Page navigation example">
                                  <ul class="pagination justify-content-center">
                                    
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    
                                  </ul>
                                </nav> -->
                                
                            </div>
                        
                    </div>
                </section>

<?= $this->include('template_front/footerd_v'); ?> 
