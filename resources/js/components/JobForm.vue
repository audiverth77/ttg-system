<template>
    <div class="max-w-xl mx-auto p-5 bg-white shadow-md rounded">
        <form @submit.prevent="submitForm">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                    Título del Trabajo
                </label>
                <input v-model="form.title" type="text"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="title" placeholder="Ingresa el título del trabajo">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                    Descripción del Trabajo
                </label>
                <!-- <textarea v-model="form.description" id="description" rows="4"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    placeholder="Describe los detalles del trabajo aquí.">
                </textarea> -->
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="state">
                    Estado
                </label>
                <select v-model="form.state"
                    class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="state">
                    <option value="available">Disponible</option>
                    <option value="closed">Cerrado</option>
                </select>
            </div>

            <button
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                type="submit">
                Publicar
            </button>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            form: {
                title: '',
                state: 'available',
            },
        };
    },
    methods: {
        submitForm() {
            console.log(this.form);
        },
    },
};
</script>