<x-layout>
    <h2>User Profile</h2>

    <div>
        <img src="" alt="image" class="size-40 rounded-xl">
        <p>{{ $user->name }}</p>
        <p>Followers: {{ $user->followers }}</p>
        <p>Following: {{ $user->following }}</p>
        <p>Favourite: {{ $user->following }}</p>
        <!-- <p>Following: {{ $user->following }}</p> -->
        <form action="{{ route('user.follow', [$user->id, Auth::user()->id]) }}">
            @csrf
            <button type="submit" class="btn">Follow</button>
        </form>
        <form action="{{ route('user.unfollow', [$user->id, Auth::user()->id]) }}">
            @csrf
            <button type="submit" class="btn">UnFollow</button>
        </form>
    </div>
    <a href="{{ route('home') }}" class="btn">Go back</a>
</x-layout>