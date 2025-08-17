#!/bin/bash

# Deployment Verification Script for CodeIgniter 3
# Helps identify missing files and creates complete deployment packages

echo "🔍 CodeIgniter 3 Deployment Verification"
echo "========================================"

# Function to check essential CI3 files
check_essential_files() {
    echo "📋 Checking essential CodeIgniter 3 files..."
    
    essential_files=(
        "index.php"
        ".htaccess"
        "application/config/config.php"
        "application/config/database.php"
        "application/config/routes.php"
        "application/controllers/HomeController.php"
        "system/core/CodeIgniter.php"
    )
    
    missing_files=()
    
    for file in "${essential_files[@]}"; do
        if [ -f "$file" ]; then
            echo "✅ $file"
        else
            echo "❌ $file (MISSING)"
            missing_files+=("$file")
        fi
    done
    
    if [ ${#missing_files[@]} -gt 0 ]; then
        echo ""
        echo "⚠️  Missing essential files detected!"
        echo "These files are critical for CI3 to work properly."
    else
        echo ""
        echo "✅ All essential CI3 files are present"
    fi
}

# Function to check assets
check_assets() {
    echo ""
    echo "🎨 Checking assets and static files..."
    
    asset_dirs=(
        "assets"
        "assetsbackoffice"
        "images"
        "uploads"
    )
    
    for dir in "${asset_dirs[@]}"; do
        if [ -d "$dir" ]; then
            file_count=$(find "$dir" -type f | wc -l)
            dir_size=$(du -sh "$dir" 2>/dev/null | cut -f1)
            echo "✅ $dir/ ($file_count files, $dir_size)"
        else
            echo "❌ $dir/ (MISSING DIRECTORY)"
        fi
    done
}

# Function to create complete deployment package
create_complete_package() {
    echo ""
    echo "📦 Creating complete deployment package..."
    
    COMPLETE_DIR="ijps-complete-$(date +%Y%m%d-%H%M%S)"
    mkdir -p "$COMPLETE_DIR"
    
    echo "🔄 Copying all necessary files..."
    
    # Copy CI3 core
    echo "  📁 Copying application/"
    cp -r application "$COMPLETE_DIR/" 2>/dev/null || true
    
    echo "  📁 Copying system/"
    cp -r system "$COMPLETE_DIR/" 2>/dev/null || true
    
    echo "  📄 Copying index.php"
    cp index.php "$COMPLETE_DIR/" 2>/dev/null || true
    
    echo "  📄 Copying .htaccess"
    cp .htaccess "$COMPLETE_DIR/" 2>/dev/null || true
    
    # Copy assets
    echo "  🎨 Copying assets/"
    cp -r assets "$COMPLETE_DIR/" 2>/dev/null || true
    
    echo "  🎨 Copying assetsbackoffice/"
    cp -r assetsbackoffice "$COMPLETE_DIR/" 2>/dev/null || true
    
    echo "  🖼️  Copying images/"
    cp -r images "$COMPLETE_DIR/" 2>/dev/null || true
    
    echo "  📤 Copying uploads/"
    cp -r uploads "$COMPLETE_DIR/" 2>/dev/null || true
    
    # Copy vendor (if reasonable size)
    if [ -d "vendor" ]; then
        VENDOR_SIZE=$(du -sm vendor | cut -f1)
        if [ "$VENDOR_SIZE" -lt 100 ]; then
            echo "  📚 Copying vendor/ (${VENDOR_SIZE}MB)"
            cp -r vendor "$COMPLETE_DIR/" 2>/dev/null || true
        else
            echo "  ⚠️  Skipping vendor/ (${VENDOR_SIZE}MB - too large)"
            echo "     You may need to upload vendor/ separately"
        fi
    fi
    
    # Copy other important files
    cp composer.json "$COMPLETE_DIR/" 2>/dev/null || true
    cp ads.txt "$COMPLETE_DIR/" 2>/dev/null || true
    
    # Clean up the package
    echo "🧹 Cleaning deployment package..."
    find "$COMPLETE_DIR" -name "*.log" -delete 2>/dev/null || true
    find "$COMPLETE_DIR" -name ".DS_Store" -delete 2>/dev/null || true
    find "$COMPLETE_DIR" -name "Thumbs.db" -delete 2>/dev/null || true
    rm -rf "$COMPLETE_DIR/application/logs/"* 2>/dev/null || true
    rm -rf "$COMPLETE_DIR/application/cache/"* 2>/dev/null || true
    
    # Create file manifest
    echo "📋 Creating file manifest..."
    find "$COMPLETE_DIR" -type f | sort > "$COMPLETE_DIR/FILE_MANIFEST.txt"
    
    # Create deployment instructions
    create_complete_deployment_guide "$COMPLETE_DIR"
    
    echo ""
    echo "✅ Complete deployment package created!"
    echo "📁 Location: $(pwd)/$COMPLETE_DIR"
    echo "📊 Package size: $(du -sh "$COMPLETE_DIR" | cut -f1)"
    echo "📄 Total files: $(find "$COMPLETE_DIR" -type f | wc -l)"
    echo ""
    echo "📋 Package contents:"
    echo "  - CodeIgniter 3 core (application/, system/)"
    echo "  - Entry files (index.php, .htaccess)"
    echo "  - All assets and images"
    echo "  - Upload directories"
    echo "  - Configuration files"
    echo "  - File manifest for verification"
    echo ""
}

# Function to create deployment guide
create_complete_deployment_guide() {
    local package_dir="$1"
    
    cat > "$package_dir/COMPLETE_DEPLOYMENT_GUIDE.txt" << EOF
🚀 COMPLETE CODEIGNITER 3 DEPLOYMENT PACKAGE
===========================================

This package contains ALL files needed for your CI3 application.

📋 DEPLOYMENT CHECKLIST:

BEFORE UPLOAD:
□ Backup your current website
□ Note your current database settings
□ Check hosting provider requirements

UPLOAD PROCESS:
□ Connect to FTP/SFTP
□ Navigate to web root (/public_html/ or /www/)
□ Upload ALL contents maintaining folder structure
□ Verify all folders uploaded correctly

AFTER UPLOAD - VERIFY THESE:
□ Homepage loads without errors
□ Admin/backend area accessible
□ Images and CSS loading properly
□ Database connection working
□ File uploads working (if applicable)

🔧 FOLDER PERMISSIONS (set after upload):
□ application/cache/ → 755 or 777
□ application/logs/ → 755 or 777
□ uploads/ → 755 or 777 (if exists)
□ assets/ → 755

📄 CONFIGURATION FILES TO CHECK:
□ application/config/config.php - Update base_url
□ application/config/database.php - Verify DB settings
□ .htaccess - Ensure mod_rewrite rules are correct

🎨 ASSETS VERIFICATION:
After deployment, check these URLs work:
□ yoursite.com/assets/css/style.css
□ yoursite.com/assetsbackoffice/css/style.css
□ yoursite.com/images/logo.png (or similar)

🔍 TROUBLESHOOTING:
- Missing CSS/JS: Check assets/ folder uploaded
- Images not loading: Check images/ folder uploaded
- 404 errors: Verify .htaccess uploaded
- Database errors: Check config/database.php
- Blank page: Check application/logs/ for errors

📊 PACKAGE CONTENTS:
$(cat FILE_MANIFEST.txt | wc -l) total files included
See FILE_MANIFEST.txt for complete file list

🆘 IF ISSUES PERSIST:
1. Check server error logs
2. Enable CI3 error reporting in index.php
3. Verify all folders have correct permissions
4. Contact hosting support if needed
EOF
}

# Function to create assets-only package
create_assets_package() {
    echo ""
    echo "🎨 Creating assets-only deployment package..."
    
    ASSETS_DIR="ijps-assets-$(date +%Y%m%d-%H%M%S)"
    mkdir -p "$ASSETS_DIR"
    
    # Copy all asset directories
    cp -r assets "$ASSETS_DIR/" 2>/dev/null || true
    cp -r assetsbackoffice "$ASSETS_DIR/" 2>/dev/null || true
    cp -r images "$ASSETS_DIR/" 2>/dev/null || true
    cp -r uploads "$ASSETS_DIR/" 2>/dev/null || true
    
    # Clean assets
    find "$ASSETS_DIR" -name ".DS_Store" -delete 2>/dev/null || true
    find "$ASSETS_DIR" -name "Thumbs.db" -delete 2>/dev/null || true
    
    echo "✅ Assets-only package created!"
    echo "📁 Location: $(pwd)/$ASSETS_DIR"
    echo "📊 Package size: $(du -sh "$ASSETS_DIR" | cut -f1)"
    echo ""
    echo "📤 Upload this to fix missing assets"
}

# Main menu
echo ""
echo "🔧 What would you like to do?"
echo "1) Check current deployment status"
echo "2) Create complete deployment package (RECOMMENDED)"
echo "3) Create assets-only package (for missing assets)"
echo "4) Show file manifest of current directory"
echo "5) Exit"
echo ""

read -p "Choose option (1-5): " choice

case $choice in
    1)
        check_essential_files
        check_assets
        ;;
    2)
        check_essential_files
        check_assets
        create_complete_package
        ;;
    3)
        create_assets_package
        ;;
    4)
        echo "📋 Current directory file manifest:"
        find . -type f -not -path './.git/*' | sort | head -50
        echo ""
        echo "📊 Total files: $(find . -type f -not -path './.git/*' | wc -l)"
        ;;
    5)
        echo "👋 Exiting"
        exit 0
        ;;
    *)
        echo "❌ Invalid option"
        exit 1
        ;;
esac

echo ""
echo "🎯 Next steps:"
echo "- Upload the generated package to your web server"
echo "- Follow the deployment guide instructions"
echo "- Test your website thoroughly after deployment"
