<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::unprepared("CREATE EXTENSION IF NOT EXISTS \"uuid-ossp\";");
        \Illuminate\Support\Facades\DB::unprepared("CREATE EXTENSION IF NOT EXISTS \"postgis\";");
        \Illuminate\Support\Facades\DB::unprepared("CREATE EXTENSION IF NOT EXISTS \"hstore\";");

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->uuid('channel')->unique()->default(new \Illuminate\Database\Query\Expression('uuid_generate_v4()'));
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
