#!/bin/bash

# Manual Deployment Script for IJPS Project
# Use this if GitHub Actions deployment fails

echo "🚀 Starting manual deployment preparation..."

# Create deployment directory
DEPLOY_DIR="ijps-deploy-$(date +%Y%m%d-%H%M%S)"
mkdir -p "../$DEPLOY_DIR"

echo "📁 Creating clean deployment copy in ../$DEPLOY_DIR"

# Copy all files except excluded ones
rsync -av --progress \
  --exclude='.git/' \
  --exclude='.github/' \
  --exclude='node_modules/' \
  --exclude='tests/' \
  --exclude='test/' \
  --exclude='vendor/bin/' \
  --exclude='vendor/*/tests/' \
  --exclude='vendor/*/test/' \
  --exclude='vendor/*/docs/' \
  --exclude='vendor/*/doc/' \
  --exclude='vendor/*/examples/' \
  --exclude='*.md' \
  --exclude='*.log' \
  --exclude='error_log*' \
  --exclude='*.tmp' \
  --exclude='*.cache' \
  --exclude='*.bak' \
  --exclude='*.backup' \
  --exclude='*.old' \
  --exclude='.DS_Store' \
  --exclude='Thumbs.db' \
  --exclude='composer.lock' \
  --exclude='phpunit.xml' \
  --exclude='.gitignore' \
  ./ "../$DEPLOY_DIR/"

echo "🧹 Cleaning up deployment directory..."

# Additional cleanup in deployment directory
cd "../$DEPLOY_DIR"

# Remove any remaining unwanted files
find . -name "*.log" -type f -delete 2>/dev/null || true
find . -name "error_log*" -type f -delete 2>/dev/null || true
find . -name "*.tmp" -type f -delete 2>/dev/null || true
find . -name "*.cache" -type f -delete 2>/dev/null || true
find . -name ".DS_Store" -type f -delete 2>/dev/null || true

# Show final size
echo "📊 Deployment package size:"
du -sh .

echo ""
echo "✅ Deployment package ready!"
echo "📁 Location: $(pwd)"
echo ""
echo "🔧 Next steps:"
echo "1. Use an FTP client (FileZilla, Cyberduck, etc.)"
echo "2. Connect to your Hostinger FTP server"
echo "3. Upload the contents of this directory to /public_html/"
echo "4. For faster uploads, upload in batches:"
echo "   - First: Core application files (application/, system/, index.php)"
echo "   - Then: Assets and vendor files"
echo "   - Finally: Large media files"
echo ""
echo "💡 Pro tip: Enable 'Skip existing files' in your FTP client for faster subsequent uploads"

cd - > /dev/null
