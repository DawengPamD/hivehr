<?php
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\SideManager;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\CompanyInvitation;
use App\Models\Invitation;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CompanyController;


Route::get('/', function () {
    return view('login');
});

Route::get('/login', [AuthManager::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthManager::class, 'login'])->name('login.post');

Route::get('/register', [AuthManager::class, 'showRegistrationForm'])->name('register');
Route::post('/user-register', [AuthManager::class, 'register'])->name('register.post');

// create company route
Route::get('/create-company', [AuthManager::class, 'create'])->name('company.create');
Route::post('/store-company', [AuthManager::class, 'store_company'])->name('company.store');

// accept invitation route
Route::get('/accept-invitation/{token}', [AuthManager::class, 'acceptInvitation'])->name('company.acceptInvitation');

// Send invitation route
Route::get('/companies/{companyId}/invite', [AuthManager::class, 'showInviteForm'])->name('company.showInviteForm');
Route::post('/send-invitation/{companyId}', [AuthManager::class, 'invite'])->name('company.invite');

Route::get('/companies/{id}', [CompanyController::class, 'getCompanyById']);


Route::get('/test-mail', function () {
        $details = [
            'title' => 'Mail from Laravel Application',
            'body' => 'This is a test email sent from Laravel.'
        ];
    
        Mail::to('dawengpamdachomo@gmail.com')->send(new \App\Mail\TestMail($details));
    
        return 'Email sent!';
}); 

// accept invitation route
Route::get('/accept-invitation/{token}', [AuthManager::class, 'acceptInvitation'])->name('company.acceptInvitation');

// Dashboard route
Route::get('/dashboard', [AuthManager::class, 'dashboard'])->name('dashboard')->middleware('auth');

// Search and filter companies
Route::get('/companies', [CompanyController::class, 'index'])->name('companies.index');
Route::get('/companies/export', [CompanyController::class, 'export'])->name('companies.export');


// Projects
Route::get('/projects', [SideManager::class, 'index'])->name('projects.index');
Route::get('/projects/overview', [SideManager::class, 'overview'])->name('projects.overview');

// Tasks
Route::get('/tasks', [SideManager::class, 'index'])->name('tasks.index');

// Team
Route::get('/team', [SideManager::class, 'index'])->name('team.index');

// Resources
Route::get('/resources', [SideManager::class, 'index'])->name('resources.index');

// Reports
Route::get('/reports', [SideManager::class, 'index'])->name('reports.index');

// Service Providers
Route::get('/service-providers', [CompanyController::class, 'index'])->name('service-providers.index');

// Calendar
Route::get('/calendar', [SideManager::class, 'index'])->name('calendar.index');

// Messages
Route::get('/messages', [SideManager::class, 'index'])->name('messages.index');

// Notifications
Route::get('/notifications', [SideManager::class, 'index'])->name('notifications.index');

// Settings
Route::get('/settings', [SideManager::class, 'index'])->name('settings.index');

// Help
Route::get('/help', [SideManager::class, 'index'])->name('help.index');

// Logout
Route::get('/logout', [AuthManager::class, 'logout'])->name('logout.index');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', [AuthManager::class, 'dashboard'])->name('dashboard');
});