<x-layout>
    <div class="border-2 border-red-400 m-20 shadow-2xl">
    <form action="{{ route('login') }}" method="post" class="flex items-center mt-2 pb-7 flex-col">

        @csrf
        <label class="text-3xl">Login</label>

        <div class="row">
            <label for="email">Email:</label>
            <input type="text" name="email" id="email" value="{{ old('email') }}" class="input">
            @if ($errors->has('email'))
            <p class="text-red-500 text-xs italic">{{ $errors->first('email') }}</p>
            @endif
        </div>

        <div class="row">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" class="input">
            @if ($errors->has('password'))
            <p class="text-red-500 text-xs italic">{{ $errors->first('password') }}</p>
            @endif
        </div>

        <div class="row">
            <input type="checkbox" name="remember" id="remember">
            <label for="remember-me">Remember Me:</label>
        </div>

        <a href="{{ route('password.request') }}">Forgot Password</a>

        <button type="submit" class="border-2 rounded-xl w-40 h-12 border-red-500 text-gray-600 
    hover:bg-madder hover:text-snow transform hover:scale-125 transition hover:ease-in-out">
            Login
        </button>
    </form>
    </div>
</x-layout>