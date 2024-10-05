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
                                    isset(session()->get("halaman")['29']['act_create']) 
                                    && session()->get("halaman")['29']['act_create'] == "1"
                                )
                            ) { ?>
                            <form method="post" class="col-md-2">
                                <h1 class="page-header col-md-12">
                                    <button name="new" class="btn btn-info btn-block btn-lg" value="OK" style="">New</button>
                                    <input type="hidden" name="meeting_id" />
                                </h1>
                            </form>
                            <?php } ?>  -->                           
                        <?php } ?>
                    </div>

                    <?php if (isset($_POST['new']) || isset($_POST['edit'])) { ?>
                        <div class="">
                            <?php if (isset($_POST['edit'])) {
                                $namabutton = 'name="change"';
                                $judul = "Update meeting";
                            } else {
                                $namabutton = 'name="create"';
                                $judul = "Tambah meeting";
                            } ?>
                            <div class="lead">
                                <h3><?= $judul; ?></h3>
                            </div>
                            <form class="form-horizontal" method="post" enctype="multipart/form-data">

                                <div class="form-group">
                                    <label class="control-label col-sm-12" for="meeting_name">Meeting Rooms Name:</label>
                                    <div class="col-sm-12">
                                        <input required type="text" autofocus class="form-control" id="meeting_name" name="meeting_name" placeholder="" value="<?= $meeting_name; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-12" for="meeting_guest">Guest (Jumlah Tamu):</label>
                                    <div class="col-sm-12">
                                        <input required type="text" autofocus class="form-control" id="meeting_guest" name="meeting_guest" placeholder="" value="<?= $meeting_guest; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-12" for="meeting_wide">Wide (Luas Ruangan dalam m<sup>2</sup>):</label>
                                    <div class="col-sm-12">
                                        <input required type="text" autofocus class="form-control" id="meeting_wide" name="meeting_wide" placeholder="" value="<?= $meeting_wide; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-12" for="meeting_price">Price:</label>
                                    <div class="col-sm-12">
                                        <input required type="text" autofocus class="form-control" id="meeting_price" name="meeting_price" placeholder="" value="<?= $meeting_price; ?>">
                                    </div>
                                </div>

                                <!-- <div class="form-group">
                                    <label class="control-label col-sm-12" for="meeting_count">Number of meetings:</label>
                                    <div class="col-sm-12">
                                        <input required type="text" autofocus class="form-control" id="meeting_count" name="meeting_count" placeholder="" value="<?= $meeting_count; ?>">
                                    </div>
                                </div> -->
                                
                                <div class="form-group">
                                    <label class="control-label col-sm-12" for="meeting_description">Description:</label>
                                    <div class="col-sm-12">
                                        <textarea class="form-control" id="meeting_description" name="meeting_description" placeholder="Description..."><?= $meeting_description; ?></textarea>
                                    </div>
                                </div>

                                

                                <div class="row">
                                    <div class="form-group col-sm-4">
                                        <label class="control-label col-sm-12" for="meeting_picture1">Image 1: (320 x 320) <span style="color:red;">Wajib</span></label>
                                        <div class="col-sm-12">
                                            <input  type="file" autofocus class="form-control" id="meeting_picture1" name="meeting_picture1" placeholder="" value="<?= $meeting_picture1; ?>">
                                            <?php if($meeting_picture1!=""){$user_image="images/meeting_picture1/".$meeting_picture1;}else{$user_image="images/meeting_picture1/no_image.png";}?>
                                            <img id="meeting_picture1_image" width="100" height="100" src="<?=base_url($user_image);?>"/>
                                            
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-4">
                                        <label class="control-label col-sm-12" for="meeting_picture2">Image 2: (320 x 320) <span style="color:red;">Wajib</span></label>
                                        <div class="col-sm-12">
                                            <input  type="file" autofocus class="form-control" id="meeting_picture2" name="meeting_picture2" placeholder="" value="<?= $meeting_picture2; ?>">
                                            <?php if($meeting_picture2!=""){$user_image="images/meeting_picture2/".$meeting_picture2;}else{$user_image="images/meeting_picture2/no_image.png";}?>
                                            <img id="meeting_picture2_image" width="100" height="100" src="<?=base_url($user_image);?>"/>
                                            
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-4">
                                        <label class="control-label col-sm-12" for="meeting_picture3">Image 3: (320 x 320)</label>
                                        <div class="col-sm-12">
                                            <input type="file" autofocus class="form-control" id="meeting_picture3" name="meeting_picture3" placeholder="" value="<?= $meeting_picture3; ?>">
                                            <?php if($meeting_picture3!=""){$user_image="images/meeting_picture3/".$meeting_picture3;}else{$user_image="images/meeting_picture3/no_image.png";}?>
                                            <img id="meeting_picture3_image" width="100" height="100" src="<?=base_url($user_image);?>"/>
                                            
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-4">
                                        <label class="control-label col-sm-12" for="meeting_picture4">Image 4: (320 x 320)</label>
                                        <div class="col-sm-12">
                                            <input type="file" autofocus class="form-control" id="meeting_picture4" name="meeting_picture4" placeholder="" value="<?= $meeting_picture4; ?>">
                                            <?php if($meeting_picture4!=""){$user_image="images/meeting_picture4/".$meeting_picture4;}else{$user_image="images/meeting_picture4/no_image.png";}?>
                                            <img id="meeting_picture4_image" width="100" height="100" src="<?=base_url($user_image);?>"/>
                                            
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-4">
                                        <label class="control-label col-sm-12" for="meeting_picture5">Image 5: (320 x 320)</label>
                                        <div class="col-sm-12">
                                            <input type="file" autofocus class="form-control" id="meeting_picture5" name="meeting_picture5" placeholder="" value="<?= $meeting_picture5; ?>">
                                            <?php if($meeting_picture5!=""){$user_image="images/meeting_picture5/".$meeting_picture5;}else{$user_image="images/meeting_picture5/no_image.png";}?>
                                            <img id="meeting_picture5_image" width="100" height="100" src="<?=base_url($user_image);?>"/>
                                            
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-4">
                                        <label class="control-label col-sm-12" for="meeting_picture6">Image 6: (320 x 320)</label>
                                        <div class="col-sm-12">
                                            <input type="file" autofocus class="form-control" id="meeting_picture6" name="meeting_picture6" placeholder="" value="<?= $meeting_picture6; ?>">
                                            <?php if($meeting_picture6!=""){$user_image="images/meeting_picture6/".$meeting_picture6;}else{$user_image="images/meeting_picture6/no_image.png";}?>
                                            <img id="meeting_picture6_image" width="100" height="100" src="<?=base_url($user_image);?>"/>
                                            
                                        </div>
                                    </div>
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
                                    
                                        $("#meeting_picture1").change(function () {
                                            readURL(this,"meeting_picture1");
                                        });
                                        $("#meeting_picture2").change(function () {
                                            readURL(this,"meeting_picture2");
                                        });
                                        $("#meeting_picture3").change(function () {
                                            readURL(this,"meeting_picture3");
                                        });
                                        $("#meeting_picture4").change(function () {
                                            readURL(this,"meeting_picture4");
                                        });
                                        $("#meeting_picture5").change(function () {
                                            readURL(this,"meeting_picture5");
                                        });
                                        $("#meeting_picture6").change(function () {
                                            readURL(this,"meeting_picture6");
                                        });
                                    </script>

                                    <div class="form-group col-sm-4">
                                        <label class="control-label col-sm-12" for="meeting_facilities1">Facilities 1:</label>
                                        <div class="col-sm-12">
                                            <input  type="text" autofocus class="form-control" id="meeting_facilities1" name="meeting_facilities1" placeholder="" value="<?= $meeting_facilities1; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label class="control-label col-sm-12" for="meeting_facilities2">Facilities 2:</label>
                                        <div class="col-sm-12">
                                            <input  type="text" autofocus class="form-control" id="meeting_facilities2" name="meeting_facilities2" placeholder="" value="<?= $meeting_facilities2; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label class="control-label col-sm-12" for="meeting_facilities3">Facilities 3:</label>
                                        <div class="col-sm-12">
                                            <input  type="text" autofocus class="form-control" id="meeting_facilities3" name="meeting_facilities3" placeholder="" value="<?= $meeting_facilities3; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label class="control-label col-sm-12" for="meeting_facilities4">Facilities 4:</label>
                                        <div class="col-sm-12">
                                            <input  type="text" autofocus class="form-control" id="meeting_facilities4" name="meeting_facilities4" placeholder="" value="<?= $meeting_facilities4; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label class="control-label col-sm-12" for="meeting_facilities5">Facilities 5:</label>
                                        <div class="col-sm-12">
                                            <input  type="text" autofocus class="form-control" id="meeting_facilities5" name="meeting_facilities5" placeholder="" value="<?= $meeting_facilities5; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label class="control-label col-sm-12" for="meeting_facilities6">Facilities 6:</label>
                                        <div class="col-sm-12">
                                            <input  type="text" autofocus class="form-control" id="meeting_facilities6" name="meeting_facilities6" placeholder="" value="<?= $meeting_facilities6; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label class="control-label col-sm-12" for="meeting_facilities7">Facilities 7:</label>
                                        <div class="col-sm-12">
                                            <input  type="text" autofocus class="form-control" id="meeting_facilities7" name="meeting_facilities7" placeholder="" value="<?= $meeting_facilities7; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label class="control-label col-sm-12" for="meeting_facilities8">Facilities 8:</label>
                                        <div class="col-sm-12">
                                            <input  type="text" autofocus class="form-control" id="meeting_facilities8" name="meeting_facilities8" placeholder="" value="<?= $meeting_facilities8; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label class="control-label col-sm-12" for="meeting_facilities9">Facilities 9:</label>
                                        <div class="col-sm-12">
                                            <input  type="text" autofocus class="form-control" id="meeting_facilities9" name="meeting_facilities9" placeholder="" value="<?= $meeting_facilities9; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label class="control-label col-sm-12" for="meeting_facilities10">Facilities 10:</label>
                                        <div class="col-sm-12">
                                            <input  type="text" autofocus class="form-control" id="meeting_facilities10" name="meeting_facilities10" placeholder="" value="<?= $meeting_facilities10; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label class="control-label col-sm-12" for="meeting_facilities11">Facilities 11:</label>
                                        <div class="col-sm-12">
                                            <input  type="text" autofocus class="form-control" id="meeting_facilities11" name="meeting_facilities11" placeholder="" value="<?= $meeting_facilities11; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label class="control-label col-sm-12" for="meeting_facilities12">Facilities 12:</label>
                                        <div class="col-sm-12">
                                            <input  type="text" autofocus class="form-control" id="meeting_facilities12" name="meeting_facilities12" placeholder="" value="<?= $meeting_facilities12; ?>">
                                        </div>
                                    </div>
                                </div>



                                <input type="hidden" name="meeting_id" value="<?= $meeting_id; ?>" />
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-12">
                                        <button type="submit" id="submit" class="btn btn-primary col-md-5" <?= $namabutton; ?> value="OK">Submit</button>
                                        <a class="btn btn-warning col-md-offset-1 col-md-5" href="<?= base_url("mmeeting"); ?>">Back</a>
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
                                        <th>Meeting Rooms Name</th>
                                        <th>Guest</th>
                                        <th>Wide</th>
                                        <th>Prize</th>
                                        <!-- <th>meeting Count</th> -->
                                        <th>Available</th>
                                        <th>Facilities</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $usr = $this->db
                                        ->table("meeting")
                                        ->orderBy("meeting_id", "DESC")
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
                                                            isset(session()->get("halaman")['29']['act_update']) 
                                                            && session()->get("halaman")['29']['act_update'] == "1"
                                                        )
                                                    ) { ?>
                                                    <form method="post" class="btn-action" style="">
                                                        <button class="btn btn-sm btn-warning " name="edit" value="OK"><span class="fa fa-edit" style="color:white;"></span> </button>
                                                        <input type="hidden" name="meeting_id" value="<?= $usr->meeting_id; ?>" />
                                                    </form>
                                                    <?php }?>  
                                                    
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
                                                            isset(session()->get("halaman")['29']['act_delete']) 
                                                            && session()->get("halaman")['29']['act_delete'] == "1"
                                                        )
                                                    ) { ?>
                                                    <form method="post" class="btn-action" style="">
                                                        <button class="btn btn-sm btn-danger delete" onclick="return confirm(' you want to delete?');" name="delete" value="OK"><span class="fa fa-close" style="color:white;"></span> </button>
                                                        <input type="hidden" name="meeting_id" value="<?= $usr->meeting_id; ?>" />
                                                    </form>
                                                    <?php }?> -->
                                                </td>
                                            <?php } ?>
                                            <td><?= $usr->meeting_name; ?></td>
                                            <td><?= $usr->meeting_guest; ?></td>
                                            <td><?= $usr->meeting_wide; ?></td>
                                            <td><?= $usr->meeting_price; ?></td>
                                            <!-- <td><?= $usr->meeting_count; ?></td> -->
                                            <td><?= $usr->meeting_terisi; ?></td>
                                            <td>
                                                <?= ($usr->meeting_facilities1!="")?$usr->meeting_facilities1:""; ?><br/>
                                                <?= ($usr->meeting_facilities2!="")?$usr->meeting_facilities2:""; ?><br/>
                                                <?= ($usr->meeting_facilities3!="")?$usr->meeting_facilities3:""; ?><br/>
                                                <?= ($usr->meeting_facilities4!="")?$usr->meeting_facilities4:""; ?><br/>
                                                <?= ($usr->meeting_facilities5!="")?$usr->meeting_facilities5:""; ?><br/>
                                                <?= ($usr->meeting_facilities6!="")?$usr->meeting_facilities6:""; ?><br/>
                                                <?= ($usr->meeting_facilities7!="")?$usr->meeting_facilities7:""; ?><br/>
                                                <?= ($usr->meeting_facilities8!="")?$usr->meeting_facilities8:""; ?><br/>
                                                <?= ($usr->meeting_facilities9!="")?$usr->meeting_facilities9:""; ?><br/>
                                                <?= ($usr->meeting_facilities10!="")?$usr->meeting_facilities10:""; ?><br/>
                                                <?= ($usr->meeting_facilities11!="")?$usr->meeting_facilities11:""; ?><br/>
                                                <?= ($usr->meeting_facilities12!="")?$usr->meeting_facilities12:""; ?><br/>
                                            </td>
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
    var title = "Master Meeting Rooms";
    $("title").text(title);
    $(".card-title").text(title);
    $("#page-title").text(title);
    $("#page-title-link").text(title);
</script>

<?php echo  $this->include("template/footer_v"); ?>