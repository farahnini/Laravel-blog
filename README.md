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

## Assignment: Add a “Projects” Section

You will add a new “Projects” section to this Laravel blog app, with full CRUD, role-based permissions, and navigation.  
**You must update the seeder, permissions, migration, model, controller, routes, and Blade views.**

---

### 1. Update Seeder: Add Project Permissions

**File:** `database/seeders/RolePermissionSeeder.php`

- Add these permissions:
  ```php
  foreach (['create', 'edit', 'delete', 'view'] as $action) {
      Permission::firstOrCreate(['name' => $action . '-projects']);
  }
  ```
- Assign them to roles:
  ```php
  $adminRole->givePermissionTo(['create-projects', 'edit-projects', 'delete-projects', 'view-projects']);
  $editorRole->givePermissionTo(['create-projects', 'edit-projects', 'view-projects']);
  $readerRole->givePermissionTo(['view-projects']);
  ```

---

### 2. Create Migration & Model

**Command:**
```bash
php artisan make:model Project -m
```

**Migration Example:**
```php
// database/migrations/xxxx_xx_xx_create_projects_table.php
public function up()
{
    Schema::create('projects', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('description');
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->timestamps();
    });
}
```

**Model Example:**
```php
// app/Models/Project.php
class Project extends Model {
    protected $fillable = ['title', 'description', 'user_id'];
    public function user() { return $this->belongsTo(User::class); }
}
```

---

### 3. Create Controller

**Command:**
```bash
php artisan make:controller ProjectController
```

**Controller Example:**
```php
class ProjectController extends Controller
{
    public function index() {
        if (!auth()->user()->can('view-projects')) abort(403);
        $projects = Project::with('user')->paginate(10);
        return view('projects.index', compact('projects'));
    }
    public function create() {
        if (!auth()->user()->can('create-projects')) abort(403);
        return view('projects.create');
    }
    public function store(Request $request) {
        if (!auth()->user()->can('create-projects')) abort(403);
        $request->validate(['title'=>'required', 'description'=>'required']);
        Project::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => auth()->id(),
        ]);
        return redirect()->route('projects.index')->with('success', 'Project created!');
    }
    public function show(Project $project) {
        if (!auth()->user()->can('view-projects')) abort(403);
        return view('projects.show', compact('project'));
    }
    public function edit(Project $project) {
        if (!auth()->user()->can('edit-projects')) abort(403);
        if ($project->user_id !== auth()->id() && !auth()->user()->hasRole('admin')) abort(403);
        return view('projects.edit', compact('project'));
    }
    public function update(Request $request, Project $project) {
        if (!auth()->user()->can('edit-projects')) abort(403);
        if ($project->user_id !== auth()->id() && !auth()->user()->hasRole('admin')) abort(403);
        $request->validate(['title'=>'required', 'description'=>'required']);
        $project->update($request->only('title', 'description'));
        return redirect()->route('projects.index')->with('success', 'Project updated!');
    }
    public function destroy(Project $project) {
        if (!auth()->user()->can('delete-projects')) abort(403);
        if ($project->user_id !== auth()->id() && !auth()->user()->hasRole('admin')) abort(403);
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Project deleted!');
    }
}
```

---

### 4. Add Routes (Not Grouped)

**In `routes/web.php`:**
```php
Route::get('projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('projects/create', [ProjectController::class, 'create'])->name('projects.create');
Route::post('projects', [ProjectController::class, 'store'])->name('projects.store');
Route::get('projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
Route::get('projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
Route::post('projects/{project}/update', [ProjectController::class, 'update'])->name('projects.update');
Route::delete('projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');
```

---

### 5. Create Blade Views

**Create these files in `resources/views/projects/`:**
- `index.blade.php` (list)
- `create.blade.php` (form)
- `edit.blade.php` (form)
- `show.blade.php` (details)

**Example for `index.blade.php`:**
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

---

### 6. Update Navigation

**In `resources/views/layouts/app.blade.php`:**
```blade
@can('view-projects')
    <li class="nav-item"><a class="nav-link" href="{{ route('projects.index') }}">Projects</a></li>
@endcan
```

---

### 7. Update README

- Add “Projects” to the features, permissions, and blade view lists.
- Example:
  ```
  - **Projects:** CRUD, permission-protected, visible in navigation if user has permission.
  - **Permissions:** create-projects, edit-projects, delete-projects, view-projects
  - **Blade Views:** projects/index, create, edit, show
  ```

---

**This assignment will help you practice extending a Laravel app with new RBAC-protected features, from backend to frontend.**

If you want a downloadable template or more code samples for any step, just let your instructor know!
