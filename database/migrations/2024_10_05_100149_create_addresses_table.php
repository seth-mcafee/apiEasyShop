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
            $table->foreignId('user_id')->constrained();
            $table->string("title");
            $table->string("name");

            $table->string("surname");
            $table->string("company")->nullable();
            $table->string("vat")->nullable();

            $table->string("region");

            $table->string("city");

            $table->string("address");

            $table->string("cp");

            $table->string("phone");

            $table->string("email");

            $table->timestamps();
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
