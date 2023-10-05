<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SelectInput from '@/Components/SelectInput.vue';
import FileInput from '@/Components/FileInput.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2';


const ok = (msj) => {
    form.reset();
    Swal.fire({ title: msj, icon: 'success' });
};
const props = defineProps({ maceradora: { type: Object },clientes: { type: Object } });

const form = useForm({
  serial: props.maceradora.serial,
  modelo: props.maceradora.modelo,
  estado: props.maceradora.estado,
  fechaFabricacion: props.maceradora.fechaFabricacion,
  tipoAsistencia: props.maceradora.tipoAsistencia,
  fechaInstalacion: props.maceradora.fechaInstalacion,
  tipoMantenimiento: props.maceradora.tipoMantenimiento,
  fechaMantenimiento: props.maceradora.fechaMantenimiento,
  tipoPieza: props.maceradora. tipoPieza,
  fechaCambioPieza: props.maceradora.fechaCambioPieza,
  numeroCiclos: parseInt(props.maceradora.numeroCiclos),
  fechaIncidente: props.maceradora.fechaIncidente,
  observaciones: props.maceradora.observaciones,
  cliente_id: props.maceradora.cliente_id,

});
</script>

<template>
    <Head title="Editar Maceradora" />
  
    <AuthenticatedLayout>
      <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Editar Maceradora</h2>
      </template>
  
      <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg py-12">
            <form @submit.prevent="form.patch(route('maceradoras.update',maceradora),{onSuccess: () => {ok('Maceradora actualizada')}})" 
             class="space-y-2 max-w-xl mx-auto grid grid-cols-3 gap-4" enctype="multipart/form-data">
               <!-- Columna 1 -->
               <div class="col-span-1">
                  <div class="flex flex-col">
                
                  <InputLabel for="serial" value="SERIAL" class="text-center"></InputLabel>
                  <TextInput id="serial" v-model="form.serial" required
                    type="text" class="mt-1 block w-full"></TextInput>
                  <InputError :message="form.errors.serial" class="mt-2"></InputError>
  
                  <InputLabel for="modelo" value="MODELO" class="block font-medium text-gray-700 text-center">País</InputLabel>
                  <select id="modelo" v-model="form.modelo" required
                  class="block form-select px-4 py-2 w-full rounded-md transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                        <option value="Compact +">Compact +</option>
                        <option value="Vortex +">Vortex +</option>
                  </select>
                  <p class="text-red-500 mt-2" v-if="form.errors.modelo">{{ form.errors.pais }}</p>
                  
                  <InputLabel for="estado" value="ESTADO" class="text-center"></InputLabel>
                  <TextInput id="estado" v-model="form.estado" required
                    type="text" class="mt-1 block w-full"></TextInput>
                  <InputError :message="form.errors.estado" class="mt-2"></InputError>
                  
                  <InputLabel for="fechaFabricacion" value="FECHA DE FABRICACIÓN" class="text-center"></InputLabel>
                  <TextInput id="fechaFabricacion" v-model="form.fechaFabricacion" required
                  type="date" class="mt-1 block w-full"></TextInput>
                  <InputError :message="form.errors.fechaFabricacion" class="mt-2"></InputError>
                  
                  <InputLabel for="tipoAsistencia" value="TIPO DE ASISTENCIA" class="text-center"></InputLabel>
                  <TextInput id="tipoAsistencia" v-model="form.tipoAsistencia" required
                  type="text" class="mt-1 block w-full"></TextInput>
                  <InputError :message="form.errors.tipoAsistencia" class="mt-2"></InputError>

                </div>
              </div>

                    <!-- Columna 2 -->
                <div class="col-span-1">
                  <div class="flex flex-col">

                  <InputLabel for="fechaInstalacion" value="FECHA DE INSTALACIÓN" class="text-center"></InputLabel>
                  <TextInput id="fechaInstalacion" v-model="form.fechaInstalacion" required
                  type="date" class="mt-1 block w-full"></TextInput>
                  <InputError :message="form.errors.fechaInstalacion" class="mt-2"></InputError>


                  <InputLabel for="tipoMantenimiento" value="TIPO DE MANTENIMIENTO" class="text-center"></InputLabel>
                  <TextInput id="tipoMantenimiento" v-model="form.tipoMantenimiento" required
                  type="text" class="mt-1 block w-full"></TextInput>
                  <InputError :message="form.errors.tipoMantenimiento" class="mt-2"></InputError>

                  <InputLabel for="fechaMantenimiento" value="FECHA DE MANTENIMIENTO" class="text-center"></InputLabel>
                  <TextInput id="fechaMantenimiento" v-model="form.fechaMantenimiento" required
                   type="date" class="mt-1 block w-full"></TextInput>
                  <InputError :message="form.errors.fechaMantenimiento" class="mt-2"></InputError>
  
                  <InputLabel for="tipoPieza" value="TIPO DE PIEZA" class="text-center"></InputLabel>
                  <TextInput id="tipoPieza" v-model="form.tipoPieza" required
                    type="text" class="mt-1 block w-full"></TextInput>
                  <InputError :message="form.errors.tipoPieza" class="mt-2"></InputError>
  
                  <InputLabel for="fechaCambioPieza" value="FECHA CAMBIO DE LA PIEZA" class="text-center"></InputLabel>
                  <TextInput id="fechaCambioPieza" v-model="form.fechaCambioPieza" required
                    type="date" class="mt-1 block w-full"></TextInput>
                  <InputError :message="form.errors.fechaCambioPieza" class="mt-2"></InputError>
                  
                </div>
              </div>
                 <!-- Columna 3 -->
                <div class="col-span-1">
                  <div class="flex flex-col">

                  <InputLabel for="numeroCiclos" value="CICLOS" class="text-center"></InputLabel>
                  <TextInput id="numeroCiclos" v-model="form.numeroCiclos" required
                  type="number" class="mt-1 block w-full"></TextInput>
                  <InputError :message="form.errors.numeroCiclos" class="mt-2"></InputError>

                  <InputLabel for="fechaIncidente" value="FECHA DEL INCIDENTE" class="text-center"></InputLabel>
                  <TextInput id="fechaIncidente" v-model="form.fechaIncidente" required
                  type="date" class="mt-1 block w-full"></TextInput>
                  <InputError :message="form.errors.fechaIncidente" class="mt-2"></InputError>

                  <InputLabel for="observaciones" value="OBSERVACIONES" class="text-center"></InputLabel>
                  <textarea  id="observaciones" v-model="form.observaciones"
                  type="text" class="mt-1 block w-full"></textarea>
                  <InputError :message="form.errors.observaciones" class="mt-2"></InputError>

                 <InputLabel for="cliente_id" value="cliente:" class="text-center"></InputLabel>
                  <SelectInput id="cliente_id" :options="clientes"
                   v-model="form.cliente_id" type="text" class="mt-1 block w-full"
                  ></SelectInput>
                  <InputError :message="form.errors.cliente_id" class="mt-2"></InputError>
                </div>
              </div>  
              <div class="col-span-3 text-center mt-2">
              <PrimaryButton :disabled="form.processing">
                <i class="fa-solid fa-save"></i> Editar
              </PrimaryButton>
            </div>
            </form>

          </div>
        </div>
      </div>
    </AuthenticatedLayout>
  </template>


