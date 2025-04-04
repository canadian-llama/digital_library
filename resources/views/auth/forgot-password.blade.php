<x-layout>
    <form action="{{ route('password.email') }}" method="post">
        @csrf
        <input type="email" name="email" id="email" value="{{ old('email') }}">
        <button type="submit" class="btn">Get Reset Password Link</button>
    </form>
</x-layout>