<!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      <!-- Anything you want -->
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2021-2022 <a href="https://nimble-esolutions.com/">Nimble e-Solutions</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?= base_url(); ?>/public/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url(); ?>/public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url(); ?>/public/plugins/moment/moment.min.js"></script>
<script src="<?= base_url(); ?>/public/plugins/toastr/toastr.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url(); ?>/public/dist/js/adminlte.min.js"></script>
<!-- <script src="<?= base_url(); ?>/public/plugins/js/main.js"></script> -->
<script src="<?= base_url(); ?>/public/frontEnd/js/main.js"></script>
<script src="<?= base_url(); ?>/public/frontEnd/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url(); ?>/public/frontEnd/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url();?>/public/frontEnd/vendor/jquery/jquery-ui.min.js"></script>
<script src="<?= base_url(); ?>/public/frontEnd/vendor/counterup/counterup.min.js"></script>
<script src="<?php echo  base_url();?>/public/frontEnd/vendor/validate/jquery.validate.min.js"></script>
<script src="<?php echo  base_url();?>/public/frontEnd/vendor/validate/additional-methods.min.js"></script>


<script type="text/javascript">
	$(window).on('load',function() {
      $(".loader").fadeOut("slow");
  });

  $(document).ready(function () {
    <?php if(isset($success)): ?>
      toastr.success("<?php echo $success; ?>");
    <?php endif; ?>
    <?php if(isset($info)): ?>
      toastr.info("<?php echo $info; ?>");
    <?php endif; ?>
    <?php if(isset($error)): ?>
      toastr.error("<?php echo $error; ?>");
    <?php endif; ?>

    $( ".datepicker" ).datepicker({
        dateFormat : 'yy-m-d',
        changeMonth: true,
        changeYear: true,
    });

    $('#deleteCP').on('show.bs.modal', function(e) {
        var cp_id = $(e.relatedTarget).data('id');
        $(e.currentTarget).find('input[name="cp_id"]').val(cp_id);
    });

     $(document).on('change',"select[name='client_state']",function(){
     // alert("hii");
      var chkVal=$(this).val(); //alert("chkVal"+chkVal);
      // $('input[name="client_city"]').val('');
     
      $.post('<?= site_url('Master/getCity') ?>',{chkVal}, function(cityInfo){
        console.log(cityInfo);
        $('input[name="client_city"] option').remove();
        $.each(cityInfo,function(p,q){           
            $("select[name='client_city']").append('<option value="'+q.ct_id+'">'+q.ct_name+'</option>');            
        });       
      },'JSON'); 
     });

    
     $('#createCustomer').validate({
      rules: {
        // lead_budget:{
        //   digits:true
        // },
        
      },
      messages: {
        // mt_category:{
        //   required: "Please enter receipe category"
        // },
        // mt_cuisine:{
        //   required: "Please enter receipe cuisine"
        // },
        // mt_name:{
        //   required: "Please enter receipe name"
        // },
        // mt_serve_to:{
        //   required: "Please enter how many serve",
        //   digits: "Enter only digits"
        // },
        // mt_preparation_time:{
        //   required:"Please enter preparation time",
        //   digits: "Enter only digits"
        // },
        // mt_display_name:{
        //   required:"Please enter receipe display name"
        // },
        // mt_ingredients:{
        //   required: "Please enter ingredients"
        // },
        // mt_preparation_method:{
        //   required: "Please enter preparation method"
        // },
        // im_image_url:{
        //   required : "Please select thumbneil image for receipe"
        // }  
      },
      errorElement: 'span',
      errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
      },
      highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      }
    });
  });
</script>
</body>
</html>
