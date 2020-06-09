var app = {
  init: function() {
    console.log('init');

    llet latitude = Number(document.getElementById('map').dataset.lat);
    console.log(latitude);
let longitude = Number(document.getElementById('map').dataset.lgt);
    console.log(longitude);
    var map;
    function initMap() {
      map = new google.maps.Map(document.getElementById('map'), {
        center: {lat:latitude, lng:longitude},
        zoom: 17,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        scrollwheel: false,
      });
      var marker = new google.maps.Marker({
    // Nous définissons sa position (syntaxe json)
    position: {lat: latitude, lng: longitude},
    // Nous définissons à quelle carte il est ajouté
    map: map
});
    }
    window.onload = function(){
      // Fonction d'initialisation qui s'exécute lorsque le DOM est chargé
      initMap(); 
    };
  }
    
};
$(app.init);



