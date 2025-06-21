<?php $this->load->view(BACKOFFICE . 'layout/header');
$this->load->view(BACKOFFICE . 'layout/sidemenu');
?>

<div class="flex-column-fluid mb-5 px-3">
	<!-- <div class="container"> -->
		<div class="card card-custom">
			<div class="card-header py-3">
				<div class="card-title">
					<span class="card-icon">						
						<i class="fa fa-list text-primary"></i>
					</span>
					<h3 class="card-label">Payment History</h3>
				</div>
				<div class="card-toolbar">
				</div>
			</div>
			<div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-bordered"
                            id="list" >
                            <thead>
                                <tr role="row">
                                    <th >Sr.No</th>
                                    <th >Article ID</th>
                                    <th >Name</th>
                                    <th >Email ID</th>
                                    <th >Contact No.</th>
                                    <th >Payment ID</th>
                                    <th >Currency</th>
                                    <th >Amount</th>
                                    <!--<th >Upi Transaction Id</th>-->
                                    <th >Status</th>
                                    <th >Type</th>
                                    <th >Created Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if(!empty($items)){
                                        $srno=1;
                                        foreach($items as $key => $rowValue){ 
                                        $jsn = json_decode($rowValue['json_details'],true);
                                        $user_details = json_decode($rowValue['user_details'],true);
                                        ?>
                                        <tr>
                                            <td><?php echo $rowValue['id']; ?></td>
                                            <td><?php echo $rowValue['article_id']; ?></td>
                                            <td><?php echo $user_details['name']; ?></td>
                                            <td><?php echo $user_details['email']; ?></td>
                                            <td><?php echo $user_details['phone_number']; ?></td>
                                            <td><?php echo $jsn['id']; ?></td>
                                            <td><?php echo  $jsn['currency']; ?></td>
                                            <td><?php echo  number_format($jsn['amount'] / 100, 2, '.', ','); ?></td>
                                            <!--<td><?php //echo  $jsn['acquirer_data']['upi_transaction_id']; ?></td>-->
                                            <td><?php echo  $jsn['status']; ?></td>
                                            <td><?php echo  $rowValue['type']; ?></td>
                                            <td><?php echo  $rowValue['created_date']; ?></td>
                                           
                                            
                                        </tr>
                                            
                                    <?php    }
                                    }
                                
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>			
		</div>
	<!-- </div> -->
</div>

<?php
$this->load->view(BACKOFFICE . 'layout/footer');
$this->load->view(BACKOFFICE . 'layout/jsfiles');
?>
<script>

    
    
</script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script>
 
  $('#list').DataTable({
      
       order: [[0, 'desc']]
  });
 

    
</script>