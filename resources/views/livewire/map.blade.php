<div>
    <div 
    wire:ignore id="map" 
    style="width:100%;height:400px;">
    </div>
    <script>
        /* Add Inline Google Auth Boostrapper here */
     
  (g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})({
    key: "{{env('GOOGLE_MAPS_API_KEY')}}",
    v: "weekly",
    // Use the 'v' parameter to indicate the version to use (weekly, beta, alpha, etc.).
    // Add other bootstrap parameters as needed, using camel case.
  });
        /* How to initialize the map */
        let map;
        let markers = {}; 

        async function initMap() {
            const { Map } = await google.maps.importLibrary("maps");
            map = new Map(document.getElementById("map"), {
                    zoom: 4,
                    center: { lat: @js( $lat ), lng: @js( $lng ) },
                    mapId: "DEMO_MAP_ID",
            });
            map.addListener("click", (mapsMouseEvent) => {
            // Get coordinates 
            let coord = mapsMouseEvent.latLng.toJSON();

            // Generate id based on lat lng to record marker
            let id = coord.lat.toString()+coord.lng.toString();

            // Add Marker to coordinate clicked on, identified by id
            markers[id] = new google.maps.Marker({
                position: mapsMouseEvent.latLng,
                map,
                title: "Re-Click to Delete",
            });

            // Delete marker on re-click
            markers[id].addListener("click", () => {
                markers[id].setMap(null);
                delete markers.id;
            });
        });
        }

        /* Initialize map when Livewire has loaded */
        document.addEventListener('livewire:init', function () { 
            initMap();
        });
        
        // Listen to location update from search box
        window.addEventListener('updatedMapLocation',function(e){
            console.log(e.detail);
            // Defer set lat long values of component
            // @this.set( 'lat', e.detail.lat, true);
            // @this.set( 'lng', e.detail.lng, true);

            // // Translate to Google coord
            // let coord = new google.maps.LatLng(e.detail.lat, e.detail.lng);

            // // Re-center map
            // map.setCenter( coord );
        });

        /* Listen to location update from search box */
        window.addEventListener('removeMarkers',function(e){
            // Delete each coordinate by id
            for( i in e.detail.coords ){
                let id = e.detail.coords[i];
                markers[id].setMap(null);
                delete markers[id];
            }
        });
    </script>
</div>