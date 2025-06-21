<?php $this->load->view(BACKOFFICE . 'layout/header');
$this->load->view(BACKOFFICE . 'layout/sidemenu');
?>
<style>
    @keyframes modal-open-from-left {
        from {
            transform: translateX(-100%);
        }

        to {
            transform: translateX(0);
        }
    }

    .modal.fade .modal-dialog {
        animation: modal-open-from-left 0.3s ease-out;
    }
</style>

<div class="flex-column-fluid mb-5 px-3">
    <!-- <div class="container"> -->
    <div class="card card-custom">
        <div class="card-header py-3">
            <div class="card-title">
                <span class="card-icon">
                    <i class="fa fa-list text-primary"></i>
                </span>
                <h3 class="card-label">Recevied Manuscript</h3>
            </div>
            <div class="card-toolbar">
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-bordered" id="list">
                        <thead>
                            <tr role="row">
                                <th>Sr.No</th>
                                <th>Article ID</th>
                                <th>Author Name</th>
                                <th>Title Of Paper</th>
                                <th>Article Type</th>
                                <th>Country Name</th>
                                <th>Date of Submission</th>
                                <th>Current Status</th>
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
    <!-- </div> -->
</div>

<div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change Manuscript Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form method="post" id="submitStatusFrm" enctype="multipart/form-data">
                <input type="hidden" name="txtManuscriptID" id="txtManuscriptID">
                <input class="form-control" type="hidden" name="txtArticleID" id="txtArticleID" value="">
                <input class="form-control" type="hidden" name="txtPDate" id="txtPDate" value="">
                <input class="form-control" type="hidden" name="txtEmail" id="txtEmail" value="">
               
                <input class="form-control" type="hidden" name="txtTitleOfPaper" id="txtTitleOfPaper" value="">

                <dvi class="container">
                    <div class="mb-5" >
                    <label for="">Status</label>
                    <select class="form-control cmbStatusID" name="cmbStatusID" id="cmbStatusID" onchange="showRespectiveDiv(this)" required>
                        <option value="1" >Received</option>
                        <option value="2">Accepted</option>
                        <option value="3">Paid</option>
                        <option value="4" data-select2-id="select2-data-2-63od">Published</option>
                        <option value="5">Rejected</option>
                    </select>
                    </div>

                    <div id="acceptedDiv" style="display:none;">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Sr.No</th>
                                    <th scope="col">Critical review on</th>
                                    <th scope="col">Points out of 10</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $emptyJson = json_decode('[{"reviewPoint":"Relevance of Title","txtCol1Value":""},{"reviewPoint":"Depth of Research","txtCol1Value":""},{"reviewPoint":"Extent of originality","txtCol1Value":""},{"reviewPoint":"Practical Applicability","txtCol1Value":""},{"reviewPoint":"Justification of conclusion","txtCol1Value":""},{"reviewPoint":"Structure and Organization","txtCol1Value":""},{"reviewPoint":"Quality of references","txtCol1Value":""}]', true);
                                $sr = 1;
                                foreach ($emptyJson as $key => $emptyValue) {
                                ?>
                                    <tr>
                                        <td><?php echo $sr++; ?></td>
                                        <td><input class="form-control" type="hidden" name="reviewPoint[]" value="<?php echo $emptyValue['reviewPoint']; ?>"><?php echo $emptyValue['reviewPoint']; ?></td>
                                        <td><input type="text" class="form-control" name="txtCol1Value[]" value="<?php echo $emptyValue['txtCol1Value']; ?>"></td>
                                    </tr>
                                <?php }  ?>
                            </tbody>
                        </table>
                    </div>
                    <div id="publishedDiv" style="display:none;">
						<input type="hidden" name="articlePdf" id="articlePdf">
						<input type="hidden" name="articleUrl" id="articleUrl">
						<div class="col-lg-12">
							<div class="form-group">
								<label for="certificatePdf">
									Upload Certificate PDF
									<span style="color:red">(only PDF file) *</span>
								</label>
								<input type="file" name="certificatePdf" class="form-control" id="certificatePdf" accept=".pdf">
								<div class="help-block with-errors"></div>
							</div>
						</div>
                    </div>
						<div id="rejectDiv" style="display:none;">
							<label for="">Message</label>
							<textarea class="form-control" name="txtMessage" rows="6"><?= htmlentities($message ?? '', ENT_QUOTES, "UTF-8") ?></textarea>
						</div>
                </dvi>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" id="dismissModal">Close</button> -->
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
             </form>
        </div>
    </div>
</div>
<?php
$this->load->view(BACKOFFICE . 'layout/footer');
$this->load->view(BACKOFFICE . 'layout/jsfiles');
$fetchLink = base_url()."/".BACKOFFICE.'manuscript/ManuscriptController/fetchDocuments';
$imagePath = base_url("assetsbackoffice/images/mainlogo.png");
$updateLink = base_url()."/".BACKOFFICE.'manuscript/ManuscriptController/updateManuscript';
$getReviewPoint = base_url()."/".BACKOFFICE.'manuscript/ManuscriptController/getReviewPoint';
$deleteData = base_url(). BACKOFFICE .'manuscript/ManuscriptController/deleteManu';
?>


