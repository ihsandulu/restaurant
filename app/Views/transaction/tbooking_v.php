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
                                    isset(session()->get("halaman")['35']['act_create']) 
                                    && session()->get("halaman")['35']['act_create'] == "1"
                                )
                            ) { ?>
                            <form method="post" class="col-md-2">
                                <h1 class="page-header col-md-12">
                                    <button name="new" class="btn btn-info btn-block btn-lg" value="OK" style="">New</button>
                                    <input type="hidden" name="booking_id" />
                                </h1>
                            </form>
                            <?php } ?>
                        <?php } ?>
                    </div>
                    <?php if (isset($_POST['new']) || isset($_POST['edit'])) { ?>
                        <div class="">
                            <?php if (isset($_POST['edit'])) {
                                $namabutton = 'name="change"';
                                $judul = "Update Booking";
                            } else {
                                $namabutton = 'name="create"';
                                $judul = "Tambah Booking";
                            } ?>
                            <div class="lead">
                                <h3><?= $judul; ?></h3>
                            </div>
                            <form class="form-horizontal" method="post" enctype="multipart/form-data">     
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="booking_date">Tgl Booking:</label>
                                    <div class="col-sm-10">
                                        <input required type="date" autofocus class="form-control" id="booking_date" name="booking_date" placeholder="" value="<?= $booking_date; ?>">
                                    </div>
                                </div>    
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="booking_no">Nomor Booking/Faktur:</label>
                                    <div class="col-sm-10">
                                        <input type="text" autofocus class="form-control" id="booking_no" name="booking_no" placeholder="Penomoran akan otomatis jika dikosongkan" value="<?= $booking_no; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="booking_id">booking:</label>
                                    <div class="col-sm-10">
                                        <?php
                                        $booking = $this->db->table("booking")
                                            ->orderBy("booking_name", "ASC")
                                            ->get();
                                        //echo $this->db->getLastQuery();
                                        ?>
                                        <select required class="form-control select" id="booking_id" name="booking_id">
                                            <option value="" <?= ($booking_id == "") ? "selected" : ""; ?>>Pilih booking</option>
                                            <?php
                                            foreach ($booking->getResult() as $booking) { ?>
                                                <option value="<?= $booking->booking_id; ?>" <?= ($booking_id == $booking->booking_id) ? "selected" : ""; ?>><?= $booking->booking_name; ?></option>
                                            <?php } ?>
                                        </select>

                                    </div>
                                </div>      
                                <div class="form-group">
                                    <label class="control-label col-sm-12" for="booking_ppn">PPN(%):</label>
                                    <div class="col-sm-12">
                                        <input onkeyup="tagihan()" type="number" autofocus class="form-control" id="booking_ppn" name="booking_ppn" placeholder="" value="<?= $booking_ppn; ?>">
                                    </div>
                                </div>                                
                                

                                <input type="hidden" name="booking_id" value="<?= $booking_id; ?>" />
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" id="submit" class="btn btn-primary col-md-5" <?= $namabutton; ?> value="OK">Submit</button>
                                        <button type="button"  class="btn btn-warning col-md-offset-1 col-md-5" onClick="location.href='<?= base_url("booking"); ?>'">Back</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    <?php } else { ?>
                        <?php 
                        if(isset($_GET["from"])&&$_GET["from"]!=""){
                            $from=$_GET["from"];
                        }else{
                            $from=date("Y-m-d");
                        }

                        if(isset($_GET["to"])&&$_GET["to"]!=""){
                            $to=$_GET["to"];
                        }else{
                            $to=date("Y-m-d");
                        }

                        ?>
                        <form class="form-inline" >
                            <label for="from">Dari:</label>&nbsp;
                            <input type="date" id="from" name="from" class="form-control" value="<?=$from;?>">&nbsp;
                            <label for="to">Ke:</label>&nbsp;
                            <input type="date" id="to" name="to" class="form-control" value="<?=$to;?>">&nbsp;
                            <?php if(isset($_GET["report"])){?>                                
                            <input type="hidden" id="report" name="report" class="form-control" value="<?=$this->request->getGet("report");?>">&nbsp;
                            <?php }?>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>

                        <?php if ($message != "") { ?>
                            <div class="alert alert-info alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong><?= $message; ?></strong>
                            </div>
                        <?php } ?>

                        <div class="table-responsive m-t-40">
                            <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <!-- <table id="dataTable" class="table table-condensed table-hover w-auto dtable"> -->
                                <thead class="">
                                    <tr>
                                        <?php if (!isset($_GET["report"])) { ?>
                                        <th>Aksi.</th>
                                        <?php }?>
                                        <th>No.</th>
                                        <th>Tanggal</th>
                                        <th>Person</th>
                                        <th>Room</th>
                                        <th>Data</th>
                                        <th>Number of Rooms Booked</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $currentURL = current_url();
                                    $currentURL = str_replace('/index.php', '', $currentURL);
                                    $params   = $_SERVER['QUERY_STRING'];
                                    $fullURL = urlencode($currentURL . '?' . $params);
                                    $builder = $this->db
                                        ->table("booking")
                                        ->join("room","room.room_id=booking.room_id","LEFT")
                                        ;
                                    if(isset($_GET["from"])&&$_GET["from"]!=""){
                                        $builder->where("booking.booking_date >=",$this->request->getGet("from"));
                                    }else{
                                        $builder->where("booking.booking_date",date("Y-m-d"));
                                    }

                                    if(isset($_GET["to"])&&$_GET["to"]!=""){
                                        $builder->where("booking.booking_date <=",$this->request->getGet("to"));
                                    }else{
                                        $builder->where("booking.booking_date",date("Y-m-d"));
                                    }

                                    /* $builder->groupStart();
                                        if(isset($_GET["from"])&&$_GET["from"]!=""){
                                            $builder->where("booking.booking_from >=",$this->request->getGet("from"));
                                        }else{
                                            $builder->where("booking.booking_from",date("Y-m-d"));
                                        }

                                        if(isset($_GET["to"])&&$_GET["to"]!=""){
                                            $builder->where("booking.booking_from <=",$this->request->getGet("to"));
                                        }else{
                                            $builder->where("booking.booking_from",date("Y-m-d"));
                                        }
                                    $builder->groupEnd();

                                    $builder->orGroupStart();
                                        if(isset($_GET["from"])&&$_GET["from"]!=""){
                                            $builder->where("booking.booking_to >=",$this->request->getGet("from"));
                                        }else{
                                            $builder->where("booking.booking_to",date("Y-m-d"));
                                        }

                                        if(isset($_GET["to"])&&$_GET["to"]!=""){
                                            $builder->where("booking.booking_to <=",$this->request->getGet("to"));
                                        }else{
                                            $builder->where("booking.booking_to",date("Y-m-d"));
                                        }                                    
                                    $builder->groupEnd(); */

                                    $usr= $builder
                                        ->orderBy("booking.booking_id", "ASC")
                                        ->get();
                                    // echo $this->db->getLastquery();die;
                                    $no = 1;
                                    $thargasetelahppn=0;
                                    $tnominal=0;
                                    foreach ($usr->getResult() as $usr) { 
                                        ?>
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
                                                            isset(session()->get("halaman")['35']['act_update']) 
                                                            && session()->get("halaman")['35']['act_update'] == "1"
                                                        )
                                                    ) { ?>
                                                    <form method="post" class="btn-action" style="">
                                                        <button class="btn btn-sm btn-warning " name="edit" value="OK"><span class="fa fa-edit" style="color:white;"></span> </button>
                                                        <input type="hidden" name="booking_id" value="<?= $usr->booking_id; ?>" />
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
                                                            isset(session()->get("halaman")['35']['act_delete']) 
                                                            && session()->get("halaman")['35']['act_delete'] == "1"
                                                        )
                                                    ) { ?>
                                                    <form method="post" class="btn-action" style="">
                                                        <button class="btn btn-sm btn-danger delete" onclick="return confirm(' you want to delete?');" name="delete" value="OK"><span class="fa fa-close" style="color:white;"></span> </button>
                                                        <input type="hidden" name="booking_id" value="<?= $usr->booking_id; ?>" />
                                                    </form>
                                                    <?php }?>
                                                </td>
                                            <?php } ?>
                                            <td><?= $no++; ?></td>                                                  
                                            <td class="text-left">From: <?= $usr->booking_from; ?><br/>To: <?= $usr->booking_to; ?></td>
                                            <td class="text-left">
                                                Name: <?= $usr->booking_name; ?><br/>Email: <?= $usr->booking_email; ?><br/>Phone: <?= $usr->booking_phone; ?>
                                            </td>
                                            <td><?= $usr->room_name; ?></td>
                                            <td class="text-left">
                                                Adult: <?= $usr->booking_adult; ?><br/>Child: <?= $usr->booking_child; ?> 
                                            </td>
                                            <td><?= $usr->booking_roomcount; ?> Rooms</td>
                                            <td class="text-left">
                                                Room Price: <?= number_format($usr->booking_roomprice,0,",","."); ?><br/>Total: <?=  number_format($usr->booking_totalprice,0,",","."); ?> 
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>                        
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('.select').select2();
    var title = "<?=(isset($_GET["report"]))?"Laporan":"";?> Booking";
    $("title").text(title);
    $(".card-title").text(title);
    $("#page-title").text(title);
    $("#page-title-link").text(title);
</script>

<?php echo  $this->include("template/footer_v"); ?>