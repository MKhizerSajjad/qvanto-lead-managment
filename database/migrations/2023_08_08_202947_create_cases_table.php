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
        Schema::create('cases', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('status')->unsigned()->default(1);
            $table->tinyInteger('case_type_id')->unsigned()->indexed();
            $table->foreignId('appointment_id')->constrained()->onDelete('cascade');
            // $table->unsignedBigInteger('appointment_id');
            // $table->foreign('appointment_id')->references('id')->on('appointments')->onDelete('CASCADE');
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->unsignedBigInteger('employe_id');
            $table->foreign('employe_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->decimal('total_amount',20,2);
            $table->decimal('paid_amount',20,2);
            $table->decimal('discount',20,2);
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cases');
    }
};