const select = document.querySelector('#driver_id');
const order_location = document.querySelector('#order_location');
const options = [];
var mylatlng = { lat: 10.5942341, lng: -67.0501904 };
var mapOptions =
{
  center: mylatlng,
  zoom: 18,
  mapTypeId: google.maps.MapTypeId.ROADMAP,
};

$(document).ready(Locations());


async function Locations() {
  let from = order_location.value;
  let to = "";

  for (var i = 0; i < select.options.length; i++) {
    var option = select.options[i];
    to = option.getAttribute('location');
    let response = await calcRoute(from, to, mapOptions);

    option.innerHTML = option.innerHTML + "(" + response.tiempo + ")";

    options[response.distancia] = {
      option: option,
      tiempo: response.tiempo,
      distancia: response.distancia
    };

    options.sortByIndex = function (a, b) {
      return a.distancia - b.distancia;
    };
  }


  options.forEach(element => {
    select.appendChild(element.option);
  });

  select.options[0].selected = true;
}

