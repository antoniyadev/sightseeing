
    <div class="shadow-xl card bg-base-100">
        <figure><img src="{{asset('images/sights/'.$sight?->coverImage?->filename)}}" alt="{{$sight->title}}" /></figure>
        <div class="card-body">
          <h2 class="card-title">
            <a href="{{route('sights.show', $sight)}}">{{$sight->title}}</a>
            <div class="badge badge-secondary">{{$sight->category->title}}</div>
          </h2>
          {{$slot}}
          <div class="justify-end card-actions">
            <div class="badge badge-outline">Buy ticket</div> 
            <div class="badge badge-outline">See more</div>
          </div>
        </div>
      </div>
