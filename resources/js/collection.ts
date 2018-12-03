import axios from 'axios'

interface Collection {
    title: string
    description: string
    image_url: string
}

function getCollection(object: Collection){
    console.log(object.title);
}

function storeCollection(event){
    event.preventDefault()
    
    //getCollection(object);
}

let save_button = document.getElementById('store-collection')
save_button.onclick = function(event){
    event.preventDefault()

    let data = {
        title: (<HTMLInputElement>document.getElementById('title')).value,
        description: (<HTMLInputElement>document.getElementById('description')).value
    }

    const api = axios.create({baseURL: 'http://soundofcitiescms.test'})
    api.post('/collection/create', {
        title: data.title,
        description: data.description
    })
    .then(res => {
        console.log(res)
    })
    .catch(error => {
        console.log(error)
    })

};