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
        Schema::create('beneficiaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('server_id')->nullable()->unique();
            $table->string('local_id', 191)->nullable()->index();
            $table->integer('created_by')->default(1);

            $table->string('firstname', 191)->nullable()->index();
            $table->string('lastname', 250)->nullable()->index();

            $table->longText('data_dynamic')->nullable(); // JSON valid (check below)
            $table->date('birthday')->nullable()->index();

            $table->integer('old')->nullable();
            $table->string('family_situation', 191)->nullable();
            $table->string('unborn_child', 191)->nullable();
            $table->string('gender', 191)->nullable();
            $table->string('phone', 191)->nullable();

            $table->string('job', 191)->nullable();
            $table->string('activity', 191)->nullable()->default('Non');

            $table->boolean('is_sync')->default(1);

            $table->integer('monthly_income')->nullable();
            $table->integer('rest_live_income')->nullable();

            $table->string('zipcode', 191)->nullable();
            $table->string('address', 191)->nullable();
            $table->string('ciu', 30)->nullable();

            $table->unsignedBigInteger('village_id')->nullable();
            $table->unsignedBigInteger('service_id')->nullable();

            $table->boolean('is_new')->default(0);

            $table->text('comment')->nullable();

            $table->string('hasChildren', 191)->nullable();
            $table->string('numberOfChildren', 191)->nullable();
            $table->string('otherAidDistributed', 191)->nullable();
            $table->string('otherAidDistributedDetails', 191)->nullable();

            $table->boolean('is_urgent')->default(0)->index();
            $table->boolean('is_normal')->default(1);
            $table->boolean('is_archive_emsp')->default(0);

            $table->timestamps();
            $table->softDeletes();

            // Foreign Keys
            $table->foreign('village_id')->references('server_id')->on('villages');
            // Index composed
            $table->index(['firstname', 'lastname', 'phone']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beneficiaries');
    }
};
