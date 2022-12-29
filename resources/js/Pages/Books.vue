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
import Menu from "primevue/menu";
import InputText from "primevue/inputtext";
import { FilterMatchMode } from "primevue/api";
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';

const props = defineProps({
    books: Array,
});

const deleteItem = (data) => {
    if (confirm(`Do you want to delete book: ${data.name}?`))
        useForm().delete(route("book.destroy", data.id));
}

const createBooking = (data) => {
    if (confirm(`Do you want to booking book: ${data.name}?`)) {
        useForm({ book_id: data.id, }).post(route('action.store'));
    }
}

const subscribeToBook = (data) => {
    if (confirm(`Do you want to subscribe to the book: ${data.name}?`)) {
        useForm({ book_id: data.id, }).post(route('subscribe.store'));
    }
}

const showBook = (data) => {
    Inertia.visit(route('book.show',data.data.id));
}

const filters = ref({
    'name': {
        value: null,
        matchMode: FilterMatchMode.CONTAINS,
    },
    'genres.name': {
        value: null,
        matchMode: FilterMatchMode.CONTAINS,
    },
    'publishers.name': {
        value: null,
        matchMode: FilterMatchMode.CONTAINS,
    },
    'authors.name': {
        value: null,
        matchMode: FilterMatchMode.CONTAINS,
    },
    'action.0.status.name': {
        value: null,
        matchMode: FilterMatchMode.CONTAINS,
    }
});

</script>

<template>

    <Head title="Books" />
    <AuthenticatedLayout>

        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Books</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <DataTable :value="props.books" :rows="10" sortMode="multiple" filterDisplay="menu"
                        :loading="loading"
                        :globalFilterFields="['id', 'name', 'genres.name', 'publishers.name', 'authors.name', 'action']"
                        v-model:filters="filters" removable-sort paginator
                        @row-click="showBook">
                        <Column header="#" field="id" :sortable="true"></Column>
                        <Column header="Name" field="name" :sortable="true" :filterMatchModeOptions="matchModes">
                            <template #filter="{ filterModel, filterCallback }">
                                <InputText type="text" v-model="filterModel.value" @keydown.enter="filterCallback()"
                                    class="p-column-filter"
                                    :placeholder="`Search by name - ${filterModel.matchMode}`" />
                            </template>
                        </Column>
                        <Column header="Genre" field="genres.name" :sortable="true">
                            <template #filter="{ filterModel, filterCallback }">
                                <InputText type="text" v-model="filterModel.value" @keydown.enter="filterCallback()"
                                    class="p-column-filter"
                                    :placeholder="`Search by name - ${filterModel.matchMode}`" />
                            </template>
                        </Column>

                        <Column header="Publisher" field="publishers.name" :sortable="true">
                            <template #filter="{ filterModel, filterCallback }">
                                <InputText type="text" v-model="filterModel.value" @keydown.enter="filterCallback()"
                                    class="p-column-filter"
                                    :placeholder="`Search by name - ${filterModel.matchMode}`" />
                            </template>
                        </Column>
                        <Column header="Author" field="authors.name" :sortable="true">
                            <template #filter="{ filterModel, filterCallback }">
                                <InputText type="text" v-model="filterModel.value" @keydown.enter="filterCallback()"
                                    class="p-column-filter"
                                    :placeholder="`Search by name - ${filterModel.matchMode}`" />
                            </template>
                        </Column>
                        <Column header="Status" field="action.0.status.name" :sortable="true">
                            <template #body="{ data }">
                                {{ data.action == 0 ? 'free' : data.action[0].status.name }}
                            </template>
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

                                    <Button v-if="data.action == 0" label="Booking"
                                        class="p-button-sm p-button-secondary p-button-outlined"
                                        @click="createBooking(data)" />

                                    <Button v-if="data.action != 0" label="Subscribe"
                                        class="p-button-sm p-button-secondary p-button-outlined"
                                        @click="subscribeToBook(data)" />

                                    <Button label="Delete" class="p-button-sm p-button-danger p-button-outlined"
                                        @click="deleteItem(data)" />
                                </div>
                            </template>
                        </Column>
                    </DataTable>
                    <Menu ref="menu" :model="menuItems" popup />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
