import axios from "axios"

function list(page,quantity)
{
    return axios.get('api/developer?p='+page+'&q='+quantity)
}

function get(id){
    return axios.get('api/developer/'+id)
} 

function create(data)
{
    return axios.post('api/developer',data)
}

function edit(data)
{
    return axios.put('api/developer/'+data.id,data)
}

function del(id)
{
    return axios.delete('api/developer/'+id)
}

export default {
    list,
    get,
    create,
    edit,
    del
}