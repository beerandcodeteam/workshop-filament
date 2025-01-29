<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedMediumInteger('city_id')->nullable();
            $table->foreign('city_id')
                ->references('id')
                ->on('cities');
            $table->unsignedMediumInteger('state_id')->nullable();
            $table->foreign('state_id')
                ->references('id')
                ->on('states');
            $table->foreignId('event_id')->nullable()->constrained('events');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->string('zipcode')->nullable();
            $table->string('address')->nullable();
            $table->string('number')->nullable();
            $table->string('district')->nullable();
            $table->string('complement')->nullable();
            $table->string('location')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
