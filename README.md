# DualBrand PHP MVC (Shnikh Agrobiotech & Cordygen)

Production-ready, Hostinger-friendly clean MVC PHP app (PHP 8.2+, MySQL 8) with dual-brand routing, ecommerce (cart, checkout, COD & Razorpay), blog, and admin panel with RBAC.

## Features
- Dual brand UX under a single codebase: `/shnikh/*` and `/cordygen/*`
- Universal landing (`/`) with brand selector and lead capture
- Shared header/footer with always-visible brand switcher
- Products, cart, checkout (COD + Razorpay checkout.js), order tracking
- Blog list/detail for both brands
- Admin panel (`/admin`): login, Products CRUD, Posts CRUD, Orders management
- RBAC roles: `SUPER_ADMIN`, `ADMIN`, `CONTENT_MANAGER`
- Bootstrap 5 + vanilla JS; clean URLs via `.htaccess`

## Requirements
- PHP 8.2+
- MySQL 8.x
- Apache with `mod_rewrite` (Hostinger compatible)

## Local Setup
1. Copy env file and set DB credentials:
   ```bash
   cp .env.example .env
   # edit .env with your DB settings and Razorpay keys
   ```
2. Create DB and install schema + seeds:
   ```bash
   php scripts/install.php
   ```
3. Serve locally:
   ```bash
   php -S 127.0.0.1:8000 -t public
   # visit http://127.0.0.1:8000
   ```

## Default Admin
- Email: `admin@example.com`
- Password: `password`
- Role: `SUPER_ADMIN`

## Deploying on Hostinger
1. Upload all files to your hosting account.
2. Point the domain/subdomain Document Root to the `public/` directory.
3. Set environment variables using Hostinger hPanel or edit `.env`.
4. Create the database, then run `scripts/install.php` once via SSH or a temporary public URL:
   - SSH: `php scripts/install.php`
   - Or visit `https://your-domain.com/scripts/install.php` temporarily (delete afterward).

## Razorpay Notes
- Add `RAZORPAY_KEY_ID` and `RAZORPAY_KEY_SECRET` in `.env`.
- The included verification is minimal; add server-side signature checks before going live.

## Project Structure
```
public/           # Front controller, assets, .htaccess
app/Core/         # Mini framework: Router, Request, Response, DB, View, Auth, CSRF
app/Controllers/  # Site and Admin controllers
app/Models/       # DB models (PDO)
app/Views/        # Layouts, partials, brand pages, admin UI
config/           # App and service config
database/         # schema.sql (tables + seed data)
scripts/          # install.php (creates DB and seeds)
```

## Security & Production
- CSRF protection on forms
- RBAC checks on admin modules
- Ensure `.env` is not publicly accessible
- Replace default `SESSION_SECRET` and admin credentials
- Add HTTPS and secure cookies on production

## License
MIT. Use at your own risk; validate payment flows before production. 