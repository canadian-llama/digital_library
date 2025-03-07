<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Library</title>
    @vite('resources/css/app.css')
</head>

<body>
    <header>
        <nav>
            @guest
            <a href="{{ route('show.register') }}" class="btn">Register</a>
            <a href="{{ route('show.login') }}" class="btn">Login</a>
            @endguest

            @auth
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit" class="btn" onclick="return confirm('Are you sure you want to LogOut')">Logout</button>
            </form>
            <a href="{{ $attributes->get('href') }}" class="btn absolute left-0 mx-2 px-2">Home</a>
            <span class="text-center text-2xl font-bold font-sans mx-44">The Clouds Library</span>
            <span class="text-red-400 italic font-bold">Current User: {{ Auth::user()->name }}</span>
            @endauth
        </nav>
    </header>

    <main class="container">
        @if (session('success'))
        <div style="color: green; font-weight: bold;">
            {{ session('success') }}
        </div>

        @endif

        {{ $slot }}

        @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </main>
    <footer>
        <p class="text-xl text-center ">&copy; 2025 My Laravel App</p>
    </footer>
</body>

</html>