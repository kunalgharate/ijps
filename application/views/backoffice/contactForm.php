<?php $this->load->view(BACKOFFICE . 'layout/header');
$this->load->view(BACKOFFICE . 'layout/sidemenu');
?>

<div class="d-flex flex-column-fluid mb-5 px-3">
	<!-- <div class="container"> -->
		<div class="card card-custom">
			<div class="card-header py-3">
				<div class="card-title">
					<span class="card-icon">						
						<i class="fa fa-list text-primary"></i>
					</span>
					<h3 class="card-label">Contact Form Data</h3>
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
                                    <th >Id</th>
                                    <th >Name</th>
                                    <th >Email ID</th>
                                    <th >Contact Number</th>
                                    <th >Subject</th>
                                    <th >Message</th>
                                    <th >Date</th>
                                    <th >Action</th>
                                </tr>
                            </thead>
                            <tbody>
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

    function deleteContact(id){
        var recordId = $(id).attr("data-id");
        
        Swal.fire({
              title: "Are you sure want to delete?",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonText: "Ok",
              showConfirmButton: true,
              allowOutsideClick: false,
              allowEscapeKey: false
            }).then((result) => {
             
              if (result.isConfirmed) {
                     $.ajax({
                        type: "POST",
                        url: "<?php echo base_url('backoffice/Contactform/deleteContactus'); ?>",
                        data: { id: recordId },
                        success: function(response){
                            var jsnParse = JSON.parse(response);
                            
                            if(jsnParse.status=='success'){
                             Swal.fire({
                              position: "top-end",
                              icon: "success",
                              title: jsnParse.msg,
                              showConfirmButton: false,
                              timer: 1500
                            });
                               
                                location.reload();
                                
                            }else{
                                Swal.fire({
                              position: "top-end",
                              icon: "error",
                              title: jsnParse.msg,
                              showConfirmButton: false,
                              timer: 1500
                            });
                            }
                            
                        },
                        error: function(xhr, status, error) {
                       
                        }
                    });
              } 
            });
      
    }
    
</script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script>
 
    $('#list').DataTable({
          'processing': true,
          'serverSide': true,
          'serverMethod': 'post',
          'ajax': {
             'url':'<?=base_url()?>backoffice/Contactform/getList'
          },
          'columns': [
             { data: 'contactFormDataID ' },
             { data: 'name' },
             { data: 'emailID' },
             { data: 'contactNumber' },
             { data: 'subject' },
             { data: 'message' },
             { data: 'createdDate' },
             { data: 'action' },
            
          ]
        });
 

    
</script>