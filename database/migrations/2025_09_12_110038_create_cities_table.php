<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id('city_id');
            $table->string('city_name');
            $table->unsignedBigInteger('state_id');
            $table->foreign('state_id')->references('state_id')->on('states')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
            $table->tinyInteger('op_status')->default(1);
            $table->tinyInteger('flag')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};
