# Larite

> **Lightweight. Laravel-Inspired. 100% Custom.**

Larite is a **lightweight PHP MVC framework** inspired by Laravel, but built entirely from scratch. It's designed for developers who love Laravel's syntax and structure but want full control, performance, and simplicity.

Larite is **not a Laravel clone**. It's a fresh micro-framework for small to medium web apps, dashboards, admin panels, and educational projects — without Composer bloat or hidden magic.

---

## 🚀 Why Larite?

* ✅ Laravel-style routing, middleware, and validation
* ✅ Custom-built DI container and lifecycle
* ✅ CSRF protection and input sanitization
* ✅ Auth scaffolding, flash messages, old inputs
* ✅ CLI commands for models, controllers, and migrations
* ✅ Useful helpers: mail, pagination
* ✅ Simple, extendable, and easy to read/learn

---

## ✨ Features

* Auth Scaffolding (`Route::authenticate()`)
* Pagination: `paginate()` / `simplePaginate()`
* Old input repopulation: `old('field')`
* Eloquent-style Relationships: `hasOne()`, `hasMany()`, `belongsTo()` now supported in models

---

## 🛡️ Security

* ✅ **CSRF Protection**: `<?php csrf_field(); ?>` inside `<form>`
* ✅ **Output escaping**: `<?= e($value) ?>`
* ✅ **File upload validation**
* ✅ **Automatic input sanitization**

---

## 🧱 Installation

Make sure you have **PHP 8+** and **Composer** installed.

```bash
composer install
```

---

## 🔧 Environment Setup

Rename `.env.example` to `.env` and set the following:

```env
APP_ENV=development
DB_HOST=localhost
DB_DATABASE=Larite
DB_USERNAME=root
DB_PASSWORD=secret
AUTH_TABLE=users
```

Set `APP_ENV=production` to hide error output.

---

## 🌐 Routing

### Define routes in `routes/web.php`

```php
Route::get('/', [HomeController::class, 'index']);
```

### Route groups with prefix + middleware

```php
Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::get('dashboard', [DashboardController::class, 'index']);
});
```

## 🧩 Extending Routes

Register route files in `app/Providers/RouteServiceProvider.php`:

```php
public static function register(): array
{
    return [
        'routes/web.php',
        'routes/api.php',
        // Add more route files here...
    ];
}
```

Larite will autoload them all.


---

## 🧰 Middleware System

You can create new middleware by running below command.
```php
php larite make:middleware Authenticate
````
Then

Register middleware in `App\Http\Kernel.php`:

```php
public $routeMiddleware = [
  'auth' => Authenticate::class,
  'web'  => WebMiddleware::class,
];
```

Use middleware in controllers:

```php
$this->middleware(['auth', 'web']);
```

### Middleware per route

```php
Route::get('/profile', [ProfileController::class, 'index'])->middleware('auth');
```

---

## 📨 Mail Support

```php
Mail::send('mail', [], function($mail) {
    $mail->to('admin@example.com');
    $mail->subject('Welcome');
    $mail->from('noreply@example.com');
    $mail->attachment('path/to/file.pdf');
});
```

---

## 🧪 Validation

```php
$rules = [
  'email' => 'required|mail|unique:users,email',
  'password' => 'required|min:6|max:20'
];

$validation = Validator::validate($_POST, $rules);

if ($validation->fails()) {
  return redirect()->backwithErrors($validation->errors());
}
```

---

## 🧱 Migrations

### Create a new migration file

```bash
php larite make:migration create_users_table
```

This will generate a file in the `database/migrations/` directory.

### Define the schema

Each migration file contains `up()` and `down()` methods. You can define your table structure using the `Blueprint` class inside the `up()` method:

```php
Migrate::create('users', function (Blueprint $table) {
    $table->increments('id');
    $table->string('name')->nullable();
    $table->string('email')->unique();
    $table->string('password');
    $table->timestamps();
});
```

### Rollback the table

In the `down()` method:

```php
Migrate::dropIfExists('users');
```

---

## 📦 CLI Commands

```bash
php larite make:auth auth
php larite make:model User
php larite make:controller PostController
php larite make:migration create_posts_table
php larite make:seeder AdminSeeder
php larite migration:migrate
php larite migration:rollback
php larite make:middleware Authenticate
php larite make:command SyncUser // create custom command
php larite schedule:run          // to run all commands with scheduler
php larite route:list
php larite route:list --method=GET        // to filter route with method
php larite route:list --method=POST      // to filter route with method
php larite route:list --method=PUT      // to filter route with method
php larite route:list --method=PATCH   // to filter route with method
php larite route:list --method=DELETE // to filter route with method
```

---

## 🌱 Database Seeding

Larite supports Laravel-style seeders for populating your database with initial or dummy data.

### 📦 Create a Seeder

Use the CLI to generate a new seeder class:

```bash
php larite make:seeder AdminSeeder
```

This creates a new file in the `database/seeders/` directory:

```php
<?php

