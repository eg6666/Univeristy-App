<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fname',20);
            $table->string('lname',20);
            $table->char('gender',1);
            $table->date('birthday');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('user_type_id')->unsigned();
            $table->integer('department_id')->unsigned();
            $table->boolean('access')->default(false);
            $table->timestamps();

            $table->foreign('user_type_id')->references('id')->on('user_types');
            $table->foreign('department_id')->references('id')->on('departments');
        });
        DB::table('users')->insert(     
            [   'fname' => 'Admin',
                'lname' => 'Admin',
                'gender' => 'M',
                'birthday' => '2021-03-07',
                'email' => 'admin@fti.edu.al',
                'password' => Hash::make('admin2021FTI#'),
                'user_type_id' => '1',
                'department_id' => '1',
                'access' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
        );
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
