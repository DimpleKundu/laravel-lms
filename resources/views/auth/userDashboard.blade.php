<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Books</title>
   
</head>

<body>
    <div">


        
        <h2>Available Books</h2>
        <div class="buttons-container">
            
            
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
        </div>

        @if(session('success'))
            <div style="color: green;">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div style="color: red;">{{ session('error') }}</div>
        @endif

        <table>
            <thead>
                <tr>
                    <th>Book ID</th>
                    <th>Book Name</th>
                    <th>Author</th>
                    <th>Rating</th>
                    <th>Quantity</th>
                    <th>Actions</th>
                    <!-- <th>Status</th> -->
                </tr>
            </thead>
            <tbody>
                @foreach($books as $book)
                @php
                    $borrowRequest = \App\Models\BorrowBook::where('user_id', Auth::id())
                        ->where('book_id', $book->bookId)
                        ->orderBy('created_at', 'desc')
                        ->first();
                @endphp
                <tr>
                    <td>{{ $book->bookId }}</td>
                    <td>{{ $book->bookName }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->rating }}</td>
                    <td>{{ $book->quantity }}</td>
                    
                    <td>
                        @if($borrowRequest && in_array($borrowRequest->status, ['pending']))
                            <button class="request-btn" disabled>Request Pending</button>
                        @elseif($book->quantity > 0)
                            <form action="{{ route('books.borrow', ['book' => $book->bookId]) }}" method="POST">
                                @csrf
                                <button type="submit" class="request-btn">Request Book</button>
                            </form>
                        @else
                            <span class="out-of-stock">Out of Stock</span>
                        @endif
                    </td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>
</body>

</html>