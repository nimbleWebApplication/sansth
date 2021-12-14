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
<script src="<?= base_url();?>/public/frontEnd/vendor/jquery/jquery-ui.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url(); ?>/public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url(); ?>/public/plugins/moment/moment.min.js"></script>
<script src="<?= base_url(); ?>/public/plugins/toastr/toastr.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url(); ?>/public/dist/js/adminlte.min.js"></script>
<script src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
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

    $(document).on('change',"select[name='cs_state']",function(){
      var chkVal=$(this).val(); //alert("chkVal"+chkVal);

       $.post('<?= site_url('Sanstha/getRegion') ?>',{chkVal}, function(regionInfo){
        console.log(regionInfo);
        $('input[name="cs_zone"]').val(regionInfo[0]['zone_name']);
        },'JSON'); 
        
      $.post('<?= site_url('Sanstha/getCity') ?>',{chkVal}, function(cityInfo){
        console.log(cityInfo);
        $('select[name="cs_city"]').empty();
        $("select[name='cs_city']").append('<option value="">Please select</option>');
        $.each(cityInfo,function(p,q){           
            $("select[name='cs_city']").append('<option value="'+q.ct_id+'">'+q.ct_name+'</option>');            
        });       
      },'JSON'); 

     var states = $(this).val();alert("states"+states);
      $.post('<?= site_url('Sanstha/stateWiseDisplay') ?>',{states}, function(stateInfo){
        console.log(stateInfo);
       $('select[name="cs_state"]').empty();
        $("select[name='cs_state']").append('<option value="">Please select</option>');
          $.each(stateInfo,function(p,q){           
            $("select[name='cs_state']").append('<option value="'+q.st_id+'">'+q.st_name+'</option>');            
        });       
      },'JSON'); 
    });

      $('#deleteSanstha').on('show.bs.modal', function(e) {
        var cs_id = $(e.relatedTarget).data('id');
        $(e.currentTarget).find('input[name="cs_id"]').val(cs_id);
        alert(cs_id);
    });
});   
</script>
</body>
</html>
