<x-layout href="{{ route('landing') }}">
    <h2 class="text-center">Admin Dashboard</h2>


    <nav class="flex flex-col">
        <a href="{{ route('admin.show', 'all-users')}}">View all users</a>
        <a href="{{ route('admin.show', 'all-books') }}">View all books</a>
        <a href="{{ route('admin.show', 'add-users')}}">Add users</a>
        <a href="{{ route('admin.show', 'add-books') }}">Add books</a>

    </nav>

</x-layout>