window.addEventListener("load", addElements);

var animal = '{"Animal":['+
  '{"nom":"Green Lantern", "desc":"Un bonhomme vert", "pays":"Iles Fidji", "photo":"greenlantern.png"},'+
  '{"nom":"Prometheus", "desc":"Un film bizarre", "pays":"Vastayas", "photo":"prometheus.png"},'+
  '{"nom":"Star Wars", "desc":"Des baguettes magiques lumineuses", "pays":"France", "photo":"starwars.png"},'+
  '{"nom":"Avatar", "desc":"Des shtroumpfs volants", "pays":"France", "photo":"avatar.png"},'+
  '{"nom":"Batman", "desc":"Un rat qui saute", "pays":"Sénégal", "photo":"batman.png"},'+
  '{"nom":"Le Voyage de Chihiro", "desc":"Une héroine kawaii", "pays":"Drôme", "photo":"levoyagedechihiro.png"},'+
  '{"nom":"OSS 117", "desc":"Un film venimeux", "pays":"La Creuse", "photo":"oss117.png"}'+
']}';

var lesAnimaux = JSON.parse(animal);

function addElements () {
  var table = document.getElementById('lesfilms');
  for (i = 0; i < lesAnimaux.Animal.length; i++) {
    var tr = document.createElement("tr");
    table.appendChild(tr);
    // nom
    var td = document.createElement("td");
    var tdText = document.createTextNode(lesAnimaux.Animal[i].nom);
    td.appendChild(tdText);
    tr.appendChild(td);
    // desc
    td = document.createElement("td");
    tdText = document.createTextNode(lesAnimaux.Animal[i].desc);
    td.appendChild(tdText);
    tr.appendChild(td);
    // pays
    td = document.createElement("td");
    tdText = document.createTextNode(lesAnimaux.Animal[i].pays);
    td.appendChild(tdText);
    tr.appendChild(td);
    // photo
    td = document.createElement("td");
    img = document.createElement("img");
    img.src = (lesAnimaux.Animal[i].photo);
    tr.appendChild(td);
    td.appendChild(img);
    // bt
    td = document.createElement("td");
    var button = document.createElement("button");
    button.type = "button";
    buttonText = document.createTextNode("Découvrir");
    button.appendChild(buttonText);
    tr.appendChild(td);
    td.appendChild(button);
  }
}
