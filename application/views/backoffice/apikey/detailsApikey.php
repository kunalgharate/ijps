<?php 
			$this->load->view(BACKOFFICE.'layout/header');
		?>
        
			<style>
				.fileUpload
				{
					width: 100%;
					padding: 0.4rem 1rem;
					overflow: hidden;
					line-height: 1.5;
					color: #3f4254;
					background-color: #fff;
					border: 1px solid #e4e6ef;
					border-radius: .42rem;
				}
				
				#previewA img { max-width: 150px; }


        td {
            word-break: break-word;
            max-width: 200px; /* Adjust width as needed */
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap; /* Keeps text in one line */
        }

        td:hover {
            white-space: normal; /* Show full text on hover */
        }
			</style>
		<?php
			$this->load->view(BACKOFFICE.'layout/sidemenu');
			
		?>
		
		<!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h2 class="mt-5">API Key Details</h2>
          </div>
          <div class="col-sm-6">
          <?php  if(empty($newsletterResult)) 
              { ?>
            <ol class="breadcrumb float-sm-right">
              <a href="<?php echo base_url('backoffice/apikey/addApiKey'); ?>"><button class="btn btn-primary">Add</button></a>
            </ol>
            <?php } ?>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
              <!-- <?php //$this->load->view('admin/layout/admin_alert'); ?> -->
            <div class="card">
             
              <!-- /.card-header -->
              <div class="card-body">
              <?php  if(count($newsletterResult) > 0 ) 
              { ?>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SN</th>
                    <th>Public key</th>
                    <th>Secret key</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php  
                  
                   $i=1; 
                   foreach($newsletterResult as $info) 
                   { 
                    // print_r($info); die;
                     ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $info['PublicKey'] ?></td>
                    <td><?php echo $info['SecretKey'] ?></td>
                    <td>
                      <a href="<?php echo site_url('backoffice/apikey/' . $info['apikeyID']); ?>" title="Update">
                          <i class="fas fa-edit" aria-hidden="true" style="color:blue;"></i>
                      </a>
                    </td>
                  </tr>
                  <?php $i++; } ?>
                  </tbody>
                </table>
                <?php } else
                { echo '<div class="alert alert-danger alert-dismissable">
                <i class="fa fa-ban"></i>
                <b>Alert!</b>
                Sorry No records available
              </div>' ; } ?>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
		<!--Main Content End-->
		
		<?php 
			$this->load->view(BACKOFFICE.'layout/footer');
			$this->load->view(BACKOFFICE.'layout/jsfiles');
			// $ajaxUrl = site_url(BACKOFFICE.$url);
		?>
		
		
	</body>
</html>