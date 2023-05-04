<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ToggleButton from "@/Components/ToggleButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import {Head, useForm,} from '@inertiajs/vue3';
import {defineProps, onBeforeMount, onMounted} from "vue";

defineProps({
    students: {
        type: Array,
    }
});
const form = new useForm({
    id:'',
});
const deleteStudent = (val) => {
    form.id = val;
    let new_student_list = form.delete(route('student.delete'));
}

const edit = (val) => {
    form.id = val;
    form.get(route('student.edit'));
}

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">View All Students</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 font-bold text-lg">Saved Students</div>
                    <div class="relative overflow-x-auto p-4">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Id
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Student Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Student Image
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Student Age
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                                v-for="student in students">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{student['id']}}
                                </th>
                                <td class="px-6 py-4">
                                    {{student['student_name']}}
                                </td>
                                <td class="px-6 py-4">
                                    <img :src="student['student_image']" alt="Student image" class="w-20">

                                </td>
                                <td class="px-6 py-4">
                                    {{student['student_age']}}
                                </td>
                                <td class="px-6 py-4">
                                    <ToggleButton
                                        @toggle="ontoggle()"
                                        :checked="student['student_status']"
                                        :student_id="student['id']"
                                    />
                                </td>
                                <td class="px-6 py-4">
                                    <SecondaryButton
                                        class="m-1"
                                        @click="edit(student['id'])">Edit</SecondaryButton>
                                    <DangerButton
                                        class="m-1"
                                        @click="deleteStudent(student['id'])">Delete</DangerButton>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
