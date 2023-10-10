<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DangerButton from '@/Components/DangerButton.vue';
import { Head,Link,useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
import VueTailwindPagination from '@ocrv/vue-tailwind-pagination';
import { ref } from 'vue';

const open = ref(false)


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


<style scoped>
.notification-container-right {
    position: absolute;
    top: 20px;
    right: 20px; /* Cambia la posición a la derecha */
    display: flex;
    align-items: center;
    cursor: pointer;
}

.notification-icon {
    font-size: 24px;
    margin-right: 5px;
}

.notification-count {
    border-radius: 50%;
    padding: 9px 10px;
    font-size: 14px;
}

/* Estilos para el contador cuando hay notificaciones pendientes (rojo) */
.red {
    background-color: red;
    color: white;
}

/* Estilos para el contador cuando no hay notificaciones (verde) */
.green {
    background-color: green;
    color: white;
}
.modal {
    position: fixed;
    top: 20%; /* Centra verticalmente en la mitad de la pantalla */
    left: 17%; /* Centra horizontalmente en la mitad de la pantalla */
    transform: translate(-50%, -50%); /* Centra exactamente en el centro */
    background-color: #39748B; 
    width: 35%; /* Tamaño del modal en relación al ancho de la pantalla */
    display: flex;
    flex-direction: column; /* Organizar contenido en columna */
    justify-content: space-between; /* Espacio entre contenido y botón de cierre */
    align-items: center; /* Centrar contenido horizontalmente */
    z-index: 1;
    border-radius: 5%;
}

/* Estilo para el contenido del modal */
.modal-content {
    background-color: #39748B;
    padding: 20px;
    margin: -22px; /* Espacio interno del modal */
    text-align: center;
    width: 100%; /* Ocupa todo el ancho del modal */
}

/* Estilo para el botón de cerrar */


.modal-button[data-v-e529c56f] {
    background-color: rgb(10, 10, 10);
    color: white;
    border: none;
    border-radius: 10px;
    padding: 10px 20px;
    margin: 10px;
    cursor: pointer;
}

/* Estilo para el botón de cerrar */
.modal-button {
    background-color: gray;
    color: white;
    border: none;
    border-radius: 10px;
    padding: 10px 20px;
    margin: 10px;
    cursor: pointer;
    /* Otros estilos según sea necesario */
}
.black-button {
    background-color: black;
    color: white;
    border-radius: 10px; /* Ajusta el valor del border-radius según lo que desees */
    padding: 10px 20px; /* Ajusta el espaciado interior según lo que desees */
    border: none; /* Elimina el borde */
    cursor: pointer;
    /* Otros estilos según sea necesario */
}

/* Estilo cuando el botón está en estado de hover (opcional) */
.black-button:hover {
    background-color: #64ce0e; /* Cambia el color de fondo cuando se pasa el mouse */
}

.notification-container-right[data-v-e529c56f] {
    position: absolute;
    top: 171px;
    right: 20px;
    display: flex;
    align-items: center;
    cursor: pointer;
}

</style>

<template>
    <Head title="Maceradoras" />



    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Maceradoras</h2>
        </template>
        <br><br><br>

        <div class="notification-container-right">
        <!-- Icono de campana -->
        <i class="fa-solid fa-bell notification-icon"></i>
        <!-- Contador de notificaciones -->
        <span :class="['notification-count', notificationCount > 0 ? 'red' : 'green']">{{ notificationCount === 0 ? '0' : notificationCount }}</span>
   

    <button @click="open = true" class="px-4 py-2 bg-gray-800 text-white border rounded-md font-semibold text-xs">Open Modal</button>
    

    <teleport to="body">
    <div v-if="open" class="modal">
        <div class="modal-content">
            <p>Hello from the modal! lorem</p>
            <!-- Contenido de notificaciones aquí -->
        </div>
        <button @click="open = false" class="modal-button">Close</button>
    </div>
    </teleport>

    

    </div>
        
        <div class="py-12">
            <div class="bg-custom-teal grid v-screen place-items-center">
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
                            <th class="px-2 py-2">Editar</th>
                            <th class="px-2 py-2">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="mac, in maceradoras.data" :key="mac.serial">
                        <td class="border border-gray-400 px-2 py-2 text-center">{{ mac.institucion }}</td>
                        <td class="border border-gray-400 px-2 py-2 text-center">{{ mac.serial }}</td>
                        <td class="border border-gray-400 px-2 py-2 text-center">{{ mac.modelo }}</td>
                        <td class="border border-gray-400 px-2 py-2 text-center">{{ mac.estado }}</td>
                        <td class="border border-gray-400 px-2 py-2 text-center">{{ mac.fechaFabricacion }}</td>
                        <td class="border border-gray-400 px-2 py-2 text-center">{{ mac.tipoAsistencia }}</td>
                        <td class="border border-gray-400 px-2 py-2 text-center">{{ mac.fechaInstalacion }}</td>
                        <td class="border border-gray-400 px-2 py-2 text-center">{{ mac.tipoMantenimiento }}</td>
                        <td class="border border-gray-400 px-2 py-2 text-center">{{ mac.fechaMantenimiento }}</td>
                        <td class="border border-gray-400 px-2 py-2 text-center">{{ mac.tipoPieza }}</td>
                        <td class="border border-gray-400 px-2 py-2 text-center">{{ mac.fechaCambioPieza }}</td>
                        <td class="border border-gray-400 px-2 py-2 text-center">{{ mac.numeroCiclos }}</td>
                        <td class="border border-gray-400 px-2 py-2 text-center">{{ mac.fechaIncidente }}</td>
                        <td class="border border-gray-400 px-2 py-2 text-center">{{ mac.observaciones ? mac.observaciones.slice(0, 10) : '' }}</td>
                        <td class="border border-gray-400 px-4 py-4">
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


