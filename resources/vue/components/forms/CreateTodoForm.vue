<template>
    <div class="flex flex-col gap-2">
        <div class="relative flex flex-col items-center">
            <h2 class="z-10 bg-gray-200 px-4 text-xl text-gray-500">Create</h2>
            <hr class="absolute top-3 w-full border-2 border-gray-500" />
        </div>
        <div class="flex gap-2">
            <input
                v-model="title"
                class="rounded focus:border-gray-500 focus:ring-gray-500"
                type="text"
                placeholder="ToDo Name"
            />
            <button @click="createTodo" class="btn btn-primary">Create</button>
        </div>
        <textarea
            class="rounded focus:border-gray-500 focus:ring-gray-500"
            v-model="description"
            cols="30"
            rows="2"
            placeholder="Description"
        ></textarea>
    </div>
</template>

<script>
import { ref } from 'vue';
import { todoServices } from '../../../js/services/todoServices';
import { actions } from '../../store';

export default {
    setup() {
        const title = ref(null);
        const description = ref(null);

        const createTodo = async () => {
            await todoServices.create({ title: title.value, description: description.value });
            actions.refreshToDos();
            title.value = null;
            description.value = null;
        };

        return { title, description, createTodo };
    },
};
</script>
