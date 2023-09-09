<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import SelectInput from '@/Components/SelectInput.vue';
import WarningButton from '@/Components/WarningButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import Modal from '@/Components/Modal.vue';
import { Head,useForm } from '@inertiajs/vue3';
import { nextTick,ref } from 'vue';
import Swal from 'sweetalert2';
import VueTailwindPagination from '@ocrv/vue-tailwind-pagination';

const nameInput = ref(null);
const modal = ref(false);
const title = ref('');
const operation = ref(1);
const id = ref('');

const props = defineProps({
    maceradoras: {type:Object},
    clientes: {type:Object}
});
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
            cliente_id:'' 
});
const formPage = useForm({});
const onPageClick = (event)=>{
    formPage.get(route('maceradoras.index',{page:event}));
}
const openModal = (op,
            serial,
            modelo,
            estado,
            fechaFabricacion,
            tipoAsistencia,
            fechaInstalacion,
            tipoMantenimiento,
            fechaMantenimiento,
            tipoPieza,
            fechaCambioPieza,
            numeroCiclos ,
            fechaIncidente,
            observaciones,
            img,
            cliente,maceradora) =>{
    modal.value = true;
    nextTick( () => nameInput.value.focus());
    operation.value = op;
    id.value = maceradora;
    if(op == 1){
        title.value = 'Crear Maceradora';
    }
    else{
        title.value = 'Editar maceradora';
        form.serial=serial;
        form.modelo=modelo;
        form.estado=estado;
        form.fechaFabricacion=fechaFabricacion;
        form.tipoAsistencia=tipoAsistencia;
        form.fechaInstalacion=fechaInstalacion;
        form.tipoMantenimiento=tipoMantenimiento;
        form.fechaMantenimiento=fechaMantenimiento;
        form.tipoPieza=tipoPieza;
        form.fechaCambioPieza=fechaCambioPieza;
        form.numeroCiclos=numeroCiclos;
        form.fechaIncidente=fechaIncidente;
        form.observaciones=observaciones;
        form.img=img;
        form.cliente_id = cliente;
    }
}
const closeModal = () =>{
    modal.value = false;
    form.reset();
}
const save = () => {
    if (operation.value === 1) {
        form.post(route('maceradoras.store'), {
            onSuccess: () => {
                ok('Maceradora created');
            },
        });
    } else {
        form.put(route('maceradoras.update', id.value), { 
            onSuccess: () => {
                ok('Maceradora updated');
            },
        });
    }
};
const ok = (msj) =>{
    form.reset();
    closeModal();
    Swal.fire({title:msj,icon:'success'});
}
const deleteMaceradora = (serial) =>{
    const alerta = Swal.mixin({
        buttonsStyling:true
    });
    alerta.fire({
        title:'Estás seguro de eliminar '+serial+' ?',
        icon:'question', showCancelButton:true,
        confirmButtonText:'<i class="fa-solid fa-check"></i> Si, Eliminar',
        cancelButtonText:'<i class="fa-solid fa-ban"></i> Cancelar'
    }).then((result) => {
        if(result.isConfirmed) {
            form.delete(route('maceradoras.destroy',serial),{
                onSuccess: () =>{ok('Maceradora eliminada')}
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
                    <PrimaryButton @click="openModal(1)">
                        <i class="fa-solid fa-plus-circle"></i> Agregar
                    </PrimaryButton>
                </div>
            </div>
            <div class="bg-white grid v-screen place-items-center overflow-x-auto py-3">
                <table class="table-auto border border-gray-400">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-2 py-2">SERIAL</th>
                            <th class="px-2 py-2">MODELO</th>
                            <th class="px-2 py-2">ESTADO</th>
                            <th class="px-2 py-2">FECHA DE FABRICACIÓN</th>
                            <th class="px-2 py-2">TIPO ASISTENCIA</th>
                            <th class="px-2 py-2">FECHA INSTALACIÓN</th>
                            <th class="px-2 py-2">TIPO DE MANTENIMIENTO</th>
                            <th class="px-2 py-2">FECHA DE MANTENIMIENTO</th>
                            <th class="px-2 py-2">TIPO DE PIEZA</th>
                            <th class="px-2 py-2">FECHA CAMBIO DE PIEZA</th>
                            <th class="px-2 py-2">NUMERO CICLOS</th>
                            <th class="px-2 py-2">FECHA DEL INCIDENTE</th>
                            <th class="px-2 py-2">OBSERVACIONES</th>
                            <th class="px-2 py-2">IMAGENES</th>
                            <th class="px-2 py-2">ID DEL CLIENTE</th>
                            <th class="px-2 py-2">EDITAR</th>
                            <th class="px-2 py-2">ELIMINAR</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="mac in maceradoras.data" :key="mac.serial">
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
                        <td class="border border-gray-400 px-2 py-2 text-center">{{ mac.observaciones.substring(0, 10) }}</td>
                        <td class="border border-gray-400 px-2 py-2 text-center">{{ mac.img }}</td>
                        <td class="border border-gray-400 px-2 py-2 text-center">{{ mac.cliente }}</td>
                        <td class="border border-gray-400 px-2 py-2 text-center">
                            <WarningButton 
                            @click="openModal(2,mac.serial,mac.modelo,mac.estado,mac.fechaFabricacion ,
                            mac.tipoAsistencia,mac.fechaInstalacion,mac.tipoMantenimiento,mac.fechaMantenimiento,
                            mac.tipoPieza,mac.fechaCambioPieza,mac.numeroCiclos,
                            mac.fechaIncidente ,mac.observaciones,mac.img,mac.cliente,mac.id)">
                                <i class="fa-solid fa-edit"></i>
                            </WarningButton>
                        </td>
                        <td class="border border-gray-400 px-2 py-2">
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
        <Modal :show="modal" @close="closeModal">
            <h2 class="p-3 text-lg font.medium text-hray-900">{{ title }}</h2>
            <div class="p-3 mt-6">
                <InputLabel for="serial" value="Serial:"></InputLabel>
                <TextInput id="serial" ref="nameInput"
                v-model="form.serial" type="text" class="mt-1 block w-3/4"
                placeholder="Serial"></TextInput>
                <InputError :message="form.errors.serial" class="mt-2"></InputError>
            </div>

                <div class="p-3">
                <label for="modelo" value="modelo" class="block font-medium text-gray-700">Modelo</label>
                <div class="mt-1 relative rounded-md shadow-sm">
                <select id="modelo" v-model="form.modelo" required
                    class="block form-select px-4 py-2 w-3/4 rounded-md transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                        <option>Vortex</option>
                        <option>Compact +</option>
                </select>
                <p class="text-red-500 mt-2" v-if="form.errors.modelo">{{ form.errors.modelo }}</p>
                </div>
                </div>

            <div class="p-3">
                <InputLabel for="estado" value="Estado:"></InputLabel>
                <TextInput id="estado"
                v-model="form.estado" type="text" class="mt-1 block w-3/4"
                placeholder="Estado"></TextInput>
                <InputError :message="form.errors.estado" class="mt-2"></InputError>
            </div>
            <div class="p-3">
                <InputLabel for="fechaFabricacion" value="fecha de Fabricacion:"></InputLabel>
                <TextInput id="fechaFabricacion"
                v-model="form.fechaFabricacion" type="date" class="mt-1 block w-3/4"
                placeholder="fecha de Fabricacion"></TextInput>
                <InputError :message="form.errors.fechaFabricacion" class="mt-2"></InputError>
            </div>
            <div class="p-3">
                <InputLabel for="tipoAsistencia" value="tipo de Asistencia:"></InputLabel>
                <TextInput id="tipoAsistencia"
                v-model="form.tipoAsistencia" type="text" class="mt-1 block w-3/4"
                placeholder="tipo de Asistencia"></TextInput>
                <InputError :message="form.errors.tipoAsistencia" class="mt-2"></InputError>
            </div>
            <div class="p-3">
                <InputLabel for="fechaInstalacion" value="fecha de Instalacion:"></InputLabel>
                <TextInput id="fechaInstalacion"
                v-model="form.fechaInstalacion" type="date" class="mt-1 block w-3/4"
                placeholder="fecha de Instalacion"></TextInput>
                <InputError :message="form.errors.fechaInstalacion" class="mt-2"></InputError>
            </div>
            <div class="p-3">
                <InputLabel for="tipoMantenimiento" value="tipo de Mantenimiento:"></InputLabel>
                <TextInput id="tipoMantenimiento"
                v-model="form.tipoMantenimiento" type="text" class="mt-1 block w-3/4"
                placeholder="tipo de Mantenimiento"></TextInput>
                <InputError :message="form.errors.tipoMantenimiento" class="mt-2"></InputError>
            </div>
            <div class="p-3">
                <InputLabel for="fechaMantenimiento" value="fecha de Mantenimiento:"></InputLabel>
                <TextInput id="fechaMantenimiento"
                v-model="form.fechaMantenimiento" type="date" class="mt-1 block w-3/4"
                placeholder="fecha de Mantenimiento"></TextInput>
                <InputError :message="form.errors.fechaMantenimiento" class="mt-2"></InputError>
            </div>
            <div class="p-3">
                <InputLabel for="tipoPieza" value="tipoPieza:"></InputLabel>
                <TextInput id="tipoPieza"
                v-model="form.tipoPieza" type="text" class="mt-1 block w-3/4"
                placeholder="tipoPieza"></TextInput>
                <InputError :message="form.errors.tipoPieza" class="mt-2"></InputError>
            </div>
            <div class="p-3">
                <InputLabel for="fechaCambioPieza" value="fecha Cambio de Pieza:"></InputLabel>
                <TextInput id="fechaCambioPieza"
                v-model="form.fechaCambioPieza" type="date" class="mt-1 block w-3/4"
                placeholder="fecha Cambio de Pieza"></TextInput>
                <InputError :message="form.errors.fechaCambioPieza" class="mt-2"></InputError>
            </div>
            <div class="p-3">
                <InputLabel for="numeroCiclos" value="numeroCiclos:"></InputLabel>
                <TextInput id="numeroCiclos"
                v-model="form.numeroCiclos" type="number" class="mt-1 block w-3/4"
                placeholder="numeroCiclos"></TextInput>
                <InputError :message="form.errors.numeroCiclos" class="mt-2"></InputError>
            </div>
            <div class="p-3">
                <InputLabel for="fechaIncidente" value="fecha del Incidente:"></InputLabel>
                <TextInput id="fechaIncidente"
                v-model="form.fechaIncidente" type="date" class="mt-1 block w-3/4"
                placeholder="fecha del Incidente"></TextInput>
                <InputError :message="form.errors.fechaIncidente" class="mt-2"></InputError>
            </div>
            <div class="p-3">
                <InputLabel for="observaciones" value="observaciones:"></InputLabel>
                <TextInput id="observaciones"
                v-model="form.observaciones" type="text" class="mt-1 block w-3/4"
                placeholder="observaciones"></TextInput>
                <InputError :message="form.errors.observaciones" class="mt-2"></InputError>
            </div>
            <div class="p-3">
                <InputLabel for="img" value="img:"></InputLabel>
                <TextInput id="img"
                v-model="form.img" type="text" class="mt-1 block w-3/4"
                placeholder="img"></TextInput>
                <InputError :message="form.errors.img" class="mt-2"></InputError>
            </div>
            
            <div class="p-3">
                <InputLabel for="cliente_id" value="cliente:"></InputLabel>
                <SelectInput id="cliente_id" :options="clientes"
                v-model="form.cliente_id" type="text" class="mt-1 block w-3/4"
                ></SelectInput>
                <InputError :message="form.errors.cliente_id" class="mt-2"></InputError>
            </div>

            <div class="p-3 mt-6">
                <PrimaryButton :disabled="form.processing" @click="save">
                    <i class="fa-solid fa-save"></i> Guardar
                </PrimaryButton>
            </div>
            <div class="p-3 mt-6 flex justify-end">
                <SecondaryButton class="ml-3" :disabled="form.processing"
                @click="closeModal">
                    Cancelar
                </SecondaryButton>
            </div>
        </Modal>
    </AuthenticatedLayout>
</template>
