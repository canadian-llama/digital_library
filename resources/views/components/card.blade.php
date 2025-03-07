<div>
    <div class="card-header">
        <img src="{{ $attributes->get('src') }}" alt="default" class="size-20">
    </div>
    <div class="card-body">
        {{ $slot }}
    </div>
    <div class="card-footer">
        <a href="{{ $attributes->get('href') }}">View Details</a>
    </div>
</div>