<?php

use Illuminate\Database\Seeder;

class GeneralTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

		    $countries = file_get_contents(database_path().'/sql/countries.sql');
		    $this->truncateWithForeiginkey('countries');
		    DB::insert($countries);

		    $this->truncateWithForeiginkey('users');

            $ramdom_string = random_string(8);

			DB::table('users')->insert(
			    [
			        'first_name' => 'admin',
		            'last_name' => 'admin',
                    'url'=>$ramdom_string,
		            'email' => 'admin@admin.com' ,
		            'password' => bcrypt('password'),
		            'active' => '1',
		         ]
			);
    }

    /**
     * Truncate Table which are foreignkey containst
     *
     * @return void
     */

    protected function truncateWithForeiginkey($table)
    {
    	DB::statement("SET foreign_key_checks=0");
		DB::table($table)->truncate();
		DB::statement("SET foreign_key_checks=1");
    }
}
