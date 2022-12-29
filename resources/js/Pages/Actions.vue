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
import { FilterMatchMode } from "primevue/api";
import { ref } from 'vue';
import Menu from "primevue/menu";
import InputText from "primevue/inputtext";

const props = defineProps({
    actions: Array,
    user: Array
});
const deleteItem = (data) => {
    if (confirm(`Do you want to delete booking ${data.id}?`))
        useForm().delete(route("action.destroy", data.id));
}

const giveBook = (data) => {
    if (confirm(`Do you want to give book to action ${data.id}?`))
        useForm().put(route("action.update", data.id));
}

const takeBook = (data) => {
    if (confirm(`Do you want to take book from action ${data.id}?`))
        useForm().delete(route("action.destroy", data.id));
}

const filters = ref({
    'book.name': {
        value: null,
        matchMode: FilterMatchMode.CONTAINS,
    },
    'book.genres.name': {
        value: null,
        matchMode: FilterMatchMode.CONTAINS,
    },
    'book.publishers.name': {
        value: null,
        matchMode: FilterMatchMode.CONTAINS,
    },
    'book.authors.name': {
        value: null,
        matchMode: FilterMatchMode.CONTAINS,
    },
    'status.name': {
        value: null,
        matchMode: FilterMatchMode.CONTAINS,
    }
});

</script>

<template>

    <Head title="Actions" />
    <AuthenticatedLayout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Actions</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <DataTable :value="props.actions" :rows="10" sortMode="multiple" filterDisplay="menu"
                        :loading="loading"
                        :globalFilterFields="['id', 'book.name', 'book.genres.name', 'book.publishers.name', 'book.authors.name', 'status.name']"
                        v-model:filters="filters" removable-sort paginator>
                        <Column header="#" field="id"></Column>
                        <Column header="Book name" field="book.name" :sortable="true">
                            <template #filter="{ filterModel, filterCallback }">
                                <InputText type="text" v-model="filterModel.value" @keydown.enter="filterCallback()"
                                    class="p-column-filter"
                                    :placeholder="`Search by name - ${filterModel.matchMode}`" />
                            </template>
                        </Column>
                        <Column header="Book genre" field="book.genres.name" :sortable="true">
                            <template #filter="{ filterModel, filterCallback }">
                                <InputText type="text" v-model="filterModel.value" @keydown.enter="filterCallback()"
                                    class="p-column-filter"
                                    :placeholder="`Search by name - ${filterModel.matchMode}`" />
                            </template>
                        </Column>
                        <Column header="Book publisher" field="book.publishers.name" :sortable="true">
                            <template #filter="{ filterModel, filterCallback }">
                                <InputText type="text" v-model="filterModel.value" @keydown.enter="filterCallback()"
                                    class="p-column-filter"
                                    :placeholder="`Search by name - ${filterModel.matchMode}`" />
                            </template>
                        </Column>
                        <Column header="Book author" field="book.authors.name" :sortable="true">
                            <template #filter="{ filterModel, filterCallback }">
                                <InputText type="text" v-model="filterModel.value" @keydown.enter="filterCallback()"
                                    class="p-column-filter"
                                    :placeholder="`Search by name - ${filterModel.matchMode}`" />
                            </template>
                        </Column>
                        <Column header="Status" field="status.name" :sortable="true">
                            <template #filter="{ filterModel, filterCallback }">
                                <InputText type="text" v-model="filterModel.value" @keydown.enter="filterCallback()"
                                    class="p-column-filter"
                                    :placeholder="`Search by name - ${filterModel.matchMode}`" />
                            </template>
                        </Column>
                        <Column>
                            <template #body="{ data }">
                                <div class="flex space-x-2">
                                    <!-- <Button label="Update book"
                                        class="p-button-sm p-button-secondary p-button-outlined"
                                        @click="$inertia.visit(route('book.edit',data.id))" /> -->
                                    <!-- <Button label="Ответы" class="p-button-sm p-button-info p-button-outlined" 
                                    @click="$inertia.visit(route('surveys.responses.index', data.id))" /> -->
                                    <!-- <Link :href="route('users.update',data.id)" class="p-button-sm p-button-danger p-button-outlined"></Link>       -->
                                    <Button label="Give book" class="p-button-sm p-button-warning p-button-outlined"
                                        @click="giveBook(data)" />
                                    <Button label="Take book" class="p-button-sm p-button-warning p-button-outlined"
                                        @click="takeBook(data)" />
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
