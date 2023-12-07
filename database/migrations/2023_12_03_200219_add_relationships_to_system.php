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
        Schema::table('systems', function (Blueprint $table) {
            $table->integer('point_value')->default(4);
            $table->foreignId('backlog_id')->nullable()->constrained('backlogs')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('systems', function (Blueprint $table) {
            $table->dropColumn('point_value');
            $table->dropForeign(['backlog_id']);
            $table->dropColumn('backlog_id');
        });
    }
};
