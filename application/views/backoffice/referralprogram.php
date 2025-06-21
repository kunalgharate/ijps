<?php 
$this->load->view(BACKOFFICE . 'layout/header');
$this->load->view(BACKOFFICE . 'layout/sidemenu');
?>

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-custom gutter-b">
                        <div class="card-header">
                            <h3 class="card-title">Referral Program Requests</h3>
                        </div>
                        <div class="container">
                            <table class="table table-bordered mt-3" id="tblRequest">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Article ID</th>
                                        <th>Title of Paper</th>
                                        <th>UPI ID</th>
                                        <th>Request Date</th>
                                        <th>Completed Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($requests)) {
                                        foreach ($requests as $request): 
                                            // Apply color coding for status
                                            $css = ($request->completed_status == 'completed') ? 'badge-success' : 'badge-warning'; ?>
                                            <tr>
                                                <td><?php echo $request->id; ?></td>
                                                <td><?php echo $request->name; ?></td>
                                                <td><?php echo $request->email; ?></td>
                                                <td><?php echo $request->article_id; ?></td>
                                                <td><?php echo $request->title_of_paper; ?></td>
                                                <td><?php echo $request->upi_id; ?></td>
                                                <td><?php echo $request->created_date; ?></td>
                                                <!-- Status dropdown for changing completed status -->
                                                <td>
                                                    <select class="form-control status-dropdown <?php echo ($request->completed_status == 'completed') ? 'badge-success' : 'badge-warning'; ?>" data-id="<?php echo $request->id; ?>" style="width: 100px;" onchange="updateDropdownColor(this)">
                                                        <option value="pending" <?php echo ($request->completed_status == 'pending') ? 'selected' : ''; ?>>Pending</option>
                                                        <option value="completed" <?php echo ($request->completed_status == 'completed') ? 'selected' : ''; ?>>Completed</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <a href="javascript:void(0);" onclick="deleteRequest(this);" data-id="<?php echo $request->id ?>" class="btn btn-sm"><i class="fa fa-trash"></i></a>
                                                    <a href="<?php echo base_url('uploads/referral/').$request->file_path; ?>" download class="btn btn-sm"><i class="fa fa-download" aria-hidden="true"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach;
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$this->load->view(BACKOFFICE . 'layout/footer');
?>


<script>
    function updateDropdownColor(selectElement) {
        // Apply background color to the dropdown based on the selected value
        if (selectElement.value === 'pending') {
            selectElement.style.backgroundColor = '#ffa800'; // Yellow (badge-warning)
            selectElement.style.color = '#000'; // Black text for readability
        } else if (selectElement.value === 'completed') {
            selectElement.style.backgroundColor = '#198754'; // Green (badge-success)
            selectElement.style.color = '#fff'; // White text for readability
        }
    }

    // Apply initial styles only to the select (not the options)
    document.querySelectorAll('.status-dropdown').forEach(selectElement => {
        updateDropdownColor(selectElement);
    });
</script>

<!-- Add jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // Function to update the status when a user selects an option
    $(document).on('change', '.status-dropdown', function() {
        var recordId = $(this).attr('data-id'); // Get the request ID
        var newStatus = $(this).val(); // Get the selected status value

        // Set the color of the dropdown based on the selected status
        if (newStatus == "Pending") {
            $(this).removeClass('badge-success').addClass('badge-warning');
        } else {
            $(this).removeClass('badge-warning').addClass('badge-success');
        }

        // Send an AJAX request to update the status in the database
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('backoffice/ReferralController/updateRequest'); ?>", // Ensure the correct URL
            data: {
                id: recordId,
                completed_status: newStatus // Send the updated status
            },
            success: function(response) {
                // Parse the response JSON
                var responseData = JSON.parse(response);
                if (responseData.status === 'success') {
                    // Success message using SweetAlert
                    Swal.fire({
                        icon: 'success',
                        title: 'Status Updated',
                        text: responseData.msg
                    });
                } else {
                    // Error message using SweetAlert
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: responseData.msg
                    });
                }
            },
            error: function(xhr, status, error) {
                // Error handling for AJAX request failure
                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: "Something went wrong. Please try again."
                });
            }
        });
    });
</script>

