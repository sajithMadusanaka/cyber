<script setup>
//import { onMounted, ref } from 'vue';
import {router, useForm} from '@inertiajs/vue3'

defineProps({
    checked : {
        type: Number,
        required: true,
    },
    student_id: {
        type: Number,
        required: true,
    }
});
function setStatus(checked) {
    let status = false;
    if (checked == 1) {
        status = true;
    }
    return status;
}
const form = new useForm({
    id:'',
});
const toggle = (val) => {
    form.id = val;
    form.put(route('student.status'));
}
</script>
<template>
    <label class="relative inline-flex items-center cursor-pointer">
        <input type="checkbox" class="sr-only peer"
               :checked="setStatus(checked)"
               @change="toggle(student_id)">
        <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
        <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300"></span>
    </label>
</template>

