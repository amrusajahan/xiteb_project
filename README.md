# Xiteb Project — Quick Start

This is a small Laravel app (users upload prescriptions; pharmacies send quotations).

Follow these simple steps after extracting the project folder.

1) Install dependencies

```powershell
cd C:\path\to\xiteb_project
composer install
```

2) Environment & key

```powershell
copy .env.example .env
php artisan key:generate
```

3) Database (MySQL)

Edit the `.env` file and set your MySQL connection values (example):

```powershell
# .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=xiteb_project
DB_USERNAME=root
DB_PASSWORD=secret
```

Create the database (example using MySQL CLI):

```powershell
mysql -u root -p -e "CREATE DATABASE IF NOT EXISTS xiteb_db;"
```

Then run migrations:

```powershell
php artisan migrate --seed
```

4) Link storage (so uploaded images are visible)

```powershell
php artisan storage:link
```

5) Run the app

```powershell
php artisan serve
```

Open: http://127.0.0.1:8000

Admin (pharmacy) user (add manually or via tinker):

- Email: admin@gmail.com
- Password: admin123
- Role: pharmacy

To create via tinker:

```powershell
php artisan tinker
>>> \App\Models\User::create([ 'name' => 'Admin', 'email' => 'admin@gmail.com', 'password' => bcrypt('admin123'), 'role' => 'pharmacy', 'contact_no' => '0000000000' ]);
```

Notes:
- Run `php artisan storage:link` once so uploaded images work.
- Login route is `login.show` and register is `register.show` if you need to adjust links.

That's it — zip and send this folder to your supervisor.
# Xiteb Project

This is a small Laravel application used to upload prescriptions (users) and allow pharmacies to prepare and send quotations. The project includes role-based dashboards for `user` and `pharmacy` roles.

## Prerequisites

- PHP 8.0+ (installed and available in PATH)
- Composer
- SQLite (or another database (eg:MySQL); this project includes a local `database/database.sqlite` file)
- Node.js + npm (optional, only if you plan to run Vite builds)

This repository was developed on Windows (PowerShell), so the example commands below use PowerShell syntax.

## Quick start (development)

1. Clone the repo (if you haven't already) and change into the project folder:

```powershell
cd C:\path\to\workspace\xiteb_project
```

2. Install PHP dependencies:

```powershell
composer install
```

3. Copy the example env and generate app key:

```powershell
copy .env.example .env
php artisan key:generate
```

4. Database

- This project ships with a SQLite DB at `database/database.sqlite`. If you want a fresh DB, ensure the file exists:

```powershell
if (-Not (Test-Path database\database.sqlite)) { New-Item database\database.sqlite -ItemType File }
```

- Run migrations and seeders (if any):

```powershell
php artisan migrate --seed
```

5. Storage link (to serve uploaded images):

```powershell
php artisan storage:link
```

6. Serve the app (development server):

```powershell
php artisan serve
```

Open http://127.0.0.1:8000 in your browser.

## Admin / Pharmacy user

The admin pharmacy user is expected to be created manually in the database. For convenience during development, use these credentials (they must be added to the `users` table):

- Email: `admin@gmail.com`
- Password: `admin123`
- Role: `pharmacy`

If you prefer to create it via tinker, run:

```powershell
php artisan tinker
>>> \App\Models\User::create([ 'name' => 'Admin Pharmacy', 'email' => 'admin@gmail.com', 'password' => bcrypt('admin123'), 'role' => 'pharmacy', 'contact_no' => '0000000000' ]);
```

Note: If you add the user manually, ensure the password is hashed (bcrypt) and the `role` column is set to `pharmacy`.

## Important routes / pages

- `/` — Welcome
- `/register` — Register (shows registration form)
- `/login` — Login
- `/dashboard` — Redirects to role-specific dashboards
- `/prescriptions/create` — Upload prescription (authenticated user)
- `/pharmacy/prescriptions` — Pharmacy list of uploaded prescriptions
- `/pharmacy/quotations` — Pharmacy's sent quotations
- `/my-quotations` — User's quotations

Route names (useful for developers):
- `login.show`, `login.process`, `register.show`, `register.process`, `logout`
- `dashboard.user`, `dashboard.pharmacy`
- `prescriptions.create`, `prescriptions.store`
- `pharmacy.prescriptions`, `pharmacy.quotations`, `pharmacy.quotations.create`, `pharmacy.quotations.store`
- `user.quotations`, `user.quotations.respond`

## Notes & troubleshooting

- Uploaded images are stored on the `public` disk and require `php artisan storage:link` to be accessible via `/storage/...`.
- If you see a `RouteNotFoundException` for `login` or `register`, the project defines those routes as `login.show` and `register.show` — update any custom links accordingly.
- Role checks are currently performed in controllers; consider adding middleware to protect role-specific routes.

