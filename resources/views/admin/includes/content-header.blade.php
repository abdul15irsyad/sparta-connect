<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="font-weight-bold m-0">{{ $title }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    @foreach ($breadcrumbs as $breadcrumb)
                        <li class="breadcrumb-item {{ $breadcrumb['status'] }}">
                            @if ($breadcrumb['status'] != 'active')
                                <a href="{{ $breadcrumb['link'] }}">{{ $breadcrumb['text'] }}</a>
                            @else
                                {{ $breadcrumb['text'] }}
                            @endif
                        </li>
                    @endforeach
                </ol>
            </div>
        </div>
    </div>
</div>
