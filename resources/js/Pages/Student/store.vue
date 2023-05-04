<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import FileInput from '@/Components/FileInput.vue';

import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    student_name :'',
    student_image :'',
    student_age :'',
});

const submit = () => {
    form.post(route('student.store'), {
        onSuccess: () => form.reset('student_name','student_image','student_age'),
    });
}
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Add New Student</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">Please fill all information</h2>
                        </header>
                        <form role="form" @submit.prevent="submit" class="mt-6 space-y-6" enctype="multipart/form-data">
                            <div>
                                <InputLabel for="student_name" value="Student Name" />

                                <TextInput
                                    id="student_name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.student_name"
                                    required
                                    autofocus
                                    autocomplete="student_name"
                                />

                                <InputError class="mt-2" :message="form.errors.student_name" />
                            </div>
                            <div>
                                <InputLabel for="student_image" value="Student Image" />
                                <input
                                    id="student_image"
                                    class="block w-full text-sm text-gray-500
                                  file:mr-4 file:py-2 file:px-4
                                  file:rounded-md file:border-0
                                  file:text-sm file:font-semibold
                                  file:bg-gray-800 file:text-white
                                  hover:file:bg-gray-700"
                                    type="file"
                                    @input="form.student_image = $event.target.files[0]"
                                    accept="image/png, image/gif, image/jpeg"
                                    required>
                                <InputError class="mt-2" :message="form.errors.student_image" />
                            </div>
                            <div>
                                <InputLabel for="student_age" value="Student Age" />
                                <TextInput
                                    id="student_age"
                                    type="number"
                                    class="mt-1 block w-full"
                                    v-model="form.student_age"
                                    required
                                    autocomplete="student_age"
                                />
                                <InputError class="mt-2" :message="form.errors.student_age" />
                            </div>
                            <div class="flex items-center gap-4">
                                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                                <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                                </Transition>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
