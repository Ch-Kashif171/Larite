<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Larite – Lightweight PHP MVC Framework</title>
    <style>

        .fixed-button {
            position: fixed;
            top: 10px;
            right: 10px;
            z-index: 1000; /* make sure it's above other elements */
            padding: 8px 12px;
            background: #2d496e;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        .dark {
            background-color: #151515;
            color: white;
        }
        .dark h1, .dark h2, .dark p {
            color: white;
        }
        .dark pre, .dark code {
            background-color: #2c3e50;
            color: white;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #ffffff;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 960px;
            margin: auto;
            padding: 2rem;
        }
        h1 {
            font-size: 2.5rem;
            color: #1f2937;
        }
        h2 {
            font-size: 1.8rem;
            color: #111827;
            margin-top: 2.5rem;
        }
        h3 {
            margin-top: 1.5rem;
            font-size: 1.3rem;
        }
        p {
            margin-bottom: 1rem;
        }
        ul {
            padding-left: 1.5rem;
            margin-bottom: 1rem;
        }
        li {
            margin-bottom: 0.5rem;
        }
        code {
            background-color: #f1f5f9;
            padding: 0.2em 0.4em;
            border-radius: 4px;
            font-family: monospace;
            font-size: 0.95rem;
        }
        pre {
            background-color: #ebebeb;
            padding: 1rem;
            border-left: 4px solid #2d496e;
            border-radius: 4px;
            font-family: monospace;
            font-size: 0.95rem;
            overflow-x: auto;
            color: #111;
        }
        hr {
            border: none;
            border-top: 1px solid #ddd;
            margin: 2rem 0;
        }
        .note {
            color: #4b5563;
            font-weight: bold;
        }
        .cron-table tr th {
            min-width: 100px;
        }
    </style>
</head>
<body id="doc" class="<?php echo $dark ?? ''; ?>">
<div class="container">
    <button class="fixed-button theme-toggle" id="themeToggle" title="Toggle Theme">🌙</button>
    <img style="width: 125px;margin-left: 40%;" src="https://raw.githubusercontent.com/Ch-Kashif171/Larite/4.x/public/images/logo/larite.jpg">
    <hr>
    <p class="note">Lightweight. Laravel-Inspired. 100% Custom.</p>
    <p>
        Larite is a <strong>lightweight PHP MVC framework</strong> inspired by Laravel, but built entirely from scratch.
        It's designed for developers who love Laravel's syntax and structure but want full control, performance, and simplicity.
    </p>
    <p>
        Larite is <strong>not a Laravel clone</strong>. It's a fresh micro-framework for small to medium web apps, dashboards,
        admin panels, and educational projects — without Composer bloat or hidden magic.
    </p>

    <hr>

    <h2>🚀 Why Larite?</h2>
    <ul>
        <li>✅ Laravel-style routing, middleware, and validation</li>
        <li>✅ Custom-built DI container and lifecycle</li>
        <li>✅ CSRF protection and input sanitization</li>
        <li>✅ Auth scaffolding, flash messages, old inputs</li>
        <li>✅ CLI commands for models, controllers, and migrations</li>
        <li>✅ Useful helpers: mail, pagination</li>
        <li>✅ Simple, extendable, and easy to read/learn</li>
    </ul>

    <hr>

    <h2>🛡️ Security</h2>
    <ul>
        <li>✅ CSRF Protection: <code>&lt;?php csrf_field(); ?&gt;</code> inside <code>&lt;form&gt;</code></li>
        <li>✅ Output escaping: <code>&lt;?= e($value) ?&gt;</code></li>
        <li>✅ File upload validation</li>
        <li>✅ Automatic input sanitization</li>
    </ul>

    <hr>

    <h2>✨ Features</h2>
    <ul>
        <li>Auth Scaffolding (<code>Route::authenticate()</code>)</li>
        <li>Pagination: <code>paginate()</code> / <code>simplePaginate()</code></li>
        <li>Old input repopulation: <code>old('field')</code></li>
    </ul>

    <hr>

    <h2>🧱 Installation</h2>
    <p>Make sure you have <strong>PHP 8+</strong> and <strong>Composer</strong> installed.</p>
    <pre>composer install</pre>

    <hr>

    <h2>🔧 Environment Setup</h2>
    <p>Rename <code>.env.example</code> to <code>.env</code> and set the following:</p>
    <pre>APP_ENV=development
