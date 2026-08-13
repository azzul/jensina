<div class="breadcrumb-bar">
    <nav class="breadcrumb container" aria-label="Breadcrumb">
        <ol>
            @foreach($breadcrumbs as $crumb)
                <li>
                    @if($crumb['url'])
                        <a href="{{ $crumb['url'] }}">{{ $crumb['label'] }}</a>
                    @else
                        <span aria-current="page">{{ $crumb['label'] }}</span>
                    @endif
                </li>
            @endforeach
        </ol>
    </nav>
</div>
