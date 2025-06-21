<?php
$this->load->view(BACKOFFICE . 'layout/header'); //print_r($knowledgeCentrePostCategoryResult); exit;
?>

<?php
$this->load->view(BACKOFFICE . 'layout/sidemenu');

$formHeading    = "Request";
$buttonName     = "Request";
$url            = SHOW_DATA_REQUEST_WITH_FILTER;
?>

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    
    <div class="subheader py-2 py-lg-6 subheader-transparent" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <h5 class="text-dark font-weight-bold my-1 mr-5"> Uploaded List</h5>
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="<?php echo site_url(BACKOFFICE . 'dashboard'); ?>" class="text-muted">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a class="text-muted"> Profile</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a class="text-muted"><?php echo $formHeading; ?></a>
                        </li>
                    </ul>
                </div>
            </div>
           
        </div>
    </div>
    <!-- page heading end-->
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-custom gutter-b example example-compact" style="padding:8px;">
                        <div class="card-header">
                            <h3 class="card-title"><?php echo $formHeading; ?></h3>
                        </div>
                        <br>
                        <br>
                        <div class="container">
                        <table class="table table-bordered mt-3" id="tblRequest">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Contact</th>
                                    <th>Payment ID</th>
                                    <th>Payment Status</th>
                                    <th>No of Pages</th>
                                    <th>Request Date</th>
                                    <th>Completed Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                               if(!empty($request)){
                                   
                              
                                foreach ($request as $image): 
                                 $css = '';
                                if($image->completed_status=='Done'){
                                    $css = 'success';
                                }elseif($image->completed_status=='Pending'){
                                     $css = 'warning';
                                }
                                ?>
                                <tr>
                                    <td><?php echo $image->id; ?></td>
                                    <td><?php echo $image->name; ?></td>
                                    <td><?php echo $image->email; ?></td>
                                    <td><?php echo $image->contact; ?></td>
                                    <td><?php echo $image->payment_id; ?></td>
                                    <td><?php echo $image->status; ?></td>
                                    <td><?php echo $image->no_of_pages; ?></td>
                                    <td><span class="badge badge-<?php echo $css; ?>"><?php echo $image->completed_status; ?></span></td>
                                    <td><?php echo $image->created_date; ?></td>
                                    <td>
                                        <a href="javascript:void(0);" onclick="editPopup(this);" data-id="<?php echo  $image->id ?>" class="btn btn-sm"><i class="fas fa-edit"></i></a>
                                        <a href="javascript:void(0);" onclick="deleteRequest(this);" data-id="<?php echo  $image->id ?>" class="btn btn-sm"><i class="fa fa-trash"></i></a>
                                        <a href="<?php echo base_url('uploads/plagarism/').$image->file; ?>" download><i class="fa fa-download" aria-hidden="true"></i></a>
                                        </td>
                                </tr>
                                <?php endforeach;  }?>
                            </tbody>
                        </table>
                        </div>
                        

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <input type="hidden" name="hid_id" id="hid_id" value="">
            <div class="col-md-12">
                <label>Status</label>
                <select class="form-control">
                    <option value="pending">Pending</option>
                    <option value="done">Done</option>
                </select>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" onclick="updateData();" class="btn btn-primary">Update</button>
      </div>
    </div>
  </div>
</div>
<!--Main Content End-->

<?php
$this->load->view(BACKOFFICE . 'layout/footer');
$this->load->view(BACKOFFICE . 'layout/jsfiles');
?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script>
    //  $('#tblRequest').DataTable({
    //      "order": [[ 1, "desc" ]] 
    //  });
     
     
     function editPopup(id){
          var recordId = $(id).attr("data-id");
          $("#hid_id").val(recordId);
          $("#exampleModal").modal('show');
          
     }
     function updateData(){
         var id = $("#hid_id").val();
          Swal.fire({
              title: "Are you sure want to update status?",
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
                    url: "<?php echo base_url('backoffice/Upload/updateRequest'); ?>",
                    data: { id: id },
                    success: function(response){
                        var jsnParse = JSON.parse(response);
                        
                        if(jsnParse.status=='success'){
                            Swal.fire({
                              position: "top-end",
                              icon: "success",
                              text: jsnParse.msg,
                              showConfirmButton: false,
                              timer: 1500
                            });
                            location.reload();
                            
                        }else{
                             Swal.fire({
                              position: "top-end",
                              icon: "error",
                              text: jsnParse.msg,
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
     
    function deleteRequest(id){
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
                    url: "<?php echo base_url('backoffice/Upload/deleteRequest'); ?>",
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

</body>

</html>