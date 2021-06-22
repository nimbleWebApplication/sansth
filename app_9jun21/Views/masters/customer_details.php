<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use \App\Models\HomeModel;
?>

    <?= view('home/dash_header'); ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark"> </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?= site_url('dashboard') ?>">Home</a></li>
                <li class="breadcrumb-item">Customers</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
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
                <h3 class="card-title">Customer Details</h3>

                <div class="card-tools">
				  
                  <div class="input-group input-group-sm" style="width: 250px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
					<a href="<?= site_url('master/create_customer') ?>"><span class="btn btn-primary btn-sm"> <i class="fas fa-plus fa-lg"></i> Customer </span></a>
                  </div>
				  
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" >
                <table class="table table-head-fixed text-nowrap table-striped table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 2%;">Sr No.</th>
                      <th>Client Name </th>
                      <th>E-mail</th>
                      <th>Contact No</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>   
                  <?php if(empty($client_details)) { ?>
                      <tr><td colspan="4" style="color: red;font-size: large;font-weight: bold;text-align: center;">No Records Found...!!</td></tr>
                  <?php } else{ $i=0; foreach (array_reverse($client_details) as $lkey) { 
                      $client=(new HomeModel())->getData(array('client_id'=>$lkey['lead_client']),'sales_client');
                      $contact_person=(new HomeModel())->getData(array('cp_company'=>$lkey['lead_client'],'cp_department'=>$lkey['lead_dept']),'sales_contact_person');
                      $dept=(new HomeModel())->getData(array('dept_id'=>$lkey['lead_dept'],'dept_isDelete'=>0),'sales_department')
                    ?>
                      <tr style="text-align: center;">
                        <td><?php echo ++$i;?></td>
                        <td><?php echo $lkey['client_name']; ?></td>
                        <td><?php echo $lkey['client_email']; ?></td>
                        <td><?php echo $lkey['client_contact']; ?></td>
                       
                        <td><a href="<?php echo site_url('master/up_cust/'.$lkey['client_id'].''); ?>"><span class="btn btn-primary btn-sm"><i class="fa fa-pencil-alt fa-sm" title="Edit Customer"></i></span></a></td>
                      </tr>
                  <?php } } ?>			
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
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
    <?= view('sales/sales_footer'); ?>