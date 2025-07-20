[![GitHub](https://img.shields.io/badge/GitHub-Project-blue?logo=github)](https://github.com/farahnini/Laravel-blog)

# Laravel Blog with Spatie Roles & Permissions

A modern, feature-rich Laravel blog with:
- Spatie roles & permissions (admin, editor, reader)
- Article CRUD, WYSIWYG editor, like/dislike, comments
- User & role management (permission-based)
- Clean Bootstrap 5 UI, iOS-style fonts
- Realistic demo data

---

## Features
- **Authentication:** Register, login, logout (Laravel built-in)
- **Roles & Permissions:**
  - Admin: Full access
  - Editor: Manage own articles, comment
  - Reader: View articles, comment
  - Permissions: create/edit/delete/view for articles, users, roles
  - Permissions can be assigned to roles or directly to users
- **Articles:** CRUD, WYSIWYG, Unsplash banners, reactions, pagination
- **Comments:** Edit/delete own, admin can delete any
- **User/Role Management:**
  - Navigation and actions are permission-based
  - Assign users to roles, assign permissions to roles (grouped by resource)
  - Assign users to roles from the role edit page
- **UI/UX:** Clean, mobile-friendly, empty state illustrations, avatars
- **Timezone:** Asia/Kuala_Lumpur

---

## Setup
1. Clone & install:
   ```bash
   git clone https://github.com/farahnini/Laravel-blog.git
   cd Laravel-blog
   composer install
   npm install && npm run build
   cp .env.example .env
   php artisan key:generate
   ```
2. Set up your database in `.env`
3. (Optional) Set timezone in `.env`:
   `APP_TIMEZONE=Asia/Kuala_Lumpur`
4. Run migrations & seeders:
   ```bash
   php artisan migrate --force
   php artisan db:seed --force
   ```
5. Login with demo users:
   - **Admin:** admin@example.com / password
   - **Editor:** editor@example.com / password
   - **Reader:** reader@example.com / password

---

## Usage
- **Articles:** Editors manage their own; admins manage all
- **Reactions:** One like/dislike per user per article
- **Comments:** Users edit/delete own; admins delete any
- **User/Role Management:**
  - Links/buttons shown only if you have permission
  - Assign users to roles, assign permissions to roles (grouped)
  - Permissions can be granted directly to users
- **WYSIWYG:** Rich text, images, formatting
- **Pagination:** Bootstrap-styled

---

## Demo Users & Roles
| Name         | Email                | Password  | Role   |
|--------------|----------------------|-----------|--------|
| Admin User   | admin@example.com    | password  | admin  |
| Editor User  | editor@example.com   | password  | editor |
| Reader User  | reader@example.com   | password  | reader |

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

## License
MIT
