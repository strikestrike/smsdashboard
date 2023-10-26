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
        Schema::table('leads', function($table) {
            $table->dropColumn('tag_id');
            $table->dropColumn('used_campaigns_ids');
            $table->dropColumn('exclude_campaigns_ids');
            $table->integer('tag_ids')->nullable();
            $table->text('exclusion_ids')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('leads', function($table) {
            $table->dropColumn('tag_ids');
            $table->dropColumn('exclusion_ids');
            $table->integer('tag_id')->nullable();
            $table->text('used_campaigns_ids')->nullable();
            $table->text('exclude_campaigns_ids')->nullable();
        });
    }
};
