<?= view('home/dash_header'); 
	use App\models\HomeModel;
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<!-- <h1>General Form</h1> -->
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= site_url('sales/pre-sales') ?>">Home</a></li>
						<li class="breadcrumb-item active">Lead Creation</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row" id="import_profiles">
				<div class="col-md-12">
					<!-- general form elements disabled -->
					<div class="card card-primary">
						<div class="card-header">
							<div class="col-sm-11">
								<h3 class="card-title">Create Lead</h3>
							</div>
							<div class="col-sm-1">
								<i class="fa fa-arrow-circle-left"></i>
							</div>
						</div>
						<!-- /.card-header -->
						<form role="form" id="createLead" method="post" action="<?= site_url('sales/save_lead'); ?>">
							<div class="card-body">
								<div class="row">
									<div class="col-sm-3">
										<!-- text input -->
										<div class="form-group">
											<label>Customer Name <span class="mandatory"> * </span></label> <a href="<?= site_url('master/create_customer'); ?>">New Customer?</a>
											<select class="form-control" name="lead_client">
												<option>Please select</option>
												<?php foreach ($client_details as $ckey) { ?>
													<option value="<?php echo $ckey['client_id']?>"><?php echo $ckey['client_name']?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="col-sm-3">
										<div class="form-group">
											<label>Contact No</label>
											<input type="text" class="form-control" placeholder="contact no..." name="client_contact" readonly="">
										</div>
									</div>
									<div class="col-sm-3">
										<div class="form-group">
											<label>Email</label>
											<input type="text" class="form-control" placeholder="email..." name="client_email" readonly="">
										</div>
									</div>
									<div class="col-sm-3">
										<!-- text input -->
										<div class="form-group">
											<label>Region<span class="mandatory"> * </span></label> 
											<select class="form-control" name="lead_region">
												<option>Please select</option>
												<?php foreach ($all_region as $ckey) { ?>
													<option value="<?php echo $ckey['reg_id']?>"><?php echo $ckey['reg_name']?></option>
												<?php } ?>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-3">
										<div class="form-group">
											<label>Department<span class="mandatory"> * </span></label>
											<select name="lead_dept" class="form-control">
												<option>Please select</option>
											</select>
										</div>
									</div>
									<div class="col-sm-3">
										<!-- text input -->
										<div class="form-group">
											<label>Contact Person<span class="mandatory"> * </span></label>
											<select class="form-control" name="cp_contact_person">
												<option>Please select</option>
											</select>
										</div>
									</div>
									<div class="col-sm-3">
										<!-- text input -->
										<div class="form-group">
											<label>Lead Generated Date<span class="mandatory"> * </span></label>
											<input type="text" placeholder="enter lead generated date" class="form-control datepicker" name="lead_generated_date">
										</div>
									</div>
									<div class="col-sm-3">
										<div class="form-group">
											<label>Lead Due Date</label>
											<input type="text" placeholder="enter lead due date" class="form-control datepicker" name="lead_due_date">
										</div>
									</div>
									

								</div>
								<div class="row">
									<div class="col-sm-3">
										<div class="form-group">
											<label>Lead Budget <span class="mandatory"> * </span></label>
											<input type="text" class="form-control" placeholder="Enter budget" name="lead_budget">
										</div>
									</div>

									<div class="col-sm-3">
										<div class="form-group">
											<label>Procurement Type <span class="mandatory"> * </span></label>
											<select name="lead_procurement_type" class="form-control">
												<option>Please Select</option>
												<option value="1">Bid/Tender</option>
												<option value="2">Quotation</option>
												<option value="3">Direct Order</option>
											</select>
										</div>
									</div>
									<div class="col-sm-3">
										<div class="form-group">
											<label>File Movement / Stage <span class="mandatory">  </span></label>
											<textarea class="form-control" placeholder="Enter file movement stage"  name="lead_file_status" ></textarea> 
										</div>
									</div>

									<div class="col-sm-3">
										<div class="form-group">
											<label>Lead Converted To<span class="mandatory">  </span></label>
											<select name="lead_status" class="form-control">
												<option>Please Select</option>
												<option value="1">Bid/Tender</option>
												<option value="2">Quotation</option>
												<option value="3">Direct Order</option>
												<option value="4">Hold</option>
												<option value="5">Delete</option>
											</select>
										</div>
									</div>
								</div>
		                        <div class="row text-right" style="border:none; padding: 5px;">
		                        	<div class="col-sm-12" style="text-align: right; ">
		                        		<span class="btn btn-success add_row" style="border-color: #a9e050;background-color: #a9e050;" id="add_row">Add New Product</span>
		                             <span class="btn btn-warning" id="delete_row" onclick="deleteRow('stock')">Delete</span>
		                        	</div>									
								</div>
								<div class="table-responsive">
		                            <table class="table table-striped table-bordered" style="width:100%">
			                            <thead>
			                                <tr>
			                                    <th>#</th>
			                                    <th>Product</th>
			                                    <th>Quantity</th>
			                                    <th>Proposed Product</th>
			                                    <th>Product Specification</th>
			                                    <th>Product GEM Link</th>
			                                    <th>Budget</th>
			                                    <th>OEM Involved?</th>
			                                </tr>
			                            </thead>
			                            <tbody id="stock">
			                                <tr id="org">
			                                    <td><input type="checkbox"></td>
			                                    <td id="item">
			                                        <select class="form-control lr_product_id" name="lr_product_id[0]" required>
			                                            <option value="">- Choose item -</option>
			                                            <?php foreach($all_products as $key) {?>
			                                                <option value="<?php echo $key['product_id'];?>"><?php echo $key['product_name'];?></option>                                                    
			                                            <?php } ?>
			                                        </select>
			                                    </td>
			                                    <td id="lr_quantity">
			                                      	<input type="text" class="form-control lr_quantity" name="lr_quantity[0]">
			                                    </td>
			                                    <td id="lr_proposed_product"><input type="text" class="form-control lr_proposed_product" name="lr_proposed_product[0]"></td>
			                                    <td id="lr_product_specification"><textarea class="form-control lr_product_specification" name="lr_product_specification[0]"></textarea> </td>
			                                    <td id="lr_product_gem_link"><input type="text" class="form-control lr_product_gem_link" name="lr_product_gem_link[0]"></td>
			                                    <td id="lr_product_budget"><input type="text" class="form-control lr_product_budget" name="lr_product_budget[0]"></td>
			                                    <td id="lr_oem_involved">
			                                    	<select class="form-control lr_oem_involved" name="lr_oem_involved[0]">
			                                    		<option>Please select</option>
			                                    		<option value="Yes">Yes</option>
			                                    		<option value="No">No</option>
			                                    	</select>
			                                    </td>                                     
			                                </tr>
			                            </tbody>                            
		                            </table>
                        		</div>

							</div>
							<!-- /.card-body -->
							<div class="card-footer">
								<button type="submit" class="btn btn-primary">Create Lead</button>
								<button type="reset" class="btn btn-default">Reset</button>
							</div>
						</form>
					</div>
					<!-- /.card -->
				</div>
			</div>
			<!-- /.row -->
			
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?= view('sales/lead/lead_footer'); ?>