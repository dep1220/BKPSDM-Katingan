# 🏛️ Website BKPSDM Katingan


<p align="center">
  <a href="https://laravel.com"><img src="https://img.shields.io/badge/Laravel-11.x-FF2D20?style=flat&logo=laravel" alt="Laravel Version"></a>
  <a href="https://php.net"><img src="https://img.shields.io/badge/PHP-8.3+-777BB4?style=flat&logo=php" alt="PHP Version"></a>
  <a href="https://tailwindcss.com"><img src="https://img.shields.io/badge/Tailwind-3.x-38B2AC?style=flat&logo=tailwind-css" alt="Tailwind CSS"></a>
  <a href="https://alpinejs.dev"><img src="https://img.shields.io/badge/Alpine.js-3.x-8BC34A?style=flat&logo=alpine.js" alt="Alpine.js"></a>
</p>

## 📋 Tentang Project

Website resmi **Badan Kepegawaian dan Pengembangan Sumber Daya Manusia (BKPSDM) Kabupaten Katingan** yang dibangun menggunakan Laravel 11. Website ini berfungsi sebagai portal informasi publik dan sistem manajemen konten untuk administrasi BKPSDM.

### ✨ Fitur Utama

**Portal Publik:**
- 🏠 **Beranda** - Hero slider, berita terbaru, agenda kegiatan
- 📰 **Berita** - Artikel dan pengumuman dengan sistem pencarian
- 🖼️ **Galeri** - Dokumentasi kegiatan dalam bentuk foto
- 📅 **Agenda** - Kalender kegiatan dan acara BKPSDM
- 👥 **Profil Pejabat** - Struktur organisasi dan pimpinan
- 🎯 **Visi & Misi** - Visi, misi, dan tujuan organisasi
- 📄 **Unduhan** - Dokumen publik yang dapat diunduh
- 📞 **Kontak** - Form kontak dan informasi alamat

**Panel Admin:**
- 📊 **Dashboard** - Statistik dan overview sistem
- 👤 **Manajemen User** - Role-based user management
- 🔐 **Sistem Permisi** - Granular permission control
- 📝 **Content Management** - CRUD untuk semua konten
- 📈 **Activity Logging** - Pencatatan aktivitas user
- 🔄 **Auto Cleanup** - Pembersihan otomatis log lama

**API RESTful:**
- 🔑 **Authentication** - Token-based auth dengan Sanctum
- 📚 **Complete CRUD** - Endpoint untuk semua resources
- 📖 **Swagger Documentation** - API docs terintegrasi
- 🛡️ **Security** - Rate limiting dan validation

## 🛠️ Teknologi & Dependencies

### Core Framework
- **Laravel 11.x** - PHP framework utama
- **PHP 8.3+** - Server-side scripting
- **MySQL/SQLite** - Database management

### Frontend Stack
- **Tailwind CSS 3.x** - Utility-first CSS framework
- **Alpine.js 3.x** - Reactive JavaScript framework
- **Vite** - Build tool dan module bundler
- **Swiper.js** - Touch slider component
- **TinyMCE** - Rich text editor

### Backend Packages
- **Spatie Laravel Permission** - Role & permission management
- **Laravel Sanctum** - API authentication
- **Intervention Image** - Image processing
- **L5 Swagger** - API documentation
- **Laravel Breeze** - Authentication scaffolding

### Development Tools
- **Pest PHP** - Testing framework
- **Laravel Tinker** - Command line tool
- **Vite Dev Server** - Hot module replacement

## 🚀 Instalasi & Setup

### Prerequisites
```bash
- PHP >= 8.3
- Composer
- Node.js >= 18
- MySQL/SQLite
- Web Server (Apache/Nginx)
```

### 1. Clone Repository
```bash
git clone https://github.com/your-repo/bkpsdm-5.git
cd bkpsdm-5
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

### 4. Database Configuration
Edit file `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bkpsdm_katingan
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 5. Database Migration & Seeding
```bash
# Run migrations
php artisan migrate

# Seed default data (optional)
php artisan db:seed
```

### 6. Storage Link
```bash
# Create storage symlink
php artisan storage:link
```

### 7. Build Assets
```bash
# Development
npm run dev

# Production
npm run build
```

### 8. Setup Permissions
Buat role dan permission default:
```bash
php artisan tinker

# Dalam tinker:
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

// Buat permissions
Permission::create(['name' => 'manage news']);
Permission::create(['name' => 'manage gallery']);
Permission::create(['name' => 'manage downloads']);
Permission::create(['name' => 'manage officials']);
Permission::create(['name' => 'manage users']);
Permission::create(['name' => 'manage contacts']);
Permission::create(['name' => 'manage hero']);

// Buat roles
$superAdmin = Role::create(['name' => 'super-admin']);
$admin = Role::create(['name' => 'admin']);

// Assign permissions ke super-admin
$superAdmin->givePermissionTo(Permission::all());

// Assign permissions terbatas ke admin
$admin->givePermissionTo(['manage news', 'manage gallery', 'manage downloads', 'manage officials']);

exit
```

