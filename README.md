# 🎭 Art Center Booking System

A web application built with **Laravel** (Blade templates for frontend)
to manage art center bookings.

------------------------------------------------------------------------

## ⚙️ Setup Instructions

### 2️⃣ Install PHP Dependencies

``` bash
composer install
```

### 3️⃣ Create Environment File

``` bash
cp .env.example .env   # Linux / Mac
copy .env.example .env # Windows
```

### 4️⃣ Generate App Key

``` bash
php artisan key:generate
```

### 5️⃣ Configure Database

Open `.env` and update:

``` env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=art_center
DB_USERNAME=root
DB_PASSWORD=
```

### 6️⃣ Run Database Migrations

``` bash
php artisan migrate
# (optional) add test data
php artisan db:seed
```

### 7️⃣ Install Node Modules (if Tailwind/Bootstrap is used)

``` bash
npm install
npm run dev
```

### 8️⃣ Start Development Server

``` bash
php artisan serve
```

Now open 👉 `http://127.0.0.1:8000`

------------------------------------------------------------------------

## 📂 Project Structure

    app/        → Core application (models, controllers)
    resources/  → Blade templates (frontend UI)
    routes/     → Web routes (web.php)
    public/     → Public assets (CSS, JS, images)
    database/   → Migrations & seeds
