// Step 1: Check existing migrations
// Look in your database/migrations folder for any files that might be creating the 'body' column

// Step 2: If you find an existing migration, you have two options:

// Option A: Update the existing migration (if it hasn't been run yet)
// Open the existing migration file and update its content if needed

// Option B: Create a new migration with a unique name
// Run this command in your terminal:
php artisan make:migration add_body_column_to_posts_table

// Step 3: Edit the new migration file
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBodyColumnToPostsTable extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('posts', 'body')) {
            Schema::table('posts', function (Blueprint $table) {
                $table->longText('body')->nullable()->after('updated_at');
            });
        }
    }

    public function down()
    {
        if (Schema::hasColumn('posts', 'body')) {
            Schema::table('posts', function (Blueprint $table) {
                $table->dropColumn('body');
            });
        }
    }
}

// Step 4: Run the migration
// php artisan migrate