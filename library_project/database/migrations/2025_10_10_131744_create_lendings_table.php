<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lendings', function (Blueprint $table) {
            $table->primary(['user_id', 'copy_id', 'start']);
            $table->foreignId('user_id')->constrained("users");
            $table->foreignId('copy_id')->constrained("copies");
            $table->date('start')->default(now());
            $table->date('end')->nullable();
            $table->boolean('extension')->default(0);
            $table->smallInteger('notice')->default(0);
            $table->timestamps();
        });

        DB::statement("ALTER TABLE lendings ADD CONSTRAINT check_dates CHECK(start > '2012-12-06')");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lendings');
    }
};
