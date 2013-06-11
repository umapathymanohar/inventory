<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// $this->call('UserTableSeeder');
		$this->call('TestingsTableSeeder');
		$this->call('ProductmastersTableSeeder');
		$this->call('ProductcategoriesTableSeeder');
		$this->call('CustomermastersTableSeeder');
		$this->call('SalesmastersTableSeeder');
	}

}