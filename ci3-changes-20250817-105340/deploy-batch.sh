#!/bin/bash

# Batch Deployment Script for Very Large IJPS Project
# Splits deployment into manageable chunks

echo "🚀 Starting batch deployment preparation..."

BASE_DIR="ijps-batch-deploy-$(date +%Y%m%d-%H%M%S)"
mkdir -p "../$BASE_DIR"

echo "📁 Creating batch deployment packages in ../$BASE_DIR"

# Batch 1: Core Application Files (Essential)
echo "📦 Creating Batch 1: Core Application..."
BATCH1_DIR="../$BASE_DIR/batch1-core"
mkdir -p "$BATCH1_DIR"

cp -r application "$BATCH1_DIR/" 2>/dev/null || true
cp -r system "$BATCH1_DIR/" 2>/dev/null || true
cp index.php "$BATCH1_DIR/" 2>/dev/null || true
cp .htaccess "$BATCH1_DIR/" 2>/dev/null || true

# Clean batch 1
cd "$BATCH1_DIR"
find . -name "*.log" -type f -delete 2>/dev/null || true
find . -name "*.tmp" -type f -delete 2>/dev/null || true
find . -name ".DS_Store" -type f -delete 2>/dev/null || true
cd - > /dev/null

echo "   📊 Batch 1 size: $(du -sh "$BATCH1_DIR" | cut -f1)"

# Batch 2: Vendor Dependencies (Large but necessary)
echo "📦 Creating Batch 2: Vendor Dependencies..."
BATCH2_DIR="../$BASE_DIR/batch2-vendor"
mkdir -p "$BATCH2_DIR"

if [ -d "vendor" ]; then
    cp -r vendor "$BATCH2_DIR/" 2>/dev/null || true
    
    # Clean vendor directory aggressively
    cd "$BATCH2_DIR"
    find vendor -name "tests" -type d -exec rm -rf {} + 2>/dev/null || true
    find vendor -name "test" -type d -exec rm -rf {} + 2>/dev/null || true
    find vendor -name "docs" -type d -exec rm -rf {} + 2>/dev/null || true
    find vendor -name "doc" -type d -exec rm -rf {} + 2>/dev/null || true
    find vendor -name "examples" -type d -exec rm -rf {} + 2>/dev/null || true
    find vendor -name ".git" -type d -exec rm -rf {} + 2>/dev/null || true
    rm -rf vendor/bin 2>/dev/null || true
    find . -name "*.md" -type f -delete 2>/dev/null || true
    find . -name ".DS_Store" -type f -delete 2>/dev/null || true
    cd - > /dev/null
    
    echo "   📊 Batch 2 size: $(du -sh "$BATCH2_DIR" | cut -f1)"
else
    echo "   ⚠️  No vendor directory found"
fi

# Batch 3: Assets and Media (Can be uploaded later)
echo "📦 Creating Batch 3: Assets and Media..."
BATCH3_DIR="../$BASE_DIR/batch3-assets"
mkdir -p "$BATCH3_DIR"

cp -r assets "$BATCH3_DIR/" 2>/dev/null || true
cp -r assetsbackoffice "$BATCH3_DIR/" 2>/dev/null || true
cp -r images "$BATCH3_DIR/" 2>/dev/null || true
cp -r uploads "$BATCH3_DIR/" 2>/dev/null || true

# Clean assets
cd "$BATCH3_DIR"
find . -name ".DS_Store" -type f -delete 2>/dev/null || true
find . -name "Thumbs.db" -type f -delete 2>/dev/null || true
cd - > /dev/null

echo "   📊 Batch 3 size: $(du -sh "$BATCH3_DIR" | cut -f1)"

# Batch 4: Additional Files (Optional)
echo "📦 Creating Batch 4: Additional Files..."
BATCH4_DIR="../$BASE_DIR/batch4-additional"
mkdir -p "$BATCH4_DIR"

# Copy any remaining important files
cp ads.txt "$BATCH4_DIR/" 2>/dev/null || true
cp composer.json "$BATCH4_DIR/" 2>/dev/null || true
cp phpmailer "$BATCH4_DIR/" 2>/dev/null || true
cp createUrl "$BATCH4_DIR/" 2>/dev/null || true

echo "   📊 Batch 4 size: $(du -sh "$BATCH4_DIR" | cut -f1)"

# Create deployment instructions
cat > "../$BASE_DIR/DEPLOYMENT_INSTRUCTIONS.txt" << EOF
🚀 BATCH DEPLOYMENT INSTRUCTIONS
================================

Deploy in this order for best results:

1. BATCH 1 - CORE APPLICATION (CRITICAL - Deploy First!)
   📁 Location: batch1-core/
   🎯 Upload to: /public_html/
   ⏱️ Estimated time: 5-15 minutes
   📝 Contains: application/, system/, index.php, .htaccess
   
2. BATCH 2 - VENDOR DEPENDENCIES (Important)
   📁 Location: batch2-vendor/
   🎯 Upload to: /public_html/
   ⏱️ Estimated time: 15-45 minutes
   📝 Contains: vendor/ (cleaned)
   
3. BATCH 3 - ASSETS & MEDIA (Can wait)
   📁 Location: batch3-assets/
   🎯 Upload to: /public_html/
   ⏱️ Estimated time: 30-90 minutes
   📝 Contains: assets/, images/, uploads/
   
4. BATCH 4 - ADDITIONAL FILES (Optional)
   📁 Location: batch4-additional/
   🎯 Upload to: /public_html/
   ⏱️ Estimated time: 1-5 minutes
   📝 Contains: misc files

🔧 FTP CLIENT SETTINGS:
- Enable "Skip existing files" or "Resume transfers"
- Set connection timeout to maximum
- Use binary transfer mode
- Enable passive mode if available
- Consider using multiple connections if supported

💡 PRO TIPS:
- Test your site after Batch 1 - it should work with basic functionality
- If Batch 2 fails, try uploading vendor subdirectories individually
- Batch 3 can be uploaded over multiple sessions
- Always backup your current site before deployment

⚠️ TROUBLESHOOTING:
- If upload fails, resume from where it stopped
- Large image files can be uploaded separately
- Consider compressing assets before upload
- Use FTP client's queue/retry features
EOF

echo ""
echo "✅ Batch deployment packages ready!"
echo "📁 Location: $(cd "../$BASE_DIR" && pwd)"
echo ""
echo "📊 DEPLOYMENT SUMMARY:"
echo "   Batch 1 (Core):       $(du -sh "$BATCH1_DIR" | cut -f1)"
echo "   Batch 2 (Vendor):     $(du -sh "$BATCH2_DIR" | cut -f1)"
echo "   Batch 3 (Assets):     $(du -sh "$BATCH3_DIR" | cut -f1)"
echo "   Batch 4 (Additional): $(du -sh "$BATCH4_DIR" | cut -f1)"
echo "   Total:                $(du -sh "../$BASE_DIR" | cut -f1)"
echo ""
echo "📖 Read DEPLOYMENT_INSTRUCTIONS.txt for detailed upload guide"
echo ""
echo "🎯 QUICK START:"
echo "1. Upload batch1-core/ first (your site will work after this)"
echo "2. Upload batch2-vendor/ second (full functionality)"
echo "3. Upload batch3-assets/ and batch4-additional/ when convenient"
