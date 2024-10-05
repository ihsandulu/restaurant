

    
<div class="toast" data-autohide="false">
    <div class="toast-header">
        <strong class="mr-auto text-primary">Alert</strong>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
    </div>
    <div class="toast-body">
        
    </div>
</div>
<script>
    function showmessage(a) {
        //alert('<?= (isset($_GET['message'])) ? $_GET['message'] : $this->session->getFlashdata("message"); ?>');
        <?php
        if (isset($_GET['message'])) {
            $isipesan = $_GET['message'];
        } else {
            $isipesan = $this->session->getFlashdata("message");
        }
        ?>
        toast('INFO >>>', '<?= $isipesan ?>');
    }

    function toast(judul, isi) {
        toastr.warning(isi, judul, {
            "positionClass": "toast-bottom-right",
            timeOut: 5000,
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut",
            "tapToDismiss": false

        })
    }

    function hidebar(){
        // $(".scroll-sidebar").toggleClass("hidebar");
        setTimeout(function(){
            $(".scroll-sidebar").css({
                "height":"inherit",
                "overflow": "auto"
            });
        },500);
        
    }

    $(document).ready(function() {
        <?php if ($this->session->getFlashdata("message") != "" || isset($_GET['message'])) { ?>
            showmessage(3000);
        <?php } ?>
        $('[data-toggle="tooltip"]').tooltip();        
    });
</script>




<!-- <script src="js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script> -->


<script src="js/lib/toastr/toastr.min.js"></script>
<script src="js/lib/toastr/toastr.init.js"></script>

<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/6550f98fcec6a912820f1906/1hf24tnb8';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

</body>

</html>