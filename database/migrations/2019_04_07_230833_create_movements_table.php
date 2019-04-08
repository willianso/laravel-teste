<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateMovementsTable.
 */
class CreateMovementsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('movements', function(Blueprint $table) {
			$table->increments('id');
			$table->unsignedBigInteger('user_id');
			$table->unsignedInteger('group_id');
			$table->unsignedInteger('product_id');
			$table->decimal('value');
			$table->integer('type');


			$table->timestampsTz();
			$table->softDeletes();

			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('group_id')->references('id')->on('groups');
			$table->foreign('product_Id')->references('id')->on('products');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('movements');
	}
}
