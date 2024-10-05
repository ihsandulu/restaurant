<?php echo $this->include("template_front/header_v"); ?>

<?= $this->include('template_front/sosmed_v'); ?> 
        
<?= $this->include('template_front/menu_v'); ?> 
        
        <?php $background=$this->db->table("background")
        ->where("background_id","3")
        ->get();
        foreach($background->getResult() as $background){                                    
            if($background->background_picture!=""){
                $background_picture="images/background_picture/".$background->background_picture;
            }else{
                $background_picture="frontend/images/background/2.jpg";
            }
        }?>
        <div id="background" data-bgimage="url(<?=base_url($background_picture);?>) fixed"></div>
        <div id="content-absolute">

            <!-- subheader -->
            <section id="subheader" class="no-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h1>Booking</h1>
                        </div>
                    </div>
                </div>
            </section>

            <section id="section-main" class="no-bg no-top" aria-label="section-menu">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 offset-lg-3">
                            <div class="de-content-overlay">
                                <?php if($message!=""){?>
                                    <div id='success_message' class='text-center'><?=$message;?></div>   
                                <?php }else{?>
                                    <form name="contactForm" id='contact_form' method="post">
                                        <div id="step-1" class="row">

                                            <div class="col-md-12 mb10">
                                                <h4>Choose Date</h4>                                        
                                                <input type="text" id="date-picker" class="form-control" name="date" value="">

                                                <div class="guests-n-rooms">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <h4>Adult</h4>
                                                            <div class="de-number">
                                                                <span onkeyup="isi()" class="d-minus">-</span>
                                                                <input onchange="isi()" id="booking_adult" name="booking_adult" type="text" value="1">
                                                                <span onkeyup="isi()" class="d-plus">+</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <h4>Children</h4>
                                                            <div class="de-number">
                                                                <span onkeyup="isi()" class="d-minus">-</span>
                                                                <input onchange="isi()" id="booking_child" name="booking_child" type="text" value="0">
                                                                <span onkeyup="isi()" class="d-plus">+</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <h4>Room</h4>
                                                            <div id="d-room-count" class="de-number">
                                                                <span onkeyup="isi()" class="d-minus">-</span>
                                                                <input onchange="isi()" name="booking_roomcount" id="booking_roomcount" type="text" value="1">
                                                                <span onclick="isi()" class="d-plus">+</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="select-room">
                                            <h4>Select Room</h4>
                                            <select onchange="isi()" name="room_id" id="room-type" class="form-control">
                                                <?php
                                                $room = $this->db
                                                    ->table("room")
                                                    ->orderBy("room_name", "ASC")
                                                    ->get();
                                                //echo $this->db->getLastquery();
                                                $no = 1;
                                                foreach ($room->getResult() as $room) { ?>
                                                <tr>
                                                <option booking_roomprice="<?=$room->room_price;?>" value="<?=$room->room_id;?>"><?=$room->room_name;?></option>
                                                <?php }?>
                                            </select>
                                            
                                            <script>
                                                function isi() {
                                                    var selectedRoom = $("#room-type option:selected");
                                                    var bookingroomprice = selectedRoom.attr("booking_roomprice");
                                                    // alert(bookingroomprice);
                                                    // Setel harga kamar ke elemen lain, misalnya, elemen dengan ID "harga-kamar"
                                                    $("#booking_roomprice").val(bookingroomprice);

                                                    let dewasa=$("#booking_adult").val();
                                                    let anak=$("#booking_child").val();
                                                    let qtyroom=$("#booking_roomcount").val();
                                                    let total = parseInt(dewasa)+parseInt(anak);
                                                    let totalprice=bookingroomprice*qtyroom;
                                                    // alert(totalprice);
                                                    $("#booking_totalprice").val(totalprice);
                                                }
                                                $(document).ready(function(){
                                                    isi();
                                                });
                                            </script>
                                        </div>

                                        <div id="step-2" class="row">
                                            <h4>Enter your details</h4>

                                            <div class="col-md-6">
                                                <div id='name_error' class='error'>Please enter your name.</div>
                                                <div>
                                                    <input type='text' name='booking_name' id='booking_name' class="form-control" placeholder="Your Name" required>
                                                </div>

                                                <div id='email_error' class='error'>Please enter your valid E-mail ID.</div>
                                                <div>
                                                    <input type='email' name='booking_email' id='booking_email' class="form-control" placeholder="Your Email" required>
                                                </div>

                                                <div id='phone_error' class='error'>Please enter your phone number.</div>
                                                <div>
                                                    <input type='text' name='booking_phone' id='booking_phone' class="form-control" placeholder="Your Phone" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div id='message_error' class='error'>Please enter your message.</div>
                                                <div>
                                                    <textarea name='booking_message' id='booking_message' class="form-control" placeholder="Your Message"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <!-- <div class="g-recaptcha" data-sitekey="copy-your-site-key-here"></div> -->
                                                <p id='submit' class="mt20">
                                                    <input type="hidden" name="booking_roomprice" id="booking_roomprice"/>
                                                    <input type="hidden" name="booking_totalprice" id="booking_totalprice"/>
                                                    <button type='submit' name="create" id='send_message' value='OK' class=" btn-line">Submit Form</button>
                                                    <style>
                                                        .btn-line{background:none;}
                                                    </style>
                                                </p>
                                            </div>
                                        </div>
                                    </form>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            

            <?= $this->include('template_front/footerd_v'); ?> 