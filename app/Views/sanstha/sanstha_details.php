<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use \App\Models\HomeModel;
use \App\Models\UserModel;
use \App\Models\RegionModel;
use \App\Models\statesModel;
use \App\Models\CitiesModel;
use \App\Models\SansthaModel;
?>

<?= view('home/dash_header'); ?>
<style type="text/css">
.field_value{
  color: #000;
  font-size: larger;
  font-weight: 600;
}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container">

    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Sanstha Details</h3>

              <div class="card-tools">

                <div class="input-group input-group-sm">
                  <a href="<?= site_url('sanstha/create_sanstha') ?>"><span class="btn btn-primary btn-sm"> <i class="fas fa-plus fa-sm"></i> New Sanstha </span></a>
                </div>

              </div>
            </div>
            <!-- /.card-header -->
          <!--   <div class="row ml-4">
                  <div class="col-sm-3">
                    <!-- text input --
                    <div class="form-group">
                      <label><h5>State</h5>
                      <select class="form-control" name="cs_state" id="state_select">
                        <option>Please select</option>
                        <?php foreach ($state as $skey) {  ?> 
                          <option value="<?php echo $skey['st_id']; ?>"><?php echo $skey['st_name']; ?></option>
                        <?php } ?>
                      </select></label>
                    </div>
                  </div>
                </div> -->
            <div class="card-body table-responsive p-0">
              	<table class="table table-responsive table-head-fixed text-nowrap table-striped table-bordered" id="sanstha_data">
	                <thead>
	                  <tr>
	                    <th style="width: 1%;text-align: center;">#</th>
	                    <th style="text-align:center;">Sanstha</th>
	                    <th style="text-align: center;">Detail Address</th>
	                    <th style="text-align: center;">Sanstha Category</th>
	                    <th style="text-align: center;">Actions</th>
	                  </tr>					
	                </thead>
	                <tbody>
	                	<?php if(empty($sanstha)) { ?>
	                    <tr><td colspan="6" style="color: red;font-size: large;font-weight: bold;text-align: center;">No Records Found...!!</td></tr>
	                    <?php } else{ $i=0; foreach(array_reverse($sanstha) as $skey) { ?>
	                  	<tr>
	                  		<td><?php echo ++$i; ?></td>
	                  		<td><?php echo $skey['cs_prefix'].' '.$skey['cs_name']; ?></td>
	                  		<td><?php echo $skey['cs_head_off_addr']; ?></td>
	                  		<td><?php //echo $i++; ?></td>
	                  		<td style="text-align: center;" data-toggle="modal" data-id="<?php echo $skey['cs_id'] ?>"data-target="#deleteSanstha"><span class="btn btn-icon btn-xs btn-primary"><i class="fa fa-trash-alt" title="Delete"></i></span> &nbsp; &nbsp; &nbsp;<a href="<?php echo site_url('sanstha/update_sanstha/'.$skey['cs_id']) ?>"><span style="align-items: center;"class="btn btn-icon btn-primary btn-xs"><i class="fa fa-edit" title="Update sanstha"></i></span></a></td>
                      </tr>
	                  <?php } }?>
	                </tbody>
	              </table>
                
               <?php echo $pager->links(); ?>
              </div>              
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
         
            <div id="deleteSanstha" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                            <!-- Modal content-->
                      <form class="form-horizontal" role="form" method="POST" action="<?php echo site_url('Sanstha/sansthaDelete') ?>" style="position: relative;z-index: 10000;">
                            <div class="modal-content">
                                <div class="modal-body">
                                  <h4 class="modal-title">Are you sure you want to delete this sanstha?</h4>
                                  <div class="form-group">
                                    <input type="text" class="form-control" name="cs_id" >
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="submit" class="btn" style="background-color: #1AB394; color:white;" >Yes</button>
                                  <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                </div>
                            </div>
                        </form>
                      </div>
                  </div>
         <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  <div class="p-3">
    <h5>Title</h5>
    <p>Sidebar content</p>
  </div>
</aside>
  <!-- /.control-sidebar -->
<?= view('sanstha/sanstha_footer'); ?>