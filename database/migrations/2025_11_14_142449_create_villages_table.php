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
        Schema::create('villages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('server_id')->unique();
            $table->string('name', 191);
            $table->string('commune', 191);
            $table->string('abreviation', 191);
            $table->bigInteger('distribution_session_id')->nullable();
            $table->timestamps();

            $table->boolean('is_distributor')->default(false);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('villages');
    }
};
