<div class="alert alert-{{ $type }} {{ $dismissible ? 'alert-dismissible' : '' }} text-sm {{ $class ?? '' }} fade show"
    role="alert">
    <span>{{ $message }}</span>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
