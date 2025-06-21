<?php
$this->load->view(BACKOFFICE . 'layout/header'); //print_r($knowledgeCentrePostCategoryResult); exit;
?>

<?php
$this->load->view(BACKOFFICE . 'layout/sidemenu');

$formHeading    = "Upload";
$buttonName     = "Upload";
$url            = SHOW_DATA_REQUEST_WITH_FILTER;
?>

<!--Main Content Start-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--page heading start-->
    <div class="subheader py-2 py-lg-6 subheader-transparent" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <h5 class="text-dark font-weight-bold my-1 mr-5"> <?php echo $formHeading; ?></h5>
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
            <div class="d-flex align-items-center">
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
                            <form action="<?php echo base_url('backoffice/upload/process'); ?>" method="post" enctype="multipart/form-data">
                                <input type="file" class="form-control" name="userfile[]" multiple  />
                                <span class="text-danger"><?php echo $error; ?></span>
                                <br /><br />

                                <input type="submit" class="btn btn-primary" value="Upload Image" />
                        </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--page heading start-->
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
            <div class="d-flex align-items-center">
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
                        <table class="table table-bordered mt-3" id="list">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Copy</th>
                                    <th>URL</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                if(!empty($images)):
                                    
                               
                                foreach ($images as $image): ?>
                                <tr>
                                    <td><?php echo $image->id; ?></td>
                                    <td><i  style="color: #009ef7 !important;cursor:pointer;" class="fa fa-copy" onclick="copyToClipboard(<?php echo $image->id; ?>,'<?php echo $image->url; ?>','<?php echo $image->original_filename; ?>')"></i> </td>
                                    <td><?php echo $image->url; ?>  </td>
                                    <td><img src="<?php echo $image->url; ?>" height="100" width="100" alt="Uploaded Image" class="img-fluid"></td>
                                    <td><a href="<?php echo base_url('backoffice/Upload/deleteCreatedUrl/'.$image->id) ?>" onclick="return confirm('Are sure want to delete?');"><i class="fa fa-trash"></i></i></a></td>
                                </tr>
                                <?php endforeach;endif; ?>
                            </tbody>
                        </table>
                        </div>
                        

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!--Main Content End-->

<?php
$this->load->view(BACKOFFICE . 'layout/footer');
$this->load->view(BACKOFFICE . 'layout/jsfiles');
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css"/>

  

   <!-- Datatable JS -->
   <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script>
    $('#list').DataTable({
        order: [[0, 'desc']]
        
    });
</script>

<script>

function copyToClipboard(imageId,imageUrl,originalName) {
          
    var htmlCode = `
        <a href="${imageUrl}" target="_blank">
            <img alt="${originalName}" height="150" src="${imageUrl}" width="150">
        </a>
    `;
    var tempTextarea = document.createElement('textarea');
    tempTextarea.value = htmlCode;
    document.body.appendChild(tempTextarea);
    tempTextarea.select();
    document.execCommand('copy');
    document.body.removeChild(tempTextarea);
    alert('Code copied to clipboard!');
}
</script>
</body>

</html>