<script>
    function deleteRecord(manuscriptID) {
        Swal.fire({
            title: "Are you sure want to delete?",
            text: "You won't be able to revert this!",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    type: "POST",
                    url: "<?php echo $deleteData ?>",
                    data: {
                        manuscriptID: manuscriptID
                    },
                    success: function(response) {
                        var jsonP = JSON.parse(response);
                        if(jsonP.status=='success'){
                            Swal.fire({
                                title: "Deleted!",
                                text: "Record has been deleted.",
                                type: "success",                               
                                }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                            });
                               
                        }else{
                            alert('Error');
                        }

                        
                    }
                });
            }
        });
    }

   
</script>
<script>



</script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#dismissModal').click(function() {
            $('#myModal').modal('hide');
        });

        
    });
    function showRespectiveDiv(id){
            var id = $(id).val();
            if(id==2){
                $("#acceptedDiv").show();
                $("#rejectDiv").hide();
                $("#publishedDiv").hide();

               
            }else if(id==5){
                $("#rejectDiv").show();
                $("#acceptedDiv").hide();
                $("#publishedDiv").hide();
            }else if(id==4){
                
                $("#rejectDiv").hide();
                $("#acceptedDiv").hide();
                $("#publishedDiv").show();

            }
            else if(id==1){
                
                $("#rejectDiv").hide();
                $("#acceptedDiv").hide();
                $("#publishedDiv").hide();

            }else{
                $("#rejectDiv").hide();
                $("#acceptedDiv").hide();
                $("#publishedDiv").hide();
            }
        }
        $("#txtManuscriptID").val('');
    function openModal(statusId,manuscriptId,uniqueCode,created_date,email) {
            $("#txtManuscriptID").val(manuscriptId);
            $("#txtArticleID").val(uniqueCode);
            $("#txtPDate").val(created_date);
            $("#txtEmail").val(email);
            // $("#txtTitleOfPaper").val(titleOfPaper);            
            shoD(manuscriptId);
            getReviewPoint(uniqueCode);
            $('.cmbStatusID')
    .val(statusId)
    .trigger('change');
            $("#exampleModal").modal('show');
    }

    function getReviewPoint(uniqueCode){
       
        $.ajax({
            url:  '<?php echo $getReviewPoint; ?>',
            type: 'POST',            
            data: {uniqueCode:uniqueCode},
            success: function (data) {
                try {
                    if (data) {
                        // var jsonParse = JSON.parse(data);
                        // if (jsonParse.status == 'success') {
                            $("#acceptedDiv").html(data);
                        // }
                    }
                } catch (error) {
                    console.error('Error parsing JSON:', error);                    
                }
            }
        });
    }



    function shoD(manuscriptId){
			
            $.ajax({
                    url:  '<?php echo $fetchLink; ?>',
                    type: 'POST',
                    
                    data: {manuscriptId:manuscriptId},
                     beforeSend: function() {
                        $("#articlePdf").val('');
                        $("#articleUrl").val('');
                    },
                    success: function (data) {
                       try {
                            if (data) {
                                var jsonParse = JSON.parse(data);
                                if (jsonParse.status == 'success') {
                                    // $("#articlePdf" + manuscriptId).val(jsonParse.document);
                                    // $("#articleUrl" + manuscriptId).val(jsonParse.articleUrl);
                                     $("#articlePdf").val(jsonParse.document);
                                    $("#articleUrl").val(jsonParse.articleUrl);
                                } else {
                                    // Handle failure case if needed
                                }
                            } else {
                                // Handle the case when data is undefined or empty
                            }
                        } catch (error) {
                            console.error('Error parsing JSON:', error);
                            // Handle the error appropriately
                        }
                    }
                });
        }

    //user users listing datatables
    var table1;
    table1 = $('#list').DataTable({

        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        "processing": true,

        "order": [
            [0, 'desc']
        ],
        "ajax": {
            "url": "<?php echo site_url('backoffice/Receviedmanuscript/getManuscript') ?>",
            "type": "POST",
            "data": function() {

            }
        },
        "columnDefs": [{
            "targets": "_all",
            "orderable": false,
        }, ],
    });

    $(document).ready(function() {
		$(document).on('submit', '#submitStatusFrm', function (e) {
			e.preventDefault();
			var form = this;
			Swal.fire({
				title: "Do you want to change the status?",
				showCancelButton: true,
				confirmButtonText: "Ok",
			}).then((result) => {
				if (result.isConfirmed) {
					var bodyFormData = new FormData(form);
					$.ajax({
						url:  '<?php echo $updateLink; ?>',
						type: 'POST',
						contentType: false,
						processData: false,
						data: bodyFormData,
						success: function (data) {
							var jsonParse = JSON.parse(data);
							if (jsonParse.status == 'success') {
								Swal.fire({
									title: "Updated!",
									text: jsonParse.msg,
									icon: "success"
								});
								// $(form).trigger("reset");
								location.reload();
							} else {
								Swal.fire({
									icon: "error",
									title: "Oops...",
									text: jsonParse.status
								});
							}
						}
					});
				}
			});
		});
	});
</script>
