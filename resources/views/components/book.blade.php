<div>
    <div class="card-header">
        <img src="{{ $attributes->get('src') }}" alt="default" class="size-20">
    </div>
    <div class="card-body">
        {{ $slot }}
    </div>
</div>