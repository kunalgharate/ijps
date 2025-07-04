<?php $this->load->view(BACKOFFICE . 'layout/header');
$this->load->view(BACKOFFICE . 'layout/sidemenu');
?>
<style>
    @keyframes modal-open-from-left {
        from { transform: translateX(-100%); }
        to { transform: translateX(0); }
    }
    .modal.fade .modal-dialog { animation: modal-open-from-left 0.3s ease-out; }

    #pagination {
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-end;
        margin-top: 15px;
    }

    .pagination .page-item {
        margin: 0 2px;
    }

    .pagination .page-link {
        color: #007bff;
        border: 1px solid #dee2e6;
        padding: 6px 12px;
        border-radius: 4px;
        text-decoration: none;
    }

    .pagination .page-item.active .page-link {
        background-color: #000;
        border-color: #000;
        color: white;
    }

    .pagination .page-item.disabled .page-link {
        color: #6c757d;
        pointer-events: none;
        background-color: transparent;
        border-color: transparent;
    }
</style>


<div class="flex-column-fluid mb-5 px-3">
    <div class="card card-custom">
        <div class="card-header py-3">
            <div class="card-title">
                <span class="card-icon">
                    <i class="fa fa-list text-primary"></i>
                </span>
                <h3 class="card-label">All Articles List</h3>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-4">
                    <input type="text" id="searchInput" class="form-control" placeholder="Search by Title">
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="list">
                    <thead>
                        <tr>
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
                    <tbody id="articleData"></tbody>
                </table>
                <nav>
                    <ul class="pagination justify-content-end" id="pagination"></ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<?php
$this->load->view(BACKOFFICE . 'layout/footer');
$this->load->view(BACKOFFICE . 'layout/jsfiles');
?>

<script>
let currentPage = 1;
const limit = 10;

function fetchArticles(page = 1, search = '') {
    $.ajax({
        url: '<?php echo base_url("backoffice/Receviedmanuscript/customArticleList"); ?>',
        method: 'POST',
        data: { page, search },
        success: function(response) {
            const data = JSON.parse(response);
            renderTable(data.articles, data.start);
            renderPagination(data.totalPages, page);
        }
    });
}

function renderTable(data, start) {
    const tbody = $('#articleData');
    tbody.empty();
    if(data.length === 0){
        tbody.append('<tr><td colspan="11" class="text-center">No matching records found</td></tr>');
        return;
    }
    data.forEach((item, index) => {
        tbody.append(`
            <tr>
                <td>${start + index + 1}</td>
                <td>${item.articleID}</td>
                <td>${item.isFeatured}</td>
                <td>${item.document}</td>
                <td>${item.articleType}</td>
                <td>${item.title}</td>
                <td>${item.publishedDate}</td>
                <td>${item.doi}</td>
                <td>${item.keywords}</td>
                <td>${item.citation}</td>
                <td>${item.actions}</td>
            </tr>
        `);
    });
}

function renderPagination(totalPages, current) {
    const pagination = $('#pagination');
    pagination.empty();

    const maxVisible = 7;
    const half = Math.floor(maxVisible / 2);
    let start = Math.max(current - half, 1);
    let end = Math.min(current + half, totalPages);

    if (end - start < maxVisible - 1) {
        if (start === 1) {
            end = Math.min(start + maxVisible - 1, totalPages);
        } else if (end === totalPages) {
            start = Math.max(end - maxVisible + 1, 1);
        }
    }

    // Previous
    if (current > 1) {
        pagination.append(`<li class="page-item"><a class="page-link" href="#">«</a></li>`);
    }

    if (start > 1) {
        pagination.append(`<li class="page-item"><a class="page-link" href="#">1</a></li>`);
        if (start > 2) {
            pagination.append(`<li class="page-item disabled"><span class="page-link">...</span></li>`);
        }
    }

    for (let i = start; i <= end; i++) {
        const active = i === current ? 'active' : '';
        pagination.append(`<li class="page-item ${active}"><a class="page-link" href="#">${i}</a></li>`);
    }

    if (end < totalPages) {
        if (end < totalPages - 1) {
            pagination.append(`<li class="page-item disabled"><span class="page-link">...</span></li>`);
        }
        pagination.append(`<li class="page-item"><a class="page-link" href="#">${totalPages}</a></li>`);
    }

    // Next
    if (current < totalPages) {
        pagination.append(`<li class="page-item"><a class="page-link" href="#">»</a></li>`);
    }
}


$(document).on('click', '#pagination a', function(e) {
    e.preventDefault();
    currentPage = parseInt($(this).text());
    fetchArticles(currentPage, $('#searchInput').val());
});

$('#searchInput').on('keyup', function() {
    currentPage = 1;
    fetchArticles(currentPage, $(this).val());
});

$(document).ready(function() {
    fetchArticles();
});

$(document).on('click', '#pagination a', function (e) {
    e.preventDefault();
    let text = $(this).text();

    if (text === '«') {
        currentPage = Math.max(currentPage - 1, 1);
    } else if (text === '»') {
        currentPage = Math.min(currentPage + 1, totalPages);
    } else {
        currentPage = parseInt(text);
    }

    fetchArticles(currentPage, $('#searchInput').val());
});

</script>
