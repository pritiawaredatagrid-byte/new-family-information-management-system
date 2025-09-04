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
        Schema::create('UserRegistration', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->date('birthdate');
            $table->bigInteger('mobile_number');
            $table->string('address');
            $table->string('state');
            $table->string('city');
            $table->integer('pincode');
            $table->string('status');
            $table->date('wedding_date')->nullable();
            $table->string('hobby');
            $table->string('photo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('UserRegistration');
    }
};
