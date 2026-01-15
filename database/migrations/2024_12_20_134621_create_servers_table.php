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
        Schema::create('servers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('server_type');
            $table->integer('server_status');
            $table->string('ip_address');
            $table->boolean('is_alive');
            $table->bigInteger('last_heartbeat')->nullable();
            $table->double('lon')->default(0);
            $table->double('lat')->default(0);
            $table->double('cpu_usage')->default(0);
            $table->double('ram_usage')->default(0);
            $table->bigInteger('rcc_jobs_open')->default(0);
            $table->string('country_code')->default('US');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servers');
    }
};
