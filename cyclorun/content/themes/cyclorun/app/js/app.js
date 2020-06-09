var app = {
  init: function() {
    console.log('init');

    let latitude = Number(document.getElementById('map').dataset.lat);
      console.log(latitude);
    let longitude = Number(document.getElementById('map').dataset.lgt);
      console.log(longitude);
    var map;
    function initMap() {
      map = new google.maps.Map(document.getElementById('map'), {
        center: {lat:latitude, lng:longitude},
        zoom: 14
      });
    }
  }
    
};
$(app.init);



