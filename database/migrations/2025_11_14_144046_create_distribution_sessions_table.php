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
        Schema::create('distribution_sessions', function (Blueprint $table) {
           $table->id();
            $table->unsignedBigInteger('server_id')->nullable()->unique();
            $table->string('name', 191);
            $table->text('description')->nullable();

            $table->date('start_date');
            $table->date('end_date');

            $table->year('year');
            $table->boolean('is_active')->default(true);

            $table->bigInteger('service_id')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();

            $table->timestamps();

            // Indexes
            $table->index(['year', 'is_active']);
            $table->index(['start_date', 'end_date']);
            $table->index('created_by');

            $table->foreign('created_by')
                ->references('server_id')
                ->on('users')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('distribution_sessions');
    }
};
