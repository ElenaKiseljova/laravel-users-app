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
    Schema::create('media', function (Blueprint $table) {
      $table->id();
      $table->string('original_filename');
      $table->string('size');
      $table->string('path');
      $table->string('filename');
      $table->string('type');
      $table->string('mime_type');
      $table->string('optimized_size')->nullable();
      $table->string('optimized_path')->nullable();
      $table->string('optimized_small_size')->nullable();
      $table->string('optimized_small_path')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('media');
  }
};
