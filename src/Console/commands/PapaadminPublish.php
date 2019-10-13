<?php

namespace Paparadi\Papaadmin\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class PapaadminPublish extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'papaadmin:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish required assets and config files for Papaadmin Admin Panel for use';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if($this->confirm("This is going to set up papaadin for you. Continue?")){
            
    		$this->line('@php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider" --tag="migrations"');
            $this->comment('published');
            Artisan::queue('vendor:publish',[
                "--provider"    => "Spatie\Permission\PermissionServiceProvider",
                "--tag"         => "migrations"
            ]);
            $this->line('@php artisan vendor:publish --provider="Paparadi\Papaadmin\PapaAdminServiceProvider" --tag="migrations"');
            $this->comment('published');
            Artisan::queue('vendor:publish',[
                "--provider"    => "Paparadi\Papaadmin\PapaAdminServiceProvider",
                "--tag"         => "migrations"
            ]);
            $this->line('@php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider" --tag="config"');
            $this->comment('published');
            Artisan::queue('vendor:publish',[
                "--provider"    => "Spatie\Permission\PermissionServiceProvider",
                "--tag"         => "config"
            ]);
            $this->line('@php artisan vendor:publish --provider="Paparadi\Papaadmin\PapaAdminServiceProvider" --tag="config"');
            $this->comment('published');
            Artisan::queue('vendor:publish',[
                "--provider"    => "Paparadi\Papaadmin\PapaAdminServiceProvider",
                "--tag"         => "config"
            ]);
            $this->line('@php artisan vendor:publish --provider="Paparadi\Papaadmin\PapaAdminServiceProvider" --tag="views"');
            $this->comment('published');
            Artisan::queue('vendor:publish',[
                "--provider"    => "Paparadi\Papaadmin\PapaAdminServiceProvider",
                "--tag"         => "views"
            ]);
            $this->line('@php artisan vendor:publish --provider="Paparadi\Papaadmin\PapaAdminServiceProvider" --tag="public"');
            $this->comment('published');
            Artisan::queue('vendor:publish',[
                "--provider"    => "Paparadi\Papaadmin\PapaAdminServiceProvider",
                "--tag"         => "public"
            ]);
        }
        else{
            $this->comment("Aborting! Thank You.");
        }
    }
}
