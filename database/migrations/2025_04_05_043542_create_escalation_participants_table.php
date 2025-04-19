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
        Schema::create('escalation_participants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('escalation_id');
            $table->foreign('escalation_id')->references('id')->on('escalations')->onDelete('cascade');
            $table->unsignedBigInteger('participant_id');
            $table->foreign('participant_id')->references('id')->on('participants')->onDelete('cascade');
            $table->enum('role', ['titular', 'reserva'])->default('titular');
            $table->boolean('is_captain')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('escalation_participants');
    }
};
