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
                <h3 class="card-label">All Articles List</h3>
            </div>
            <div class="card-toolbar">
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="table-responsive"> 
                    <table class="table table-bordered table-hover" id="list">
                        <thead>
                        
                            <tr role="row">
                                <th>Sr.No</th>
                                <th>Article ID</th>
                                <th>Is Featured</th>
                                <th>Document</th>
                                <th>Article Type</th>
                                <th>Title</th>
                                <th>Published Date</th>
                                <th>DOI</th>
                                <th>Keywords</th>
                                <th>Citation</th>
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


<?php
$this->load->view(BACKOFFICE . 'layout/footer');
$this->load->view(BACKOFFICE . 'layout/jsfiles');


?>


<script>



</script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script> 

    
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
            "url": "<?php echo site_url('backoffice/Receviedmanuscript/manageArticleList') ?>",
            "type": "POST",
            "data": function() {

            }
        },
        "columnDefs": [{
            "targets": "_all",
            "orderable": false,
        }, ],
    });

   
</script>