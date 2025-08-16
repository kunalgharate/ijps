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
        cursor: pointer;
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
    
    .loading-spinner {
        display: none;
        text-align: center;
        padding: 20px;
    }
    
    .error-message {
        display: none;
        background-color: #f8d7da;
        color: #721c24;
        padding: 10px;
        border-radius: 4px;
        margin-bottom: 15px;
    }
    
    .table-container {
        position: relative;
        min-height: 400px;
    }
    
    .search-container {
        position: relative;
    }
    
    .search-container .form-control {
        padding-right: 40px;
    }
    
    .search-container .search-icon {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        color: #6c757d;
    }
    
    .filters-container {
        background-color: #f8f9fa;
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 20px;
    }
    
    .table-responsive {
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    
    .table thead th {
        background-color: #343a40;
        color: white;
        border: none;
        font-weight: 600;
    }
    
    .table tbody tr:hover {
        background-color: #f8f9fa;
    }
    
    .btn-action {
        margin: 0 2px;
        padding: 5px 8px;
        border-radius: 3px;
    }
    
    .status-badge {
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 0.8em;
        font-weight: 500;
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
            <div class="card-toolbar">
                <button type="button" class="btn btn-primary btn-sm" onclick="refreshData()">
                    <i class="fa fa-sync-alt"></i> Refresh
                </button>
            </div>
        </div>
        <div class="card-body">
            <!-- Error Message Container -->
            <div id="errorMessage" class="error-message"></div>
            
            <!-- Filters Container -->
            <div class="filters-container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="search-container">
                            <input type="text" id="searchInput" class="form-control" placeholder="Search by Title, Article ID..." maxlength="100">
                            <i class="fa fa-search search-icon"></i>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select id="statusFilter" class="form-control">
                            <option value="">All Status</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select id="featuredFilter" class="form-control">
                            <option value="">All Articles</option>
                            <option value="1">Featured Only</option>
                            <option value="0">Non-Featured</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-secondary btn-block" onclick="clearFilters()">
                            <i class="fa fa-times"></i> Clear
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Loading Spinner -->
            <div id="loadingSpinner" class="loading-spinner">
                <div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <p class="mt-2">Loading articles...</p>
            </div>
            
            <!-- Table Container -->
            <div class="table-container">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="articlesTable">
                        <thead>
                            <tr>
                                <th width="5%">Sr.No</th>
                                <th width="10%">Article ID</th>
                                <th width="8%">Featured</th>
                                <th width="8%">Document</th>
                                <th width="10%">Article Type</th>
                                <th width="25%">Title</th>
                                <th width="10%">Published Date</th>
                                <th width="12%">DOI</th>
                                <th width="15%">Keywords</th>
                                <th width="12%">Citation</th>
                                <th width="15%">Action</th>
                            </tr>
                        </thead>
                        <tbody id="articleData">
                            <!-- Data will be loaded here -->
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="pagination-info">
                        <span id="paginationInfo">Showing 0 to 0 of 0 entries</span>
                    </div>
                    <nav>
                        <ul class="pagination justify-content-end" id="pagination"></ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$this->load->view(BACKOFFICE . 'layout/footer');
$this->load->view(BACKOFFICE . 'layout/jsfiles');
?>

<script>
/**
 * Secure Article Management System
 * Enhanced with security features, error handling, and performance optimization
 */
class SecureArticleManager {
    constructor() {
        this.currentPage = 1;
        this.limit = 10;
        this.totalPages = 0;
        this.totalRecords = 0;
        this.cache = new Map();
        this.searchTimeout = null;
        this.csrfToken = '<?php echo $this->security->get_csrf_hash(); ?>';
        this.csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
        
        this.init();
    }
    
    init() {
        this.bindEvents();
        this.fetchArticles();
    }
    
    bindEvents() {
        // Search with debouncing
        document.getElementById('searchInput').addEventListener('input', (e) => {
            this.debounceSearch(() => {
                this.currentPage = 1;
                this.fetchArticles(1, e.target.value.trim());
            });
        });
        
        // Filter events
        document.getElementById('statusFilter').addEventListener('change', () => {
            this.currentPage = 1;
            this.fetchArticles();
        });
        
        document.getElementById('featuredFilter').addEventListener('change', () => {
            this.currentPage = 1;
            this.fetchArticles();
        });
        
        // Pagination click handler
        document.addEventListener('click', (e) => {
            if (e.target.closest('.pagination .page-link')) {
                e.preventDefault();
                this.handlePaginationClick(e.target);
            }
        });
        
        // Prevent XSS in search input
        document.getElementById('searchInput').addEventListener('paste', (e) => {
            setTimeout(() => {
                e.target.value = this.sanitizeInput(e.target.value);
            }, 0);
        });
    }
    
    debounceSearch(callback, delay = 300) {
        clearTimeout(this.searchTimeout);
        this.searchTimeout = setTimeout(callback, delay);
    }
    
    sanitizeInput(input) {
        // Remove potentially dangerous characters
        return input.replace(/[<>\"'&]/g, '');
    }
    
    async fetchArticles(page = null, search = null) {
        try {
            this.showLoading(true);
            this.hideError();
            
            const currentPage = page || this.currentPage;
            const searchTerm = search !== null ? search : document.getElementById('searchInput').value.trim();
            const statusFilter = document.getElementById('statusFilter').value;
            const featuredFilter = document.getElementById('featuredFilter').value;
            
            // Create cache key
            const cacheKey = `${currentPage}-${searchTerm}-${statusFilter}-${featuredFilter}`;
            
            // Check cache first
            if (this.cache.has(cacheKey)) {
                const cachedData = this.cache.get(cacheKey);
                this.renderTable(cachedData.articles, cachedData.start);
                this.renderPagination(cachedData.totalPages, currentPage);
                this.updatePaginationInfo(cachedData.start, cachedData.articles.length, cachedData.totalRecords);
                this.showLoading(false);
                return;
            }
            
            const formData = new FormData();
            formData.append('page', currentPage);
            formData.append('search', searchTerm);
            formData.append('status_filter', statusFilter);
            formData.append('featured_filter', featuredFilter);
            formData.append(this.csrfName, this.csrfToken);
            
            const response = await fetch('<?php echo base_url("backoffice/Receviedmanuscript/customArticleList"); ?>', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            const data = await response.json();
            
            if (data.error) {
                throw new Error(data.error);
            }
            
            // Update CSRF token if provided
            if (data.csrf_token) {
                this.csrfToken = data.csrf_token;
            }
            
            // Cache the result
            this.cache.set(cacheKey, data);
            
            // Limit cache size
            if (this.cache.size > 50) {
                const firstKey = this.cache.keys().next().value;
                this.cache.delete(firstKey);
            }
            
            this.currentPage = currentPage;
            this.totalPages = data.totalPages;
            this.totalRecords = data.totalRecords || 0;
            
            this.renderTable(data.articles, data.start);
            this.renderPagination(data.totalPages, currentPage);
            this.updatePaginationInfo(data.start, data.articles.length, this.totalRecords);
            
        } catch (error) {
            console.error('Error fetching articles:', error);
            this.showError('Failed to load articles: ' + error.message);
        } finally {
            this.showLoading(false);
        }
    }
    
    renderTable(articles, start) {
        const tbody = document.getElementById('articleData');
        tbody.innerHTML = '';
        
        if (!articles || articles.length === 0) {
            tbody.innerHTML = '<tr><td colspan="11" class="text-center py-4">No articles found</td></tr>';
            return;
        }
        
        articles.forEach((article, index) => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${start + index + 1}</td>
                <td><strong>${this.escapeHtml(article.articleID)}</strong></td>
                <td>
                    <span class="status-badge ${article.isFeatured === 'Yes' ? 'bg-success text-white' : 'bg-secondary text-white'}">
                        ${this.escapeHtml(article.isFeatured)}
                    </span>
                </td>
                <td class="text-center">${article.document}</td>
                <td>${this.escapeHtml(article.articleType)}</td>
                <td>
                    <div class="text-truncate" style="max-width: 200px;" title="${this.escapeHtml(article.title)}">
                        ${this.escapeHtml(article.title)}
                    </div>
                </td>
                <td>${this.escapeHtml(article.publishedDate)}</td>
                <td>
                    <div class="text-truncate" style="max-width: 100px;" title="${this.escapeHtml(article.doi)}">
                        ${this.escapeHtml(article.doi)}
                    </div>
                </td>
                <td>
                    <div class="text-truncate" style="max-width: 120px;" title="${this.escapeHtml(article.keywords)}">
                        ${this.escapeHtml(article.keywords)}
                    </div>
                </td>
                <td>
                    <div class="text-truncate" style="max-width: 100px;" title="${this.escapeHtml(article.citation)}">
                        ${this.escapeHtml(article.citation)}
                    </div>
                </td>
                <td>${article.actions}</td>
            `;
            tbody.appendChild(row);
        });
    }
    
    renderPagination(totalPages, currentPage) {
        const pagination = document.getElementById('pagination');
        pagination.innerHTML = '';
        
        if (totalPages <= 1) return;
        
        const maxVisible = 7;
        const half = Math.floor(maxVisible / 2);
        let start = Math.max(currentPage - half, 1);
        let end = Math.min(currentPage + half, totalPages);
        
        if (end - start < maxVisible - 1) {
            if (start === 1) {
                end = Math.min(start + maxVisible - 1, totalPages);
            } else if (end === totalPages) {
                start = Math.max(end - maxVisible + 1, 1);
            }
        }
        
        // Previous button
        if (currentPage > 1) {
            pagination.appendChild(this.createPageItem('«', currentPage - 1));
        }
        
        // First page and ellipsis
        if (start > 1) {
            pagination.appendChild(this.createPageItem('1', 1));
            if (start > 2) {
                pagination.appendChild(this.createPageItem('...', null, true));
            }
        }
        
        // Page numbers
        for (let i = start; i <= end; i++) {
            pagination.appendChild(this.createPageItem(i.toString(), i, false, i === currentPage));
        }
        
        // Last page and ellipsis
        if (end < totalPages) {
            if (end < totalPages - 1) {
                pagination.appendChild(this.createPageItem('...', null, true));
            }
            pagination.appendChild(this.createPageItem(totalPages.toString(), totalPages));
        }
        
        // Next button
        if (currentPage < totalPages) {
            pagination.appendChild(this.createPageItem('»', currentPage + 1));
        }
    }
    
    createPageItem(text, page, disabled = false, active = false) {
        const li = document.createElement('li');
        li.className = `page-item ${disabled ? 'disabled' : ''} ${active ? 'active' : ''}`;
        
        const a = document.createElement('a');
        a.className = 'page-link';
        a.textContent = text;
        a.href = '#';
        
        if (!disabled && page !== null) {
            a.dataset.page = page;
        }
        
        li.appendChild(a);
        return li;
    }
    
    handlePaginationClick(target) {
        const page = parseInt(target.dataset.page);
        if (page && page !== this.currentPage) {
            this.fetchArticles(page);
        }
    }
    
    updatePaginationInfo(start, count, total) {
        const end = start + count;
        document.getElementById('paginationInfo').textContent = 
            `Showing ${start + 1} to ${end} of ${total} entries`;
    }
    
    showLoading(show) {
        const spinner = document.getElementById('loadingSpinner');
        const table = document.getElementById('articlesTable');
        
        if (show) {
            spinner.style.display = 'block';
            table.style.opacity = '0.5';
        } else {
            spinner.style.display = 'none';
            table.style.opacity = '1';
        }
    }
    
    showError(message) {
        const errorDiv = document.getElementById('errorMessage');
        errorDiv.textContent = message;
        errorDiv.style.display = 'block';
        
        // Auto-hide after 5 seconds
        setTimeout(() => {
            this.hideError();
        }, 5000);
    }
    
    hideError() {
        document.getElementById('errorMessage').style.display = 'none';
    }
    
    escapeHtml(text) {
        if (!text) return '';
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
    
    clearCache() {
        this.cache.clear();
    }
}

// Global functions
function refreshData() {
    articleManager.clearCache();
    articleManager.fetchArticles();
}

function clearFilters() {
    document.getElementById('searchInput').value = '';
    document.getElementById('statusFilter').value = '';
    document.getElementById('featuredFilter').value = '';
    articleManager.currentPage = 1;
    articleManager.clearCache();
    articleManager.fetchArticles();
}

// Initialize when DOM is ready
let articleManager;
document.addEventListener('DOMContentLoaded', function() {
    articleManager = new SecureArticleManager();
});

// Handle browser back/forward
window.addEventListener('popstate', function() {
    articleManager.fetchArticles();
});
</script>
