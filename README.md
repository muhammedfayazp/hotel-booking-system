# 🏨 Hotel Inventory & Search System

A Laravel 13 full-stack mini booking system built as a technical assessment for **SkyUniTech**.

---

## 👨‍💻 Developer
**Muhammed Fayaz**

---

## 🛠️ Tech Stack

| Layer | Technology |
|-------|-----------|
| Framework | Laravel 13 |
| Auth | Laravel Sanctum (API) + Session (Web) |
| Database | MySQL 8.0 / MariaDB |
| Cache | Redis / File |
| Frontend | Blade + Tailwind CSS |
| Testing | PHPUnit 11 |
| Containers | Docker + Docker Compose |

---

## ✅ Features Implemented

### Architecture
- ✅ Repository Pattern (Interface + Implementation)
- ✅ Service Layer (business logic separated from controllers)
- ✅ Form Request Validation
- ✅ API Resource Transformers
- ✅ Eloquent Relationships (Hotel hasMany Rooms)
- ✅ Query Scopes (byCity, byRating, available, forGuests)

### Authentication
- ✅ Web login/logout with session
- ✅ API login/logout with Laravel Sanctum tokens
- ✅ Middleware protection for all routes

### API Endpoints
- ✅ POST /api/login
- ✅ POST /api/logout
- ✅ GET /api/hotels (with city, rating filters + pagination)
- ✅ POST /api/hotels
- ✅ POST /api/rooms
- ✅ GET /api/search (with total price calculation)

### Frontend (Blade + Tailwind CSS)
- ✅ Login page with validation
- ✅ Dashboard with stats
- ✅ Hotel management (add + filter + paginate)
- ✅ Room management (add + list)
- ✅ Search availability with results

### Bonus
- ✅ Redis cache for search results
- ✅ Repository pattern
- ✅ Unit tests (4 tests passing)
- ✅ Rate limiting on API
- ✅ Docker setup
- ✅ Tailwind CSS
- ✅ Postman collection

---

## 🚀 Quick Start

### Option 1 — Local (PHP + MySQL)

**Requirements:** PHP 8.2+, Composer, MySQL

```bash
# 1. Clone the repository
git clone https://github.com/YOUR_USERNAME/hotel-booking-system.git
cd hotel-booking-system

# 2. Install dependencies
composer install
npm install

# 3. Copy environment file
cp .env.example .env

# 4. Update .env with your database credentials
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hotel_booking
DB_USERNAME=root
DB_PASSWORD=

# 5. Generate app key
php artisan key:generate

# 6. Run migrations and seed data
php artisan migrate
php artisan db:seed

# 7. Build assets
npm run build

# 8. Start server
php artisan serve
```

Open **http://localhost:8000**

---

### Option 2 — Docker

**Requirements:** Docker Desktop

```bash
# 1. Clone the repository
git clone https://github.com/YOUR_USERNAME/hotel-booking-system.git
cd hotel-booking-system

# 2. Copy environment file
cp .env.example .env

# 3. Start containers
docker compose up -d --build

# 4. Install dependencies
docker compose exec app composer install

# 5. Setup Laravel
docker compose exec app php artisan key:generate
docker compose exec app php artisan migrate
docker compose exec app php artisan db:seed
```

Open **http://localhost:8000**

---

## 🔐 Login Credentials

| Field | Value |
|-------|-------|
| Email | `admin@example.com` |
| Password | `password` |

---

## 📡 API Reference

All protected routes require:
```
Authorization: Bearer <token>
```

| Method | Endpoint | Auth | Description |
|--------|----------|------|-------------|
| POST | `/api/login` | ❌ | Get access token |
| POST | `/api/logout` | ✅ | Revoke token |
| GET | `/api/hotels` | ✅ | List hotels (filter by city, rating) |
| POST | `/api/hotels` | ✅ | Create hotel |
| POST | `/api/rooms` | ✅ | Create room |
| GET | `/api/search` | ✅ | Search availability + total price |

---

## 🧪 Running Tests

```bash
php artisan test --testsuite=Unit
```

Expected output:
```
PASS  Tests\Unit\SearchServiceTest
✓ it calculates total price correctly
✓ it returns empty when no hotels available
✓ it handles single night stay
✓ it includes hotel meta in results
Tests: 4 passed (10 assertions)
```

---

## 📁 Project Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Api/          # API controllers
│   │   └── Web/          # Web controllers
│   ├── Requests/         # Form Request validators
│   └── Resources/        # API Resource transformers
├── Models/               # Hotel, Room, User
├── Repositories/         # Repository pattern
├── Services/             # Business logic
└── Providers/            # RepositoryServiceProvider
database/
├── migrations/           # Database tables
└── seeders/              # Sample data
resources/views/
├── layouts/              # Main layout
├── auth/                 # Login page
├── dashboard/            # Dashboard
├── hotels/               # Hotel management
├── rooms/                # Room management
└── search/               # Search pages
routes/
├── web.php               # Web routes
└── api.php               # API routes
tests/Unit/
└── SearchServiceTest.php # 4 unit tests
docker/
├── Dockerfile
└── nginx.conf
```

---

## 📮 Postman Collection

Import `HotelBooking.postman_collection.json` into Postman.

The **Login** request automatically saves the token — all other requests work immediately after login.

---

## 📞 Contact

Built as part of a technical assessment.
