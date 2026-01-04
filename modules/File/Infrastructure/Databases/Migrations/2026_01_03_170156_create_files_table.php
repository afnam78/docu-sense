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
        Schema::create('files', function (Blueprint $table) {
            $table->string('hash')->primary();
            $table->string('status')->default('NOT_ANALYZED');
            $table->string('mimetype');
            $table->json('json_response')->nullable();
            $table->json('payslip_response')->nullable();
            $table->timestamp('analyze_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
