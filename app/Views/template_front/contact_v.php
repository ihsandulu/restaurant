<?php echo $this->include("template_front/header_v"); ?>
        
<?= $this->include('template_front/menu_v'); ?>
    <?php $background=$this->db->table("background")
        ->where("background_id","9")
        ->get();
        foreach($background->getResult() as $background){                                    
            if($background->background_picture!=""){
                $background_picture="images/background_picture/".$background->background_picture;
            }else{
                $background_picture="frontend/images/background/9.jpg";
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
                            <h4>Make a</h4>
                            <h1>Contact</h1>
                        </div>
                    </div>
                </div>
            </section>

            <section id="section-main" class="no-bg no-top" aria-label="section-menu">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="de-content-overlay">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row">                                            
                                            <?php 
                                            
                                            function formatNomorTelepon($nomorTelepon) {
                                                // Hilangkan karakter yang bukan angka
                                                $nomorTeleponClean = preg_replace('/\D/', '', $nomorTelepon);
                                            
                                                // Tambahkan awalan '62' jika tidak ada
                                                if (strlen($nomorTeleponClean) === 11 && strpos($nomorTeleponClean, '0') === 0) {
                                                    $nomorTeleponClean = '62' . substr($nomorTeleponClean, 1);
                                                } elseif (strlen($nomorTeleponClean) === 12 && strpos($nomorTeleponClean, '+') === 0) {
                                                    $nomorTeleponClean = '62' . substr($nomorTeleponClean, 3);
                                                }
                                            
                                                return $nomorTeleponClean;
                                            }

                                            $contact=$this->db->table("contact")->get();
                                            foreach($contact->getResult() as $contact){                                                 
                                                if($contact->contact_brochure!=""){
                                                    $contact_brochure="images/contact_brochure/".$contact->contact_brochure;
                                                }else{
                                                    $contact_brochure="";
                                                }
                                                ?>
                                                <div class="col-lg-6 mb-3">
                                                    <h3><?=$contact->contact_branch;?></h3>
                                                    <address>
                                                        <span><strong>Address:</strong><?=$contact->contact_address;?></span>
                                                        <span><strong>Phone:</strong><?=$contact->contact_phone;?></span>
                                                        <span><strong>Fax:</strong><?=$contact->contact_fax;?></span>
                                                        <span><strong>Email:</strong><a href="mailto:<?=$contact->contact_email;?>"><?=$contact->contact_email;?></a></span>
                                                        <?php
                                                        $contact_wacs = formatNomorTelepon($contact->contact_wacs);
                                                        ?>
                                                        <span><strong>Whatsapp:</strong> <a href="https://wa.me/<?=$contact_wacs;?>"><?=$contact->contact_wacs;?></a></span>
                                                        <?php if($contact_brochure!=""){?>
                                                        <span><strong>Brocure:</strong> <a href="<?=base_url($contact_brochure);?>">Download</a></span>
                                                        <?php }?>
                                                    </address>
                                                </div>
                                                <div class="col-lg-6 mb-3">
                                                    <div class="map-container map-fullwidth">
                                                        <?=$contact->contact_maps;?>
                                                    </div>
                                                </div>
                                                <hr/>
                                            <?php }?>
                                        </div>

                                        <div class="spacer-single"></div>

                                        <!-- <form name="contactForm" id='contact_form' method="post">
                                            <div class="row">
                                                <div class="col-md-12 mb10">
                                                    <h3>Send Us Message</h3>
                                                </div>
                                                <div class="col-md-6">
                                                    <div id='name_error' class='error'>Please enter your name.</div>
                                                    <div>
                                                        <input type='text' name='Name' id='name' class="form-control" placeholder="Your Name" required>
                                                    </div>

                                                    <div id='email_error' class='error'>Please enter your valid E-mail ID.</div>
                                                    <div>
                                                        <input type='email' name='Email' id='email' class="form-control" placeholder="Your Email" required>
                                                    </div>

                                                    <div id='phone_error' class='error'>Please enter your phone number.</div>
                                                    <div>
                                                        <input type='text' name='phone' id='phone' class="form-control" placeholder="Your Phone" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div id='message_error' class='error'>Please enter your message.</div>
                                                    <div>
                                                        <textarea name='message' id='message' class="form-control" placeholder="Your Message" required></textarea>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="g-recaptcha" data-sitekey="copy-your-site-key-here"></div>
                                                    <p id='submit' class="mt20">
                                                        <input type='submit' id='send_message' value='Submit Form' class="btn btn-line">
                                                    </p>
                                                    <div id='mail_success' class='success'>Your message has been sent successfully.</div>
                                                    <div id='mail_fail' class='error'>Sorry, error occured this time sending your message.</div>
                                                    
                                                </div>
                                            </div>
                                        </form> -->

                                        <!-- <div id="success_message" class='success'>
                                            Your message has been sent successfully. Refresh this page if you want to send more messages.
                                        </div>
                                        <div id="error_message" class='error'>
                                            Sorry there was an error sending your form.
                                        </div> -->
                                    </div>

                                    
                                </div>
                            </div>
                        </div>
                    </div>                   
                </div>
            </section>

<?= $this->include('template_front/footerd_v'); ?> 
