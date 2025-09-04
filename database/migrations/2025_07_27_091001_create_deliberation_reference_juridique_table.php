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
        Schema::create('deliberation_reference_juridique', function (Blueprint $table) {
            $table->id();
            $table->foreignId('deliberation_id')->constrained('deliberations')->onDelete('cascade');
            $table->foreignId('reference_juridique_id')->constrained('reference_juridiques')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deliberation_reference_juridique');
    }
};
