<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('books', function (Blueprint $table) {
            // Drop old columns if they exist
            $table->dropColumn(['bookId', 'bookName']);
            
            // Add new columns
            $table->string('name');
            $table->string('author');
            $table->decimal('rating', 2, 1)->default(0);
            $table->integer('quantity')->default(0);
        });
    }

    public function down()
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn(['name', 'author', 'rating', 'quantity']);
            $table->string('bookId');
            $table->string('bookName');
        });
    }
}; 