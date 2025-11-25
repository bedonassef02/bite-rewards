# 🍽️ Bite Rewards - Loyalty & Rewards API

A multi‑restaurant loyalty and rewards platform built with **Laravel**. It supports shop subscription plans (Basic & Premium), Stripe payment integration, API authentication, and a rich set of endpoints for both web and API consumers.

---

## ✨ Features

### Core
- **Shop Management** – Create, edit, and delete shops with slug‑based URLs.
- **Visit Tracking** – Record customer visits, calculate progress toward rewards, and view history.
- **Reward System** – Automatic reward issuance after a configurable number of visits.

### Subscriptions & Payments
- **Basic & Premium Plans** – Premium shops get a featured badge, top placement, and enhanced styling.
- **Stripe Checkout** – Secure payment flow for upgrading to Premium.
- **Plan Management** – API endpoints to view plans, upgrade, and handle payment callbacks.

### API
- **Auth** – Register and login with token‑based authentication.
- **Shop API** – Full CRUD, plan status, and subscription actions.
- **Visit API** – Record visits (shop owners) and list a customer's visit history.
- **QR Code API** – Generate QR payload for customers.

---

## 📦 Installation

```bash
# Clone the repository
git clone https://github.com/yourusername/bite-rewards.git
cd bite-rewards

# Install PHP dependencies
composer install

# Install Node dependencies (requires Node 20.19+ or 22.12+)
npm install

# Copy env file and generate app key
cp .env.example .env
php artisan key:generate

# Set Stripe keys in .env
# STRIPE_KEY=pk_test_...
# STRIPE_SECRET=sk_test_...
# STRIPE_PRICE_ID=price_...

# Run migrations and seeders
php artisan migrate:fresh --seed

# Build assets
npm run build

# Serve the application
php artisan serve
```

---

## 🔧 Configuration

- **Stripe** – Create a product and price in the Stripe Dashboard, then set `STRIPE_PRICE_ID` in `.env`.
- **Shop Plans** – Defined in `ShopController::plans()` (Basic is free, Premium is $29 / month).
- **Slug URLs** – Shops are accessed via `/shops/{slug}`; slugs are generated automatically.

---

## 📚 API Documentation

| Method | Endpoint | Description |
|--------|----------|-------------|
| `POST` | `/api/register` | Register a new user (shop owner or customer). |
| `POST` | `/api/login` | Login and receive a Sanctum token. |
| `GET` | `/api/shops` | List shops with search & sorting. |
| `POST` | `/api/shops` | Create a new shop (shop owners only). |
| `GET` | `/api/shops/{slug}` | Get shop details and current plan. |
| `PUT` | `/api/shops/{slug}` | Update shop information. |
| `DELETE` | `/api/shops/{slug}` | Delete a shop. |
| `GET` | `/api/plans` | Retrieve available subscription plans. |
| `POST` | `/api/shops/{slug}/upgrade` | Upgrade shop to Premium via Stripe Checkout. |
| `GET` | `/api/shops/{slug}/payment/success` | Handle successful payment callback. |
| `GET` | `/api/shops/{slug}/payment/cancel` | Handle cancelled payment. |
| `GET` | `/api/visits` | List the authenticated customer's visits. |
| `POST` | `/api/visits` | Record a visit (shop owners only). |
| `GET` | `/api/my-qr` | Generate QR payload for the authenticated user. |

---

## 🎨 Front‑end

The web UI uses **Tailwind CSS** for a premium look, with animated "Featured" badges for premium shops, consistent card sizing, and a modern navigation bar that includes a **Pricing** link for shop owners.

---

## 🧪 Testing

```bash
# Run PHPUnit tests
php artisan test
```

---

## 📄 License

MIT License – feel free to use and modify this project.
