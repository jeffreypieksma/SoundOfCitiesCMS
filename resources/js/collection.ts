import axios from 'axios'

interface Collection {
    title: string
    description: string
    location: string
}

function getCollection(object: Collection){
    console.log(object.title);
}

function storeCollection(event){
    event.preventDefault()
    let object = {
        title: (<HTMLInputElement>document.getElementById('title')).value,
        description: (<HTMLInputElement>document.getElementById('description')).value,
        location: (<HTMLInputElement>document.getElementById('location')).value
    }

    getCollection(object);
}

// let save_button = document.getElementById('save-collection')
// save_button.onclick = function(event){
//     event.preventDefault()

   

//     const api = axios.create({baseURL: 'http://soundofcitiescms.test'})
//     api.post('/collection/create', {
//         object
//     })
//     .then(res => {
//         console.log(res)
//     })
//     .catch(error => {
//         console.log(error)
//     })

// };