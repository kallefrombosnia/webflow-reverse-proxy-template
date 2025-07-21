<?php

use App\Livewire\Homepage;
use App\Livewire\Pricing;
use App\Livewire\Faq;
use App\Livewire\Dashboard;
use App\Livewire\DomainDetail;
use App\Livewire\Domains\Index as DomainsIndex;
use App\Livewire\Domains\Create as DomainsCreate;
use App\Livewire\Domains\Show as DomainsShow;
use App\Livewire\RoutingRules\Create as RoutingRulesCreate;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Public Routes
Route::get('/', Homepage::class)->name('home');
Route::get('/pricing', Pricing::class)->name('pricing');
Route::get('/faq', Faq::class)->name('faq');

// Authentication Routes (Laravel Breeze default)
require __DIR__.'/auth.php';

// Protected Routes
Route::middleware(['auth'])->group(function () {
    // Dashboard (Livewire Component)
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    
    // Domain Management Routes
    Route::get('/domains', DomainsIndex::class)->name('domains.index');
    Route::get('/domains/create', DomainsCreate::class)->name('domains.create');
    Route::get('/domains/{id}', DomainsShow::class)->name('domains.show');
    
    // Routing Rules Routes
    Route::get('/domains/{domain_id}/routing-rules/create', RoutingRulesCreate::class)->name('routing-rules.create');
    
    // Logout
    Route::post('/logout', function () {
        auth()->logout();
        return redirect('/');
    })->name('logout');
});

/*
 * Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';
 */