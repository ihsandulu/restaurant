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
                                    isset(session()->get("halaman")['36']['act_create']) 
                                    && session()->get("halaman")['36']['act_create'] == "1"
                                )
                            ) { ?>
                            <form method="post" class="col-md-2">
                                <h1 class="page-header col-md-12">
                                    <button name="new" class="btn btn-info btn-block btn-lg" value="OK" style="">New</button>
                                    <input type="hidden" name="offer_id" />
                                </h1>
                            </form>
                            <?php } ?>                            
                        <?php } ?>
                    </div>

                    <?php if (isset($_POST['new']) || isset($_POST['edit'])) { ?>
                        <div class="">
                            <?php if (isset($_POST['edit'])) {
                                $namabutton = 'name="change"';
                                $judul = "Update Special Offer";
                            } else {
                                $namabutton = 'name="create"';
                                $judul = "Tambah Special Offer";
                            } ?>
                            <div class="lead">
                                <h3><?= $judul; ?></h3>
                            </div>
                            <form class="form-horizontal" method="post" enctype="multipart/form-data">
                            

                            <div class="form-group">
                                <label class="control-label col-sm-2" for="offer_title">Title:</label>
                                <div class="col-sm-10">
                                    <input required type="text" autofocus class="form-control" id="offer_title" name="offer_title" placeholder="" value="<?= $offer_title; ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-2" for="offer_from">From:</label>
                                <div class="col-sm-10">
                                    <input required type="date" autofocus class="form-control" id="offer_from" name="offer_from" placeholder="" value="<?= $offer_from; ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-2" for="offer_to">To:</label>
                                <div class="col-sm-10">
                                    <input required type="date" autofocus class="form-control" id="offer_to" name="offer_to" placeholder="" value="<?= $offer_to; ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-2" for="offer_category">Category:</label>
                                <div class="col-sm-10">
                                    <input required type="text" autofocus class="form-control" id="offer_category" name="offer_category" placeholder="" value="<?= $offer_category; ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-2" for="offer_short">Short Description:</label>
                                <div class="col-sm-10">
                                    <input required type="text" autofocus class="form-control" id="offer_short" name="offer_short" placeholder="" value="<?= $offer_short; ?>">
                                </div>
                            </div>
                                
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="offer_description">Description:</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="offer_description" name="offer_description" placeholder="Description..."><?= $offer_description; ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-12" for="offer_picture">Image: (700 x 700)</label>
                                    <div class="col-sm-10">
                                        <input type="file" autofocus class="form-control" id="offer_picture" name="offer_picture" placeholder="" value="<?= $offer_picture; ?>">
                                        <?php if($offer_picture!=""){$user_image="images/offer_picture/".$offer_picture;}else{$user_image="images/offer_picture/no_image.png";}?>
                                          <img id="offer_picture_image" width="100" height="100" src="<?=base_url($user_image);?>"/>
                                          <script>
                                            function readURL(input) {
                                                if (input.files && input.files[0]) {
                                                    var reader = new FileReader();
                                        
                                                    reader.onload = function (e) {
                                                        $('#offer_picture_image').attr('src', e.target.result);
                                                    }
                                        
                                                    reader.readAsDataURL(input.files[0]);
                                                }
                                            }
                                        
                                            $("#offer_picture").change(function () {
                                                readURL(this);
                                            });
                                          </script>
                                    </div>
                                </div>

                                <input type="hidden" name="offer_id" value="<?= $offer_id; ?>" />
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" id="submit" class="btn btn-primary col-md-5" <?= $namabutton; ?> value="OK">Submit</button>
                                        <a class="btn btn-warning col-md-offset-1 col-md-5" href="<?= base_url("moffer"); ?>">Back</a>
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
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Short</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $usr = $this->db
                                        ->table("offer")
                                        ->orderBy("offer_id", "DESC")
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
                                                            isset(session()->get("halaman")['36']['act_update']) 
                                                            && session()->get("halaman")['36']['act_update'] == "1"
                                                        )
                                                    ) { ?>
                                                    <form method="post" class="btn-action" style="">
                                                        <button class="btn btn-sm btn-warning " name="edit" value="OK"><span class="fa fa-edit" style="color:white;"></span> </button>
                                                        <input type="hidden" name="offer_id" value="<?= $usr->offer_id; ?>" />
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
                                                            isset(session()->get("halaman")['36']['act_delete']) 
                                                            && session()->get("halaman")['36']['act_delete'] == "1"
                                                        )
                                                    ) { ?>
                                                    <form method="post" class="btn-action" style="">
                                                        <button class="btn btn-sm btn-danger delete" onclick="return confirm(' you want to delete?');" name="delete" value="OK"><span class="fa fa-close" style="color:white;"></span> </button>
                                                        <input type="hidden" name="offer_id" value="<?= $usr->offer_id; ?>" />
                                                    </form>
                                                    <?php }?>
                                                </td>
                                            <?php } ?>
                                            <td><?= $usr->offer_from; ?></td>
                                            <td><?= $usr->offer_to; ?></td>
                                            <td><?= $usr->offer_title; ?></td>
                                            <td><?= $usr->offer_category; ?></td>
                                            <td><?= $usr->offer_category; ?></td>
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
    var title = "Master Special Offer";
    $("title").text(title);
    $(".card-title").text(title);
    $("#page-title").text(title);
    $("#page-title-link").text(title);
</script>

<?php echo  $this->include("template/footer_v"); ?>