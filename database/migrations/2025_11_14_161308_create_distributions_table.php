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
        Schema::create('distributions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('server_id')->nullable()->unique();
            $table->unsignedBigInteger('distributor_id')->nullable();
            $table->integer('aid_request_id'); // pas de FK dans le dump, juste un lien logique
            $table->unsignedBigInteger('village_id')->nullable();

            $table->string('status', 191)->default('Planifié');
            $table->string('type', 191)->nullable();

            $table->bigInteger('coupon_amount')->nullable();
            $table->integer('coupon_quantity')->nullable();

            $table->longText('description')->nullable();
            $table->date('date')->nullable();

            $table->timestamps();

            $table->bigInteger('carnet_id')->nullable();
            $table->integer('facial_count')->nullable()->default(0);
            $table->string('kind_of_kit', 191)->nullable();
            $table->boolean('is_sync')->default(1);

            $table->unsignedBigInteger('session_id')->nullable();

            // Indexes
            $table->index('distributor_id');
            $table->index('village_id');
            $table->index('session_id');

            // Foreign keys
            $table->foreign('distributor_id')
                ->references('server_id')
                ->on('users');

            $table->foreign('village_id')
                ->references('server_id')
                ->on('villages');


            $table->foreign('session_id')
                ->references('server_id')
                ->on('distribution_sessions')
                ->nullOnDelete(); // ON DELETE SET NULL
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('distributions');
    }
};
