<?php
namespace App\Repositories;
use Illuminate\Support\ServiceProvider;

class SaveXmlDataServiceProvider extends ServiceProvider
{
    public function register()
    {
	$this->app->bind(
	  'App\Repositories\SaveDataInterface',
	  'App\Repositories\SaveXmlDataRepository'
	);
    }
}
?>
