<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Create scenes table
        Schema::create('scenes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('code')->unique();
            $table->string('flag')->nullable();
            $table->enum('subtitle', ['active', 'disable'])->default('active');
            $table->enum('filter', ['active', 'disable'])->default('disable');
            $table->timestamps();
        });

        // Update posts table to add nullable scene_id foreign key
        Schema::table('posts', function (Blueprint $table) {
            if (!Schema::hasColumn('posts', 'scene_id')) {
                // Add scene_id column as nullable
                $table->unsignedBigInteger('scene_id')->nullable();

                // Define foreign key constraint for scene_id
                $table->foreign('scene_id')
                      ->references('id')
                      ->on('scenes')
                      ->onDelete('set null');
            }
        });

        // Update existing scenes records if necessary
        DB::table('scenes')->where('subtitle', 'disable')->update(['subtitle' => 'active']);
    }

    public function down()
    {
        // Remove foreign key and scene_id column from posts table
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign(['scene_id']);
            $table->dropColumn('scene_id');
        });

        // Drop scenes table
        Schema::dropIfExists('scenes');
    }
};
