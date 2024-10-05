<?php
$this->session = \Config\Services::session();
$this->request = \Config\Services::request();

use Config\Database;

$this->db = Database::connect("default");
/* if ($this->session->get('user_id') == "") {
    $this->session->setFlashdata("message", "Selamat Datang !");
    header('Location:' . base_url('login?message=Silahkan Login !'));
    exit;
} */
?>
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

<!DOCTYPE html>
<html lang="zxx">
    <head>
        <meta charset="utf-8">
        <title><?=$name;?></title>
        <link rel="icon" href="<?=base_url($logo);?>" type="image/gif" sizes="16x16">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="">

        <!-- CSS Files
        ================================================== -->
        <link rel="stylesheet" href="frontend/css/bootstrap.min.css" type="text/css" id="bootstrap">
        <link rel="stylesheet" href="frontend/css/plugins.css" type="text/css">
        <link rel="stylesheet" href="frontend/css/style.css" type="text/css">
        <link rel="stylesheet" href="frontend/css/color.css" type="text/css">

        <!-- supersized -->
        <link rel='stylesheet' href='frontend/js/supersized/css/supersized.css' type='text/css'>
        <link rel='stylesheet' href='frontend/js/supersized/theme/supersized.shutter.css' type='text/css'>

        <!-- color scheme -->
        <link rel="stylesheet" href="frontend/css/colors/brown.css" type="text/css" id="colors">

        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


        <link href="css/lib/toastr/toastr.min.css" rel="stylesheet">
        <script src="js/lib/toastr/toastr.min.js"></script>
        <script src="js/lib/toastr/toastr.init.js"></script>


        <!--Custom JavaScript -->
        <script src="js/custom.min.js"></script>

        <!--Fungsi Pemisah Ribuan -->
        <script src="js/pemisah_ribuan.js"></script>

        <!-- <script src="tinymce/js/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
        <script>tinymce.init({selector:'textarea'});</script> -->

        <style>
            .logo{height:100px; width:auto; margin-top:10px;}
            #jpreOverlay{background:url(<?=base_url($logo);?>) center no-repeat rgba(var(--bg-dark-color),1)!important;
                position:absolute;
                width:100%!important;
                height:100%!important;
            }
            #sosmedd{display:none;}
            @media only screen and (max-width: 600px) {
                .logo{height:50px; width:auto; margin-top:10px;}
                #sosmedd{
                    display:block;
                    position: absolute;
                    top:80px!important;
                    left:50%;
                    transform:translate(0,-50px);
                }
            }
        </style>
    </head>
    <body>
        

            