namespace Database\Seeders;

use Core\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Add seeding logic here
    }
}
```

### 🌾 Run Seeders

Run all seeders through the `DatabaseSeeder` entry point:

```bash
php larite db:seed
```

Seeders should be registered inside `DatabaseSeeder.php` like this:

```php
public function run(): void
{
    $this->call([
        AdminSeeder::class,
        // Add more seeders here
    ]);
}
```

Each seeder class should extend the base `Seeder` class and implement the `run()` method.

### ✅ Example Seeder

```php
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate([
            'email' => 'admin@example.com',
        ], [
            'name' => 'Admin',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);
    }
}
```

This makes it easy to pre-fill admin accounts, demo users, settings, and more — ideal for dev and staging environments.

---

## 🤮 Queries & ORM

Larite offers a Laravel-inspired ORM as well as a simple query builder for interacting with your database using expressive and chainable syntax.

---

### 🔍 Fetching Data

#### Using ORM (Eloquent-like)

```php
// Get all users
$users = Users::get();

// Find a specific user by ID
$user = Users::find(1);

// Get users with conditions
$activeUsers = Users::where('status', '=', 'active')->get();

// First matching result
$user = Users::where('email', '=', 'john@example.com')->first();

// Pagination
$users = Users::paginate(10);

//create new user
$user = Users::create([
    'name' => 'Kashif',
    'email' => 'kashif@gmail.com',
    'password' => bcrypt('12345678'),
]);

// update or create user
$user = Users::updateOrCreate([
        'email' => 'kashif@gmail.com'
        ], [
            'name' => 'Kashif',
            'email' => 'kashif@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

// save user
$user = new Users();
$user->name = 'Kashif';
$user->email = 'kashif@gmail.com';
$user->password = bcrypt('12345678');

// Save the user to the database
$user->save();

// or update like
$user = Users::find(1);
$user->name = 'Kashif Sohail';
$user->password = bcrypt('11111111');

// Save the user to the database
$user->save();

```

#### Using Query Builder (DB facade)

```php
use Core\Support\Facades\DB;

// Get all users
$users = DB::table('users')->get();

// Find user by ID
$user = DB::table('users')->where('id', '=', 1)->first();

// Conditional query
$activeUsers = DB::table('users')->where('status', '=',  'active')->get();

// Pagination
$users = DB::table('users')->paginate(10);

// create user
$user = DB::table('users')->create([
    'name' => 'Kashif',
    'email' => 'kashif@gmail.com',
    'password' => bcrypt('12345678'),
]);
```

Both ORM and query builder provide a clean and fluent interface to interact with your database. Use whichever suits your use-case.

----

### 🔒 Hidden Fields

To hide sensitive fields like passwords when converting models to arrays or JSON, use the `$hidden` property in your model:

```php
class User extends Model
{
    protected $hidden = ['password'];
}
```

This ensures that fields such as `password` or `other` are excluded when rendering user data in responses or views.

---

## 🔗 Defining Relationships

Define Laravel-style relationships directly in your models.

### One-to-One

```php
public function profile()
{
    return $this->hasOne(Profile::class, 'user_id');
}
```

### One-to-Many

```php
public function posts()
{
    return $this->hasMany(Post::class, 'user_id');
}
```

### Inverse (Belongs To)

```php
public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}
```

---

## 🔥 Advanced Relationship Queries

Larite supports expressive, Laravel-style relationship queries:

### Eager Loading (with)
```php
//Eager load a relation (prevents N+1 queries, supported hasMany for now)
$users = User::with('posts')->get();
```

### Filtering by Relation (has)
```php
// Get users who have at least one post
$users = User::has('posts')->get();
```

### Filtering with Constraints (whereHas)
```php
// Get users who have published posts
$users = User::whereHas('posts', function($q) {
    $q->where('status', '=', 'published');
})->get();
```

### Eager Load + Filter (withWhereHas)
```php
// Filter users by a relation and eager load it in one call
$users = User::withWhereHas('posts', function($q) {
    $q->where('status', '=', 'published');
})->get();
```

- `has('relation')` — Only include models that have the relation.
- `whereHas('relation', fn($q) => ...)` — Only include models where the relation matches a condition.
- `with('relation')`
- `withWhereHas('relation', fn($q) => ...)` — Filter and eager load in one call (recommended for APIs).

---

### 🧩 Customize Exception Handling

Your global exception handling logic is located at:

```
app/Exceptions/Handler.php
```

You can handle and customize different types of exceptions in this file.

Example:
```php
protected bool $exception = true; // true, false
```

```php
public function handle(Throwable $e)
{
    $this->render($e, function (Throwable $e) {

        if ($e instanceof NotFoundException) {
            response()->json(['NotFoundException' => $e->getMessage()], 404);
        } elseif ($e instanceof ValidationException) {
            response()->json(['ValidationException' => $e->getErrors()], 422);
        } elseif ($e instanceof AuthException) {
            response()->json('Unauthenticated.', 401);
        } else {
            response()->json(['Exception' => 'Something went wrong.'], 500);
        }
    });

    return true;
}
```

---

### 🧪 Tip for Development

If you're in a development environment and want to disable this custom handler to see default **Whoops** debug pages:

- Simply make it true
```php
protected bool $exception = true; // true, false
```
- Whoops will automatically display the error with a full debug trace.

---

## ✅ Custom Commands

You can create your own custom console commands by running the following command.

```php
php larite make:command SyncUser
```
### 📄 Example Command

```php
<?php

namespace App\Console\Commands;

use Core\Console\BaseCommand;

class SyncUser extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected  string $signature = 'sync:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected  string $description = 'Command description here';

    /**
     * Execute the console command logic.
     */
    public function handle()
    {
        $this->info('Command executed from handle()!');
    }
}

