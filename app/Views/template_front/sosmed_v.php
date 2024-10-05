
<div class="float-text">
    <div class="de_social-icons">
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
    <span><a href="booking">Book Now</a></span>
</div>