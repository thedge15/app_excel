<template>
    <div>
        <div v-if="projects" class="overflow-x-auto">
            <div
                class="bg-gray-100 flex items-center justify-center bg-gray-100 font-sans overflow-auto">
                <div class="w-full">
                    <div class="bg-white shadow-md rounded my-6">
                        <table class="min-w-max w-full table-auto">
                            <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-center">Id</th>
                                <th class="py-3 px-6 text-center">Type</th>
                                <th class="py-3 px-6 text-center">Title</th>
                                <th class="py-3 px-6 text-center">Creation date</th>
                                <th class="py-3 px-6 text-center">Signing the contract</th>
                                <th class="py-3 px-6 text-center">Deadline</th>
                                <th class="py-3 px-6 text-center">Chain stores</th>
                                <th class="py-3 px-6 text-center">Has outsource</th>
                                <th class="py-3 px-6 text-center">Has investors</th>
                                <th class="py-3 px-6 text-center">Delivery on time</th>
                                <th class="py-3 px-6 text-center">Worker count</th>
                                <th class="py-3 px-6 text-center">Service count</th>
                            </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm font-light">
                            <tr v-for="project in projects.data"
                                class="border-b border-gray-200 bg-gray-50 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left">
                                    <div class="text-center">
                                        <span class="font-medium">{{ project.id }}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-left">
                                    <div class="flex items-center">
                                        <span>{{ project.type.title }}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex items-center justify-center">
                                        {{ project.title }}
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex items-center justify-center">
                                        {{ project.creation_date }}
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex items-center justify-center">
                                        {{ project.signing_the_contract }}
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex items-center justify-center">
                                        {{ project.deadline }}
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-left">
                                    <div class="text-center">
                                        <span class="font-medium">{{ project.chain_stores }}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-left">
                                    <div class="flex items-center">
                                        <span>{{ project.has_outsource }}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex items-center justify-center">
                                        {{ project.has_investors }}
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex items-center justify-center">
                                        {{ project.delivery_on_time }}
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex items-center justify-center">
                                        {{ project.worker_count }}
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex items-center justify-center">
                                        {{ project.service_count }}
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="flex justify-center">
                <Pagination :meta="projects.meta"></Pagination>
            </div>
        </div>
    </div>
</template>

<script>

import MainLayout from "@/Layouts/MainLayout.vue";
import Pagination from "@/Components/Pagination.vue";

export default {
    name: "Index",

    layout: MainLayout,

    components: {
        Pagination
    },

    props: [
        'projects'
    ]
}
</script>

<style scoped>

</style>
