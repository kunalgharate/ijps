#!/bin/bash

# IJPS Deployment Script for Hostinger
# This script can be run manually or via GitHub Actions

echo "🚀 Starting IJPS deployment to Hostinger..."

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Function to print colored output
print_status() {
    echo -e "${GREEN}[INFO]${NC} $1"
}

print_warning() {
    echo -e "${YELLOW}[WARNING]${NC} $1"
}

print_error() {
    echo -e "${RED}[ERROR]${NC} $1"
}

# Check if we're in the right directory
if [ ! -f "index.php" ] || [ ! -d "application" ]; then
    print_error "This doesn't appear to be a CodeIgniter project directory"
    exit 1
fi

print_status "Preparing deployment package..."

# Create temporary deployment directory
DEPLOY_DIR="ijps_deploy_$(date +%Y%m%d_%H%M%S)"
mkdir -p $DEPLOY_DIR

# Copy files to deployment directory
print_status "Copying project files..."
rsync -av --progress . $DEPLOY_DIR/ \
    --exclude='.git' \
    --exclude='.github' \
    --exclude='node_modules' \
    --exclude='tests' \
    --exclude='.gitignore' \
    --exclude='README.md' \
    --exclude='phpunit.xml' \
    --exclude='deploy.sh' \
    --exclude='*.log' \
    --exclude='error_log.txt' \
    --exclude='.DS_Store' \
    --exclude='Thumbs.db'

# Install Composer dependencies if composer.json exists
if [ -f "$DEPLOY_DIR/composer.json" ]; then
    print_status "Installing Composer dependencies..."
    cd $DEPLOY_DIR
    composer install --no-dev --optimize-autoloader --no-interaction
    cd ..
fi

# Set proper permissions
print_status "Setting file permissions..."
find $DEPLOY_DIR -type f -exec chmod 644 {} \;
find $DEPLOY_DIR -type d -exec chmod 755 {} \;

# Make specific directories writable
if [ -d "$DEPLOY_DIR/application/logs" ]; then
    chmod 777 $DEPLOY_DIR/application/logs
fi

if [ -d "$DEPLOY_DIR/application/cache" ]; then
    chmod 777 $DEPLOY_DIR/application/cache
fi

if [ -d "$DEPLOY_DIR/uploads" ]; then
    chmod -R 755 $DEPLOY_DIR/uploads
fi

# Create deployment archive
print_status "Creating deployment archive..."
tar -czf ${DEPLOY_DIR}.tar.gz -C $DEPLOY_DIR .

print_status "Deployment package created: ${DEPLOY_DIR}.tar.gz"
print_status "Deployment directory: $DEPLOY_DIR"

echo ""
print_status "✅ Deployment preparation completed!"
echo ""
print_warning "Next steps:"
echo "1. Upload ${DEPLOY_DIR}.tar.gz to your Hostinger hosting"
echo "2. Extract it in your public_html directory"
echo "3. Update database configuration if needed"
echo "4. Test your website"
echo ""
print_warning "Or use the GitHub Actions workflow for automatic deployment"

# Cleanup option
read -p "Do you want to cleanup temporary files? (y/n): " -n 1 -r
echo
if [[ $REPLY =~ ^[Yy]$ ]]; then
    rm -rf $DEPLOY_DIR
    rm -f ${DEPLOY_DIR}.tar.gz
    print_status "Temporary files cleaned up"
fi

print_status "🎉 Deployment script completed!"
