<x-layout>
    <h2>User Profile</h2>

    <div>
        <img src="" alt="image" class="size-40 rounded-xl">
        <p>{{ $user->name }}</p>
        <p>Followers: {{ count($user->followers) }}</p>
        <p>Following: {{ count($user->followings) }}</p>
        <p>Favourite: {{ $user->following }}</p>
        <!-- <p>Following: {{ $user->following }}</p> -->
        <form action="{{ route('user.follow', ['follow', $user->id, Auth::user()->id]) }}">
            @csrf
            <button type="submit" class="btn">Follow</button>
        </form>
        <form action="{{ route('user.follow', ['unfollow', $user->id, Auth::user()->id]) }}">
            @csrf
            <button type="submit" class="btn">UnFollow</button>
        </form>
    </div>
    <a href="{{ route('home') }}" class="btn">Go back</a>
</x-layout>