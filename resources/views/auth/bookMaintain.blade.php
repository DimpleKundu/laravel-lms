<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Management Dashboard</title>
    
</head>
<body>
    <div class="header-container">
        
        <div class="buttons-container">
            <a href="{{ route('admin.books.add') }}" class="add-book-btn">Add Book</a>
            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </div>
    <form action="{{ route('admin.dashboard') }}">
        @csrf
        <button type="submit" class="reject-btn">back to dashboard</button>
    </form>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
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
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
            <tr>
            <td>{{ $book->bookId }}</td>
                <td>{{ $book->bookName }}</td>
                <td>{{ $book->author }}</td>
                <td>{{ $book->rating }}</td>
                <td>{{ $book->quantity }}</td>
                <td class="action-buttons">
                    <form action="{{ route('admin.books.edit', ['book' => $book->bookId]) }}" method="GET" style="display: inline;">
                        <button type="submit" class="edit-btn">Edit</button>
                    </form>
                    <form action="{{ route('admin.books.delete', ['book' => $book->bookId]) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this book?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-btn">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html> 