```

Then, register your command in `App\Console\Kernel.php`:

```php
protected array $commands = [
    \App\Console\Commands\SyncUser::class,
];
```

### ➕ Generate Command Using CLI

To generate a custom command file automatically, run:

```bash
php larite make:command SyncUser
```

---

## ⏰ Task Scheduler

Larite supports a simple scheduler inspired by Laravel.

To schedule tasks, override the `schedule()` method inside `App\Console\Kernel`:

```php
public function schedule(Schedule $schedule): void
{
    $schedule->command(SyncUser::class)->everyMinute();
}
```

### 🕒 Supported Schedule Methods

| Method                 | Cron Expression | Description                    |
|------------------------|------------------|--------------------------------|
| `everyMinute()`        | `* * * * *`      | Every minute                   |
| `everyFiveMinutes()`   | `*/5 * * * *`    | Every 5 minutes                |
| `everyTenMinutes()`    | `*/10 * * * *`   | Every 10 minutes               |
| `everyThirtyMinutes()` | `*/30 * * * *`   | Every 30 minutes               |
| `hourly()`             | `0 * * * *`      | Once per hour                  |
| `daily()`              | `0 0 * * *`      | Once a day at midnight         |
| `weekly()`             | `0 0 * * 0`      | Once a week (Sunday midnight)  |

### 🧪 Testing Locally

To run scheduled tasks manually:

```bash
php larite schedule:run
```

To simulate a cron run every minute in dev/testing, use this loop:

```bash
while true; do php larite schedule:run; sleep 60; done
```

Or set up a system cron job (Linux/macOS):

```bash
* * * * * php /path/to/laragon/www/Larite/larite schedule:run >> /dev/null 2>&1
```
---

## Larite Welcome Page.

Here is the Larite welcome page view.

![Larite Logo](https://raw.githubusercontent.com/Ch-Kashif171/Larite/4.x/core/images/Larite.png)

---

## ChatGPT Comparison.

Here is the ChatGPT comparison after review the complete Larite's code review.

![Larite Logo](https://raw.githubusercontent.com/Ch-Kashif171/Larite/4.x/core/images/Larite-Review-ChatGpt.png)

---

## 🙌 Contribute

Want to improve this Laravel-style lightweight framework? Submit a PR or open an issue. All contributions are welcome!

---

## 📄 License

Larite is open-source and licensed under the MIT license.

[![MIT License](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE)
[![Contributions welcome](https://img.shields.io/badge/contributions-welcome-brightgreen.svg)](CONTRIBUTING.md)