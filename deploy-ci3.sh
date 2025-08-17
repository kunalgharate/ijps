#!/bin/bash

# CodeIgniter 3 Deployment Script
# Optimized for CI3 applications with multiple deployment strategies

echo "🚀 CodeIgniter 3 Deployment Preparation"
echo "========================================"

# Function to show menu
show_menu() {
    echo ""
    echo "📋 Select deployment strategy:"
    echo "1) Changes Only (Recommended - Fast)"
    echo "2) Core Application Only (CI3 essentials)"
    echo "3) Core + Assets (Application + static files)"
    echo "4) Full Optimized (Everything, cleaned)"
    echo "5) Exit"
    echo ""
}

# Function to create changes-only package
deploy_changes_only() {
    echo "📝 Creating changes-only deployment package..."
    
    PACKAGE_DIR="ci3-changes-$(date +%Y%m%d-%H%M%S)"
    mkdir -p "$PACKAGE_DIR"
    
    # Get recent changes
    git diff --name-only HEAD~3..HEAD > /tmp/changed_files.txt
    
    echo "📊 Files changed in recent commits:"
    cat /tmp/changed_files.txt
    echo ""
    
    # Copy changed files
    while IFS= read -r file; do
        if [ -f "$file" ]; then
            mkdir -p "$PACKAGE_DIR/$(dirname "$file")"
            cp "$file" "$PACKAGE_DIR/$file"
            echo "✅ Packaged: $file"
        fi
    done < /tmp/changed_files.txt
    
    create_deployment_guide "$PACKAGE_DIR" "Changes Only"
    show_package_info "$PACKAGE_DIR"
    rm -f /tmp/changed_files.txt
}

# Function to create core-only package
deploy_core_only() {
    echo "🎯 Creating CodeIgniter 3 core deployment package..."
    
    PACKAGE_DIR="ci3-core-$(date +%Y%m%d-%H%M%S)"
    mkdir -p "$PACKAGE_DIR"
    
    # Copy CI3 essentials
    echo "📦 Copying CodeIgniter 3 core files..."
    cp -r application "$PACKAGE_DIR/" 2>/dev/null || true
    cp -r system "$PACKAGE_DIR/" 2>/dev/null || true
    cp index.php "$PACKAGE_DIR/" 2>/dev/null || true
    cp .htaccess "$PACKAGE_DIR/" 2>/dev/null || true
    
    # Copy essential vendor files (if small)
    if [ -d "vendor" ]; then
        VENDOR_SIZE=$(du -sm vendor | cut -f1)
        if [ "$VENDOR_SIZE" -lt 50 ]; then
            echo "📚 Including vendor dependencies (${VENDOR_SIZE}MB)..."
            cp -r vendor "$PACKAGE_DIR/" 2>/dev/null || true
        else
            echo "⚠️  Skipping vendor directory (${VENDOR_SIZE}MB - too large)"
        fi
    fi
    
    # Clean up
    cleanup_package "$PACKAGE_DIR"
    create_deployment_guide "$PACKAGE_DIR" "Core Only"
    show_package_info "$PACKAGE_DIR"
}

# Function to create core + assets package
deploy_core_assets() {
    echo "🎨 Creating CodeIgniter 3 core + assets deployment package..."
    
    PACKAGE_DIR="ci3-core-assets-$(date +%Y%m%d-%H%M%S)"
    mkdir -p "$PACKAGE_DIR"
    
    # Copy CI3 core
    echo "📦 Copying CodeIgniter 3 core files..."
    cp -r application "$PACKAGE_DIR/" 2>/dev/null || true
    cp -r system "$PACKAGE_DIR/" 2>/dev/null || true
    cp index.php "$PACKAGE_DIR/" 2>/dev/null || true
    cp .htaccess "$PACKAGE_DIR/" 2>/dev/null || true
    
    # Copy assets
    echo "🎨 Copying assets..."
    cp -r assets "$PACKAGE_DIR/" 2>/dev/null || true
    cp -r assetsbackoffice "$PACKAGE_DIR/" 2>/dev/null || true
    
    # Copy small additional files
    cp ads.txt "$PACKAGE_DIR/" 2>/dev/null || true
    cp composer.json "$PACKAGE_DIR/" 2>/dev/null || true
    
    cleanup_package "$PACKAGE_DIR"
    create_deployment_guide "$PACKAGE_DIR" "Core + Assets"
    show_package_info "$PACKAGE_DIR"
}