DB_HOST=localhost
DB_DATABASE=Larite
DB_USERNAME=root
DB_PASSWORD=secret
AUTH_TABLE=users</pre>
    <p>Set <code>APP_ENV=production</code> to hide error output.</p>

    <hr>

    <h2>🌐 Routing</h2>
    <h3>Define routes in <code>routes/web.php</code></h3>
    <pre>Route::get('/', [HomeController::class, 'index']);</pre>

    <h3>Route groups with prefix + middleware</h3>
    <pre>Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
  Route::get('dashboard', [DashboardController::class, 'index']);
});</pre>

    <h2>Named Routes</h2>
    <p>Named routes allow you to generate URLs for specific routes using a name instead of hardcoding the URL. This makes your application more maintainable and flexible.</p>

    <h3>Defining Named Routes</h3>
    <pre>// In routes/web.php
Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');</pre>

    <h3>Using Named Routes</h3>
    <pre>// Generate URL for a named route
echo route('home.index'); // Outputs: /

// Generate URL with parameters
echo route('users.show', ['user' => 5]); // Outputs: /users/5

// Use in views
&lt;a href="&lt;?= route('home.index') ?&gt;"&gt;Home&lt;/a&gt;
&lt;a href="&lt;?= route('users.show', ['id' => 1]) ?&gt;"&gt;View User&lt;/a&gt;

// Use in redirects
redirect(route('users.index'));
redirect(route('users.show', ['user' => 5]));

// Use in forms
    </pre>
<pre>
&lt;form action="&lt;?= route('users.store') ?&gt;" method="POST"&gt;
    &lt;?= csrf_field() ?&gt;
    &lt;input type="text" name="name" placeholder="User Name"&gt;
    &lt;button type="submit"&gt;Create User&lt;/button&gt;
&lt;/form&gt;
</pre>

    <h2>Resource Routes</h2>
    <p>Resource routes provide a quick way to create all the necessary routes for a resource controller. A resource controller typically handles CRUD operations for a model.</p>

    <h3>Defining Resource Routes</h3>
    <pre>// In routes/web.php
Route::resource('users', 'UserController::class');</pre>

    <p>This single line creates the following routes:</p>
    <table class="cron-table">
        <thead>
        <tr style="text-align: left;">
            <th>Method</th><th>URI</th><th>Name</th><th>Action</th><th>Description</th>
        </tr>
        </thead>
        <tbody>
        <tr><td><code>GET</code></td><td><code>/users</code></td><td><code>users.index</code></td><td><code>index()</code></td><td><code>Display a listing of the resource</code></td></tr>
        <tr><td><code>GET</code></td><td><code>/users/create</code></td><td><code>users.create</code></td><td><code>create()</code></td><td><code>Show the form for creating a new resource</code></td></tr>
        <tr><td><code>POST</code></td><td><code>/users</code></td><td><code>users.store</code></td><td><code>store()</code></td><td><code>Store a newly created resource</code></td></tr>
        <tr><td><code>GET</code></td><td><code>/users/{user}</code></td><td><code>users.show</code></td><td><code>show()</code></td><td><code>Display the specified resource</code></td></tr>
        <tr><td><code>GET</code></td><td><code>/users/{user}/edit</code></td><td><code>users.edit</code></td><td><code>edit()</code></td><td><code>Show the form for editing the specified resource</code></td></tr>
        <tr><td><code>PUT/PATCH</code></td><td><code>/users/{user}</code></td><td><code>users.update</code></td><td><code>update()</code></td><td><code>Update the specified resource</code></td></tr>
        <tr><td><code>DELETE</code></td><td><code>/users/{user}</code></td><td><code>users.destroy</code></td><td><code>destroy()</code></td><td><code>Remove the specified resource</code></td></tr>
        </tbody>
    </table>

    <h3>Using Resource Routes</h3>
    <pre>// Generate URLs for resource routes
