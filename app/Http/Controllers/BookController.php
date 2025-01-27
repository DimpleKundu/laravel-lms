<?php
namespace App\Http\Controllers;
use Illuminate\Routing\Controller;
use App\Models\Book;

//author: dimple kundu
// class used to display all books details in userDashboard when user is not an admin also
class BookController extends Controller
{
    public function userDashboard()
    {
        // Fetch all books
        $books = Book::all();
        return view('auth.userDashboard', compact('books'));
    }
}
