import axios from 'axios'

//https://www.typescriptlang.org/docs/handbook/interfaces.html

interface Collection {
    title?: string;
    description?: string;
    location?: string;
}

let save_collection = document.getElementById('save-collection');

save_collection.onclick = function(event){
    event.preventDefault();

    let title = (<HTMLInputElement>document.getElementById('title')).value
    let description = (<HTMLInputElement>document.getElementById('description')).value
    let location = (<HTMLInputElement>document.getElementById('location')).value

    const api = axios.create({baseURL: 'http://soundofcitiescms.test'})
    api.post('/collection/post', {
        title: title,
        description: description,
        location: location
    })
    .then(res => {
        console.log(res)
    })
    .catch(error => {
        console.log(error)
    })

};

function storeData(data: any){


}