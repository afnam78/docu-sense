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
        Schema::create('file_aliases', function (Blueprint $table) {
            $table->id();
            $table->string('file_hash')->index();
            $table->string('name');
            $table->foreignId('user_id')->index()->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->foreign('file_hash')->references('hash')->on('files')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file_aliases');
    }
};
