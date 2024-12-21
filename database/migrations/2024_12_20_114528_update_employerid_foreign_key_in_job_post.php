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
        Schema::table('job_post', function (Blueprint $table) {
            // Drop the existing foreign key constraint
            $table->dropForeign(['EmployerId']);

            // Update the foreign key to reference the employees table
            $table->foreign('EmployerId')->references('id')->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_post', function (Blueprint $table) {
            // Drop the foreign key referencing employees
            $table->dropForeign(['EmployerId']);

            // Restore the original foreign key referencing employer
            $table->foreign('EmployerId')->references('id')->on('employer')->onDelete('cascade');
        });
    }
};
