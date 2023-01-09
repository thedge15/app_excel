<template>
    <div >
        <div class="flex justify-center">
            <form>
                <input @change="setExcel" type="file" ref="file" class="hidden">
                <button @click.prevent="selectExcel" type="button" class="text-gray-900 bg-gradient-to-r from-lime-200 via-lime-400 to-lime-500 hover:bg-gradient-to-br
                focus:ring-4 focus:outline-none focus:ring-lime-300 dark:focus:ring-lime-800 font-medium rounded-lg text-sm
                px-5 py-2.5 text-center mr-2 mb-2">Excel
                </button>
            </form>
            <div v-if="file" class="ml-4">
                <button @click.prevent="importExcel" type="button" class="text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none
                focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2
                mb-2">Import</button>
            </div>
        </div>
    </div>
</template>

<script>
import MainLayout from "@/Layouts/MainLayout.vue";

export default {
    name: "Import",

    layout: MainLayout,

    data() {
        return {
            file: null,
        }
    },

    methods: {
        selectExcel() {
            this.$refs.file.click()
        },

        setExcel(e) {
            this.file = e.target.files[0]
        },

        importExcel() {
            const formData = new FormData
            formData.append('file', this.file)
            this.$inertia.post('/projects/import', formData)
        },
    },
}
</script>

<style scoped>

</style>
