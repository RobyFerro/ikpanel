<li class="m-t-30">
    <a href="{{ env('IKPANEL_URL') }}" class="detailed">
        <span class="title">Home</span>
    </a>
    <span class="icon-thumbnail "><i class="pg-home"></i></span>
</li>

@foreach($items as $item)
    @if(count($item->children) !== 0)
        <li>
            <a href='javascript:;'>
                <span class="title">{{ $item->name }}</span>
                <span class='arrow'></span>
            </a>
            <span class="folder-link icon-thumbnail">
                <i class="{{ $item->icon }}"></i>
            </span>
            <ul class='sub-menu'>
                @foreach ($item->children as $child)
                    <li>
                        <a href="{{env('IKPANEL_URL').''.$child->route}}" class='detailed'>
                            <span class='title'>{{$child->name}}</span>
                        </a>
                        <a href='{{ env('IKPANEL_URL').''.$child->route }}' class="sub-icon-link icon-thumbnail">
                            <i class='{{ $child->icon }}'></i>
                        </a>
                    </li>
                @endforeach
            </ul>
        </li>
    @else
        <li>
            <a href="{{ env('IKPANEL_URL').''.$item->route }}" class="detailed">
                <span class="title">{{ $item->name }}</span>
            </a>
            <span class="icon-thumbnail ">
                <i class="{{ $item->icon }}"></i>
            </span>
        </li>
    @endif
@endforeach