echo route('users.index'); // Outputs: /users
echo route('users.create'); // Outputs: /users/create
echo route('users.show', ['user' => 1]); // Outputs: /users/1
echo route('users.edit', ['user' => 1]); // Outputs: /users/1/edit
    </pre>

<pre>
    // Use in forms
&lt;form action="&lt;?= route('users.store') ?&gt;" method="POST"&gt;
    &lt;?= csrf_field() ?&gt;
    &lt;input type="text" name="name" placeholder="User Name"&gt;
    &lt;button type="submit"&gt;Create User&lt;/button&gt;
&lt;/form&gt;
</pre>


<pre>&lt;form action="&lt;?= route('users.update', ['user' =&gt; 1]) ?&gt;" method="POST"&gt;
    &lt;?= csrf_field() ?&gt;
    &lt;?= method('PUT') ?&gt;
    &lt;input type="text" name="name" placeholder="User Name"&gt;
    &lt;button type="submit"&gt;Update User&lt;/button&gt;
&lt;/form&gt;
</pre>

<pre>&lt;form action="&lt;?= route('users.destroy', ['user' =&gt; 1]) ?&gt;" method="POST"&gt;
    &lt;?= csrf_field() ?&gt;
    &lt;?= method('DELETE') ?&gt;
    &lt;button type="submit"&gt;Delete User&lt;/button&gt;
&lt;/form&gt;
</pre>


    <h2>Route Parameters</h2>
    <p>Named routes support parameters that can be passed to generate dynamic URLs:</p>
    <pre>// Route definition
Route::get('/users/{id}/posts/{post_id}', [UserController::class, 'showPost'])->name('users.posts.show');

// Usage
echo route('users.posts.show', ['user' => 5, 'post_id' => 10]); // Outputs: /users/5/posts/10></pre>

    <h2>Multiple Resource Routes</h2>
    <pre>Route::resource('users', UserController::class);
Route::resource('posts', PostController::class);
Route::resource('comments', CommentController::class);</pre>

    <h2>Route Groups with Named Routes</h2>
    <pre>Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::get('/home', [HomeController::class, 'show'])->name('home.index');
});

// Usage
echo route('dashboard'); // Outputs: /dashboard
echo route('profile'); // Outputs: /profile
echo route('home.index'); // Outputs: /home</pre>

    <h2>🧩 Extending Routes</h2>
    <p>Register route files in <code>app/Providers/RouteServiceProvider.php</code>:</p>
    <pre>
public static function register(): array
{
    return [
        'routes/web.php',
        'routes/api.php',
        // Add more route files here...
    ];
}
</pre>
    <p>Larite will autoload them all.</p>

    <hr>

    <h2>🧰 Middleware System</h2>
    <p>You can create new middleware by running the below command</p>
    <pre>php larite make:middleware Authenticate</pre>
    <p>Then</p>
    <p>Register middleware in <code>App\Kernel.php</code>:</p>
    <pre>public $routeMiddleware = [
  'auth' => Authenticate::class,
  'web'  => WebMiddleware::class,
];</pre>
    <p>Use middleware in controllers:</p>
    <pre>$this->middleware(['auth', 'web']);</pre>

    <hr>

    <h3>Middleware per route</h3>
    <pre>Route::get('/profile', [ProfileController::class, 'index'])->middleware('auth');</pre>

    <hr>

    <h2>📨 Mail Support</h2>
    <pre>Mail::send('mail', [], function($mail) {
  $mail->to('admin@example.com');
  $mail->subject('Welcome');
  $mail->from('noreply@example.com');
  $mail->attachment('path/to/file.pdf');
});</pre>

    <hr>

    <h2>🧪 Validation</h2>
    <pre>$rules = [
  'email' => 'required|email|unique:users,email',
  'password' => 'required|min:6|max:20'
];

$validation = Validator::validate($_POST, $rules);

