#!/bin/bash

# Deployment Comparison Script
# Helps identify what files are missing from your server

echo "🔍 Deployment Comparison Tool"
echo "============================"
echo ""
echo "This tool helps you identify missing files by comparing:"
echo "1. Your local project files"
echo "2. What you've actually deployed"
echo ""

# Function to create local file manifest
create_local_manifest() {
    echo "📋 Creating local file manifest..."
    
    # Create manifest of important files only (exclude git, logs, etc.)
    find . -type f \
        -not -path './.git/*' \
        -not -path './ci3-*/*' \
        -not -path './ijps-*/*' \
        -not -path './application/logs/*' \
        -not -path './application/cache/*' \
        -not -name '*.log' \
        -not -name '.DS_Store' \
        -not -name 'Thumbs.db' \
        | sed 's|^\./||' \
        | sort > local_manifest.txt
    
    echo "✅ Local manifest created: $(wc -l < local_manifest.txt) files"
}

# Function to show critical files that must be deployed
show_critical_files() {
    echo ""
    echo "🚨 CRITICAL FILES - These MUST be on your server:"
    echo "================================================"
    
    critical_files=(
        "index.php"
        ".htaccess"
        "application/config/config.php"
        "application/config/database.php"
        "application/config/routes.php"
        "application/controllers/HomeController.php"
        "system/core/CodeIgniter.php"
        "system/core/Loader.php"
        "system/libraries/Session.php"
    )
    
    for file in "${critical_files[@]}"; do
        if [ -f "$file" ]; then
            echo "✅ $file"
        else
            echo "❌ $file (MISSING LOCALLY!)"
        fi
    done
}

# Function to show asset files
show_asset_files() {
    echo ""
    echo "🎨 ASSET FILES - These affect appearance:"
    echo "========================================"
    
    echo "📁 CSS Files:"
    find assets assetsbackoffice -name "*.css" 2>/dev/null | head -10 | while read file; do
        echo "  📄 $file"
    done
    
    echo ""
    echo "📁 JavaScript Files:"
    find assets assetsbackoffice -name "*.js" 2>/dev/null | head -10 | while read file; do
        echo "  📄 $file"
    done
    
    echo ""
    echo "📁 Image Files:"
    find assets assetsbackoffice images -name "*.png" -o -name "*.jpg" -o -name "*.gif" 2>/dev/null | head -10 | while read file; do
        echo "  🖼️  $file"
    done
    
    echo ""
    echo "📊 Asset Summary:"
    echo "  CSS files: $(find assets assetsbackoffice -name "*.css" 2>/dev/null | wc -l)"
    echo "  JS files: $(find assets assetsbackoffice -name "*.js" 2>/dev/null | wc -l)"
    echo "  Images: $(find assets assetsbackoffice images -name "*.png" -o -name "*.jpg" -o -name "*.gif" 2>/dev/null | wc -l)"
}

# Function to create deployment checklist
create_deployment_checklist() {
    echo ""
    echo "📝 Creating deployment checklist..."
    
    cat > "DEPLOYMENT_CHECKLIST.txt" << EOF
🚀 DEPLOYMENT VERIFICATION CHECKLIST
===================================

After uploading files to your server, verify these:

🔧 CRITICAL FUNCTIONALITY:
□ Homepage loads (yoursite.com)
□ No PHP errors displayed
□ Database connection works
□ Admin/login area accessible

🎨 VISUAL ELEMENTS:
□ CSS styles loading correctly
□ Images displaying properly
□ JavaScript functionality working
□ Responsive design working on mobile

📁 FOLDER STRUCTURE ON SERVER:
□ /application/ folder exists
□ /system/ folder exists
□ /assets/ folder exists
□ /assetsbackoffice/ folder exists
□ /images/ folder exists
□ /uploads/ folder exists (if used)
□ /vendor/ folder exists (if using Composer)

📄 ESSENTIAL FILES ON SERVER:
□ index.php in root directory
□ .htaccess in root directory
□ application/config/config.php
□ application/config/database.php
□ application/config/routes.php

🔒 PERMISSIONS (set via FTP client):
□ application/cache/ → 755 or 777
□ application/logs/ → 755 or 777
□ uploads/ → 755 or 777 (if exists)

🌐 TEST THESE URLS:
□ yoursite.com (homepage)
□ yoursite.com/assets/css/style.css (should show CSS)
□ yoursite.com/images/logo.png (or any image)
□ yoursite.com/admin (or your admin URL)

❌ IF SOMETHING IS MISSING:
1. Check the file exists in your deployment package
2. Re-upload the missing folder/file
3. Verify folder permissions
4. Check server error logs

📊 DEPLOYMENT PACKAGES AVAILABLE:
- Complete package: $(ls -d ijps-complete-* 2>/dev/null | tail -1 || echo "Not created yet")
- Assets only: $(ls -d ijps-assets-* 2>/dev/null | tail -1 || echo "Not created yet")
- Changes only: $(ls -d ci3-changes-* 2>/dev/null | tail -1 || echo "Not created yet")

💡 QUICK FIX FOR MISSING ASSETS:
If only CSS/JS/images are missing, upload just the assets folders:
- assets/
- assetsbackoffice/
- images/
EOF
    
    echo "✅ Deployment checklist created: DEPLOYMENT_CHECKLIST.txt"
}

# Function to show deployment package options
show_deployment_options() {
    echo ""
    echo "📦 AVAILABLE DEPLOYMENT PACKAGES:"
    echo "================================"
    
    # Check for existing packages
    complete_pkg=$(ls -d ijps-complete-* 2>/dev/null | tail -1)
    assets_pkg=$(ls -d ijps-assets-* 2>/dev/null | tail -1)
    changes_pkg=$(ls -d ci3-changes-* 2>/dev/null | tail -1)
    
    if [ -n "$complete_pkg" ]; then
        size=$(du -sh "$complete_pkg" | cut -f1)
        files=$(find "$complete_pkg" -type f | wc -l)
        echo "✅ Complete Package: $complete_pkg ($size, $files files)"
        echo "   📤 Upload this for full deployment"
    fi
    
    if [ -n "$assets_pkg" ]; then
        size=$(du -sh "$assets_pkg" | cut -f1)
        echo "✅ Assets Package: $assets_pkg ($size)"
        echo "   📤 Upload this to fix missing CSS/JS/images"
    fi
    
    if [ -n "$changes_pkg" ]; then
        size=$(du -sh "$changes_pkg" | cut -f1)
        echo "✅ Changes Package: $changes_pkg ($size)"
        echo "   📤 Upload this for recent code changes only"
    fi
    
    if [ -z "$complete_pkg" ] && [ -z "$assets_pkg" ] && [ -z "$changes_pkg" ]; then
        echo "❌ No deployment packages found"
        echo "💡 Run ./verify-deployment.sh to create packages"
    fi
}

# Main execution
create_local_manifest
show_critical_files
show_asset_files
create_deployment_checklist
show_deployment_options

echo ""
echo "🎯 SUMMARY:"
echo "==========="
echo "📄 Total files in project: $(wc -l < local_manifest.txt)"
echo "📋 Deployment checklist: DEPLOYMENT_CHECKLIST.txt"
echo "📊 Local file manifest: local_manifest.txt"
echo ""
echo "🚀 NEXT STEPS:"
echo "1. Use the complete deployment package (165MB, 4210 files)"
echo "2. Upload to your server maintaining folder structure"
echo "3. Follow the deployment checklist to verify everything works"
echo "4. If only assets are missing, use the assets-only package"

# Cleanup
rm -f local_manifest.txt
