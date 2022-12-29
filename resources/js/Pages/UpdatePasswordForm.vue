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
    user_id: Int16Array,
});

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const updatePassword = () => {
    form.put(route('users.update', props.user_id), {
        onFinish: () => form.reset('password', 'password_confirmation')
    });
};
</script>

<template>

    <Head title="Update user password" />
    <AuthenticatedLayout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Update user password</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                    <form @submit.prevent="updatePassword" class="max-w-2xl p-6 mx-auto space-y-6">
                        <div>
                            <InputLabel for="password" value="New Password" />

                            <TextInput id="password" ref="passwordInput" v-model="form.password" type="password"
                                class="mt-1 block w-full" autocomplete="new-password" />

                            <InputError :message="form.errors.password" class="mt-2" />
                        </div>

                        <div>
                            <InputLabel for="password_confirmation" value="Confirm Password" />

                            <TextInput id="password_confirmation" v-model="form.password_confirmation" type="password"
                                class="mt-1 block w-full" autocomplete="new-password" />

                            <InputError :message="form.errors.password_confirmation" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4">
                            <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                            <Transition enter-from-class="opacity-0" leave-to-class="opacity-0"
                                class="transition ease-in-out">
                                <p v-if="form.recentlySuccessful" class="text-sm text-gray-600 dark:text-gray-400">
                                    Saved.</p>
                            </Transition>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</AuthenticatedLayout>
</template>