if ($validation->fails()) {
  return redirect()->backwithErrors($validation->errors());
}</pre>

    <hr>

    <h2>🧱 Migrations</h2>
    <h3>Create a new migration file</h3>
    <pre>php Larite make:migration create_users_table</pre>

    <span>This will generate a file in the <code>database/migrations/</code> directory.</span>

    <h3>Define the schema</h3>
    <span>Each migration file contains <code>up()</code> and <code>down()</code> methods. You can define your table structure using the <code>Blueprint</code> class inside the <code>up()</code> method:</span>
    <pre>Migrate::create('users', function (Blueprint $table) {
  $table->increments('id');
  $table->string('name')->nullable();
  $table->string('email')->unique();
  $table->string('password');
  $table->timestamps();
});</pre>

    <h3>Rollback the table</h3>
    <pre>Migrate::dropIfExists('users');</pre>

    <hr>

    <h2>📦 CLI Commands</h2>
    <pre>php Larite make:auth auth
php Larite make:model User
php Larite make:controller PostController
php larite make:controller PostController --resource // to create resource conteroller
php Larite make:migration create_posts_table
php larite make:seeder AdminSeeder
php Larite migration:migrate
php Larite migration:rollback
php larite make:middleware Authenticate
php larite make:command SyncUser // create custom command
php larite schedule:run          // to run all commands with scheduler
php Larite route:list
php Larite route:list --method=GET        // to filter route with method
php Larite route:list --method=POST      // to filter route with method
php Larite route:list --method=PUT      // to filter route with method
php Larite route:list --method=PATCH   // to filter route with method
php Larite route:list --method=DELETE // to filter route with method
    </pre>

    <hr>

    <section id="database-seeding">
        <h2>🌱 Database Seeding</h2>
        <p>Larite supports Laravel-style seeders for populating your database with initial or dummy data.</p>

        <h3>📦 Create a Seeder</h3>
        <p>Use the CLI to generate a new seeder class:</p>
        <pre>php Larite make:seeder AdminSeeder</pre>
        <p>This creates a new file in the <code>database/seeders/</code> directory:</p>
        <pre>&lt;?php

namespace Database\\Seeders;

use Core\\Database\\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Add seeding logic here
    }
}
</pre>

        <h3>🌾 Run Seeders</h3>
        <p>Run all seeders through the <code>DatabaseSeeder</code> entry point:</p>
        <pre>php Larite db:seed</pre>
        <p>Seeders should be registered inside <code>DatabaseSeeder.php</code> like this:</p>
        <pre>public function run(): void
{
    $this->call([
        AdminSeeder::class,
        // Add more seeders here
    ]);
}</pre>

        <p>Each seeder class should extend the base <code>Seeder</code> class and implement the <code>run()</code> method.</p>

        <h3>✅ Example Seeder</h3>
        <pre>use App\\Models\\User;

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
}</pre>

        <p>This makes it easy to pre-fill admin accounts, demo users, settings, and more — ideal for dev and staging environments.</p>
    </section>

    <hr>
    <h2>🧮 Queries & ORM</h2>
    <p>Larite offers a Laravel-inspired ORM for interacting with your database using expressive and chainable syntax. It also supports raw queries using the query builder.</p>

    <h4>🔍 Fetching Data (ORM)</h4>
    <pre>
// Get all users
$users = User::get();
    </pre>
<pre>
// Find a specific user by ID
$user = User::find(1);
</pre>
    <pre>
// Get users with conditions
$activeUsers = User::where('status', '=', 'active')->get();
    </pre>
    <pre>
// First matching result
$user = User::where('email', '=', 'john@example.com')->first();
    </pre>
    <pre>
//create new user
$user = Users::create([
    'name' => 'Kashif',
    'email' => 'kashif@gmail.com',
    'password' => bcrypt('12345678'),
]);
    </pre>
