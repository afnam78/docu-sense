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
        Schema::create('audits', function (Blueprint $table) {
            $table->id();

            $table->string('file_hash')->index();
            $table->string('sheet_hash');

            $table->string('status');
            $table->string('arithmetic_coherence_status');
            $table->string('social_security_coherence_status');
            $table->string('heuristic_integrity_status');
            $table->string('fields_sanity_status');

            $table->json('arithmetic_coherence_details')->nullable();
            $table->json('social_security_coherence_details')->nullable();
            $table->json('heuristic_integrity_details')->nullable();
            $table->json('fields_sanity_details')->nullable();

            $table->timestamps();

            $table->foreign('file_hash')->references('hash')->on('files')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audits');
    }
};
