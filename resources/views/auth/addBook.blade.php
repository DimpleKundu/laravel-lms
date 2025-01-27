<!DOCTYPE html>
<html>
<head>
    <title>Add Book</title>
</head>
<body>
    <h2>Add New Book</h2>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.books.store') }}" method="POST">
        @csrf
        
        <div>
            <label for="bookName">Book Name</label>
            <input type="text" name="bookName" id="bookName" value="{{ old('bookName') }}" required>
        </div>

        <div>
            <label for="author">Author</label>
            <input type="text" name="author" id="author" value="{{ old('author') }}" required>
        </div>

        <div>
            <label for="rating">Rating</label>
            <input type="number" name="rating" id="rating" step="0.1" min="0" max="5" value="{{ old('rating') }}" required>
        </div>

        <div>
            <label for="quantity">Quantity</label>
            <input type="number" name="quantity" id="quantity" min="0" value="{{ old('quantity') }}" required>
        </div>

        <button type="submit">Add Book</button>
    </form>
</body>
</html>
