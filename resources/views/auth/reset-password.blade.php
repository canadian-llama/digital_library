<x-layout>

    <form action="{{ route('password.update') }}" method="post">
        @csrf
        <input type="text" name="token" id="token" hidden value="{{ $token }}">
        <label for="">Email:</label>
        <input type="email" name="email" id="email">

        <label for="">Password:</label>
        <input type="password" name="password" id="password">

        <label for="">Password Confirmation:</label>
        <input type="password" name="password_confirmation" id="password_confirmation">
        <button type="submit"> Submit </button>
    </form>
</x-layout>