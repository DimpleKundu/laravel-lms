<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        DB::table('books')->insert([
            [
                'name' => 'The Great Gatsby',
                'author' => 'F. Scott Fitzgerald',
                'rating' => 4.5,
                'quantity' => 10,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => '1984',
                'author' => 'George Orwell',
                'rating' => 4.7,
                'quantity' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'To Kill a Mockingbird',
                'author' => 'Harper Lee',
                'rating' => 4.8,
                'quantity' => 8,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Pride and Prejudice',
                'author' => 'Jane Austen',
                'rating' => 4.6,
                'quantity' => 12,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }

    public function down()
    {
        DB::table('books')->whereIn('name', [
            'The Great Gatsby',
            '1984',
            'To Kill a Mockingbird',
            'Pride and Prejudice'
        ])->delete();
    }
}; 