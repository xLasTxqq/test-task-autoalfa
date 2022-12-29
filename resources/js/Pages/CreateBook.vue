<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/inertia-vue3';
import Dropdown from "primevue/dropdown";

const props = defineProps({
    authors: Array,
    publishers: Array,
    genres: Array,
});

const form = useForm({
    author_id: '',
    publisher_id: '',
    genre_id: '',
    name: ''
});

const submit = () => {
    form.post(route('book.store'));
};
</script>

<template>

    <Head title="Book create" />
    <AuthenticatedLayout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Book create</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <form @submit.prevent="submit" class="max-w-2xl p-6 mx-auto space-y-6">
                        <div>
                            <InputLabel for="name" value="Name" />

                            <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required
                                autofocus autocomplete="name" />

                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>

                        <div class="mt-4">
                            <InputLabel for="author" value="Author" />

                            <Dropdown id="author" v-model="form.author_id" required autocomplete="author" optionLabel="name"
                                optionValue="id" :options="props.authors" :class="{ 'p-invalid': form.errors.author_id }"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            </Dropdown>
                            
                            <InputError class="mt-2" :message="form.errors.author_id" />
                        </div>

                        <div class="mt-4">
                            <InputLabel for="genre" value="Genre" />

                            <Dropdown id="genre" v-model="form.genre_id" required autocomplete="genre" optionLabel="name"
                                optionValue="id" :options="props.genres" :class="{ 'p-invalid': form.errors.genre_id }"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            </Dropdown>
                            
                            <InputError class="mt-2" :message="form.errors.genre_id" />
                        </div>

                        <div class="mt-4">
                            <InputLabel for="publisher" value="Publisher" />

                            <Dropdown id="publisher" v-model="form.publisher_id" required autocomplete="publisher" optionLabel="name"
                                optionValue="id" :options="props.publishers" :class="{ 'p-invalid': form.errors.publisher_id }"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            </Dropdown>
                            
                            <InputError class="mt-2" :message="form.errors.publisher_id" />

                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing">
                                Create
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
