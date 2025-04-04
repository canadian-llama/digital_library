<x-layout>
    <h1 class="mb-4">Pls Verify your email through email we've sent</h1>
    <form action="{{ route('verification.send') }}" method="post">
        @csrf
        <button type="submit" class="btn">Send again</button>
    </form>
</x-layout>