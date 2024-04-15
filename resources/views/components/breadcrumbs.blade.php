<div class="text-sm breadcrumbs" {{$attributes}}>
        <ul>
            <li><a href="/">Home</a></li>
            
            @foreach ($links as $label => $href)
            <li><a href="{{$href}}">{{$label}}</a></li>
            @endforeach
           
        </ul>
</div>

