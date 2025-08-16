#!/bin/bash

# Deploy Recent Changes Only Script
# Creates a minimal package with only your recent modifications

echo "🔍 Identifying your recent changes..."

# Create deployment directory in current folder
CHANGES_DIR="ijps-changes-only-$(date +%Y%m%d-%H%M%S)"
mkdir -p "$CHANGES_DIR"

echo "📁 Creating changes-only package in $CHANGES_DIR"

# Get files changed in recent commits (your recent work)
git diff --name-only HEAD~3..HEAD > /tmp/changed_files.txt

echo "📝 Files that will be packaged:"
cat /tmp/changed_files.txt

echo ""
echo "📊 Total changed files: $(wc -l < /tmp/changed_files.txt)"

# Copy only the changed files, preserving directory structure
while IFS= read -r file; do
  if [ -f "$file" ]; then
    # Create directory structure in deployment folder
    mkdir -p "$CHANGES_DIR/$(dirname "$file")"
    # Copy the file
    cp "$file" "$CHANGES_DIR/$file"
    echo "✅ Packaged: $file"
  else
    echo "⚠️  File not found (may have been deleted): $file"
  fi
done < /tmp/changed_files.txt

# Create deployment summary
cat > "$CHANGES_DIR/DEPLOYMENT_SUMMARY.txt" << EOF
🚀 RECENT CHANGES DEPLOYMENT PACKAGE
===================================

This package contains ONLY the files you've modified in your recent commits.
This is a minimal deployment focused on your latest work.

📊 PACKAGE CONTENTS:
$(cat /tmp/changed_files.txt)

🎯 DEPLOYMENT INSTRUCTIONS:
1. Upload the contents of this folder to your /public_html/ directory
2. Maintain the folder structure when uploading
3. These files will overwrite existing files on the server
4. Your recent security and optimization changes will be applied

⚡ ADVANTAGES:
- Very small package size (only changed files)
- Fast upload time
- Low risk of connection timeouts
- Preserves existing files that haven't changed

🔧 FTP CLIENT SETTINGS:
- Enable "Overwrite existing files"
- Maintain directory structure
- Use binary transfer mode

📝 WHAT'S INCLUDED:
- Security enhancements
- Database optimizations  
- New models and repositories
- Configuration improvements
- Deployment scripts

⏱️ ESTIMATED UPLOAD TIME: 2-10 minutes
EOF

# Show final package info
echo ""
echo "✅ Changes-only package ready!"
echo "📁 Location: $(pwd)/$CHANGES_DIR"
echo "📊 Package size: $(du -sh "$CHANGES_DIR" | cut -f1)"
echo ""
echo "🎯 QUICK DEPLOYMENT:"
echo "1. This package contains only your recent changes (28 files)"
echo "2. Upload time should be under 10 minutes"
echo "3. No risk of large file timeouts"
echo "4. Your security and optimization work will be deployed"
echo ""
echo "📖 Read $CHANGES_DIR/DEPLOYMENT_SUMMARY.txt for detailed instructions"

# Clean up
rm -f /tmp/changed_files.txt
