@if(!empty($breadcrumbs))
    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            @foreach($breadcrumbs as $key => $item)
                @if($key != count($breadcrumbs) -1)
                    <li class="breadcrumb-item"><a href="{{ $item['page'] ?? '' }}">{{ $item['title'] ?? ''}}</a></li>
                @else
                    <li class="breadcrumb-item active">{{ $item['title'] ?? ''}}</li>
                @endif
            @endforeach
        </ol>
    </div>
@endif
