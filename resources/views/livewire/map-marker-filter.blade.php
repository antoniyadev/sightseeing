<div>
  <select id="filterId" onchange="filterChange( this )">
      <option>Select an Area</option>
      @foreach( $options as $opt )
          <option value="{{ $opt['id'] }}">
          {{ $opt['label'] }}
          </option>
      @endforeach
    </select>
  </div>
  <script>
    function filterChange( objVal ){
        let filterId = objVal.value;
        let coords = Object.keys(markers);
        console.log( coords );
        @this.filterMarkers( filterId, coords );
    }
  </script>