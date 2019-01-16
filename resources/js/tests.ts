function Zone (id, type, coords, center_point, radius) {
    this.id =  id
    this.type = type
    this.coords = coords
    this.center_point = center_point
    this.radius = radius
}

class ZoneCreator {

    drawZone (zone : any) : String {
        return zone.coords.length     
    }
    
    drawCircleZone (zone : any) : String {
        return zone.coords.length       
    }

    drawPolyZone (zone : any) : String {
        return zone.coords.length
    }
}

let zoneCreator = new ZoneCreator ();

const circleCoords = new Array(
    {'lat': '53.21061991910329', 'lng': '5.702758220639979'}
 );

const polyCoords = new Array(
   {'lat': '53.21061991910329', 'lng': '5.702758220639979'},
   {'lat': '53.21051704917011', 'lng': '5.733996253312515'},
   {'lat': '53.20188619560709', 'lng': '5.731593310342751'},
);

let circleZone = new Zone(1, 'circle', circleCoords, '53.21061991910329', 302323)
let polyZone = new Zone(2, 'polygon', polyCoords, '', '')

function assertTrue (isSuccess : Boolean, message: String) {
    if (!isSuccess) {
        console.error ("Test not succeed: " + message);
    }
}

//assertTrue must be true to succeed test
assertTrue (zoneCreator.drawCircleZone (circleZone) == '1', "Should return 1s")
assertTrue (zoneCreator.drawPolyZone (polyZone) == '3', "Should return 3")

console.log ("Tests executed")