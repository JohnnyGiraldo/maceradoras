<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DangerButton from '@/Components/DangerButton.vue';
import { Head,Link,useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
import VueTailwindPagination from '@ocrv/vue-tailwind-pagination';


const props = defineProps({
    clientes: {type:Object}
});
const form = useForm({
    cliente_id:'',
    pais:'',
    ciudad:'',
    institucion:'',
    email:'',
    telefono:'',
    direccion:'',
});
const formPage = useForm({});
const onPageClick = (event)=>{
    formPage.get(route('clientes.index',{page:event}));
}

const deleteCliente = (id, institucion) => {
    const alerta = Swal.mixin({
        buttonsStyling: true
    });
    alerta.fire({
        title: '¿Está seguro de eliminar a: ' + institucion + ' ?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: '<i class="fa-solid fa-check"></i> Sí, eliminar',
        cancelButtonText: '<i class="fa-solid fa-ban"></i> Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            form.delete(route('clientes.destroy', id), {
                onSuccess: () => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Cliente eliminado',
                        text: 'El cliente ha sido eliminado con éxito.'
                    });
                }
            });
        }
    });
}
</script>

<template>
    <Head title="Clientes" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Clientes</h2>
        </template>

        <div class="py-12">
            <div class="bg-custom-blue grid v-screen place-items-center">
                <div class="mt-3 mb-3 flex">
                    <Link :href="route('clientes.create')"
                    :class="'px-4 py-2 bg-gray-800 text-white border rounded-md font-semibold text-xs'">
                    <i class="fa-solid fa-plus-circle"></i> AGREGAR
                    </Link>
                </div>
            </div>
            <div class="bg-white grid v-screen place-items-center">
                <table class="table-auto border border-gray-400">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-4 py-4">Nro</th>
                            <th class="px-4 py-4">País</th>
                            <th class="px-4 py-4">Ciudad</th>
                            <th class="px-4 py-4">Institución</th>
                            <th class="px-4 py-4">Email</th>
                            <th class="px-4 py-4">Teléfono</th>
                            <th class="px-4 py-4">Dirección</th>
                            <th class="px-4 py-4">EDITAR</th>
                            <th class="px-4 py-4">ELIMINAR</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="cli, i in clientes.data" :key="cli.id">
                        <td class="border border-gray-400 px-4 py-4 text-center">{{ (i+1) }}</td>
                        <td class="border border-gray-400 px-4 py-4 text-center">{{ cli.pais }}</td>
                        <td class="border border-gray-400 px-4 py-4 text-center">{{ cli.ciudad }}</td>
                        <td class="border border-gray-400 px-4 py-4 text-center">{{ cli.institucion }}</td>
                        <td class="border border-gray-400 px-4 py-4 text-center">{{ cli.email }}</td>
                        <td class="border border-gray-400 px-4 py-4 text-center">{{ cli.telefono }}</td>
                        <td class="border border-gray-400 px-4 py-4 text-center">{{ cli.direccion }}</td>
                        <td class="border border-gray-400 px-4 py-4">
                            <Link :href="route('clientes.edit',cli)"
                            :class="'px-4 py-2 bg-yellow-400 text-white border rounded-md font-semibold text-xs'">
                            <i class="fa-solid fa-edit"></i>
                            </Link>
                        </td>
                        <td class="border border-gray-400 px-4 py-4">
                            <DangerButton @click="deleteCliente(cli.id,cli.institucion)">
                                <i class="fa-solid fa-trash"></i>
                            </DangerButton>
                        </td>
                        </tr>
                    </tbody>
                </table>
            </div> 
            <div class="bg-white grid v-screen place-items-center">
                <VueTailwindPagination
                    :current="clientes.currentPage" :total="clientes.total"
                    :per-page="clientes.perPage"
                    @page-changed="onPageClick($event)"
                ></VueTailwindPagination>
            </div>        
        </div>
    </AuthenticatedLayout>
</template>
