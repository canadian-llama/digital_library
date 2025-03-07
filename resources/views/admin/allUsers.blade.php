<x-layout href="{{ route('landing') }}">
    <p>All users</p>

    @if ($users->isEmpty())

    <p>No registered users</p>

    @else
    @foreach($users as $user)
    <table>

        <tr>
            <th>S/N</th>
            <th>Full name</th>
            <th>E-mail</th>
        </tr>
        <tbody>
            <tr>
                <th>1</th>
                <th>{{ $user->name }}</th>
                <th>{{ $user->email }}</th>
                <th>
                    <div class="row">
                        <a href="{{ route('admin.edit', $user->id) }}" class="btn">Edit</a>

                        <form action="{{ route('admin.delete', $user->id) }}" method="post">
                            @csrf
                            <button type="submit" class="btn" onclick="return confirm('Are u sure you want to delete user?')">Delete</button>
                        </form>
                    </div>
                </th>
            </tr>
        </tbody>
    </table>
    @endforeach
    @endif

    <a href="{{ route('user.dashboard') }}" class="btn">Go back</a>
</x-layout>