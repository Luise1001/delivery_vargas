# Delivery Vargas

**Delivery Vargas** is a food delivery system inspired by apps like **Yummy** and **PedidosYa**, originally built in pure PHP and later partially migrated to **Laravel**. The project was canceled before completion, but it includes a working structure for customer orders, store management, admin coordination, and delivery driver assignment.

---

## 📦 Core Features (Implemented or In Progress)

- **Customer Session**:
  - Browse product listings and filter by stores.
  - Add items to a cart and submit orders.
- **Store Owner Session**:
  - Receive push notifications when an order is placed.
  - Prepare orders and mark them as ready for delivery.
- **Admin Session**:
  - Get notified when an order is ready.
  - View available delivery drivers sorted by distance (in kilometers).
  - Assign drivers to deliveries.
- **Driver Session**:
  - Receive assigned orders via push notifications.
  - View customer details and open a map with the delivery route.

---

## ⚙️ Tech Stack

- **Laravel + Blade Templates**
- **MySQL**
- **Firebase** (for push notifications)
- **Google Maps API** (for distance & routing)
- **Bootstrap** (frontend UI)

> ⚠️ Some features from the original PHP version may not yet be fully migrated into this Laravel version.

---

## 🚀 Installation

```bash
git clone https://github.com/Luise1001/delivery_vargas.git
cd delivery_vargas
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
