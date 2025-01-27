<!DOCTYPE html>
<html>
<head>
    <title>Edit Book</title>
</head>
<body>
    <h2>Edit Book</h2>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.dashboard') }}">
        @csrf
        <button type="submit" class="reject-btn">back to dashboard</button>
    </form>

    <form action="{{ route('admin.books.update', $book->bookId) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div>
            <label for="name">Book Name</label>
            <input type="text" name="bookName" id="bookName" value="{{ $book->bookName }}" required>
        </div>

        <div>
            <label for="author">Author</label>
            <input type="text" name="author" id="author" value="{{ $book->author }}" required>
        </div>

        <div>
            <label for="rating">Rating</label>
            <input type="number" name="rating" id="rating" step="0.1" min="0" max="5" value="{{ $book->rating }}" required>
        </div>

        <div>
            <label for="quantity">Quantity</label>
            <input type="number" name="quantity" id="quantity" min="0" value="{{ $book->quantity }}" required>
        </div>

        <button type="submit">Update Book</button>
    </form>
</body>
</html>
