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
        Schema::create('borrow_books', function (Blueprint $table) {
            $table->id();
            
            // Explicitly reference 'bookID' in the 'books' table
            $table->unsignedBigInteger('book_id');
            $table->foreign('book_id')->references('bookID')->on('books')->onDelete('cascade');
            
            // Reference 'id' in the 'users' table
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            // Status as a string
            $table->string('status')->default('Rejected'); // borrowed, returned, overdue
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrow_books');
    }
};
