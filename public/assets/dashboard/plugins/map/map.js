class MapInput{
    constructor(id, center, zoom, type){
        this.map = new L.map(id, {
            center: center,
            zoom : zoom,
            maxZoom : 19
        });
        this.id = id;
        this.markers = [];
    
        // let layer = new L.TileLayer('https://a.tile.openstreetmap.org/{z}/{x}/{y}.png');
        let layer = new L.TileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
        this.map.addLayer(layer);


        let AMM = this.addMultipleMarker
        let ASM = this.addSingleMarker
        let obj = this
        if(type == 'multiple'){
            this.map.on('click', function (e) { 
                AMM(obj, e)
            })
        }
        else if(type == 'single'){
            this.map.on('click', function (e) { 
                ASM(obj, e)
            })
        }
    
    }
    
    oldMarkers(oldLocation){
        if($.isArray(oldLocation)){
            let obj = this
            oldLocation.forEach(element => {

                var marker = L.marker(element).addTo(this.map).on('click', function(){
                    obj.map.removeLayer(marker);
      
                    let temp = []
                    obj.markers.forEach(e => {
                        if(e['_latlng'].lat != marker['_latlng'].lat || e['_latlng'].lng != marker['_latlng'].lng){
                            temp.push(e)
                        }
                    });
                    obj.markers = temp;
    
                    let newMarkers = []
                    obj.markers.forEach(e => {
                        newMarkers.push(e['_latlng'])
                    });
                    document.querySelector('.'+obj.id).value = JSON.stringify(newMarkers);
                });;
                this.markers.push(marker);
            });
        }else if(typeof(oldLocation) == 'object'){
            var marker = L.marker(oldLocation).addTo(this.map);
            this.markers.push(marker);
        }
    }

    addSingleMarker(obj, e){
        obj.markers.forEach(element => {
        obj.map.removeLayer(element);
        });
        var marker = new L.marker(e.latlng).addTo(obj.map);
        obj.markers.push(marker);

        let latlang = {lat : e.latlng.lat, lng : e.latlng.lng};
        document.querySelector('.'+obj.id).value = JSON.stringify(latlang);       
    }
    addMultipleMarker(obj, e){

        var marker = new L.marker(e.latlng).addTo(obj.map).on('click', function(){
                obj.map.removeLayer(marker);
  
                let temp = []
                obj.markers.forEach(element => {
                    if(element['_latlng'].lat != marker['_latlng'].lat || element['_latlng'].lng != marker['_latlng'].lng){
                        temp.push(element)
                    }
                });
                obj.markers = temp;

                let newMarkers = []
                obj.markers.forEach(element => {
                    newMarkers.push(element['_latlng'])
                });
                document.querySelector('.'+obj.id).value = JSON.stringify(newMarkers);
            });
        obj.markers.push(marker);
        let newMarkers = []
        obj.markers.forEach(element => {
            newMarkers.push(element['_latlng'])
        });
        document.querySelector('.'+obj.id).value = JSON.stringify(newMarkers);
    }
    
    
}