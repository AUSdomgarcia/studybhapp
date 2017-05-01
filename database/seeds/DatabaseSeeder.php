<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Role;
use App\WebSetting;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        Model::unguard();
        DB::table('users')->truncate();

        /*|---------------
          | Default Users
          |--------------- 
        */
        $defaultUsers = array(
						array(
							'name'=>'Admin Project',
							'email' => 'admin@domain.com',
							'role_id' => 1,
							'password' => bcrypt('password'),
							'created_at' => date("Y-m-d H:i:s"),
							'updated_at' => date("Y-m-d H:i:s"),
						),
						array(
							'name'=>'Editor Project',
							'email' => 'editor@domain.com',
							'role_id' => 2,
							'password' => bcrypt('password'),
							'created_at' => date("Y-m-d H:i:s"),
							'updated_at' => date("Y-m-d H:i:s")
						),
						array(
							'name'=>'Moderator Project',
							'email' => 'moderator@domain.com',
							'role_id' => 3,
							'password' => bcrypt('password'),
							'created_at' => date("Y-m-d H:i:s"),
							'updated_at' => date("Y-m-d H:i:s")
						)
					);
        DB::table('users')->truncate();
        DB::table('users')->insert($defaultUsers);

        /*|---------------
          | Default Role
          |--------------- 
        */
        DB::table('roles')->truncate();

        Role::create([
            'name'          => 'Administrators',
            'description'   => 'Complete access to the CMS (all management modules).'
        ]);
        Role::create([
            'name'          => 'Editors',
            'description'   => 'Manage website page contents.'
        ]);
        Role::create([
            'name'          => 'Moderators',
            'description'   => 'Monitor/extract customers’ submissions/requests and updates the status of inquiries '
        ]);

        /*
          |---------------------
          | Default WebSetting
          |--------------------- 
        */
        $mail_content = array(
                    array(
                      'key'=>'default-recipient',
                      'group'=> 'email',
                      'content' => '<p>domgarcia.fp@gmail.com;ruthgpokemon@gmail.com;</p>',
                      'created_at' => date("Y-m-d H:i:s"),
                      'updated_at' => date("Y-m-d H:i:s")
                    ),
                    array(
                      'key'=>'default-reply-message',
                      'group'=> 'email',
                      'content' => '<p>We already made a resolution regarding your concern.</p>',
                      'created_at' => date("Y-m-d H:i:s"),
                      'updated_at' => date("Y-m-d H:i:s")
                    ),
                    array(
                      'key'=>'default-thankyou-message',
                      'group'=> 'email',
                      'content' => '<p>Good day! Thank You for sending us your feedback.</p>',
                      'created_at' => date("Y-m-d H:i:s"),
                      'updated_at' => date("Y-m-d H:i:s")
                    )
                );
        
        DB::table('web_settings')->truncate();
        DB::table('web_settings')->insert($mail_content);
    }	
}
