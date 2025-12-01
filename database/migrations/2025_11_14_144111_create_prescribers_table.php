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
        Schema::create('prescribers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('server_id')->nullable()->unique();
            $table->unsignedBigInteger('structure_id');
            $table->bigInteger('service_id')->nullable();

            $table->string('firstname', 191)->nullable();
            $table->string('lastname', 191);
            $table->string('login', 191);
            $table->string('token', 191);
            $table->string('email', 191)->nullable();
            $table->string('phone', 191)->nullable();

            $table->timestamp('email_verified_at')->nullable();
            $table->string('register_ip', 191)->nullable();
            $table->string('password', 191)->nullable();
            $table->string('history', 191)->nullable();
            $table->string('forget_token', 191)->nullable();
            $table->string('active_token', 191)->nullable();

            $table->boolean('active')->default(true);
            $table->tinyInteger('is_accepted_condition')->default(0);

            $table->string('address', 191)->nullable();
            $table->longText('aboutme')->nullable();
            $table->string('city', 191)->nullable();
            $table->string('postalcode', 191)->nullable();
            $table->string('avatar', 191)->nullable();

            $table->timestamp('last_connection')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->dateTime('mdp_change_at')->nullable();

            $table->string('status', 191)->nullable();
            $table->boolean('otp_enabled')->default(true);

            // Uniques
            $table->unique('token');
            $table->unique('email');

            // Indexes
            $table->index('structure_id');
            // Foreign keys
            $table->foreign('structure_id')
                ->references('server_id')
                ->on('structures')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescribers');
    }
};
