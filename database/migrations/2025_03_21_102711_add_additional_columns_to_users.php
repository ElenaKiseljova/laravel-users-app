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
    Schema::table('users', function (Blueprint $table) {
      $table->string('phone')->after('name')->nullable();
      $table->string('photo')->after('phone')->nullable();
      $table->foreignId('position_id')->after('id')->nullable()->constrained();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('users', function (Blueprint $table) {
      $table->dropColumn('phone');
      $table->dropColumn('photo');

      $table->dropForeign(['position_id']);
      $table->dropColumn('position_id');
    });
  }
};
