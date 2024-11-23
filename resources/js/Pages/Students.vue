<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import Button from "primevue/button"
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import ColumnGroup from 'primevue/columngroup';   // optional
import Row from 'primevue/row';
import { InputIcon } from 'primevue';
import { IconField } from 'primevue';
import { InputText } from 'primevue'
import { ref, watch } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { usePage } from '@inertiajs/inertia-vue3';
import { Link } from '@inertiajs/inertia-vue3';
import { useToast } from "primevue/usetoast";
import NavLink from '@/Components/NavLink.vue';
const toast = useToast();
const data = defineProps({
    students: Array
})

const locaStudent = ref([...data.students])

const { props } = usePage();

const search = ref("")

const message = ref(props.message || '');
const error = ref(props.error || '');

const selectRow = (data) => {
    console.log(data)
    router.visit(route('addstudents.edit', data.id));
}

const deleteItem = (id) => {
    console.log(id)
    if (confirm('Are you sure you want to delete this item?')) {
        Inertia.delete(`/students/${id}`);
        showToast()
        setTimeout(()=>{
            Inertia.reload()
        },700)
    }
}

const showToast = () =>{
    return toast.add({ severity: 'success', summary: 'Info', detail: 'Data Berhasil di hapus', life: 3000 })
}

const performSearch = (args) =>{
    console.log("preform search",args)
    if (args && args.trim() !== "") {
        locaStudent.value = data.students.filter(el => {
            // Filter by name, case insensitive
            return el.name.toLowerCase().includes(args.toLowerCase());
        });
        console.log("Filtered students:", locaStudent.value);
    } else {
        // Reset to the original data if the search term is empty
        locaStudent.value = [...data.students];
        console.log("Reset to original students:", locaStudent.value);
    }
    
}

watch((search), (newValue) => {
    console.log(newValue)
},)

</script>

<template>
    <Head title="Students" />
    <Toast />
    <AuthenticatedLayout>

        <template #header>
            <div class="flex flex-row w-full items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight w-full text-gray-800">
                    STUDENT'S DATA
                </h2>

                <div class="flex flex-row w-full justify-end gap-3 items-center">
                    <Link :href="route('addstudents')">
                    <Button :label="'Add Student'" style="color: white;border-radius: 10px; "
                        icon="pi pi-plus text-white" :class="'text-white'" raised="" :severity="'info'" />
                    </Link>   
                    <Button :label="'Export PDF'" style="color: white;border-radius: 10px; " raised=""
                        icon="pi pi-file-pdf text-white" :class="'text-white'" :severity="'danger'" />
                    <Button :label="'Export Excell'" style="color: white;border-radius: 10px; " raised="" 
                        icon="pi pi-file-excel text-white" :class="'text-white'" :severity="'primary'" />

                </div>

            </div>

        </template>

        <div class="py-6">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm rounded-xl sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex justify-end w-full mx-3 py-2">
                            <IconField>
                                <InputIcon>
                                    <i class="pi pi-search" />
                                </InputIcon>
                                <InputText v-model:modelValue="search" @keydown.enter="performSearch(search)"  placeholder="Keyword Search" />
                            </IconField>
                        </div>
                        <div class="flex w-full h-full justify-center">
                            <div class="card">
                                <DataTable :value="locaStudent" filterDisplay="menu" class="custom-data-table"
                                    style="background-color: white;" paginator rowHover="true" :rows="10" tableStyle="min-width: 50rem">
                                    <Column field="id" header="ID" ></Column>
                                    <Column field="name" header="Name"  ></Column>
                                    <Column field="age" header="Age"></Column>
                                    <Column field="class_name" header="Class"></Column>
                                    <Column field="section_name" header="Section"></Column>
                                    <Column class="w-30 !text-center" header="Action"
                                        headerClass="text-center justify-center flex">
                                        <template #body="{ data }">
                                            <Button icon="pi pi-trash text-white" class="mx-3"
                                                @click="deleteItem(data.id)" severity="danger" raised="" rounded></Button>
                                            <Button icon="pi pi-pencil text-white" raised="" @click="selectRow(data)"
                                                severity="warning" rounded></Button>
                                        </template>
                                    </Column>
                                </DataTable>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
/* Apply custom white background to the DataTable */
.custom-datatable .p-datatable {
    background-color: white;
    /* Set background to white */
}

/* Optional: Set a light background for the header */
.custom-datatable .p-datatable-header {
    background-color: #f8f8f8;
    /* Light gray background for the header */
}

/* Optional: Set a hover effect for the rows */
.custom-datatable .p-datatable-tbody>tr:hover {
    background-color: #f1f1f1;
    /* Light hover effect */
}
</style>