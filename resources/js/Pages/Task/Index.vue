<template>
    <div v-if="tasks" class="overflow-x-auto">
        <div
            class="bg-gray-100 flex items-center justify-center bg-gray-100 font-sans overflow-hidden">
            <div class="w-full lg:w-5/6">
                <div class="bg-white shadow-md rounded my-6">
                    <table class="min-w-max w-full table-auto">
                        <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-center">Project</th>
                            <th class="py-3 px-6 text-center">User</th>
                            <th class="py-3 px-6 text-center">File</th>
                            <th class="py-3 px-6 text-center">Status</th>
                            <th class="py-3 px-6 text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                        <tr v-for="task in tasks.data" class="border-b border-gray-200 bg-gray-50 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left">
                                <div class="flex items-center">
                                    <div class="mr-2">
                                        <img class="w-6 h-6"
                                             src="https://cdn3.iconfinder.com/data/icons/popular-services-brands/512/laravel-64.png"/>
                                    </div>
                                    <span class="font-medium">Laravel Project</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-left">
                                <div class="flex items-center">
                                    <div class="mr-2">
                                        <img class="w-6 h-6 rounded-full"
                                             src="https://randomuser.me/api/portraits/men/4.jpg"/>
                                    </div>
                                    <span>{{ task.user.name }}</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex items-center justify-center">
                                    {{ task.file.path }}
                                </div>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <span
                                    :class="['py-1 px-3 rounded-full text-xs', task.status === '???????????? ??????????????' ?
                                    'bg-red-200 text-red-600' : 'bg-green-200 text-green-600']">{{task.status}}</span>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center">
                                    <div v-if="task.failed_rows_count > 0" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        <Link :href="route('task.failed_list', task.id)">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                        </Link>
                                    </div>
                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="flex justify-center bg-gray-100">
            <Pagination :meta="tasks.meta"></Pagination>
        </div>
    </div>
</template>

<script>

import MainLayout from "@/Layouts/MainLayout.vue";
import {Link} from "@inertiajs/inertia-vue3";
import Pagination from "@/Components/Pagination.vue";

export default {
    name: "Index",

    layout: MainLayout,

    components: {
        Link,
        Pagination
    },

    props: [
        'tasks',
    ],


}
</script>

<style scoped>

</style>
