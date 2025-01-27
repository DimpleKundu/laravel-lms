<table>
    <thead>
        <tr>
            <th>Book Name</th>
            <th>Author</th>
            @if(Auth::user()->is_admin)
            <th>User</th>
            @endif
            <th>Status</th>
            @if(Auth::user()->is_admin)
            <th>Actions</th>
            @endif
        </tr>
    </thead>
    <form action="{{ route('user.dashboard') }}">
        @csrf
        <button type="submit" class="reject-btn">back to dashboard</button>
    </form>
    <tbody>
        @forelse ($borrowedBooks as $borrow)
        <tr>
            <td>{{ $borrow->book->bookName }}</td>
            <td>{{ $borrow->book->author }}</td>
            @if(Auth::user()->is_admin)
            <td>{{ $borrow->user->username }}</td>
            @endif
            <td>{{ $borrow->status }}</td>
            @if(Auth::user()->is_admin && $borrow->status == 'pending')
            <td>
                <form action="{{ route('admin.borrow.approve', $borrow->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="approve-btn">Approve</button>
                </form>
                <form action="{{ route('admin.borrow.reject', $borrow->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="reject-btn">Reject</button>
                </form>
            </td>
            @endif
        </tr>
        @empty
        <tr>
            <td colspan="5">No borrow requests found.</td>
        </tr>
        @endforelse
    </tbody>
</table>
<!-- to display pagination links -->
<div>
    {{ $borrowedBooks->links() }}
</div>