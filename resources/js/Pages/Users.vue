<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/inertia-vue3';
import Dropdown from "primevue/dropdown";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import Button from "primevue/button";

const props = defineProps({
    users: Array,
});

const deleteItem = (data) => {
    if (confirm(`Do you want to delete user: ${data.name}?`))
        useForm().delete(route("users.destroy", data.id));
}

</script>

<template>

    <Head title="Users" />
    <AuthenticatedLayout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Users</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <DataTable :value="props.users">
                        <Column header="#" field="id"></Column>
                        <Column header="Name" field="name"></Column>
                        <Column header="Email" field="email"></Column>
                        <Column>
                            <template #body="{ data }">
                                <div class="flex space-x-2">
                                    <Button label="Change password"
                                        class="p-button-sm p-button-secondary p-button-outlined"
                                        @click="$inertia.visit(route('users.edit',data.id))" />
                                    <!-- <Button label="Ответы" class="p-button-sm p-button-info p-button-outlined" 
                                    @click="$inertia.visit(route('surveys.responses.index', data.id))" /> -->
                                    <!-- <Link :href="route('users.update',data.id)" class="p-button-sm p-button-danger p-button-outlined"></Link>       -->
                                    <Button label="Delete" class="p-button-sm p-button-danger p-button-outlined"
                                        @click="deleteItem(data)" />
                                </div>
                            </template>
                        </Column>
                    </DataTable>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
