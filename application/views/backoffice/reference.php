<?php $this->load->view(BACKOFFICE . 'layout/header');
$this->load->view(BACKOFFICE . 'layout/sidemenu');
?>

<div class=" flex-column-fluid mb-5 px-3">
	<!-- <div class="container"> -->
		<div class="card card-custom">
			<div class="card-header py-3">
				<div class="card-title">
					<span class="card-icon">						
						<i class="fa fa-list text-primary"></i>
					</span>
					<h3 class="card-label">Reference Form Data</h3>
				</div>
				<div class="card-toolbar">
				</div>
			</div>
			<div class="card-body">
           
            <div class="row">
                    <div class="col-sm-12">
                <div id="popup" style="display: none;">
                    <form action="<?php echo base_url('backoffice/add-reference'); ?>" enctype="multipart/form-data" method="post">
                        <label for="title">Title:</label><br>
                        <input type="text" id="title" name="title" class="form-control"><br>
                        <label for="description">Description:</label><br>
                        <textarea id="description" name="description" class="form-control"></textarea><br>
                        <label for="url">URL:</label><br>
                        <input type="text" id="url" name="url" class="form-control"><br>
                        <label for="image">Image URL:</label><br>
                        <input type="file" id="userfile" name="userfile" class="form-control"><br>
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" onclick="closeId()"  class="btn btn-danger">Close</button>
                    </form>
                </div>
                    </div></div>
                <div class="row">
                    <div class="col-md-12">
                    <button onclick="openPopup()" class="btn btn-primary float-right">Add New</button> <br>
                    <div class="table-responsive">
                    <table class="table table-bordered" id="referencelist">
                        <thead>
                            <tr>
                               
                                <th>Srno</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>URL</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        
                       
                    </table>
                    </div>
                    </div>
                </div>
            </div>			
		</div>
	<!-- </div> -->
</div>
<div class="modal fade" id="editReferenceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit References</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url('backoffice/saveReferenceData'); ?>" enctype="multipart/form-data" method="post">
            <input type='hidden' name="edit_id" id="edit_id" value=''>
                        <label for="title">Title:</label><br>
                        <input type="text" id="edit_title" name="edit_title" class="form-control"><br>
                        <label for="description">Description:</label><br>
                        <textarea id="edit_description" name="edit_description" class="form-control"></textarea><br>
                        <label for="url">URL:</label><br>
                        <input type="text" id="edit_url" name="edit_url" class="form-control"><br>
                        <label for="image">Image URL:</label><br>
                        <input type="file" id="edit_userfile" name="edit_userfile" class="form-control"><br>
                        <input type="hidden" id="old_image" name="old_image" class="form-control"><br>
                        
                        <!--<button type="submit" class="btn btn-primary">Update</button>-->
                        <!--<button type="button"   class="btn btn-danger">Cancel</button>-->
                    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="closeId()" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php
$this->load->view(BACKOFFICE . 'layout/footer');
$this->load->view(BACKOFFICE . 'layout/jsfiles');
?>
<script>
        function openPopup() {
            document.getElementById("popup").style.display = "block";
        }
        function closeId() {
            document.getElementById("popup").style.display = "none";
        }
    </script>
<script>

    function deleteReference(id){
        var recordId = $(id).attr("data-id");
       if(confirm('Are you sure want to delete?')){
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('backoffice/Reference/deleteRefe'); ?>",
                data: { id: recordId },
                success: function(response){
                    var jsnParse = JSON.parse(response);
                    
                    if(jsnParse.status=='success'){
                        alert(jsnParse.msg);
                        location.reload();
                        
                    }else{
                        alert(jsnParse.msg);
                    }
                    
                },
                error: function(xhr, status, error) {
               
                }
            });
        }
    }
    
    function editReference(id){
        var recordId = $(id).attr("data-id");
       
      if(confirm('Are you sure want to update?')){
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('backoffice/Reference/editReference'); ?>",
                data: { id: recordId },
                success: function(response){
                       var jsnParse = JSON.parse(response);
                       
                       console.log(jsnParse);
                    $("#edit_id").val(jsnParse.id);
                    $("#edit_title").val(jsnParse.title);
                    $("#edit_description").val(jsnParse.description);
                    $("#old_image").val(jsnParse.image);
                    $("#edit_url").val(jsnParse.url);
                   
                    $('#editReferenceModal').modal('show');
                   
                    
                },
                error: function(xhr, status, error) {
               
                }
            });
        }
    }
    
    
</script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script>
 
    $('#referencelist').DataTable({
          'processing': true,
          'serverSide': true,
          'serverMethod': 'post',
          'ajax': {
             'url':'<?=base_url()?>backoffice/Reference/getList'
          },
          'columns': [
           
             { data: 'id' },
             { data: 'title' },
             { data: 'description' },
             { data: 'image' },
             { data: 'url' },             
             { data: 'action' },
            
          ]
        });
</script>
