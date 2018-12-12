//Import map and audioZone

//Constructor for all the full zones 
function Zone (id, type, coords, center_point, radius) {
    this.id =  id
    this.type = type
    this.coords = coords
    this.center_point = center_point
    this.radius = radius
}

console.log('test init')

/* Unit testing

    1st: Check if all zones are stored properly and the amount is right. 
        Store data - return the ids - count ids - compare with amount of objects. 
    2nd test: Check if the amount of coordinates are right.  
    3rd: test: Check if coordinates are stored right. 
    4th: test: Draw items on map. 
    5th: test: Delete a zone  
*/

class ZoneCreator {
    drawZone (coords : any) : String {
        return ""
    }
}

function assertTrue (isSuccess : Boolean, message: String) {
    if (!isSuccess) {
        console.error ("Test niet geslaagd: " + message);
    }
}

let zoneCreator = new ZoneCreator ();

let coords = [
    [
        lat =>	'53.21061991910329',
        lng	=> '5.702758220639979'
    ],
    [
        lat =>	'53.21051704917011',
        lng	=> '5.733996253312515'
    ],
    [
        lat =>	'53.20188619560709',
        lng	=> '5.731593310342751'
    ]
]
let circleCoords = [lat=> '	53.21061991910329', lng => '5.702758220639979']

let circleZone = new Zone(1, 'circle', circleCoords, '53.21061991910329', 302323)
//storeAudioZone(circleZone)

let polygonZone = new Zone(2, 'circle', coords, '53.21061991910329', '')
//storeAudioZone(polygonZone)

let squareZone = new Zone(3, 'circle', coords, '53.21061991910329', '')
//storeAudioZone(squareZone)

//assertTrue must be true 
assertTrue (zoneCreator.drawZone (circleZone) === "", "Should handle...")
assertTrue (zoneCreator.drawZone (polygonZone) === "", "Should handle...")
assertTrue (zoneCreator.drawZone (squareZone) === "", "Should handle...")

console.log ("All tests executed");