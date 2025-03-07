<x-layout>
    <form action="{{ route('register') }}" method="post" class="form">

        @csrf

        <h2>Register</h2>

        <div class="row">
            <label for="name">Full name:</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}">

            @if ($errors->has('name'))
            <p class="text-red-500 text-xs italic">{{ $errors->first('name') }}</p>
            @endif
        </div>

        <div class="row">
            <label for="name">Username:</label>
            <input type="text" name="username" id="username" value="{{ old('username') }}">

            @if ($errors->has('name'))
            <p class="text-red-500 text-xs italic">{{ $errors->first('username') }}</p>
            @endif
        </div>

        <div class="row">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}">
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
            <label for="password_confirmation">Confirm Password:</label>
            <input type="password" name="password_confirmation" id="password_confirmation">
        </div>

        <div class="row">
            <label for="role">Role:</label>
            <select name="role" id="role">
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>
        </div>

        <button type="submit" class="btn">Register</button>


    </form>
</x-layout>