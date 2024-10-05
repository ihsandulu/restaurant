<?php echo $this->include("template_front/header_v"); ?>
        
<?= $this->include('template_front/menu_v'); ?>
            <?php $background=$this->db->table("background")
            ->where("background_id","7")
            ->get();
            foreach($background->getResult() as $background){                                    
                if($background->background_picture!=""){
                    $background_picture="images/background_picture/".$background->background_picture;
                }else{
                    $background_picture="frontend/images/background/4.jpg";
                }
            }?>
        <div id="background" data-bgimage="url(<?=base_url($background_picture);?>) fixed"></div>
        <div id="content-absolute">

        <?= $this->include('template_front/sosmed_v'); ?> 
            
            <?php $blog=$this->db->table("blog")
            ->where("blog_id",$this->request->getGet("id"))
            ->orderBy("blog_date","DESC")
            ->get();
            foreach($blog->getResult() as $blog){                                      
                if($blog->blog_picture!=""){
                    $room_picture="images/blog_picture/".$blog->blog_picture;
                }else{
                    $blog="frontend/images/blog/1.jpg";
                }
                ?>
            <!-- subheader -->
            <section id="subheader" class="no-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-md-10 offset-md-1 mt-4 text-center">
                            <h1><?=strtoupper($blog->blog_title);?></h1>
                        </div>
                    </div>
                </div>
            </section>

            <section id="section-main" class="no-bg no-top" aria-label="section-menu">
                        <div class="container">
                    <div class="row g-5">
                        <div class="col-md-10 offset-md-1">
                            <div class="de-post-read">
                                    <div class="post-content">

                                        <div class="post-text">
                                            <?=$blog->blog_description;?>
                                        </div>
                                    </div>
                                    
                                    <div class="post-meta">
                                        <span><i class="fa fa-calendar id-color"></i> <a href="#"><?=date("d, M Y",strtotime($blog->blog_date));?></a></span>
                                    </div>
                                    
                                    <div class="spacer-single"></div>
                                    
                            <!-- <div id="blog-comment">
                                <h3>Comments (5)</h3>
                                
                                <div class="spacer-half"></div>
                                
                                <ol>
                                    <li>
                                        <div class="avatar">
                                            <img src="images/ui/avatar.jpg" alt=""></div>
                                        <div class="comment-info">
                                            <span class="c_name">John Smith</span>
                                            <span class="c_date id-color">8 August 2018</span>
                                            <span class="c_reply"><a href="#">Reply</a></span>
                                            <div class="clearfix"></div>
                                        </div>

                                        <div class="comment">Sed ut perspiciatis unde omnis iste natus error sit voluptatem   accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt   explicabo.</div>
                                        <ol>
                                            <li>
                                                <div class="avatar">
                                                    <img src="images/ui/avatar.jpg" alt=""></div>
                                                <div class="comment-info">
                                                    <span class="c_name">John Smith</span>
                                                    <span class="c_date id-color">8 August 2018</span>
                                                    <span class="c_reply"><a href="#">Reply</a></span>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="comment">Sed ut perspiciatis unde omnis iste natus error sit voluptatem   accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt   explicabo.</div>
                                            </li>
                                        </ol>
                                    </li>

                                    <li>
                                        <div class="avatar">
                                            <img src="images/ui/avatar.jpg" alt=""></div>
                                        <div class="comment-info">
                                            <span class="c_name">John Smith</span>
                                            <span class="c_date id-color">8 August 2018</span>
                                            <span class="c_reply"><a href="#">Reply</a></span>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="comment">Sed ut perspiciatis unde omnis iste natus error sit voluptatem   accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt   explicabo.</div>
                                        <ol>
                                            <li>
                                                <div class="avatar">
                                                    <img src="images/ui/avatar.jpg" alt=""></div>
                                                <div class="comment-info">
                                                    <span class="c_name">John Smith</span>
                                                    <span class="c_date id-color">8 August 2018</span>
                                                    <span class="c_reply"><a href="#">Reply</a></span>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="comment">Sed ut perspiciatis unde omnis iste natus error sit voluptatem   accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt   explicabo.</div>
                                            </li>
                                        </ol>
                                    </li>

                                    <li>
                                        <div class="avatar">
                                            <img src="images/ui/avatar.jpg" alt=""></div>
                                        <div class="comment-info">
                                            <span class="c_name">John Smith</span>
                                            <span class="c_date id-color">8 August 2018</span>
                                            <span class="c_reply"><a href="#">Reply</a></span>

                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="comment">Sed ut perspiciatis unde omnis iste natus error sit voluptatem   accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt   explicabo.</div>
                                    </li>
                                </ol>
                                
                                <div class="spacer-single"></div>

                                <div id="comment-form-wrapper">
                                    <h3>Leave a Comment</h3>
                                    <div class="comment_form_holder">
                                        <form id="contact_form" name="form1" method="post" action="#">

                                            <label>Name</label>
                                            <input type="text" name="name" id="name" class="form-control">

                                            <label>Email <span class="req">*</span></label>
                                            <input type="text" name="email" id="email" class="form-control">
                                            <div id="error_email" class="error">Please check your email</div>

                                            <label>Message <span class="req">*</span></label>
                                            <textarea cols="10" rows="10" name="message" id="message" class="form-control"></textarea>
                                            <div id="error_message" class="error">Please check your message</div>
                                            <div id="mail_success" class="success">Thank you. Your message has been sent.</div>
                                            <div id="mail_failed" class="error">Error, email not sent</div>

                                            <p id="btnsubmit">
                                                <input type="submit" id="send" value="Send" class="btn btn-line"></p>
                                            </form>
                                        </div>
                                    </div>
                                </div>  -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php }?>

<?= $this->include('template_front/footerd_v'); ?> 
