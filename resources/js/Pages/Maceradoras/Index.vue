<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DangerButton from '@/Components/DangerButton.vue';
import { Head,Link,useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
import VueTailwindPagination from '@ocrv/vue-tailwind-pagination';

const props = defineProps({
    maceradoras: {type:Object},
    clientes: {type:Object}
});

const formPage = useForm({});
const onPageClick = (event)=>{
    formPage.get(route('maceradoras.index',{page:event}));

}
const form = useForm({
            serial:'',
            modelo:'',
            estado:'',
            fechaFabricacion:'',
            tipoAsistencia:'',
            fechaInstalacion:'',
            tipoMantenimiento:'',
            fechaMantenimiento:'',
            tipoPieza:'',
            fechaCambioPieza:'',
            numeroCiclos :'',
            fechaIncidente:'',
            observaciones:'',
            img:'',
            cliente:''           
});
const ok = (msj) => {
  form.reset();
  Swal.fire({ title: msj, icon: 'success' });
}

const deleteMaceradora = (serial) => {
  const alerta = Swal.mixin({
    buttonsStyling: true,
  });

  alerta.fire({
    title: 'Esta seguro de Eliminar a: ' + serial + ' ?',
    icon: 'question',
    showCancelButton: true,
    confirmButtonText: '<i class="fa-solid fa-check"></i> Si, eliminar',
    cancelButtonText: '<i class="fa-solid fa-ban"></i> Cancelar',
  }).then((result) => {
    if (result.isConfirmed) {
      form.delete(route('maceradoras.destroy', serial), {
        onSuccess: () => { ok('Maceradora eliminada') }
      });
    }
  });
}
</script>

<template>
    <Head title="Maceradoras" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Maceradoras</h2>
        </template>

        <div class="py-12">
            <div class="bg-white grid v-screen place-items-center">
                <div class="mt-3 mb-3 flex">
                    <Link :href="route('maceradoras.create')"
                    :class="'px-4 py-2 bg-gray-800 text-white border rounded-md font-semibold text-xs'">
                    <i class="fa-solid fa-plus-circle"></i> AGREGAR
                    </Link>
                </div>
            </div>
            <div class="bg-white grid v-screen place-items-center">
                <table class="table-auto border border-gray-400">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-2 py-2">Institucion</th>
                            <th class="px-2 py-2">Serial</th>
                            <th class="px-2 py-2">Modelo</th>
                            <th class="px-2 py-2">Estado</th>
                            <th class="px-2 py-2">fecha Fabricacion</th>
                            <th class="px-2 py-2">Tipo Asistencia</th>
                            <th class="px-2 py-2">Fecha Instalacion</th>
                            <th class="px-2 py-2">Mantenimiento</th>
                            <th class="px-2 py-2">Fecha mantenimiento</th>
                            <th class="px-2 py-2">Tipo Pieza</th>
                            <th class="px-2 py-2">Fecha cambio Pieza</th>
                            <th class="px-2 py-2">Num Ciclos</th>
                            <th class="px-2 py-2">Fecha Incidente</th>
                            <th class="px-2 py-2">observaciones</th>
                            <th class="px-2 py-2">Imagen</th>
                            <th class="px-2 py-2">Editar</th>
                            <th class="px-2 py-2">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="mac, i in maceradoras.data" :key="mac.serial">
                        <td class="border border-gray-400 px-2 py-2">{{ mac.cliente }}</td>
                        <td class="border border-gray-400 px-2 py-2">{{ mac.serial }}</td>
                        <td class="border border-gray-400 px-2 py-2">{{ mac.modelo }}</td>
                        <td class="border border-gray-400 px-2 py-2">{{ mac.estado }}</td>
                        <td class="border border-gray-400 px-2 py-2">{{ mac.fechaFabricacion }}</td>
                        <td class="border border-gray-400 px-2 py-2">{{ mac.tipoAsistencia }}</td>
                        <td class="border border-gray-400 px-2 py-2">{{ mac.fechaInstalacion }}</td>
                        <td class="border border-gray-400 px-2 py-2">{{ mac.tipoMantenimiento }}</td>
                        <td class="border border-gray-400 px-2 py-2">{{ mac.fechaMantenimiento }}</td>
                        <td class="border border-gray-400 px-2 py-2">{{ mac.tipoPieza }}</td>
                        <td class="border border-gray-400 px-2 py-2">{{ mac.fechaCambioPieza }}</td>
                        <td class="border border-gray-400 px-2 py-2">{{ mac.numeroCiclos }}</td>
                        <td class="border border-gray-400 px-2 py-2">{{ mac.fechaIncidente}}</td>
                        <td class="border border-gray-400 px-2 py-2">{{ mac.observaciones.substring(0, 10) }}</td>
                        <td class="border border-gray-400 px-2 py-2">{{ mac.img.substring(0, 10) }}</td>
                        <td class="border border-gray-400 px-2 py-2">

                            <Link :href="route('maceradoras.edit',mac)"
                            :class="'px-4 py-2 bg-yellow-400 text-white border rounded-md font-semibold text-xs'">
                            <i class="fa-solid fa-edit"></i>
                            </Link>
                        </td>
                        <td class="border border-gray-400 px-4 py-4">
                            <DangerButton @click="deleteMaceradora(mac.serial,mac.modelo)">
                                <i class="fa-solid fa-trash"></i>
                            </DangerButton>
                        </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="bg-white grid v-screen place-items-center">
                <VueTailwindPagination
                    :current="maceradoras.currentPage" :total="maceradoras.total"
                    :per-page="maceradoras.perPage"
                    @page-changed="onPageClick($event)"
                ></VueTailwindPagination>
            </div>
        </div>
    </AuthenticatedLayout>
</template>