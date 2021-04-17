<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;
use Illuminate\Pagination\Paginator;
use App\Settings;
use App\SettingsUser;

class AppServiceProvider extends ServiceProvider
{
    public $settings;
    public $userSettings;

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->settings = $this->app->singleton(Settings::class, function () {
            return Settings::make(storage_path('app/settings.json'));
        });

        $this->userSettings = $this->app->singleton(SettingsUser::class, function () {
            return SettingsUser::make(storage_path('app/user_settings.json'));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Blade::directive('money', function ($amount) {
            return "<?php echo '€ ' . number_format($amount, 2, ',', '.'); ?>";
        });

        Paginator::useBootstrap();
    }
}
