<?php
namespace Maxfactor\CMS\Commands;

use App\User;
use Illuminate\Console\Command;
use Silvanite\Brandenburg\Policy;

class MakeAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'maxfactor:make:admin';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a new super admin account';
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
        $this->setupRole();

        $user = factory(User::class)->create([
            'name' => $this->ask('Name', 'System Administrator'),
            'email' => $this->ask('Email address', 'dewsigncontrol@gmail.com'),
            'password' => bcrypt($this->secret('Password') ?? 'secret'),
        ]);

        if (!$user) {
            return $this->error('Could not create user account');
        }

        $user->assignRole('super-admin');

        $this->info('A new admin account has been created');
    }

    private function setupRole()
    {
        $role = factory('Maxfactor\CMS\Models\Role')->create([
            'name' => 'Super Admin',
            'slug' => 'super-admin',
        ]);

        $role->setPermissions(Policy::all());
    }
}
