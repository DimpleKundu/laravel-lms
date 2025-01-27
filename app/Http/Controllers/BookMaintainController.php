<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookMaintainController extends Controller
{
    public function dashboard()
{
    // if (!Auth::check() || Auth::user()->is_admin) {
    //     return redirect()->route(route: 'user.dashboard');
    // }
    if (!Auth::check() || !Auth::user()->is_admin) {
        return redirect()->route(route: 'user.dashboard');
    }
    


    $userId = Auth::id();

    // $books = DB::table('books')
    //     ->leftJoin('borrow_books', function ($join) use ($userId) {
    //         $join->on('books.id', '=', 'borrow_books.book_id')
    //              ->where('borrow_books.user_id', '=', $userId);
    //     })
    //     ->select(
    //         'books.id as bookId',
    //         'books.name as bookName',
    //         'books.author',
    //         'books.rating',
    //         'books.quantity',
    //         'borrow_books.status as borrow_status'
    //     )
    //     ->get();
    $books = DB::table('books')
        ->get();

    return view('auth.bookMaintain', compact('books'));
}


    public function addBook()
    {
        if (Auth::user()->is_admin != 1) {
            return redirect()->route('user.dashboard');
        }

        return view('auth.addBook');
    }

    public function storeBook(Request $request)
    {
        $validated = $request->validate([
            'bookName' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'rating' => 'required|numeric|max:5',
            'quantity' => 'required|integer|min:0',
        ]);

        $book = Book::create($validated);

        if ($book) {
            return redirect()->route('bookMaintain.dashboard')
                ->with('success', 'Book added successfully.');
        }

        return back()->with('error', 'Failed to add book. Please try again.');
    }

    public function editBook(Book $book)
    {
        if (Auth::user()->is_admin != 1) {
            return redirect()->route('user.dashboard');
        }

        return view('auth.edit-book', compact('book'));
    }

    public function updateBook(Request $request, Book $book)
    {
        $validated = $request->validate([
            'bookName' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'rating' => 'required|numeric|max:5',
            'quantity' => 'required|integer|min:0',
        ]);

        $book->update($validated);
        return redirect()->route('bookMaintain.dashboard')->with('success', 'Book updated successfully');
    }

    public function deleteBook(Book $book)
    {
        if (Auth::user()->is_admin != 1) {
            return redirect()->route('user.dashboard');
        }

        $book->delete();
        return redirect()->route('bookMaintain.dashboard')
            ->with('success', 'Book deleted successfully');
    }
}
