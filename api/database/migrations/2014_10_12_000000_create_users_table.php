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
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->foreignId('tenant_id')->constrained()->onDelete('cascade');

            $table->unsignedBigInteger('city_id')->nullable();
            $table->foreign('city_id')->references('id')->on('cities');
            $table->integer('state_id')->nullable();

            $table->bigInteger('type')->default('2')->comment('1 = Administrador, 2 = Usuario Comum');
            $table->bigInteger('stats')->default('1')->comment('0 = Inativo, 1 = Ativo');

            $table->string('cpf')->unique();
            $table->string('name_first')->nullable();
            $table->string('name_last')->nullable();
            $table->string('birth')->nullable();
            $table->string('cell_phone')->nullable();
            $table->string('address')->nullable();
            $table->string('zip_code')->nullable();
            $table->longText('information')->nullable();
            $table->string('email')->unique();
            $table->string('password');

            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
