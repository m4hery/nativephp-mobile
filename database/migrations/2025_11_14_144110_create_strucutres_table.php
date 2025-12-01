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
        Schema::create('structures', function (Blueprint $table) {
             $table->id();
            $table->unsignedBigInteger('server_id')->unique();
            $table->string('name', 191);
            $table->string('address', 191)->nullable();
            $table->string('phone', 191)->nullable();
            $table->string('email', 191)->nullable();
            $table->longText('description')->nullable();
            $table->unsignedInteger('max_aid_per_day')->nullable();
            $table->string('logo', 191)->nullable();

            $table->integer('created_by')->default(1);

            $table->softDeletes();
            $table->timestamps();

            // Unique
            $table->unique('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('structures');
    }
};
