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
                                    isset(session()->get("halaman")['37']['act_create']) 
                                    && session()->get("halaman")['37']['act_create'] == "1"
                                )
                            ) { ?>
                            <form method="post" class="col-md-2">
                                <h1 class="page-header col-md-12">
                                    <button name="new" class="btn btn-info btn-block btn-lg" value="OK" style="">New</button>
                                    <input type="hidden" name="blog_id" />
                                </h1>
                            </form>
                            <?php } ?>                            
                        <?php } ?>
                    </div>

                    <?php if (isset($_POST['new']) || isset($_POST['edit'])) { ?>
                        <div class="">
                            <?php if (isset($_POST['edit'])) {
                                $namabutton = 'name="change"';
                                $judul = "Update News";
                            } else {
                                $namabutton = 'name="create"';
                                $judul = "Tambah News";
                            } ?>
                            <div class="lead">
                                <h3><?= $judul; ?></h3>
                            </div>
                            <form class="form-horizontal" method="post" enctype="multipart/form-data">
                            

                            <div class="form-group">
                                <label class="control-label col-sm-2" for="blog_title">Title:</label>
                                <div class="col-sm-10">
                                    <input required type="text" autofocus class="form-control" id="blog_title" name="blog_title" placeholder="" value="<?= $blog_title; ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-2" for="blog_date">From:</label>
                                <div class="col-sm-10">
                                    <input required type="date" autofocus class="form-control" id="blog_date" name="blog_date" placeholder="" value="<?= $blog_date; ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-2" for="blog_short">Short Description:</label>
                                <div class="col-sm-10">
                                    <input required type="text" autofocus class="form-control" id="blog_short" name="blog_short" placeholder="" value="<?= $blog_short; ?>">
                                </div>
                            </div>
                                
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="blog_description">Description:</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="blog_description" name="blog_description" placeholder="Description..."><?= $blog_description; ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-12" for="blog_picture">Image: (700 x 700)</label>
                                    <div class="col-sm-10">
                                        <input type="file" autofocus class="form-control" id="blog_picture" name="blog_picture" placeholder="" value="<?= $blog_picture; ?>">
                                        <?php if($blog_picture!=""){$user_image="images/blog_picture/".$blog_picture;}else{$user_image="images/blog_picture/no_image.png";}?>
                                          <img id="blog_picture_image" width="100" height="100" src="<?=base_url($user_image);?>"/>
                                          <script>
                                            function readURL(input) {
                                                if (input.files && input.files[0]) {
                                                    var reader = new FileReader();
                                        
                                                    reader.onload = function (e) {
                                                        $('#blog_picture_image').attr('src', e.target.result);
                                                    }
                                        
                                                    reader.readAsDataURL(input.files[0]);
                                                }
                                            }
                                        
                                            $("#blog_picture").change(function () {
                                                readURL(this);
                                            });
                                          </script>
                                    </div>
                                </div>

                                <input type="hidden" name="blog_id" value="<?= $blog_id; ?>" />
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" id="submit" class="btn btn-primary col-md-5" <?= $namabutton; ?> value="OK">Submit</button>
                                        <a class="btn btn-warning col-md-offset-1 col-md-5" href="<?= base_url("mblog"); ?>">Back</a>
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
                                        <th>Date</th>
                                        <th>Title</th>
                                        <th>Short</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $usr = $this->db
                                        ->table("blog")
                                        ->orderBy("blog_id", "DESC")
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
                                                            isset(session()->get("halaman")['37']['act_update']) 
                                                            && session()->get("halaman")['37']['act_update'] == "1"
                                                        )
                                                    ) { ?>
                                                    <form method="post" class="btn-action" style="">
                                                        <button class="btn btn-sm btn-warning " name="edit" value="OK"><span class="fa fa-edit" style="color:white;"></span> </button>
                                                        <input type="hidden" name="blog_id" value="<?= $usr->blog_id; ?>" />
                                                    </form>
                                                    <?php }?>  
                                                    
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
                                                            isset(session()->get("halaman")['37']['act_delete']) 
                                                            && session()->get("halaman")['37']['act_delete'] == "1"
                                                        )
                                                    ) { ?>
                                                    <form method="post" class="btn-action" style="">
                                                        <button class="btn btn-sm btn-danger delete" onclick="return confirm(' you want to delete?');" name="delete" value="OK"><span class="fa fa-close" style="color:white;"></span> </button>
                                                        <input type="hidden" name="blog_id" value="<?= $usr->blog_id; ?>" />
                                                    </form>
                                                    <?php }?>
                                                </td>
                                            <?php } ?>
                                            <td><?= $usr->blog_date; ?></td>
                                            <td><?= $usr->blog_title; ?></td>
                                            <td><?= $usr->blog_short; ?></td>
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
    var title = "Master News";
    $("title").text(title);
    $(".card-title").text(title);
    $("#page-title").text(title);
    $("#page-title-link").text(title);
</script>

<?php echo  $this->include("template/footer_v"); ?>