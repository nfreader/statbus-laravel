<?php
namespace App\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider {
  /**
   * Bootstrap the application services.
   *
   * @return void
   */
  public function boot() {
    Blade::directive('fa', function ($expression) {
      return sprintf('<i aria-hidden="true" class="far fa-%s"></i>', trim($expression, "'"));
    });

    Blade::directive('ckeylink', function ($expression) {
      var_dump($expression);
      // $route = route('tgdb.player',['ckey'=>])
      return "<?php echo 'Hi'?>";
    });
  }
}