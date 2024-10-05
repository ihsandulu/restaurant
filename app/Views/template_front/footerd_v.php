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
<!-- subheader close -->
            <!-- footer begin -->
            <footer class="no-top pl20 pr20">
                <div class="subfooter">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">&copy; Copyright <?=date("Y");?> - <?=$name;?></div>
                            <div class="col-md-6 text-right">
                                <div class="social-icons">
                                    <?php 
                                    $sosmed = $this->db
                                        ->table("sosmed")
                                        ->get();
                                    //echo $this->db->getLastquery();
                                    $no = 1;
                                    foreach ($sosmed->getResult() as $sosmed) {?>
                                        <a target="_blank" href="<?=$sosmed->sosmed_url;?>"><i class="fa fa-<?=strtolower($sosmed->sosmed_name);?> fa-lg"></i></a>
                                    <?php }?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="#" id="back-to-top"></a>
            </footer>
            <!-- footer close -->
        </div>

        <!-- Javascript Files
    ================================================== -->
        <script src="frontend/js/plugins.min.js"></script>
        <script src="frontend/js/designesia.js"></script>
        <script src='https://www.google.com/recaptcha/api.js' async defer></script>
        <script src="frontend/form.js"></script>
        <!--Start of Tawk.to Script-->
        <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/6550f98fcec6a912820f1906/1hf24tnb8';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
        })();
        </script>
        <!--End of Tawk.to Script-->
    </body>
</html>