# 🚗 Automobile Service and Parts Management System

A **Laravel-based full-stack web application** that streamlines vehicle service management, spare parts ordering, vendor coordination, and administrative operations under one unified platform.

---

## 📑 Table of Contents
1. [Introduction](#-introduction)
2. [Project Objectives](#-project-objectives)
3. [System Overview](#-system-overview)
4. [Modules Implemented](#-modules-implemented)
5. [Architecture](#-architecture)
6. [Features](#-features)
7. [Tech Stack](#-tech-stack)
8. [Setup Instructions](#-setup-instructions)
9. [Screenshots & Diagrams](#-screenshots--diagrams)
10. [Author & Contribution](#-author--contribution)
11. [License](#-license)

---

## 🚀 Introduction

The **Automobile Service and Parts Management System** is a comprehensive solution developed using **Laravel + Blade** templates to facilitate the management of automobile-related activities.

It serves **three major user roles**:

- 👨‍🔧 **Customer:** Manage vehicles, book services, and order parts.  
- 🏭 **Vendor:** Manage catalogs, stock, and fulfill customer orders.  
- 🧑‍💼 **Administrator:** Oversee all operations, users, reports, and settings.

The project enhances efficiency, transparency, and automation within the automobile after-sales ecosystem.

---

## 🎯 Project Objectives

- Streamline vehicle service and parts order workflows.
- Improve visibility through real-time dashboards and analytics.
- Enable role-based access for secure data handling.
- Automate approvals, tracking, and reporting processes.
- Maintain usability and scalability through clean architecture.

---

## 🧩 System Overview

| **Role** | **Key Capabilities** |
|-----------|----------------------|
| **Customer** | Browse parts, manage vehicles, maintain cart, view orders. |
| **Vendor** | Manage catalog (CRUD), view incoming orders, update stock. |
| **Admin** | Manage users, vendors, reports, and system configurations. |

---

## 🧱 Modules Implemented

### 1. **Customer Module**
- Dashboard with quick stats (vehicles, services, orders)
- Browse Parts, Add to Cart, Checkout flow
- Order detail with item-level totals
- Controllers, routes, and validation logic

### 2. **Vendor Module**
- Dashboard with pending approval banner
- Catalog Management (List/Create/Edit with file uploads)
- Orders List and Detail
- Placeholder sections for Stock, Reviews, Reports, Profile

### 3. **Admin Module**
- Dashboard with system-wide KPIs
- User Management (CRUD + Pending Approvals)
- Reports (Chart.js visualization for users & revenue)
- Settings page with configuration persistence

### 4. **Cross-Cutting**
- Tailwind-based layouts for all roles  
- Role-based middleware (`auth`, `role`)  
- Flash messages, CSRF protection, and route guards

---

## 🏗 Architecture

```
+------------------------------------------------------------+
|                     Presentation Layer                     |
|   Blade Views: Customer, Vendor, Admin Dashboards          |
+------------------------------------------------------------+
|                     Application Layer                      |
|   Controllers, Middleware, Route Groups, Validation         |
+------------------------------------------------------------+
|                       Data Layer                           |
|   Eloquent Models: User, Order, Inventory, Settings         |
+------------------------------------------------------------+
|                   Infrastructure Layer                      |
|   MySQL Database, Laravel Framework, TailwindCSS, Chart.js  |
+------------------------------------------------------------+
```

---

## ✨ Features

✅ Role-based dashboards (Customer, Vendor, Admin)  
✅ End-to-end parts ordering workflow  
✅ Vendor catalog management  
✅ Admin analytics using Chart.js  
✅ Secure authentication & middleware protection  
✅ Clean TailwindCSS UI and flash feedback system  

---

## 🧰 Tech Stack

| Category | Technologies |
|-----------|--------------|
| **Frontend** | HTML, CSS, TailwindCSS, Blade Templates |
| **Backend** | Laravel (PHP 9.x), Eloquent ORM |
| **Database** | MySQL |
| **Visualization** | Chart.js |
| **Version Control** | Git & GitHub |

---

## ⚙️ Setup Instructions

1. **Clone Repository**
   ```bash
   git clone https://github.com/yourusername/automobile-service-system.git
   cd automobile-service-system
   ```

2. **Install Dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment Setup**
   - Copy `.env.example` → `.env`
   - Set database credentials and app key:
     ```bash
     php artisan key:generate
     php artisan migrate --seed
     ```

4. **Run the Application**
   ```bash
   php artisan serve
   ```
   Visit: [http://localhost:8000](http://localhost:8000)

---

## 🖼 Screenshots & Diagrams
> _To be added later:_
- Use Case Diagram  
- System Architecture Diagram  
- Sequence (Checkout Flow) Diagram  
- Screenshots of Dashboards (Customer/Vendor/Admin)

---

## 👨‍💻 Author & Contribution

**Author:** Ashen Rajakulathilaka  
**Role:** Full-stack Developer  
**Contribution:**  
- End-to-end implementation of Customer, Vendor, and Admin modules  
- Database schema design, controllers, and route logic  
- Frontend (Blade + TailwindCSS) and backend (Laravel MVC)  
- System integration, validation, and testing

---

## 🪪 License
This project is developed for academic and demonstration purposes.  
© 2025 [Your Name]. All rights reserved.

---

### 🌟 Star this repo if you found it useful!
