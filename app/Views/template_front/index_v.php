<?php echo $this->include("template_front/header_v"); ?>
        
<?= $this->include('template_front/menu_v'); ?>

<div id="content" class="no-bottom no-top">

    <!-- float text begin -->    
    <?= $this->include('template_front/sosmed_v'); ?>
    <!-- float text close --> 
    <div class='slider-overlay'></div>

    <div id="slidecaption"></div>

    <div class="container">    
        <div id="prevthumb"></div>
        <div id="nextthumb"></div>
        
        <!--Arrow Navigation-->
        <a id="prevslide" class="load-item"></a>
        <a id="nextslide" class="load-item"></a>
        
        <!--Time Bar-->
        <div id="progress-back" class="load-item">
            <div id="progress-bar"></div>
        </div>
        <!--Control Bar-->
        <div id="controls-wrapper" class="load-item">
            <div id="controls">
                
                <a id="play-button"><span id="pauseplay" class="play"></span></a>
            
                <!--Slide counter-->
                <div id="slidecounter">
                    <span class="slidenumber"></span> / <span class="totalslides"></span>
                </div>
                
                <!--Navigation-->
                <ul id="slide-list"></ul>
                
            </div>
        </div>
    </div>

    <?php echo $this->include("template_front/bfooter_v"); ?>
    <script>
        jQuery(function($){
                                                    
                var slides=[];
                <?php
                $slider = $this->db
                    ->table("slider")
                    ->get();
                // echo $this->db->getLastquery();die;
                $no = 1;
                foreach ($slider->getResult() as $slider) {
                    if($slider->slider_picture!=""){
                        $slider_picture="images/slider_picture/".$slider->slider_picture;
                    }else{
                        $slider_picture="frontend/images/slider/1.jpg";
                    }
                ?>
                    slides.push({image : '<?=base_url($slider_picture);?>', title : "<div class='slider-text'><h2 class='wow fadeInUp' style='font-size:30px!important;'><?=$slider->slider_title;?></h2><a class='btn-line wow fadeInUp' data-wow-delay='.3s' href='<?=base_url($slider->slider_url);?>'><span><?=$slider->slider_titlelink;?></span></a></div>", thumb : '', url : ''}); 
                <?php }?>


            $.supersized({
                // Functionality
                slide_interval      :   5000, // Length between transitions
                
                transition          :   1, // 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
                transition_speed    :   500, // Speed of transition
                slide_links         :   'blank',    // Individual links for each slide (Options: false, 'num', 'name', 'blank')
                slides              :   slides,
                autoplay            :   1,                  
                fit_always          :   0,
                performance         :   0,
                image_protect       :   1        // Disables image dragging and right click with Javascript
            });

            jQuery("#pauseplay").toggle(
            function () {
                jQuery(this).addClass("pause");
            },
            function () {
                jQuery(this).removeClass("pause").addClass("play");
            });

        jQuery("#pauseplay").stop().fadeTo(150, .5);
        jQuery("#pauseplay").hover(
            function () {
                jQuery(this).stop().fadeTo(150, 1);
            },
            function () {
                jQuery(this).stop().fadeTo(150, .5);
            });

        });
    </script>
<?php echo $this->include("template_front/footer_v"); ?>
