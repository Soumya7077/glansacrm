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
        Schema::disableForeignKeyConstraints();

        Schema::create('job_post', function (Blueprint $table) {
            $table->id();
            $table->integer('EmployerId');
            $table->foreign('EmployerId')->references('id')->on('employer');
            $table->string('Titlle');
            $table->string('Description');
            $table->dateTime('CreatedOn');
            $table->integer('CreatedBy');
            $table->dateTime('ModifyOn');
            $table->integer('ModifyBy');
            $table->string('Opening');
            $table->string('Salary');
            $table->string('Location');
            $table->string('Education');
            $table->string('KeySkills');
            $table->string('Department');
            $table->string('Experience');
            $table->string('Shift');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_post');
    }
};