<pre>
// update or create user
$user = Users::updateOrCreate([
        'email' => 'kashif@gmail.com'
        ], [
            'name' => 'Kashif',
            'email' => 'kashif@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

</pre>
    <pre>
// save user
$user = new Users();
$user->name = 'Kashif';
$user->email = 'kashif@gmail.com';
$user->password = bcrypt('12345678');

// Save the user to the database
$user->save();

    </pre>
    <pre>
// or update like
$user = Users::find(1);
$user->name = 'Kashif Sohail';
$user->password = bcrypt('11111111');

// Save the user to the database
$user->save();
    </pre>

    <h4>🛠️ Query Builder (DB Facade)</h4>
    <pre>

use Core\Support\Facades\DB;
    </pre>
    <pre>
// Get all users
$users = DB::table('users')->get();
    </pre>
    <pre>
// Paginate results
$users = DB::table('users')->paginate(10);
    </pre>
    <pre>
// Get users with conditions
$activeUsers = DB::table('users')->where('status', 'active')->get();
    </pre>
    <pre>
// First matching result
$user = DB::table('users')->where('email', 'john@example.com')->first();
    </pre>
    <pre>
// create user
$user = DB::table('users')->create([
    'name' => 'Kashif',
    'email' => 'kashif@gmail.com',
    'password' => bcrypt('12345678'),
]);
    </pre>
    <hr>

    <h3>🔒 Hidden Fields</h3>
    <p>To hide sensitive fields like passwords when converting models to arrays or JSON, use the <code>$hidden</code> property in your model:</p>
    <pre>
class User extends Model
{
    protected $hidden = ['password'];
}
    </pre>
    <p>This ensures that fields such as <code>password</code> or other are excluded when rendering user data in responses or views.</p>

    <hr>

    <h2>🔗 Defining Relationships</h2>
    <h3>Define Laravel-style relationships directly in your models.</h3>
    <h3>One-to-One</h3>
    <pre>
public function profile()
{
    return $this->hasOne(Profile::class, 'user_id');
}
</pre>

    <h3>One-to-Many</h3>
    <pre>
public function posts()
{
    return $this->hasMany(Post::class, 'user_id');
}
</pre>

    <h3>Inverse (Belongs To)</h3>
<pre>
public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}
</pre>

<blockquote>
📝 Note: Eager loading is not yet supported but is planned in a future update.
</blockquote>

    <h2>🔥 Advanced Relationship Queries</h2>
    <p>Larite supports expressive, Laravel-style relationship queries:</p>

    <h3>Eager Loading (<code>with</code>)</h3>
    <p>Eager load a relation (prevents N+1 queries, supported for <code>hasMany</code> for now):</p>
    <pre>$users = User::with('posts')->get();</pre>

    <h3>Filtering by Relation (<code>has</code>)</h3>
    <p>Get users who have at least one post:</p>
    <pre>$users = User::has('posts')->get();</pre>

    <h3>Filtering with Constraints (<code>whereHas</code>)</h3>
    <p>Get users who have published posts:</p>
    <pre>
$users = User::whereHas('posts', function($q) {
    $q->where('status', '=', 'published');
})->get();
    </pre>

    <h3>Eager Load + Filter (<code>withWhereHas</code>)</h3>
    <p>Filter users by a relation and eager load it in one call:</p>
    <pre>
$users = User::withWhereHas('posts', function($q) {
    $q->where('status', '=', 'published');
})->get();
    </pre>

    <ul>
        <li><code>has('relation')</code> — Only include models that have the relation.</li>
        <li><code>whereHas('relation', fn($q) => ...)</code> — Only include models where the relation matches a condition.</li>
        <li><code>with('relation')</code> — Eager load a relation.</li>
        <li><code>withWhereHas('relation', fn($q) => ...)</code> — Filter and eager load in one call (recommended for APIs).</li>
    </ul>

    <hr>

    <h2>🧩 Customize Exception Handling</h2>
    <p>Your global exception handling logic is located at:</p>
    <pre>app/Exceptions/Handler.php</pre>
    <p>You can handle and customize different types of exceptions in this file.</p>

    <pre>
protected bool $exception = true; // true, false

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
    </pre>

    <h2>🧪 Tip for Development</h2>
    <p>If you're in a development environment and want to disable this custom handler to see default <strong>Whoops</strong> debug pages:</p>
    <ul>
        <li>Simply make it true</li>
        <pre>protected bool $exception = true; // true, false</pre>
        <li>Whoops will automatically display the error with a full debug trace.</li>
    </ul>

    <hr>

    <h2>✅ Custom Commands</h2>
    <p>You can create your own custom console commands by running the following command.</p>
    <pre>php larite make:command SyncUser</pre>

    <h3>📄 Example Command</h3>
    <pre>namespace App\Console\Commands;

use Core\Console\BaseCommand;

class SyncUser extends BaseCommand
{
    protected string $signature = 'sync:user';
    protected string $description = 'Command description here';

    public function handle()
    {
        $this->info('Command executed from handle()!');
    }
}
</pre>

    <p>Then, register your command in <pre>App\Console\Kernel.php</pre>:</p>
    <pre>protected array $commands = [
    \App\Console\Commands\SyncUser::class,
];</pre>

    <h3>➕ Generate Command Using CLI</h3>
    <pre>php larite make:command SyncUser</pre>

    <hr>

    <h2>⏰ Task Scheduler</h2>
    <p>Larite supports a simple scheduler inspired by Laravel.</p>

    <p>To schedule tasks, override the <code>schedule()</code> method inside <code>App\Console\Kernel</code>:</p>
    <pre>public function schedule(Schedule $schedule): void
{
    $schedule->command(SyncUser::class)->everyMinute();
}
</pre>

    <h3>🕒 Supported Schedule Methods</h3>
    <table class="cron-table">
        <tr style="text-align: left;"><th>Method</th><th>Cron Expression</th><th>Description</th></tr>
        <tr><td><code>everyMinute()</code></td><td><code>* * * * *</code></td><td><code>Every minute</code></td></tr>
        <tr><td><code>everyFiveMinutes()</code></td><td><code>*/5 * * * *</code></td><td><code>Every 5 minutes</code></td></tr>
        <tr><td><code>everyTenMinutes()</code></td><td><code>*/10 * * * *</code></td><td><code>Every 10 minutes</code></td></tr>
        <tr><td><code>everyThirtyMinutes()</code></td><td><code>*/30 * * * *</code></td><td><code>Every 30 minutes</code></td></tr>
        <tr><td><code>hourly()</code></td><td><code>0 * * * *</code></td><td><code>Once per hour</code></td></tr>
        <tr><td><code>daily()</code></td><td><code>0 0 * * *</code></td><td><code>Once a day at midnight</code></td></tr>
        <tr><td><code>weekly()</code></td><td><code>0 0 * * 0</code></td><td><code>Once a week (Sunday midnight)</code></td></tr>
    </table>

    <h3>🧪 Testing Locally</h3>
    <p>To run scheduled tasks manually:</p>
    <pre>php larite schedule:run</pre>

    <p>To simulate a cron run every minute in dev/testing, use this loop:</p>
    <pre>while true; do php larite schedule:run; sleep 60; done</pre>

    <p>Or set up a system cron job (Linux/macOS):</p>
    <pre>* * * * * php /path/to/var/www/Larite/larite schedule:run >> /dev/null 2>&1</pre>

    <hr>

    <h2>⚡ Larite Welcome Page.</h2>
    <p>Here is the Larite welcome page view.</p>

    <img style="width: 100%;" src="https://raw.githubusercontent.com/Ch-Kashif171/Larite/4.x/core/images/Larite.png">

    <hr>

    <h2>🧠 ChatGPT Comparison.</h2>
    <p>Here is the ChatGPT comparison after review the complete Larite's code review.</p>

    <img style="width: 100%;" src="https://raw.githubusercontent.com/Ch-Kashif171/Larite/4.x/core/images/Larite-Review-ChatGpt.png">

    <hr>

    <h2>🙌 Contribute</h2>
    <p>Want to improve this Laravel-style lightweight framework? Submit a PR or open an issue. All contributions are welcome!</p>

    <hr>

    <h2>📄 License</h2>
    <p>Larite is open-source and licensed under the MIT license.</p>
</div>

<script>
    const toggleBtn = document.getElementById('themeToggle');
    const toggleDoc = document.getElementById('doc');
    const html = document.documentElement;

    function setTheme(theme) {
        html.setAttribute('data-theme', theme);
        localStorage.setItem('theme', theme);
        toggleBtn.textContent = theme === 'dark' ? '🌞' : '🌙';
        if (theme == 'dark') {
            toggleDoc.classList.add('dark'); // or any class you want
        } else {
            toggleDoc.classList.remove('dark'); // or any class you want
        }
    }

    // Check saved theme
    const savedTheme = localStorage.getItem('theme') || 'light';
    setTheme(savedTheme);

    toggleBtn.addEventListener('click', () => {
        const newTheme = html.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
        setTheme(newTheme);
    });
</script>

</body>
</html>
