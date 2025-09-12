<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
    {
        Schema::create('states', function (Blueprint $table) {
            $table->id('state_id');
            $table->string('state_name');
            $table->timestamps(); 
            $table->softDeletes();
            $table->tinyInteger('op_status')->default(1);
            $table->tinyInteger('flag')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('states');
    }
};
