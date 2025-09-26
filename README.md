# NepBlog - Professional Blog Platform

A fully responsive, feature-rich blog website built with Laravel 11 and Tailwind CSS. This platform includes comprehensive SEO optimization, admin and user dashboards, advertisement management, and a complete content management system.

## 🚀 Features

### 🎨 Frontend Features
- **Fully Responsive Design** - Works perfectly on all devices and screen sizes
- **Modern UI/UX** - Beautiful gradient designs and smooth animations
- **Multiple Categories** - Organized content with category management
- **Advanced Search** - Find articles quickly with intelligent search
- **Comprehensive SEO** - Meta tags, Open Graph, Twitter Cards, Schema markup
- **Advertisement System** - Multiple ad positions with tracking
- **Newsletter Subscription** - Email collection for marketing
- **Social Media Integration** - Share buttons and social links
- **Reading Progress Bar** - Enhanced user experience
- **Dynamic Settings** - Logo, contact info, and site configuration from admin

### 👨‍💼 Admin Features
- **Professional Dashboard** - Comprehensive statistics and analytics
- **Category Management** - Full CRUD with image uploads
- **Post Management** - Advanced editor with SEO fields
- **User Management** - Approve/reject user posts, manage roles
- **Advertisement Management** - Control ad placement and tracking
- **Settings Management** - Dynamic website configuration
- **Analytics Dashboard** - Detailed post and user statistics
- **Delete Confirmations** - Professional popup confirmations
- **Bulk Operations** - Manage multiple items efficiently

### 👤 User Features
- **Personal Dashboard** - View your blog statistics and performance
- **Post Creation** - Rich editor with SEO optimization
- **Post Management** - Edit, delete, and track your posts
- **Analytics** - View your post performance and views
- **Profile Management** - Update profile and change password
- **Post Approval System** - Admin reviews before publication

### 🔧 Technical Features
- **Laravel 11** - Latest PHP framework with modern features
- **Tailwind CSS** - Utility-first CSS framework
- **Alpine.js** - Lightweight JavaScript framework
- **Database Migrations** - Proper database structure
- **File Upload System** - Image handling for posts and categories
- **SEO Optimization** - Automatic SEO scoring and recommendations
- **View Counting** - Track post popularity
- **Ad Tracking** - Click and impression tracking
- **Email System** - Contact form and newsletter functionality
- **Responsive Design** - Mobile-first approach

## 📋 Requirements

- PHP 8.2 or higher
- Composer 2.0 or higher
- Node.js 18+ and NPM
- MySQL 8.0+ or PostgreSQL 13+
- Web server (Apache/Nginx)
- SSL certificate (for production)

## 🛠️ Installation

### 1. Clone the Repository
```bash
git clone <repository-url>
cd NepBlog
```

### 2. Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### 3. Environment Setup
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Configure Database
Edit `.env` file with your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=NepBlog
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 5. Configure Email (Optional)
For contact form and newsletter functionality:
```env
MAIL_MAILER=smtp
MAIL_HOST=your_smtp_host
MAIL_PORT=587
MAIL_USERNAME=your_email
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=contact@NepBlog.com
MAIL_FROM_NAME="NepBlog"
```

### 6. Run Database Setup
```bash
# Run migrations
php artisan migrate

# Seed the database
php artisan db:seed --class=CategorySeeder
php artisan db:seed --class=AdvertisementSeeder
php artisan db:seed --class=SettingsSeeder
```

### 7. Storage Setup
```bash
# Create storage link
php artisan storage:link
```

### 8. Build Assets
```bash
# Build for development
npm run dev

# Build for production
npm run build
```

### 9. Create Admin User
```bash
# Create a user and make them admin
php artisan tinker
```
```php
$user = \App\Models\User::create([
    'name' => 'Admin User',
    'email' => 'admin@NepBlog.com',
    'password' => bcrypt('password'),
    'is_admin' => true,
    'is_verified' => true,
    'email_verified_at' => now()
]);
```

### 10. Start the Server
```bash
php artisan serve
```

Visit `http://localhost:8000` to see your blog!

## 🗂️ Project Structure

```
NepBlog/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── HomeController.php
│   │   │   ├── ContactController.php
│   │   │   ├── Admin/
│   │   │   │   ├── CategoryController.php
│   │   │   │   ├── PostController.php
│   │   │   │   ├── AdvertisementController.php
│   │   │   │   ├── SettingController.php
│   │   │   │   └── UserController.php
│   │   │   └── User/
│   │   │       └── DashboardController.php
│   │   └── Middleware/
│   │       └── AdminMiddleware.php
│   ├── Models/
│   │   ├── Category.php
│   │   ├── Post.php
│   │   ├── Advertisement.php
│   │   ├── Setting.php
│   │   └── User.php
│   └── Mail/
│       └── ContactFormMail.php
├── database/
│   ├── migrations/
│   │   ├── create_categories_table.php
│   │   ├── create_posts_table.php
│   │   ├── create_advertisements_table.php
│   │   ├── create_settings_table.php
│   │   ├── add_seo_fields_to_posts_table.php
│   │   └── add_fields_to_users_table.php
│   └── seeders/
│       ├── CategorySeeder.php
│       ├── AdvertisementSeeder.php
│       └── SettingsSeeder.php
├── resources/
│   └── views/
│       ├── frontend/
│       │   ├── layout/
│       │   │   ├── main.blade.php
│       │   │   ├── header.blade.php
│       │   │   └── footer.blade.php
│       │   ├── homepage/
│       │   │   └── home.blade.php
│       │   └── pages/
│       │       ├── about.blade.php
│       │       ├── contact.blade.php
│       │       └── 404.blade.php
│       ├── admin/
│       │   ├── layouts/
│       │   │   └── app.blade.php
│       │   └── dashboard.blade.php
│       └── user/
│           ├── layouts/
│           │   └── app.blade.php
│           └── dashboard/
│               └── index.blade.php
└── routes/
    └── web.php
```

