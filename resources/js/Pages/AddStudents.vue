<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router, useForm } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import AutoComplete from 'primevue/autocomplete';
import Dropdown from 'primevue/dropdown';
import { onMounted, ref, watch } from 'vue';
import { Link } from '@inertiajs/inertia-vue3';
import { Button } from 'primevue';
import { useToast } from "primevue/usetoast";

const toast = useToast();

const data = defineProps({
    dataClass: Object,
    dataEachStudent:Object
})

const InputMode = ref(false)

const dataSection = ref([
    {section:'Section Reguler',section_id:2},
    {section:'Section Advanced',section_id:1}
])

const showToast = () =>{
    return toast.add({ severity: 'success', summary: 'Info', detail: 'Data Berhasil di Simpan', life: 3000 })
}


const item = ref([])
const value = ref("class_id")
const sectionValue = ref("section_id")
const error = ref({})

const form = useForm({
    id:0,
    name: "",
    age: 0,
    class_id: 0,
    class_name: null,
    section_name: null,
    section_id: 0
})

onMounted(() => {
    console.log(data.dataClass)
    item.value = data.dataClass
    console.log(item.value)
    console.log(dataSection.value)
    setForm(data.dataEachStudent)
    if(!data.dataEachStudent){
        InputMode.value = true
    }else{
        InputMode.value = false
    }

    console.log('input Mode',InputMode.value)
})

const setForm = (data)=>{
    console.log(data)
    form.id = data?.id
    form.name = data?.name
    form.age = data?.age
    form.class_name = data?.class_name
    form.class_id = data?.class_id
    form.section_id = data?.section_id
    form.section_name = data?.section_name
}


const search = () => {
    item.value = []
}

const submit = async () =>{
    form.post(route('addstudents.store'),{
        onError:(error)=>{
            error.value = error
        },
        onSuccess:(success)=>{
            console.log(success)
            showToast()
        }
    })
}

const classChange = (args)=>{
    console.log(args)
    form.class_name = args.class_name
    form.class_id = args.class_id
}

const SectionChange = (args)=>{
    form.section_id = args.section_id
    form.section_name = args.section
}

const onEdit = () =>{
    form.put(route(`addstudents.update`,form.id),{
        onError:(error)=>{
            console.log(error)
        },
        onSuccess:(success)=>{
            console.log(success)
            showToast()
            setTimeout(()=>{
                window.location.href = route('students')
            },2000)
        }
    })
}

</script>

<template>

    <Head title="Add Student" />
    <Toast />
    <AuthenticatedLayout>
        <template #header>
            <div class="flex flex-row w-full items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight w-full text-gray-800">
                    ADD STUDENT's
                </h2>

                <div class="flex flex-row w-full justify-end gap-3 items-center">
                    <Link :href="route('students')">
                    <Button :label="'Back'" style="color: white;border-radius: 10px; " raised=""
                        icon="pi pi-arrow-left text-white" :class="'text-white'" :severity="'danger'" />
                    </Link>
                    <Button :label="'Add Student'" style="color: white;border-radius: 10px; " v-if="InputMode == true" @click="submit"
                        icon="pi pi-plus text-white" :class="'text-white'" raised="" :severity="'info'" />

                        <Button :label="'Edit Student'" style="color: white;border-radius: 10px;  " v-if="InputMode == false" @click="onEdit"
                        icon="pi pi-pencil text-white" :class="'text-white'" raised="" :severity="'success'" />



                </div>

            </div>

        </template>

        <div class="py-6">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <section>
                            <header>
                                <h2 class="text-lg font-medium text-gray-900">
                                    Input Students Data
                                </h2>
                            </header>

                            <form  class="mt-6 space-y-6">
                                <div class="flex flex-row gap-3 w-full h-auto">
                                    <div class="flex flex-col w-6/12 h-full">
                                        <div>
                                            <InputLabel for="name" value="Name" />

                                            <TextInput id="name" type="text" class="mt-1 block w-full"
                                                v-model="form.name" required autofocus autocomplete="name" />

                                            <InputError class="mt-2" :message="form.errors.name" />
                                        </div>

                                        <div>
                                            <InputLabel for="age" value="Age" />

                                            <TextInput id="age" type="number" class="mt-1 block w-full"
                                                v-model="form.age" required autocomplete="username" />

                                            <InputError class="mt-2" :message="form.errors.age" />
                                        </div>
                                    </div>
                                    <div class="flex flex-col w-6/12 h-full">
                                        <div>
                                            <InputLabel for="Class" value="Class" />

                                            <!-- <AutoComplete v-model="value" :suggestions="item.value" @complete="search"
                                                size="small" style="width: 100%;" placeholder="" dropdown /> -->
                                            <Dropdown id="class-dropdown" v-model="value" style="width: 100%;"
                                                :options="dataClass" optionLabel="class_name" v-on:change="classChange($event.value)"
                                                placeholder="Select a Class">
                                            </Dropdown>
                                        </div>

                                        <div>

                                            <InputLabel for="Section" value="Section" />

                                            <Dropdown id="class-dropdown" v-model="sectionValue" style="width: 100%;"
                                                :options="dataSection" optionLabel="section"  v-on:change="SectionChange($event.value)"
                                                placeholder="Select a Section">
                                            </Dropdown>

                                            <!-- <InputLabel for="Section" value="Section" />

                                            <AutoComplete v-model="form.section" :suggestions="items" size="small"
                                                style="width: 100%;" placeholder="" dropdown />

                                            <InputError class="mt-2" :message="form.errors.age" /> -->
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>