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
        Schema::create('exclusions', function (Blueprint $table) {
            $table->id();
            $table->string('lead_number', 255);
            $table->unsignedBigInteger('sending_server_id');
            $table->unsignedBigInteger('campaign_id');
            $table->timestamps();
            $table->softDeletes();

            // Define foreign key constraints
            $table->foreign('sending_server_id')->references('id')->on('sending_servers');
            $table->foreign('campaign_id')->references('id')->on('campaigns');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exclusions');
    }
};