## 🎨 Customization

### Styling
The website uses Tailwind CSS for styling. Customize by:
- Modifying CSS classes in Blade templates
- Adding custom CSS in `<style>` sections
- Updating `tailwind.config.js` file

### Colors and Themes
Current theme uses purple and blue gradients. To change:
1. Update gradient classes in templates
2. Modify custom CSS variables
3. Update Tailwind configuration

### Advertisement Positions
Supported ad positions:
- `header` - Top banner
- `sidebar` - Sidebar ads
- `footer` - Footer banner
- `content` - In-content ads

## 🔧 Configuration

### Admin Access
Create admin users by setting `is_admin` to `true` in the users table.

### File Uploads
Configure file upload settings in `config/filesystems.php` and ensure storage directory is writable.

### SEO Settings
Manage SEO settings through the admin panel:
- Google Analytics ID
- Meta descriptions
- Schema markup
- Social media tags

### Dynamic Settings
All website settings can be changed from the admin panel:
- Site name and description
- Logo and favicon
- Contact information
- Social media links
- Advertisement settings

## 📊 Database Schema

### Categories Table
- `id` - Primary key
- `name` - Category name
- `slug` - URL-friendly slug
- `description` - Category description
- `image` - Category image path
- `is_active` - Active status

### Posts Table
- `id` - Primary key
- `title` - Post title
- `slug` - URL-friendly slug
- `content` - Post content
- `excerpt` - Post excerpt
- `featured_image` - Featured image path
- `category_id` - Foreign key to categories
- `user_id` - Foreign key to users
- `status` - Draft or published
- `published_at` - Publication date
- `is_approved` - Admin approval status
- `is_featured` - Featured post flag
- `views_count` - View counter
- `reading_time` - Estimated reading time
- `seo_score` - SEO optimization score
- **SEO Fields:**
  - `meta_title`, `meta_description`, `meta_keywords`
  - `og_title`, `og_description`, `og_image`
  - `twitter_title`, `twitter_description`, `twitter_image`
  - `canonical_url`, `schema_markup`

### Users Table
- `id` - Primary key
- `name` - User name
- `email` - Email address
- `password` - Hashed password
- `avatar` - Profile image
- `bio` - User biography
- `website` - Personal website
- `is_admin` - Admin privileges
- `is_verified` - Email verification
- `last_login_at` - Last login timestamp
- `preferences` - User preferences (JSON)

### Advertisements Table
- `id` - Primary key
- `title` - Ad title
- `description` - Ad description
- `image` - Ad image path
- `link` - Ad destination URL
- `position` - Ad position
- `is_active` - Active status
- `start_date`, `end_date` - Campaign dates
- `clicks_count` - Click counter
- `impressions_count` - Impression counter

### Settings Table
- `id` - Primary key
- `key` - Setting key
- `value` - Setting value (JSON)
- `type` - Setting type
- `group` - Setting group

## 🚀 Deployment

### 1. Production Environment
```bash
# Install production dependencies
composer install --optimize-autoloader --no-dev

# Build assets
npm run build

# Cache configurations
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 2. Set Permissions
```bash
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### 3. Configure Web Server
Point your web server to the `public` directory and ensure proper URL rewriting.

### 4. Environment Variables
Set all production environment variables in `.env`:
- Database credentials
- Mail settings
- Cache settings
- Queue settings (if using)

### 5. SSL Certificate
Install SSL certificate for HTTPS (required for production).

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📝 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 🆘 Support

For support and questions:
- Create an issue in the repository
- Contact the development team
- Check the documentation

## 🔄 Updates

To update the application:
1. Pull the latest changes
2. Run `composer install`
3. Run `npm install && npm run build`
4. Run `php artisan migrate`
5. Clear caches: `php artisan cache:clear`

## 🎯 Roadmap

- [ ] Advanced analytics with charts
- [ ] Multi-language support
- [ ] Advanced search with filters
- [ ] Comment system
- [ ] Social login integration
- [ ] API endpoints for mobile apps
- [ ] Advanced caching system
- [ ] Automated backups
- [ ] Email templates customization
- [ ] Advanced user roles and permissions

---

**NepBlog** - Your Ultimate Blog Destination 🚀

Built with ❤️ using Laravel 11 and Tailwind CSS