## 🎯 Struktur Project

### Model & Database
```
app/Models/
├── User.php              # User management
├── Berita.php            # News articles
├── Galeri.php            # Photo gallery
├── Agenda.php            # Event schedule
├── Unduhan.php           # Downloadable files
├── Pejabat.php           # Officials data
├── Hero.php              # Homepage slider
├── Kontak.php            # Contact messages
├── VisiMisi.php          # Vision & mission
└── ActivityLog.php       # Activity logging
```

### Controllers
```
app/Http/Controllers/
├── PublicController.php           # Public frontend
├── Admin/
│   ├── DashboardController.php    # Admin dashboard
│   ├── UserController.php         # User management
│   ├── KontakController.php       # Contact management
│   ├── HeroController.php         # Hero slider
│   ├── VisiMisiController.php     # Vision & mission
│   └── AgendaController.php       # Event management
├── Api/                          # RESTful API endpoints
└── Auth/                         # Authentication
```

### Routes
```
routes/
├── web.php               # Web routes (admin + public)
├── api.php               # API routes
├── auth.php              # Authentication routes
└── console.php           # Artisan commands
```

### Views Structure
```
resources/views/
├── layouts/              # Layout templates
│   ├── app.blade.php     # Admin layout
│   ├── public.blade.php  # Public layout
│   └── sidebar.blade.php # Admin sidebar
├── admin/                # Admin panel views
│   ├── dashboard.blade.php
│   ├── berita/           # News management
│   ├── galeri/           # Gallery management
│   ├── users/            # User management
│   └── ...
├── public/               # Public frontend views
│   ├── index.blade.php   # Homepage
│   ├── berita/           # News pages
│   ├── galeri/           # Gallery pages
│   └── ...
└── components/           # Reusable components
```

## 📚 API Documentation

### Authentication
```bash
# Login untuk mendapatkan token
POST /api/login
{
    "email": "admin@example.com",
    "password": "password"
}

# Response
{
    "user": {...},
    "token": "1|abc123...",
    "token_type": "Bearer"
}
```

### Public Endpoints
```bash
GET /api/beritas           # Daftar berita
GET /api/beritas/{id}      # Detail berita
GET /api/galeris           # Daftar galeri
GET /api/agendas           # Daftar agenda
GET /api/pejabats          # Daftar pejabat
GET /api/unduhans          # Daftar unduhan
GET /api/visi-misi         # Visi & misi
POST /api/kontaks          # Kirim pesan kontak
```

### Protected Endpoints (Requires Token)
```bash
# Headers
Authorization: Bearer {token}

# CRUD Operations
POST /api/beritas          # Buat berita
PUT /api/beritas/{id}      # Update berita
DELETE /api/beritas/{id}   # Hapus berita

# Dan endpoint CRUD lainnya untuk resource lain
```

### Swagger Documentation
Akses dokumentasi API lengkap di: `http://localhost:8000/api/documentation`

## 🔐 Sistem Roles & Permissions

### Roles
- **Super Admin** - Full access ke semua fitur
- **Admin** - Access terbatas (tidak bisa manage users)

### Permissions
- `manage news` - Kelola berita
- `manage gallery` - Kelola galeri
- `manage downloads` - Kelola unduhan & agenda
- `manage officials` - Kelola data pejabat
- `manage users` - Kelola pengguna
- `manage contacts` - Kelola pesan kontak
- `manage hero` - Kelola slider & visi misi

### Middleware Usage
```php
// Di routes
Route::resource('beritas', BeritaController::class)
    ->middleware('can:manage news');

// Di controller
public function __construct()
{
    $this->middleware('can:manage news');
}
```

### Environment Variables (Production)
```env
APP_NAME="BKPSDM Katingan"
APP_ENV=production
APP_KEY=base64:your-generated-key
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=your-db-host
DB_PORT=3306
DB_DATABASE=your-database
DB_USERNAME=your-username
DB_PASSWORD=your-secure-password

MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host
MAIL_PORT=587
MAIL_USERNAME=your-email
MAIL_PASSWORD=your-email-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@yourdomain.com"
MAIL_FROM_NAME="${APP_NAME}"

CACHE_STORE=redis
SESSION_DRIVER=redis
QUEUE_CONNECTION=redis

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
```
