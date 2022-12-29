<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const passwordInput = ref(null);

const props = defineProps({
    url: String,
    name: String
});

const form = useForm({
    name: '',
});

const create = () => {
    form.post(props.url, {
        onFinish: () => form.reset('name')
    });
};
</script>

<template>

    <Head title="Create {{ props.name }}" />
    <AuthenticatedLayout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Create {{ props.name }}</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                    <form @submit.prevent="create" class="max-w-2xl p-6 mx-auto space-y-6">

                        <div>
                            <InputLabel for="name" value="name" />

                            <TextInput id="name"  v-model="form.name" type="text"
                                class="mt-1 block w-full" autocomplete="name" />

                            <InputError :message="form.errors.password" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4">
                            <PrimaryButton :disabled="form.processing">Create</PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</AuthenticatedLayout>
</template>
