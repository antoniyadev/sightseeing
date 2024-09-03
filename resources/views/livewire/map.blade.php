<div id="googleMap" style="width:100%;height:400px;">
    <script>
        function myMap() {
            const latLng = new google.maps.LatLng({{$this->lat}},{{$this->lng}})
            const mapProp = {
            center: latLng,
            zoom:18,
            };
            const map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
            const marker = new google.maps.Marker({position: latLng});

            marker.setMap(map);
        }
    </script>
        
    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('app.googleMapsApiKey')}}&callback=myMap"></script>
</div>