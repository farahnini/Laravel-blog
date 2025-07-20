<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

# Laravel Blog with Spatie Roles & Permissions

A modern, feature-rich Laravel blog application with:
- Spatie roles & permissions (admin, editor, reader)
- Article CRUD with WYSIWYG editor
- Like/dislike (rating) system
- Reader comments (with edit/delete permissions)
- User and role management (permission-based)
- Clean, responsive UI (Bootstrap 5, iOS-style fonts)
- Realistic demo data and images

---

## Features

### 1. Authentication
- Laravel built-in authentication (register, login, logout)
- Only authenticated users can create/edit articles or comment

### 2. Roles & Permissions (Spatie)
- **Admin**: Full access to all features, can manage users/roles, edit/delete any article or comment
- **Editor**: Can create, edit, and delete their own articles; can comment and edit/delete their own comments
- **Reader**: Can view articles and post/edit/delete their own comments
- **Permissions** are assigned to roles and can also be granted directly to users.

#### Permissions List
- **Articles:**
  - create-articles, edit-articles, delete-articles, view-articles
- **Users:**
  - create-users, edit-users, delete-users, view-users
- **Roles:**
  - create-roles, edit-roles, delete-roles, view-roles

### 3. Article Management
- **Create, edit, delete, view articles**
- Editors can only edit/delete their own articles; admins can manage all
- Articles use a WYSIWYG editor (Quill.js) for rich content (headings, images, lists, links)
- Articles display a curated Unsplash banner image
- Article index shows title, excerpt, author, date, and reactions
- Pagination (6 per page, Bootstrap 5 style)

### 4. Like/Dislike (Rating) System
- Users can like or dislike each article (one reaction per user per article)
- Like/dislike counts shown on index and show pages
- User’s own reaction is highlighted

### 5. Comments
- Authenticated users can comment on articles
- Users can edit/delete their own comments
- Admins can delete any comment, but can only edit their own
- Comments show user, content, created time (date and "time ago")

### 6. User & Role Management (Permission-Based)
- Navigation bar shows **Users** and **Roles** links only if you have `view-users` or `view-roles` permission
- User management actions (view, create, edit) require the corresponding permission (`view-users`, `create-users`, `edit-users`)
- Role management actions (view, create, edit, delete) require the corresponding permission (`view-roles`, `create-roles`, `edit-roles`, `delete-roles`)
- Assign multiple roles to users from the user edit page
- Assign permissions to roles from the role edit page (permissions are grouped by resource)
- Assign users to a role directly from the role edit page
- Permissions can be granted directly to users as well as via roles

### 7. UI/UX
- Clean, modern, mobile-friendly design (Bootstrap 5, iOS-style font)
- Banner images for articles (curated Unsplash set)
- User avatars (initials in a circle)
- Friendly illustrations for empty states
- All actions use GET/POST/DELETE (no PUT)
- Timezone set to Asia/Kuala_Lumpur
- Pagination and dates are Bootstrap and Carbon-powered

---

## Setup

1. **Clone the repo and install dependencies:**
   ```bash
   git clone ...
   cd your-project
   composer install
   npm install && npm run build # if using Laravel Mix/Vite
   cp .env.example .env
   php artisan key:generate
   ```
2. **Set up your database in `.env`**
3. **Set timezone in `.env` (optional, default is Asia/Kuala_Lumpur):**
   ```
   APP_TIMEZONE=Asia/Kuala_Lumpur
   ```
4. **Run migrations and seeders:**
   ```bash
   php artisan migrate --force
   php artisan db:seed --force
   ```
5. **Login with demo users:**
   - **Editor:** editor@example.com / password
   - **Admin:** admin@example.com / password
   - **Reader:** reader@example.com / password

---

## Usage

- **Articles:** Editors can create, edit, and delete their own articles. Admins can manage all articles.
- **Reactions:** All users can like/dislike each article (one reaction per article).
- **Comments:** All users can comment. Users can edit/delete their own comments. Admins can delete any comment.
- **User/Role Management:**
  - Navigation and actions are permission-based (not just role-based)
  - Only users with the right permissions see management links and buttons
  - Assign users to roles and assign permissions to roles from the role edit page
  - Permissions are grouped by resource for clarity
  - Permissions can be granted directly to users as well as via roles
- **WYSIWYG Editor:** Rich text, images, and formatting supported in articles.
- **Pagination:** Article index paginated, styled with Bootstrap.
- **Timezone:** All dates/times use Asia/Kuala_Lumpur.

---

## Customization
- **Banner Images:** Change the curated Unsplash URLs in `articles/show.blade.php` for your own style.
- **Roles/Permissions:** Add or remove roles/permissions in the seeders as needed.
- **UI:** Tweak Bootstrap classes or add your own CSS in `layouts/app.blade.php`.

---

## Demo Users & Roles
- **Admin User:** Full permissions, can manage everything
- **Editor User:** Can manage their own articles, comment, and (optionally) has direct permissions if assigned
- **Reader User:** Can view articles, comment, and (optionally) has direct permissions if assigned

---

## Database Tables

| Table                  | Description                                 |
|------------------------|---------------------------------------------|
| users                  | User accounts                               |
| articles               | Blog articles                               |
| article_comments       | Comments on articles                        |
| article_reactions      | Like/dislike reactions on articles          |
| roles                  | Spatie roles                                |
| permissions            | Spatie permissions                          |
| model_has_roles        | Pivot: users <-> roles                      |
| model_has_permissions  | Pivot: users <-> permissions                |
| role_has_permissions   | Pivot: roles <-> permissions                |

---

## Blade Views

**Articles:**
- `articles/index.blade.php` — Article list
- `articles/show.blade.php` — Article details
- `articles/create.blade.php` — Create article
- `articles/edit.blade.php` — Edit article
- `articles/comment_edit.blade.php` — Edit comment

**Users:**
- `users/index.blade.php` — User list
- `users/create.blade.php` — Create user
- `users/edit.blade.php` — Edit user

**Roles:**
- `roles/index.blade.php` — Role list
- `roles/create.blade.php` — Create role
- `roles/edit.blade.php` — Edit role

**Auth:**
- `auth/login.blade.php` — Login
- `auth/register.blade.php` — Register
- `auth/verify.blade.php` — Email verification
- `auth/passwords/email.blade.php` — Password reset request
- `auth/passwords/reset.blade.php` — Password reset
- `auth/passwords/confirm.blade.php` — Password confirm

**Layout & Errors:**
- `layouts/app.blade.php` — Main layout
- `errors/403.blade.php` — Custom 403 Forbidden page

---

## Credits
- [Laravel](https://laravel.com/)
- [Spatie Laravel Permission](https://spatie.be/docs/laravel-permission)
- [Bootstrap 5](https://getbootstrap.com/)
- [Quill.js](https://quilljs.com/)
- [Unsplash](https://unsplash.com/) for demo images

---

## License
MIT
