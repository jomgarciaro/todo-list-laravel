<template>
    <div class="flex flex-col gap-2">
        <div class="relative flex flex-col items-center">
            <h2 class="z-10 bg-gray-200 px-4 text-xl text-gray-500">Export</h2>
            <hr class="absolute top-3 w-full border-2 border-gray-500" />
        </div>
        <div class="flex gap-2">
            <form @submit.prevent="todoExport">
                <select
                    class="rounded focus:border-gray-500 focus:ring-gray-500"
                    name="status"
                    v-model="status"
                >
                    <option value="all">Todos</option>
                    <option value="pending">Pendiente</option>
                    <option value="process">En Proceso</option>
                    <option value="completed">Completado</option>
                </select>
                <button class="ml-2 btn btn-primary">Export</button>
            </form>
        </div>

    </div>
</template>

<script>
import { ref } from 'vue';
import { todoServices } from '../../js/services/todoServices';
import { actions } from '../store';

export default {
    setup() {
        const title = ref(null);
        const description = ref(null);
        const status = ref('all')


        const todoExport = async () => {
            const urlParams = new URLSearchParams({status: status.value});
            const url = `http://localhost:8000/api/todos/export?${urlParams.toString()}`
            window.location.href = url;

            actions.refreshToDos();
        };

        return { title, description, todoExport, status };
    },
};
</script>