# Function to create full optimized package
deploy_full_optimized() {
    echo "📦 Creating full optimized deployment package..."
    
    PACKAGE_DIR="ci3-full-optimized-$(date +%Y%m%d-%H%M%S)"
    mkdir -p "$PACKAGE_DIR"
    
    # Copy everything with exclusions
    echo "📋 Copying all files with optimizations..."
    rsync -av --progress \
        --exclude='.git/' \
        --exclude='.github/' \
        --exclude='node_modules/' \
        --exclude='tests/' \
        --exclude='*.log' \
        --exclude='error_log*' \
        --exclude='*.tmp' \
        --exclude='.DS_Store' \
        --exclude='Thumbs.db' \
        --exclude='vendor/*/tests/' \
        --exclude='vendor/*/docs/' \
        --exclude='vendor/*/examples/' \
        --exclude='*.md' \
        --exclude='*.bak' \
        --exclude='*.backup' \
        ./ "$PACKAGE_DIR/"
    
    cleanup_package "$PACKAGE_DIR"
    create_deployment_guide "$PACKAGE_DIR" "Full Optimized"
    show_package_info "$PACKAGE_DIR"
}

# Function to cleanup package
cleanup_package() {
    local package_dir="$1"
    echo "🧹 Cleaning up package..."
    
    # Remove logs and cache
    rm -rf "$package_dir/application/logs/"* 2>/dev/null || true
    rm -rf "$package_dir/application/cache/"* 2>/dev/null || true
    
    # Remove system files
    find "$package_dir" -name "*.log" -delete 2>/dev/null || true
    find "$package_dir" -name "*.tmp" -delete 2>/dev/null || true
    find "$package_dir" -name ".DS_Store" -delete 2>/dev/null || true
    find "$package_dir" -name "Thumbs.db" -delete 2>/dev/null || true
    
    # Clean vendor if present
    if [ -d "$package_dir/vendor" ]; then
        find "$package_dir/vendor" -name "tests" -type d -exec rm -rf {} + 2>/dev/null || true
        find "$package_dir/vendor" -name "docs" -type d -exec rm -rf {} + 2>/dev/null || true
        find "$package_dir/vendor" -name "examples" -type d -exec rm -rf {} + 2>/dev/null || true
    fi
}

# Function to create deployment guide
create_deployment_guide() {
    local package_dir="$1"
    local strategy="$2"
    
    cat > "$package_dir/DEPLOYMENT_INSTRUCTIONS.txt" << EOF
🚀 CODEIGNITER 3 DEPLOYMENT PACKAGE
==================================

Strategy: $strategy
Created: $(date)
Package: $package_dir

📋 DEPLOYMENT STEPS:
1. Connect to your hosting provider via FTP/SFTP
2. Navigate to your web root directory (usually /public_html/)
3. Upload ALL contents of this package maintaining folder structure
4. Set proper permissions:
   - application/cache/: 755 or 777
   - application/logs/: 755 or 777
   - uploads/ (if exists): 755 or 777

🔧 CODEIGNITER 3 SPECIFIC SETTINGS:
- Ensure index.php is in web root
- Verify .htaccess for URL rewriting
- Check application/config/config.php for base_url
- Update application/config/database.php if needed

⚠️  IMPORTANT CHECKS AFTER DEPLOYMENT:
1. Test your homepage loads correctly
2. Check database connectivity
3. Verify file upload functionality (if used)
4. Test admin/backend access
5. Check error logs for any issues

🔒 SECURITY CHECKLIST:
- Remove any test/debug files
- Ensure application/ folder is protected
- Verify database credentials are secure
- Check file permissions are not too open

📞 TROUBLESHOOTING:
- If you see CI3 welcome page: Check routing in config/routes.php
- If database errors: Verify config/database.php settings
- If 404 errors: Check .htaccess and mod_rewrite
- If permission errors: Adjust folder permissions

🎯 CODEIGNITER 3 STRUCTURE:
- application/ - Your CI3 application code
- system/ - CodeIgniter 3 framework files
- index.php - Main entry point
- .htaccess - URL rewriting rules
EOF
}

# Function to show package information
show_package_info() {
    local package_dir="$1"
    
    echo ""
    echo "✅ Deployment package ready!"
    echo "📁 Location: $(pwd)/$package_dir"
    echo "📊 Package size: $(du -sh "$package_dir" | cut -f1)"
    echo "📄 Files count: $(find "$package_dir" -type f | wc -l)"
    echo ""
    echo "📖 Read $package_dir/DEPLOYMENT_INSTRUCTIONS.txt for detailed steps"
    echo ""
}

# Main menu loop
while true; do
    show_menu
    read -p "Choose option (1-5): " choice
    
    case $choice in
        1)
            deploy_changes_only
            break
            ;;
        2)
            deploy_core_only
            break
            ;;
        3)
            deploy_core_assets
            break
            ;;
        4)
            deploy_full_optimized
            break
            ;;
        5)
            echo "👋 Deployment cancelled"
            exit 0
            ;;
        *)
            echo "❌ Invalid option. Please choose 1-5."
            ;;
    esac
done

echo ""
echo "🎉 CodeIgniter 3 deployment package created successfully!"
echo "📤 Ready for upload to your hosting provider"
