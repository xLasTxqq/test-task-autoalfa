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
    book: Array,
});

const stars = [1,2,3,4,5];

const formStars = useForm({
    stars: props.book.grades[0]?.stars,
    book_id: props.book.id
});

const submitStars = () => {
    formStars.post(route('grade.store'));
};

const formComment = useForm({
    text: '',
    book_id: props.book.id
});

const submitComment = () => {
    formComment.post(route('comment.store'));
};

</script>

<template>

    <Head title="Book" />
    <AuthenticatedLayout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Book</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                    <div class="mt-4 max-w-2xl p-6 mx-auto space-y-6 text-center">
                        <h2 class="text-xl">{{ props.book.name }}</h2>
                        <h2 class="text-lg">{{ props.book.genres.name }}</h2>
                        <h2 class="text-lg">{{ props.book.publishers.name }}</h2>
                        <h2 class="text-lg">{{ props.book.authors.name }}</h2>
                        <h2 class="text-base font-bold">Stars: {{ Number(props.book.grades_avg_stars ?? 0).toFixed(2) }}</h2>
                    </div>

                    <div class="mt-4 max-w-2xl p-6 mx-auto space-y-6">
                        <InputLabel for="grades" value="Grades" />

                        <Dropdown @change="submitStars" id="grades" v-model="formStars.stars" required
                            autocomplete="grades" :options="stars"
                            :class="{ 'p-invalid': formStars.errors.stars }"
                            class="mt-1 w-full mx-auto border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                        </Dropdown>

                        <InputError class="mt-2" :message="formStars.errors.stars" />

                    </div>

                    <form @submit.prevent="submitComment" class="max-w-2xl p-6 mx-auto space-y-6">
                        <div>
                            <InputLabel for="comment" value="Comment" />

                            <TextInput id="comment" type="text" class="mt-1 block w-full" v-model="formComment.text"
                                required autofocus autocomplete="comment" />

                            <InputError class="mt-2" :message="formComment.errors.text" />
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <PrimaryButton class="ml-4" :class="{ 'opacity-25': formComment.processing }"
                                :disabled="formComment.processing">
                                Create
                            </PrimaryButton>
                        </div>
                    </form>
                    
                    <div class="mt-4 max-w-2xl p-6 mx-auto space-y-6">
                        <template v-for="comment in props.book.comments">
                            <h2 class="text-sm italic font-bold">{{ comment.user.name }}</h2>
                            <h2 class="text-lg">{{ comment.text }}</h2>
                        </template>
                    </div>


                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
