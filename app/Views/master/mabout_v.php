<?php echo $this->include("template/header_v"); ?>

<div class='container-fluid'>
    <div class='row'>
        <div class='col-12'>
            <div class="card">
                <div class="card-body">


                    <div class="row">
                        <?php if (!isset($_GET['user_id']) && !isset($_POST['new']) && !isset($_POST['edit'])) {
                            $coltitle = "col-md-10";
                        } else {
                            $coltitle = "col-md-8";
                        } ?>
                        <div class="<?= $coltitle; ?>">
                            <h4 class="card-title"></h4>
                            <!-- <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6> -->
                        </div>
                        <?php if (!isset($_POST['new']) && !isset($_POST['edit']) && !isset($_GET['report'])) { ?>
                            <?php if (isset($_GET["user_id"])) { ?>
                                <form action="<?= site_url("user"); ?>" method="get" class="col-md-2">
                                    <h1 class="page-header col-md-12">
                                        <button class="btn btn-warning btn-block btn-lg" value="OK" style="">Back</button>
                                    </h1>
                                </form>
                            <?php } ?>
                            <!-- <?php 
                            if (
                                (
                                    isset(session()->get("position_administrator")[0][0]) 
                                    && (
                                        session()->get("position_administrator") == "1" 
                                        || session()->get("position_administrator") == "2"
                                    )
                                ) ||
                                (
                                    isset(session()->get("halaman")['30']['act_create']) 
                                    && session()->get("halaman")['30']['act_create'] == "1"
                                )
                            ) { ?>
                            <form method="post" class="col-md-2">
                                <h1 class="page-header col-md-12">
                                    <button name="new" class="btn btn-info btn-block btn-lg" value="OK" style="">New</button>
                                    <input type="hidden" name="about_id" />
                                </h1>
                            </form>
                            <?php } ?>   -->                          
                        <?php } ?>
                    </div>

                    <?php if (isset($_POST['new']) || isset($_POST['edit'])) { ?>
                        <div class="">
                            <?php if (isset($_POST['edit'])) {
                                $namabutton = 'name="change"';
                                $judul = "Update About";
                            } else {
                                $namabutton = 'name="create"';
                                $judul = "Tambah About";
                            } ?>
                            <div class="lead">
                                <h3><?= $judul; ?></h3>
                            </div>
                            <form class="form-horizontal" method="post" enctype="multipart/form-data">

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="about_title">Title:</label>
                                    <div class="col-sm-10">
                                        <input type="text" autofocus class="form-control" id="about_title" name="about_title" placeholder="" value="<?= $about_title; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="about_description">Description:</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="about_description" name="about_description" placeholder="Mis:Barang tidak dapat ditukar."><?= $about_description; ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="about_urltitle">URL Title:</label>
                                    <div class="col-sm-10">
                                        <input type="text" autofocus class="form-control" id="about_urltitle" name="about_urltitle" placeholder="" value="<?= $about_urltitle; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="about_url">URL:</label>
                                    <div class="col-sm-10">
                                        <input type="text" autofocus class="form-control" id="about_url" name="about_url" placeholder="" value="<?= $about_url; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-12" for="about_picture1">Image 1: (1000 x 1513)</label>
                                    <div class="col-sm-10">
                                        <input type="file" autofocus class="form-control" id="about_picture1" name="about_picture1" placeholder="" value="<?= $about_picture1; ?>">
                                        <?php if($about_picture1!=""){$user_image="images/about_picture1/".$about_picture1;}else{$user_image="images/about_picture1/no_image.png";}?>
                                          <img id="about_picture1_image" width="100" height="100" src="<?=base_url($user_image);?>"/>
                                          
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-12" for="about_picture2">Image 2: (1000 x 1513)</label>
                                    <div class="col-sm-10">
                                        <input type="file" autofocus class="form-control" id="about_picture2" name="about_picture2" placeholder="" value="<?= $about_picture2; ?>">
                                        <?php if($about_picture2!=""){$user_image="images/about_picture2/".$about_picture2;}else{$user_image="images/about_picture2/no_image.png";}?>
                                          <img id="about_picture2_image" width="100" height="100" src="<?=base_url($user_image);?>"/>
                                          <script>
                                            function readURL(input,idnya) {
                                                if (input.files && input.files[0]) {
                                                    var reader = new FileReader();
                                        
                                                    reader.onload = function (e) {
                                                        $('#'+idnya+'_image').attr('src', e.target.result);
                                                    }
                                        
                                                    reader.readAsDataURL(input.files[0]);
                                                }
                                            }
                                        
                                        $("#about_picture1").change(function () {
                                            readURL(this,"about_picture1");
                                        });
                                        
                                        $("#about_picture2").change(function () {
                                            readURL(this,"about_picture2");
                                        });
                                          </script>
                                    </div>
                                </div>

                                <input type="hidden" name="about_id" value="<?= $about_id; ?>" />
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" id="submit" class="btn btn-primary col-md-5" <?= $namabutton; ?> value="OK">Submit</button>
                                        <a class="btn btn-warning col-md-offset-1 col-md-5" href="<?= base_url("mabout"); ?>">Back</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    <?php } else { ?>
                        <?php if ($message != "") { ?>
                            <div class="alert alert-info alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong><?= $message; ?></strong><br />
                            </div>
                        <?php } ?>

                        <div class="table-responsive m-t-40">
                            <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <!-- <table id="dataTable" class="table table-condensed table-hover w-auto dtable"> -->
                                <thead class="">
                                    <tr>
                                        <?php if (!isset($_GET["report"])) { ?>
                                            <th>Action</th>
                                        <?php } ?>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>URL Title</th>
                                        <th>URL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $usr = $this->db
                                        ->table("about")
                                        ->orderBy("about_id", "DESC")
                                        ->get();
                                    //echo $this->db->getLastquery();
                                    $no = 1;
                                    foreach ($usr->getResult() as $usr) { ?>
                                        <tr>
                                            <?php if (!isset($_GET["report"])) { ?>
                                                <td style="padding-left:0px; padding-right:0px;">
                                                    <?php 
                                                    if (
                                                        (
                                                            isset(session()->get("position_administrator")[0][0]) 
                                                            && (
                                                                session()->get("position_administrator") == "1" 
                                                                || session()->get("position_administrator") == "2"
                                                            )
                                                        ) ||
                                                        (
                                                            isset(session()->get("halaman")['30']['act_update']) 
                                                            && session()->get("halaman")['30']['act_update'] == "1"
                                                        )
                                                    ) { ?>
                                                    <form method="post" class="btn-action" style="">
                                                        <button class="btn btn-sm btn-warning " name="edit" value="OK"><span class="fa fa-edit" style="color:white;"></span> </button>
                                                        <input type="hidden" name="about_id" value="<?= $usr->about_id; ?>" />
                                                    </form>
                                                    <?php }?>  
                                                    
                                                   <!--  <?php 
                                                    if (
                                                        (
                                                            isset(session()->get("position_administrator")[0][0]) 
                                                            && (
                                                                session()->get("position_administrator") == "1" 
                                                                || session()->get("position_administrator") == "2"
                                                            )
                                                        ) ||
                                                        (
                                                            isset(session()->get("halaman")['30']['act_delete']) 
                                                            && session()->get("halaman")['30']['act_delete'] == "1"
                                                        )
                                                    ) { ?>
                                                    <form method="post" class="btn-action" style="">
                                                        <button class="btn btn-sm btn-danger delete" onclick="return confirm(' you want to delete?');" name="delete" value="OK"><span class="fa fa-close" style="color:white;"></span> </button>
                                                        <input type="hidden" name="about_id" value="<?= $usr->about_id; ?>" />
                                                    </form>
                                                    <?php }?> -->
                                                </td>
                                            <?php } ?>
                                            <td><?= $usr->about_title; ?></td>
                                            <td><?= $usr->about_description; ?></td>
                                            <td><?= $usr->about_urltitle; ?></td>
                                            <td><?= $usr->about_url; ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('.select').select2();
    var title = "Master About";
    $("title").text(title);
    $(".card-title").text(title);
    $("#page-title").text(title);
    $("#page-title-link").text(title);
</script>

<?php echo  $this->include("template/footer_v"); ?>