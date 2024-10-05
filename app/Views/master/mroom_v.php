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
                                    isset(session()->get("halaman")['29']['act_create']) 
                                    && session()->get("halaman")['29']['act_create'] == "1"
                                )
                            ) { ?>
                            <form method="post" class="col-md-2">
                                <h1 class="page-header col-md-12">
                                    <button name="new" class="btn btn-info btn-block btn-lg" value="OK" style="">New</button>
                                    <input type="hidden" name="room_id" />
                                </h1>
                            </form>
                            <?php } ?>                            
                        <?php } ?>
                    </div>

                    <?php if (isset($_POST['new']) || isset($_POST['edit'])) { ?>
                        <div class="">
                            <?php if (isset($_POST['edit'])) {
                                $namabutton = 'name="change"';
                                $judul = "Update Room";
                            } else {
                                $namabutton = 'name="create"';
                                $judul = "Tambah Room";
                            } ?>
                            <div class="lead">
                                <h3><?= $judul; ?></h3>
                            </div>
                            <form class="form-horizontal" method="post" enctype="multipart/form-data">

                                <div class="form-group">
                                    <label class="control-label col-sm-12" for="room_name">Room:</label>
                                    <div class="col-sm-12">
                                        <input required type="text" autofocus class="form-control" id="room_name" name="room_name" placeholder="" value="<?= $room_name; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-12" for="room_guest">Guest (Jumlah Tamu):</label>
                                    <div class="col-sm-12">
                                        <input required type="text" autofocus class="form-control" id="room_guest" name="room_guest" placeholder="" value="<?= $room_guest; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-12" for="room_wide">Wide (Luas Ruangan dalam m<sup>2</sup>):</label>
                                    <div class="col-sm-12">
                                        <input required type="text" autofocus class="form-control" id="room_wide" name="room_wide" placeholder="" value="<?= $room_wide; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-12" for="room_price">Price:</label>
                                    <div class="col-sm-12">
                                        <input required type="text" autofocus class="form-control" id="room_price" name="room_price" placeholder="" value="<?= $room_price; ?>">
                                    </div>
                                </div>

                                <!-- <div class="form-group">
                                    <label class="control-label col-sm-12" for="room_count">Number of Rooms:</label>
                                    <div class="col-sm-12">
                                        <input required type="text" autofocus class="form-control" id="room_count" name="room_count" placeholder="" value="<?= $room_count; ?>">
                                    </div>
                                </div> -->
                                
                                <div class="form-group">
                                    <label class="control-label col-sm-12" for="room_description">Description:</label>
                                    <div class="col-sm-12">
                                        <textarea class="form-control" id="room_description" name="room_description" placeholder="Description..."><?= $room_description; ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group col-sm-4">
                                    <label class="control-label col-sm-12" for="room_background">Background: (1920 x 1280) <span style="color:red;">Wajib</span></label>
                                    <div class="col-sm-12">
                                        <input  type="file" autofocus class="form-control" id="room_background" name="room_background" placeholder="" value="<?= $room_background; ?>">
                                        <?php if($room_background!=""){$user_image="images/room_background/".$room_background;}else{$user_image="images/room_background/no_image.png";}?>
                                        <img id="room_background_image" width="100" height="100" src="<?=base_url($user_image);?>"/>
                                        
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-sm-4">
                                        <label class="control-label col-sm-12" for="room_picture1">Image 1: (320 x 320) <span style="color:red;">Wajib</span></label>
                                        <div class="col-sm-12">
                                            <input  type="file" autofocus class="form-control" id="room_picture1" name="room_picture1" placeholder="" value="<?= $room_picture1; ?>">
                                            <?php if($room_picture1!=""){$user_image="images/room_picture1/".$room_picture1;}else{$user_image="images/room_picture1/no_image.png";}?>
                                            <img id="room_picture1_image" width="100" height="100" src="<?=base_url($user_image);?>"/>
                                            
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-4">
                                        <label class="control-label col-sm-12" for="room_picture2">Image 2: (320 x 320) <span style="color:red;">Wajib</span></label>
                                        <div class="col-sm-12">
                                            <input  type="file" autofocus class="form-control" id="room_picture2" name="room_picture2" placeholder="" value="<?= $room_picture2; ?>">
                                            <?php if($room_picture2!=""){$user_image="images/room_picture2/".$room_picture2;}else{$user_image="images/room_picture2/no_image.png";}?>
                                            <img id="room_picture2_image" width="100" height="100" src="<?=base_url($user_image);?>"/>
                                            
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-4">
                                        <label class="control-label col-sm-12" for="room_picture3">Image 3: (320 x 320)</label>
                                        <div class="col-sm-12">
                                            <input type="file" autofocus class="form-control" id="room_picture3" name="room_picture3" placeholder="" value="<?= $room_picture3; ?>">
                                            <?php if($room_picture3!=""){$user_image="images/room_picture3/".$room_picture3;}else{$user_image="images/room_picture3/no_image.png";}?>
                                            <img id="room_picture3_image" width="100" height="100" src="<?=base_url($user_image);?>"/>
                                            
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-4">
                                        <label class="control-label col-sm-12" for="room_picture4">Image 4: (320 x 320)</label>
                                        <div class="col-sm-12">
                                            <input type="file" autofocus class="form-control" id="room_picture4" name="room_picture4" placeholder="" value="<?= $room_picture4; ?>">
                                            <?php if($room_picture4!=""){$user_image="images/room_picture4/".$room_picture4;}else{$user_image="images/room_picture4/no_image.png";}?>
                                            <img id="room_picture4_image" width="100" height="100" src="<?=base_url($user_image);?>"/>
                                            
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-4">
                                        <label class="control-label col-sm-12" for="room_picture5">Image 5: (320 x 320)</label>
                                        <div class="col-sm-12">
                                            <input type="file" autofocus class="form-control" id="room_picture5" name="room_picture5" placeholder="" value="<?= $room_picture5; ?>">
                                            <?php if($room_picture5!=""){$user_image="images/room_picture5/".$room_picture5;}else{$user_image="images/room_picture5/no_image.png";}?>
                                            <img id="room_picture5_image" width="100" height="100" src="<?=base_url($user_image);?>"/>
                                            
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-4">
                                        <label class="control-label col-sm-12" for="room_picture6">Image 6: (320 x 320)</label>
                                        <div class="col-sm-12">
                                            <input type="file" autofocus class="form-control" id="room_picture6" name="room_picture6" placeholder="" value="<?= $room_picture6; ?>">
                                            <?php if($room_picture6!=""){$user_image="images/room_picture6/".$room_picture6;}else{$user_image="images/room_picture6/no_image.png";}?>
                                            <img id="room_picture6_image" width="100" height="100" src="<?=base_url($user_image);?>"/>
                                            
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
                                    
                                        $("#room_picture1").change(function () {
                                            readURL(this,"room_picture1");
                                        });
                                        $("#room_picture2").change(function () {
                                            readURL(this,"room_picture2");
                                        });
                                        $("#room_picture3").change(function () {
                                            readURL(this,"room_picture3");
                                        });
                                        $("#room_picture4").change(function () {
                                            readURL(this,"room_picture4");
                                        });
                                        $("#room_picture5").change(function () {
                                            readURL(this,"room_picture5");
                                        });
                                        $("#room_picture6").change(function () {
                                            readURL(this,"room_picture6");
                                        });
                                    </script>

                                    <div class="form-group col-sm-4">
                                        <label class="control-label col-sm-12" for="room_facilities1">Facilities 1:</label>
                                        <div class="col-sm-12">
                                            <input  type="text" autofocus class="form-control" id="room_facilities1" name="room_facilities1" placeholder="" value="<?= $room_facilities1; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label class="control-label col-sm-12" for="room_facilities2">Facilities 2:</label>
                                        <div class="col-sm-12">
                                            <input  type="text" autofocus class="form-control" id="room_facilities2" name="room_facilities2" placeholder="" value="<?= $room_facilities2; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label class="control-label col-sm-12" for="room_facilities3">Facilities 3:</label>
                                        <div class="col-sm-12">
                                            <input  type="text" autofocus class="form-control" id="room_facilities3" name="room_facilities3" placeholder="" value="<?= $room_facilities3; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label class="control-label col-sm-12" for="room_facilities4">Facilities 4:</label>
                                        <div class="col-sm-12">
                                            <input  type="text" autofocus class="form-control" id="room_facilities4" name="room_facilities4" placeholder="" value="<?= $room_facilities4; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label class="control-label col-sm-12" for="room_facilities5">Facilities 5:</label>
                                        <div class="col-sm-12">
                                            <input  type="text" autofocus class="form-control" id="room_facilities5" name="room_facilities5" placeholder="" value="<?= $room_facilities5; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label class="control-label col-sm-12" for="room_facilities6">Facilities 6:</label>
                                        <div class="col-sm-12">
                                            <input  type="text" autofocus class="form-control" id="room_facilities6" name="room_facilities6" placeholder="" value="<?= $room_facilities6; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label class="control-label col-sm-12" for="room_facilities7">Facilities 7:</label>
                                        <div class="col-sm-12">
                                            <input  type="text" autofocus class="form-control" id="room_facilities7" name="room_facilities7" placeholder="" value="<?= $room_facilities7; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label class="control-label col-sm-12" for="room_facilities8">Facilities 8:</label>
                                        <div class="col-sm-12">
                                            <input  type="text" autofocus class="form-control" id="room_facilities8" name="room_facilities8" placeholder="" value="<?= $room_facilities8; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label class="control-label col-sm-12" for="room_facilities9">Facilities 9:</label>
                                        <div class="col-sm-12">
                                            <input  type="text" autofocus class="form-control" id="room_facilities9" name="room_facilities9" placeholder="" value="<?= $room_facilities9; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label class="control-label col-sm-12" for="room_facilities10">Facilities 10:</label>
                                        <div class="col-sm-12">
                                            <input  type="text" autofocus class="form-control" id="room_facilities10" name="room_facilities10" placeholder="" value="<?= $room_facilities10; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label class="control-label col-sm-12" for="room_facilities11">Facilities 11:</label>
                                        <div class="col-sm-12">
                                            <input  type="text" autofocus class="form-control" id="room_facilities11" name="room_facilities11" placeholder="" value="<?= $room_facilities11; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label class="control-label col-sm-12" for="room_facilities12">Facilities 12:</label>
                                        <div class="col-sm-12">
                                            <input  type="text" autofocus class="form-control" id="room_facilities12" name="room_facilities12" placeholder="" value="<?= $room_facilities12; ?>">
                                        </div>
                                    </div>
                                </div>



                                <input type="hidden" name="room_id" value="<?= $room_id; ?>" />
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-12">
                                        <button type="submit" id="submit" class="btn btn-primary col-md-5" <?= $namabutton; ?> value="OK">Submit</button>
                                        <a class="btn btn-warning col-md-offset-1 col-md-5" href="<?= base_url("mroom"); ?>">Back</a>
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
                                        <th>Room</th>
                                        <th>Guest</th>
                                        <th>Wide</th>
                                        <th>Prize</th>
                                        <!-- <th>Room Count</th> -->
                                        <th>Available</th>
                                        <th>Facilities</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $usr = $this->db
                                        ->table("room")
                                        ->orderBy("room_id", "DESC")
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
                                                        <input type="hidden" name="room_id" value="<?= $usr->room_id; ?>" />
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
                                                            isset(session()->get("halaman")['29']['act_delete']) 
                                                            && session()->get("halaman")['29']['act_delete'] == "1"
                                                        )
                                                    ) { ?>
                                                    <form method="post" class="btn-action" style="">
                                                        <button class="btn btn-sm btn-danger delete" onclick="return confirm(' you want to delete?');" name="delete" value="OK"><span class="fa fa-close" style="color:white;"></span> </button>
                                                        <input type="hidden" name="room_id" value="<?= $usr->room_id; ?>" />
                                                    </form>
                                                    <?php }?>
                                                </td>
                                            <?php } ?>
                                            <td><?= $usr->room_name; ?></td>
                                            <td><?= $usr->room_guest; ?></td>
                                            <td><?= $usr->room_wide; ?></td>
                                            <td><?= $usr->room_price; ?></td>
                                            <!-- <td><?= $usr->room_count; ?></td> -->
                                            <td><?= $usr->room_terisi; ?></td>
                                            <td>
                                                <?= ($usr->room_facilities1!="")?$usr->room_facilities1:""; ?><br/>
                                                <?= ($usr->room_facilities2!="")?$usr->room_facilities2:""; ?><br/>
                                                <?= ($usr->room_facilities3!="")?$usr->room_facilities3:""; ?><br/>
                                                <?= ($usr->room_facilities4!="")?$usr->room_facilities4:""; ?><br/>
                                                <?= ($usr->room_facilities5!="")?$usr->room_facilities5:""; ?><br/>
                                                <?= ($usr->room_facilities6!="")?$usr->room_facilities6:""; ?><br/>
                                                <?= ($usr->room_facilities7!="")?$usr->room_facilities7:""; ?><br/>
                                                <?= ($usr->room_facilities8!="")?$usr->room_facilities8:""; ?><br/>
                                                <?= ($usr->room_facilities9!="")?$usr->room_facilities9:""; ?><br/>
                                                <?= ($usr->room_facilities10!="")?$usr->room_facilities10:""; ?><br/>
                                                <?= ($usr->room_facilities11!="")?$usr->room_facilities11:""; ?><br/>
                                                <?= ($usr->room_facilities12!="")?$usr->room_facilities12:""; ?><br/>
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
    var title = "Master Room";
    $("title").text(title);
    $(".card-title").text(title);
    $("#page-title").text(title);
    $("#page-title-link").text(title);
</script>

<?php echo  $this->include("template/footer_v"); ?>