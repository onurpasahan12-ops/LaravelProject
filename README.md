# 🛒 Laravel E-Commerce & Admin Management Panel Project

This project is a modern web application featuring an advanced user authentication system, role-based authorization (Admin/User Middleware), and a dynamic product management (CRUD) system.

## 🚀 Features
- **Role-Based Security:** Only users with the `admin` role can access the management panel (`/admin/dashboard`). Unauthorized users and guests are strictly restricted from these areas.
- **Product Management (CRUD):** Full capability to create, read, update, and delete products dynamically from the secure admin dashboard.
- **Client Showcase Vitrine:** All products added by the admin are automatically listed on the homepage using clean Bootstrap cards, with real-time stock status badges.
- **Secure Logout:** Integrated with a CSRF-protected secure logout mechanism.

---

## 🛠️ Installation & Setup Guide

Follow the steps below to set up the database structure and seed the test users on your local machine:

### 1. Install Dependencies
Open your terminal in the project root directory and run the following command to install the required PHP packages:
```bash
composer install