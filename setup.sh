#!/bin/bash

# MyBlogSite Setup Script
# This script will set up the complete blog platform

echo "🚀 MyBlogSite Setup Script"
echo "=========================="

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Function to print colored output
print_status() {
    echo -e "${BLUE}[INFO]${NC} $1"
}

print_success() {
    echo -e "${GREEN}[SUCCESS]${NC} $1"
}

print_warning() {
    echo -e "${YELLOW}[WARNING]${NC} $1"
}

print_error() {
    echo -e "${RED}[ERROR]${NC} $1"
}

# Check if required tools are installed
check_requirements() {
    print_status "Checking requirements..."

    # Check PHP
    if ! command -v php &> /dev/null; then
        print_error "PHP is not installed. Please install PHP 8.2 or higher."
        exit 1
    fi

    PHP_VERSION=$(php -r "echo PHP_VERSION;")
    print_success "PHP version: $PHP_VERSION"

    # Check Composer
    if ! command -v composer &> /dev/null; then
        print_error "Composer is not installed. Please install Composer."
        exit 1
    fi

    print_success "Composer is installed"

    # Check Node.js
    if ! command -v node &> /dev/null; then
        print_error "Node.js is not installed. Please install Node.js 18 or higher."
        exit 1
    fi

    NODE_VERSION=$(node --version)
    print_success "Node.js version: $NODE_VERSION"

    # Check NPM
    if ! command -v npm &> /dev/null; then
        print_error "NPM is not installed. Please install NPM."
        exit 1
    fi

    print_success "NPM is installed"
}

# Install PHP dependencies
install_php_dependencies() {
    print_status "Installing PHP dependencies..."

    if composer install --no-interaction; then
        print_success "PHP dependencies installed successfully"
    else
        print_error "Failed to install PHP dependencies"
        exit 1
    fi
}

# Install Node.js dependencies
install_node_dependencies() {
    print_status "Installing Node.js dependencies..."

    if npm install; then
        print_success "Node.js dependencies installed successfully"
    else
        print_error "Failed to install Node.js dependencies"
        exit 1
    fi
}

# Setup environment file
setup_environment() {
    print_status "Setting up environment file..."

    if [ ! -f .env ]; then
        if cp .env.example .env; then
            print_success "Environment file created"
        else
            print_error "Failed to create environment file"
            exit 1
        fi
    else
        print_warning "Environment file already exists"
    fi

    # Generate application key
    if php artisan key:generate --no-interaction; then
        print_success "Application key generated"
    else
        print_error "Failed to generate application key"
        exit 1
    fi
}

# Setup database
setup_database() {
    print_status "Setting up database..."

    # Check if database configuration is set
    if ! grep -q "DB_DATABASE=" .env; then
        print_warning "Please configure your database settings in .env file"
        print_status "Example database configuration:"
        echo "DB_CONNECTION=mysql"
        echo "DB_HOST=127.0.0.1"
        echo "DB_PORT=3306"
        echo "DB_DATABASE=myblogsite"
        echo "DB_USERNAME=your_username"
        echo "DB_PASSWORD=your_password"
        echo ""
        read -p "Press Enter after configuring database settings..."
    fi

    # Run migrations
    if php artisan migrate --no-interaction; then
        print_success "Database migrations completed"
    else
        print_error "Failed to run database migrations"
        print_warning "Please check your database configuration"
        exit 1
    fi

    # Run seeders
    print_status "Seeding database..."

    if php artisan db:seed --class=CategorySeeder --no-interaction; then
        print_success "Categories seeded"
    fi

    if php artisan db:seed --class=AdvertisementSeeder --no-interaction; then
        print_success "Advertisements seeded"
    fi

    if php artisan db:seed --class=SettingsSeeder --no-interaction; then
        print_success "Settings seeded"
    fi
}

# Setup storage
setup_storage() {
    print_status "Setting up storage..."

    if php artisan storage:link; then
        print_success "Storage link created"
    else
        print_warning "Storage link already exists or failed to create"
    fi
}

# Build assets
build_assets() {
    print_status "Building assets..."

    if npm run build; then
        print_success "Assets built successfully"
    else
        print_error "Failed to build assets"
        exit 1
    fi
}

# Create admin user
create_admin_user() {
    print_status "Creating admin user..."

    echo ""
    echo "Please provide admin user details:"
    read -p "Admin name: " ADMIN_NAME
    read -p "Admin email: " ADMIN_EMAIL
    read -s -p "Admin password: " ADMIN_PASSWORD
    echo ""

    # Create admin user using tinker
    php artisan tinker --execute="
        \$user = \App\Models\User::create([
            'name' => '$ADMIN_NAME',
            'email' => '$ADMIN_EMAIL',
            'password' => bcrypt('$ADMIN_PASSWORD'),
            'is_admin' => true,
            'is_verified' => true,
            'email_verified_at' => now()
        ]);
        echo 'Admin user created successfully: ' . \$user->email;
    "

    if [ $? -eq 0 ]; then
        print_success "Admin user created successfully"
    else
        print_error "Failed to create admin user"
    fi
}

# Set permissions
set_permissions() {
    print_status "Setting permissions..."

    # Make storage and cache directories writable
    chmod -R 755 storage bootstrap/cache 2>/dev/null
    chmod -R 755 public/storage 2>/dev/null

    print_success "Permissions set"
}

# Display final instructions
show_final_instructions() {
    echo ""
    echo "🎉 Setup completed successfully!"
    echo "================================"
    echo ""
    echo "Next steps:"
    echo "1. Start the development server:"
    echo "   php artisan serve"
    echo ""
    echo "2. Visit your blog at:"
    echo "   http://localhost:8000"
    echo ""
    echo "3. Admin panel:"
    echo "   http://localhost:8000/admin"
    echo ""
    echo "4. User dashboard:"
    echo "   http://localhost:8000/user/dashboard"
    echo ""
    echo "Default admin credentials:"
    echo "Email: (the email you provided)"
    echo "Password: (the password you provided)"
    echo ""
    echo "For production deployment, please refer to the README.md file."
    echo ""
}

# Main setup function
main() {
    echo "Starting MyBlogSite setup..."
    echo ""

    check_requirements
    echo ""

    install_php_dependencies
    echo ""

    install_node_dependencies
    echo ""

    setup_environment
    echo ""

    setup_database
    echo ""

    setup_storage
    echo ""

    build_assets
    echo ""

    set_permissions
    echo ""

    create_admin_user
    echo ""

    show_final_instructions
}

# Run the setup
main
