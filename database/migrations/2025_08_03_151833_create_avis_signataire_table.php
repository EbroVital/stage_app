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
        Schema::create('avis_signataire', function (Blueprint $table) {
            $table->id();
            $table->foreignId('avis_id')->constrained()->onDelete('cascade');
            $table->foreignId('signataire_id')->constrained()->onDelete('cascade');
            $table->string('fonction');
            $table->integer('ordre')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avis_signataire');
    }
};
