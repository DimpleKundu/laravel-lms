<?php

namespace App\Http\Controllers;

use App\Models\BorrowBook;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use Illuminate\Pagination\Paginator;

class BorrowBookController extends Controller
{
    public function store(Request $request, Book $book)
    {
        // Check if user already has a pending request for this book
        $existingRequest = BorrowBook::where('user_id', Auth::id())
            ->where('book_id', $book->bookId)
            ->where('status', 'pending')
            ->first();

        if ($existingRequest) {
            return back()->with('error', 'You already have a pending request for this book.');
        }

        // Create new borrow request
        $borrow = BorrowBook::create([
            'user_id' => Auth::id(),
            'book_id' => $book->bookId,
            'status' => 'pending'
        ]);

        return back()->with('success', 'Book request submitted successfully.');
    }

    public function approveBorrow(BorrowBook $borrow)
    {
        if (Auth::user()->is_admin != 1) {
            return redirect()->route('user.dashboard');
        }

        // Check if book is available
        if ($borrow->book->quantity <= 0) {
            return back()->with('error', 'Book is not available for borrowing.');
        }

        // Update borrow status and decrement book quantity
        $borrow->status = 'borrowed';
        $borrow->save();

        $borrow->book->decrement('quantity');

        return back()->with('success', 'Borrow request approved successfully.');
    }

    public function rejectBorrow(BorrowBook $borrow)
    {
        if (Auth::user()->is_admin != 1) {
            return redirect()->route('user.dashboard');
        }

        $borrow->status = 'rejected';
        $borrow->save();

        return back()->with('success', 'Borrow request rejected.');
    }

    public function viewBorrowedBooks()
    {
        $borrowedBooks = BorrowBook::with(['user', 'book'])
            ->where('status', 'borrowed')
            ->get();

        return view('admin.borrowed-books', compact('borrowedBooks'));
    }

    public function returnBook(BorrowBook $borrowBook)
    {
        $borrowBook->status = 'returned';
        $borrowBook->return_date = now();
        $borrowBook->save();

        // Increment book quantity
        $borrowBook->book->increment('quantity');

        return back()->with('success', 'Book returned successfully.');
    }
   
    public function viewBorrowRequests()
    {
        if (Auth::user()->is_admin != 1) {
            return redirect()->route('user.dashboard');
        }

        $borrowedBooks = BorrowBook::with(['user', 'book'])
        ->orderByRaw("CASE WHEN status = 'pending' THEN 0 ELSE 1 END")
        ->paginate(10);
        return view('auth.borrowRequest', compact('borrowedBooks'));
    }
}
