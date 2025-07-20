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

---

## Assignment: Add a Projects Section

This assignment guides you to add a new "Projects" section to the Laravel blog app, with full CRUD, role-based permissions, and navigation. You will update the seeder, permissions, controllers, Blade views, and navigation bar.

### Steps & Pseudocode

#### 1. Seeder: Add Project Permissions
- In `database/seeders/RolePermissionSeeder.php`:
  ```php
  // Add project permissions
  foreach (['create', 'edit', 'delete', 'view'] as $action) {
      Permission::firstOrCreate(['name' => $action . '-projects']);
  }
  // Assign to roles as appropriate
  $adminRole->givePermissionTo(['create-projects', 'edit-projects', 'delete-projects', 'view-projects']);
  $editorRole->givePermissionTo(['create-projects', 'edit-projects', 'view-projects']);
  $readerRole->givePermissionTo(['view-projects']);
  ```

#### 2. Migration & Model
- Create a migration and model for `Project`:
  ```bash
  php artisan make:model Project -m
  ```
- Migration fields: `id`, `title`, `description`, `user_id`, `timestamps`.
- Model:
  ```php
  class Project extends Model {
      protected $fillable = ['title', 'description', 'user_id'];
      public function user() { return $this->belongsTo(User::class); }
  }
  ```

#### 3. Controller
- Create a `ProjectController`:
  ```bash
  php artisan make:controller ProjectController
  ```
- Implement CRUD methods with permission checks:
  ```php
  if (!auth()->user()->can('create-projects')) abort(403);
  // ... create logic
  ```

#### 4. Blade Views
- Create Blade files in `resources/views/projects/`:
  - `index.blade.php` (list)
  - `create.blade.php` (form)
  - `edit.blade.php` (form)
  - `show.blade.php` (details)
- Use the same card/table style as articles.
- Example for `index.blade.php`:
  ```blade
  @extends('layouts.app')
  @section('content')
  <div class="d-flex justify-content-between align-items-center mb-4">
      <h1 class="fw-bold" style="color:#007aff;">Projects</h1>
      @can('create-projects')
          <a href="{{ route('projects.create') }}" class="btn btn-primary">New Project</a>
      @endcan
  </div>
  <div class="section-box">
      @if($projects->count())
          <div class="row g-4">
              @foreach($projects as $project)
                  <div class="col-md-6">
                      <div class="card p-4 mb-3 shadow-sm">
                          <h5 class="fw-bold" style="color:#ff7f50;">{{ $project->title }}</h5>
                          <div class="mb-2 text-muted small">{{ $project->user->name ?? 'N/A' }}</div>
                          <div class="mb-2">{{ Str::limit($project->description, 120) }}</div>
                          <a href="{{ route('projects.show', $project) }}" class="btn btn-info btn-sm">View</a>
                          @can('edit-projects')
                              @if($project->user_id === auth()->id() || auth()->user()->hasRole('admin'))
                                  <a href="{{ route('projects.edit', $project) }}" class="btn btn-primary btn-sm">Edit</a>
                              @endif
                          @endcan
                          @can('delete-projects')
                              @if($project->user_id === auth()->id() || auth()->user()->hasRole('admin'))
                                  <form action="{{ route('projects.destroy', $project) }}" method="POST" class="d-inline">
                                      @csrf @method('DELETE')
                                      <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                  </form>
                              @endif
                          @endcan
                      </div>
                  </div>
              @endforeach
          </div>
          <div class="mt-4">{{ $projects->links() }}</div>
      @else
          <div class="text-center py-5">
              <img src="https://undraw.co/api/illustrations/undraw_empty_re_opql.svg" alt="No projects" class="empty-illustration">
              <h4 class="mt-3">No projects found.</h4>
          </div>
      @endif
  </div>
  @endsection
  ```

#### 5. Navigation
- In `resources/views/layouts/app.blade.php`:
  ```blade
  @can('view-projects')
      <li class="nav-item"><a class="nav-link" href="{{ route('projects.index') }}">Projects</a></li>
  @endcan
  ```

#### 6. Routes
- In `routes/web.php`:
  ```php
  Route::middleware(['auth'])->group(function () {
      Route::get('projects', [ProjectController::class, 'index'])->name('projects.index');
      Route::get('projects/create', [ProjectController::class, 'create'])->name('projects.create');
      Route::post('projects', [ProjectController::class, 'store'])->name('projects.store');
      Route::get('projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
      Route::get('projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
      Route::post('projects/{project}/update', [ProjectController::class, 'update'])->name('projects.update');
      Route::delete('projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');
  });
  ```

#### 7. README
- Add “Projects” to the features, permissions, and blade view lists.
- Example:
  ```
  - **Projects:** CRUD, permission-protected, visible in navigation if user has permission.
  - **Permissions:** create-projects, edit-projects, delete-projects, view-projects
  - **Blade Views:** projects/index, create, edit, show
  ```

---

**This assignment ensures you understand how to extend the app’s RBAC system and UI for new features.**

If you want the full code for any specific file, see the sample solution above or ask your instructor.
