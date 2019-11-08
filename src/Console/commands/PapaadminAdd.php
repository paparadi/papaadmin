<?php

namespace Paparadi\Papaadmin\Console\Commands;

use Illuminate\Console\Command;
use Paparadi\Papaadmin\Models\Agent;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PapaadminAdd extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'papaadmin:add';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create initial admin with permission to manage users and manage permissions';

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
		try {
	        DB::connection()->getPdo();
	        if(!DB::connection()->getDatabaseName()){
	            die("Could not find provided database. Please check your configuration.\r\n");
	        }
	    } catch (\Exception $e) {
	        die("Could not open connection to database server.  Please check your configuration.\r\n");
	    }
	    try {
			if(count(Agent::all()) == 0){
				try {
					//code...
					$name                       = $this->ask("Please enter admin name");
					$email                      = "";
					while(!filter_var($email, FILTER_VALIDATE_EMAIL)){
						$email                  = $this->ask("Please enter admin valid email address");
						$password                   = $this->secret("Please enter password");
					}
					//$this->comment($email . PHP_EOL . $password);
					$password                   = Hash::make($password);
					$agent                      = Agent::create([
						'name'              => $name,
						'email'             => $email,
						'password'          => $password,
						'status'            => 1,
					]);
					$role                       = Role::create([
						'name'              => 'admin',
						'guard_name'        => 'admin'
					]);
					$users_permission           = Permission::create([
						'name'              => 'manage_users',
						'guard_name'        => 'admin'
					]);
					$permissions_permission     = Permission::create([
						'name'              => 'manage_permissions',
						'guard_name'        => 'admin'
					]);
					$agent->assignRole($role);
					$role->givePermissionTo([$users_permission, $permissions_permission]);
					$this->line('Complete!');
					$this->line('Build something awesome!');
				} 
				catch (Throwable $message) {
					Agent::truncate();
					Role::truncate();
					Permission::truncate();
					$this->error($message->getMessage());
				}
			}
			else{
				$this->comment('Initialization Done Already!');
			}
		}
		catch (\Exception $e) {
			if($e->getMessage() === 'SQLSTATE[HY000]: General error: 1 no such table: agents (SQL: select * from "agents")'){
				$this->comment("Please Run @'php artisan migrate' first.");
			}
			else {
				$this->comment($e->getMessage());
			}
		}
	}
}
