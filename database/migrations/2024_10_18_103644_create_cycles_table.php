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
        Schema::create('cycles', function (Blueprint $table) {
            $table->id();
            $table->integer("cycle_no");
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->integer('Trays')->nullable();
            $table->integer('Days')->nullable();
            $table->enum('phase', ['Germination', 'Seedling Stage', 'Transplanting', 'Establishment', 'Vegetative Growth', 'Head Initiation' , 'Head Development', 'Maturation', 'Harvesting' , 'Post-Harvest'])->default('Germination');
            $table->enum('status', ['current', 'completed'])->default('current');
            $table->string('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cycles');
    }
};
