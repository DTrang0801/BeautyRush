# Beauty Rush

Beauty Rush is a Laravel web application for discovering beauty products, reading reviews, and sharing beauty tips with a community.

## Features

- User registration, login, logout, remember me, and password reset
- Public user profiles with username, birthday, profile photo, and About me text
- User-created beauty tips with create, edit, and delete functionality
- Community Tips & Tricks page
- Product catalogue with product detail popups and reviews
- Save products and beauty tips
- Account page with saved products, saved tips, reviews, and shared tips
- Admin-only user management
- Admin-only FAQ management with categories
- Contact information page
- Responsive Beauty Rush theme using Blade, Tailwind CSS, and Alpine.js

## Requirements

- PHP 8.4+
- Composer
- Node.js and npm
- SQLite, MySQL, or another supported Laravel database

## Installation

Clone the repository and enter the project directory:

```bash
git clone <repository-url>
cd BeautyRush
```

Install the dependencies:

```bash
composer install
npm install
```

Create the environment file and application key:

```bash
cp .env.example .env
php artisan key:generate
```

For SQLite, create or use this database file:

```text
database/database.sqlite
```

Make sure `.env` contains:

```env
DB_CONNECTION=sqlite
```

Run the migrations and seed the demo data:

```bash
php artisan migrate:fresh --seed
php artisan storage:link
```

Start the frontend development process if needed:

```bash
npm run dev
```

The application is available through Laravel Herd at:

```text
http://beautyrush.test
```

## Default Admin Account

The seeder creates this administrator account:

```text
Username: admin
Email: admin@ehb.be
Password: Password!321
```

Admins can manage users at `/admin/users` and FAQs at `/admin/faqs`.

## Important Routes

| Page | URL |
| --- | --- |
| Homepage | `/` |
| Products | `/products` |
| Tips & Tricks | `/tips` |
| FAQ | `/faq` |
| Contact | `/contact` |
| Account | `/account` |
| Login | `/login` |
| Public profile | `/users/{user}` |
| Admin users | `/admin/users` |
| Admin FAQs | `/admin/faqs` |

## Technical Implementation

- **Views:** Blade views, two layouts, reusable Breeze components, and a site layout component
- **Authentication:** Laravel Breeze authentication scaffolding
- **Database:** SQLite by default with migrations and seeders
- **Models:** User, Article, Category, Tip, Review, and FAQ models
- **Relationships:** Users have many tips and reviews; categories have many articles and FAQs
- **Validation:** Form Request classes for profile, tip, review, FAQ, and admin user actions
- **Security:** CSRF protection, escaped Blade output, authentication middleware, and admin middleware
- **Uploads:** Profile photos are validated as images and stored on the public filesystem disk
- **Frontend:** Tailwind CSS utilities and Alpine.js for popups and tip pagination
- **Testing:** Pest feature tests for authentication, profiles, tips, reviews, products, FAQs, and admin access

## Testing

Run the complete test suite with:

```bash
php artisan test --compact
```

Format modified PHP files with:

```bash
vendor/bin/pint --dirty --format agent
```

## AI Usage

AI was used as a learning and development aid. I used AI to help me understand Laravel course material, clarify errors, think through Laravel concepts, and improve the layout and styling of the application. I reviewed, tested, and adapted the generated suggestions to fit my own project.

## Sources

- [Laravel documentation](https://laravel.com/docs)
- [Laravel Breeze documentation](https://laravel.com/docs/starter-kits#laravel-breeze)
- [Tailwind CSS documentation](https://tailwindcss.com/docs)
- [Alpine.js documentation](https://alpinejs.dev/start-here)
