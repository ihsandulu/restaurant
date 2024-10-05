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
                                    isset(session()->get("halaman")['32']['act_create']) 
                                    && session()->get("halaman")['32']['act_create'] == "1"
                                )
                            ) { ?>
                            <form method="post" class="col-md-2">
                                <h1 class="page-header col-md-12">
                                    <button name="new" class="btn btn-info btn-block btn-lg" value="OK" style="">New</button>
                                    <input type="hidden" name="contact_id" />
                                </h1>
                            </form>
                            <?php } ?>                            
                        <?php } ?>
                    </div>

                    <?php if (isset($_POST['new']) || isset($_POST['edit'])) { ?>
                        <div class="">
                            <?php if (isset($_POST['edit'])) {
                                $namabutton = 'name="change"';
                                $judul = "Update Contact";
                            } else {
                                $namabutton = 'name="create"';
                                $judul = "Tambah Contact";
                            } ?>
                            <div class="lead">
                                <h3><?= $judul; ?></h3>
                            </div>
                            <form class="form-horizontal" method="post" enctype="multipart/form-data">

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="contact_branch">Branch:</label>
                                    <div class="col-sm-10">
                                        <input required autofocus type="text"  class="form-control" id="contact_branch" name="contact_branch" placeholder="" value="<?= $contact_branch; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="contact_address">Address:</label>
                                    <div class="col-sm-10">
                                        <input required type="text"  class="form-control" id="contact_address" name="contact_address" placeholder="" value="<?= $contact_address; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="contact_phone">Phone:</label>
                                    <div class="col-sm-10">
                                        <input required type="text"  class="form-control" id="contact_phone" name="contact_phone" placeholder="" value="<?= $contact_phone; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="contact_fax">Fax:</label>
                                    <div class="col-sm-10">
                                        <input required type="text"  class="form-control" id="contact_fax" name="contact_fax" placeholder="" value="<?= $contact_fax; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="contact_email">Email:</label>
                                    <div class="col-sm-10">
                                        <input required type="text"  class="form-control" id="contact_email" name="contact_email" placeholder="" value="<?= $contact_email; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-12" for="contact_wacs">Whatapp CS: <span class="text-danger">(wajib diawali dengan 62 dan bersambung | tanpa spasi ataupun pemisah lainnya)</span></label>
                                    <div class="col-sm-12">
                                        <input required type="text"  class="form-control" id="contact_wacs" name="contact_wacs" placeholder="" value="<?= $contact_wacs; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-12" for="contact_maps">Maps: <span class="text-danger">(ambil dari gmaps, pilih bagikan > sematkan peta. Isikan iframe di sini...)</span></label>
                                    <div class="col-sm-12">
                                        <input required type="text"  class="form-control" id="contact_maps" name="contact_maps" placeholder="" value="<?= htmlspecialchars($contact_maps); ?>">
                                        <style>
                                            #contact_maps{border:#e7e7e7 solid 1px!important;}
                                        </style>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-12" for="contact_brochure">Brochure: (PDF/PNG/JPG)</label>
                                    <div class="col-sm-10">
                                        <input type="file" autofocus class="form-control" id="contact_brochure" name="contact_brochure" placeholder="" value="<?= $contact_brochure; ?>">                                       
                                    </div>
                                </div>

                                <input type="hidden" name="contact_id" value="<?= $contact_id; ?>" />
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" id="submit" class="btn btn-primary col-md-5" <?= $namabutton; ?> value="OK">Submit</button>
                                        <a class="btn btn-warning col-md-offset-1 col-md-5" href="<?= base_url("mcontact"); ?>">Back</a>
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
                                        <th>Branch</th>
                                        <th>Address</th>
                                        <th>Phone</th>
                                        <th>Fax</th>
                                        <th>Email</th>
                                        <th>Whatsapp CS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $usr = $this->db
                                        ->table("contact")
                                        ->orderBy("contact_id", "ASC")
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
                                                            isset(session()->get("halaman")['32']['act_update']) 
                                                            && session()->get("halaman")['32']['act_update'] == "1"
                                                        )
                                                    ) { ?>
                                                    <form method="post" class="btn-action" style="">
                                                        <button class="btn btn-sm btn-warning " name="edit" value="OK"><span class="fa fa-edit" style="color:white;"></span> </button>
                                                        <input type="hidden" name="contact_id" value="<?= $usr->contact_id; ?>" />
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
                                                            isset(session()->get("halaman")['32']['act_delete']) 
                                                            && session()->get("halaman")['32']['act_delete'] == "1"
                                                        )
                                                    ) { ?>
                                                    <form method="post" class="btn-action" style="">
                                                        <button class="btn btn-sm btn-danger delete" onclick="return confirm(' you want to delete?');" name="delete" value="OK"><span class="fa fa-close" style="color:white;"></span> </button>
                                                        <input type="hidden" name="contact_id" value="<?= $usr->contact_id; ?>" />
                                                    </form>
                                                    <?php }?>
                                                </td>
                                            <?php } ?>
                                            <td><?= $usr->contact_branch; ?></td>
                                            <td><?= $usr->contact_address; ?></td>
                                            <td><?= $usr->contact_phone; ?></td>
                                            <td><?= $usr->contact_fax; ?></td>
                                            <td><?= $usr->contact_email; ?></td>
                                            <td><?= $usr->contact_wacs; ?></td>
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
    var title = "Master Contact";
    $("title").text(title);
    $(".card-title").text(title);
    $("#page-title").text(title);
    $("#page-title-link").text(title);
</script>

<?php echo  $this->include("template/footer_v"); ?>