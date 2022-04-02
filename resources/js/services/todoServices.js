import axios from 'axios';

const URL = 'api/todos';

export const todoServices = {
    all: () => axios.get(URL),
    create: (data) => axios.post(URL, data),
    show: (id) => axios.get(`${URL}/${id}`),
    destroy: (id) => axios.delete(`${URL}/${id}`),
    changeStatus: (id, data) => axios.patch(`${URL}/${id}/changeStatus`, data),
};
