<template>
    <li

        :class="{ 'opacity-70': todo.done }"
        class="flex cursor-pointer justify-between overflow-hidden rounded bg-white shadow-md duration-100 hover:scale-102"
    >
        <div class="flex items-center gap-4 px-4 py-2">
            <select
                name="status"
                v-model="status"
                @change="(event) => changeStatus(todo.id, event)"
            >
                <option value="pending">Pendiente</option>
                <option value="process">En Proceso</option>
                <option value="completed">Completado</option>
            </select>
            <div class="flex flex-col justify-center">
                <span :class="{ 'font-semibold text-gray-800': true, 'line-through': todo.done }">{{
                    todo.title
                }}</span>
                <Timestamp :date="todo.created_at" />
            </div>
        </div>
        <button
            @click="(event) => deleteToDo(todo, event)"
            class="flex items-center bg-red-400 px-2 hover:bg-red-700"
            title="Delete ToDo"
        >
            <TrashIcon class="h-5 text-white" />
        </button>
    </li>
</template>

<script>
import { ClockIcon, TrashIcon } from '@heroicons/vue/outline';
import Timestamp from './Timestamp.vue';
import { actions, state } from '../store';
import { TODOS } from '../../js/constants/todos';
import { todoServices } from '../../js/services/todoServices';
import {ref} from 'vue';

export default {
    props: { todo: { type: Object, required: true } },
    components: { ClockIcon, TrashIcon, Timestamp },
    setup(props) {
        const status = ref(props.todo.status);

        const showToDo = (todo) => {
            console.log('show');
            state.todoSelected = todo;
            state.modal = TODOS.SHOW;
        };

        const deleteToDo = (todo, event) => {
            event.stopPropagation();
            state.todoSelected = todo;
            state.modal = TODOS.DELETE;
        };


        const changeStatus = async (id, event) => {
            event.stopPropagation();
            console.log(status.value);
            await todoServices.changeStatus(id, {status: status.value});
            actions.refreshToDos();
        };

        return { showToDo, deleteToDo, changeStatus, status };
    },
};
</script>
