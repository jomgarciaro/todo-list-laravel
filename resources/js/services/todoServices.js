import axios from 'axios';

const URL = 'api/todos';

export const todoServices = {
    all: () => axios.get(URL),
    create: (data) => axios.post(`${URL}/store`, data),
    show: (id) => axios.get(`${URL}/${id}/show`),
    destroy: (id) => axios.delete(`${URL}/${id}/destroy`),
    changeStatus: (id, data) => axios.patch(`${URL}/${id}/changeStatus`, data),
    export: (config) => axios.get(`${URL}/export`),
    import: (data) => axios.post(`${URL}/import`, data, { headers: {'Content-Type': 'multipart/form-data'}}),
};

