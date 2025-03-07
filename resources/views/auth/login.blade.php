<x-layout>
    <form action="{{ route('login') }}" method="post" class="form">

        @csrf
        <h2>Login</h2>
        
        <div class="row">
            <label for="email">Email:</label>
            <input type="text" name="email" id="email" value="{{ old('email') }}">
            @if ($errors->has('email'))
            <p class="text-red-500 text-xs italic">{{ $errors->first('email') }}</p>
            @endif
        </div>

        <div class="row">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password">
            @if ($errors->has('password'))
            <p class="text-red-500 text-xs italic">{{ $errors->first('password') }}</p>
            @endif
        </div>

        <div class="row">
            <input type="checkbox" name="remember" id="remember">
            <label for="remember-me">Remember Me:</label>
        </div>

        <button type="submit" class="btn">Login</button>

    </form>
</x-layout>