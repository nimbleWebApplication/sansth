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
              <!-- <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Layout</a></li>
                <li class="breadcrumb-item active">Top Navigation</li>
              </ol> -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container">
          <div class="row">
            <?php //if(session()->get('role_id') == '3' || session()->get('role_id') == '4'){ ?>
            <div class="col-lg-2 col-6">
              <!-- small box -->
              <div style="background-color: #30b977;color:white;"class="small-box">
                <div class="inner">
                

                  <p>Sanstha</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="<?= site_url('sanstha/sanstha_details/9999'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
             <div class="col-lg-2 col-6">
              <!-- small box -->
              <div style="background-color: #f9d62c;" class="small-box">
                <div class="inner">
                

                  <p>Maharashtra</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="<?= site_url('sanstha/sanstha_details/22'); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-2 col-6">
              <!-- small box -->
              <div style="background-color: #30b977;color:white;" class="small-box">
                <div class="inner">
                

                  <p>Karnataka</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="<?= site_url("sanstha/sanstha_details/17"); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-2 col-6">
              <!-- small box -->
              <div style="background-color: #f9d62c;" class="small-box">
                <div class="inner">
                

                  <p>Goa</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="<?= site_url("sanstha/sanstha_details/11"); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>


            <?php //} ?>
            <!-- ./col -->
           
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
    <?= view('home/dash_footer'); ?>