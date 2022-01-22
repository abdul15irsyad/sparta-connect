<div
    class="alert alert-default-{{ $type }} {{ $dismissible ? 'alert-dismissible' : '' }} text-sm {{ $class ?? '' }}">
    <button type="button" class="close source-sans-pro" data-dismiss="alert" aria-hidden="true">×</button>
    <span>{{ $message }}</span>
</div>
