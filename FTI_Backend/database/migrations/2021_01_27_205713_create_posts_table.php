<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->mediumtext('content');
            $table->string('file_path')->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->boolean('is_public')->default(false);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
        DB::table('posts')->insert(     
            [   'title' => 'Postimi 1',
                'content' => 'Ky eshte postimi i pare i vendosur automatikisht nga aplikacioni',
                'user_id' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
