<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({ maceradora: { type: Object },cliente: { type: Object } });

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
  numeroCiclos: props.maceradora.numeroCiclos,
  fechaIncidente: props.maceradora.fechaIncidente,
  observaciones: props.maceradora.observaciones,
  img: props.maceradora.img,
  cliente_institucion: props.cliente_institucion
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
            <form @submit.prevent="form.patch(route('maceradoras.update',maceradora))"
                  class="space-y-2 max-w-xl mx-auto grid grid-cols-2 gap-4">

                  <!-- Columna izquierda -->
              <div class="col-span-1">
                <div class="flex flex-col">
                  <InputLabel for="serial" value="Serial" class="text-center" />
                  <TextInput id="serial" v-model="form.serial" autofocus required
                             type="text" class="mt-1 block w-full" />
                  <InputError :message="form.errors.serial" class="mt-2" />
  
                  <InputLabel for="modelo" value="modelo" class="text-center" />
                  <TextInput id="modelo" v-model="form.modelo" autofocus required
                             type="text" class="mt-1 block w-full" />
                  <InputError :message="form.errors.modelo" class="mt-2" />
  
                  <InputLabel for="estado" value="estado" class="text-center" />
                  <TextInput id="estado" v-model="form.estado" autofocus required
                             type="text" class="mt-1 block w-full" />
                  <InputError :message="form.errors.estado" class="mt-2" />
  
                  <InputLabel for="fechaFabricacion" value="fechaFabricacion" class="text-center" />
                  <TextInput id="fechaFabricacion" v-model="form.fechaFabricacion" autofocus required
                             type="date" class="mt-1 block w-full align-sub" />
                  <InputError :message="form.errors.fechaFabricacion" class="mt-2" />
                  
                  <InputLabel for="tipoAsistencia" value="tipo Asistencia" class="text-center" />
                  <TextInput id="tipoAsistencia" v-model="form.tipoAsistencia" autofocus required
                             type="text" class="mt-1 block w-full align-sub" />
                  <InputError :message="form.errors.tipoAsistencia" class="mt-2" />
                  
                  <InputLabel for="fechaInstalacion" value="fecha Instalacion" class="text-center" />
                  <TextInput id="fechaInstalacion" v-model="form.fechaInstalacion" autofocus required
                             type="text" class="mt-1 block w-full align-sub" />
                  <InputError :message="form.errors.fechaInstalacion" class="mt-2" />
                  
                  <InputLabel for="tipoMantenimiento" value="tipo Mantenimiento" class="text-center" />
                  <TextInput id="tipoMantenimiento" v-model="form.tipoMantenimiento" autofocus required
                             type="text" class="mt-1 block w-full align-sub" />
                  <InputError :message="form.errors.tipoMantenimiento" class="mt-2" />
                  
                  <InputLabel for="fechaMantenimiento" value="fecha Mantenimiento" class="text-center" />
                  <TextInput id="fechaMantenimiento" v-model="form.fechaMantenimiento" autofocus required
                             type="text" class="mt-1 block w-full align-sub" />
                  <InputError :message="form.errors.fechaMantenimiento" class="mt-2" />
                  
                </div>
              </div>
  
              <!-- Columna derecha -->
              <div class="col-span-1" style="margin-top: 0">
                <div class="flex flex-col">
                  <InputLabel for="tipoPieza" value="tipo Pieza" class="text-center" />
                  <TextInput id="tipoPieza" v-model="form.tipoPieza" autofocus required
                             type="text" class="mt-1 block w-full" />
                  <InputError :message="form.errors.tipoPieza" class="mt-2" />
  
                  <InputLabel for="fechaCambioPieza" value="fecha Cambio Pieza" class="text-center" />
                  <TextInput id="fechaCambioPieza" v-model="form.fechaCambioPieza" autofocus required
                             type="date" class="mt-1 block w-full" />
                  <InputError :message="form.errors.fechaCambioPieza" class="mt-2" />
  
                  <InputLabel for="numeroCiclos" value="numero Ciclos" class="text-center" />
                  <TextInput id="numeroCiclos" v-model="form.numeroCiclos" autofocus required
                             type="text" class="mt-1 block w-full" />
                  <InputError :message="form.errors.numeroCiclos" class="mt-2" />

                  <InputLabel for="fechaIncidente" value="fecha Incidente" class="text-center" />
                  <TextInput id="fechaIncidente" v-model="form.fechaIncidente" autofocus required
                             type="date" class="mt-1 block w-full" />
                  <InputError :message="form.errors.fechaIncidente" class="mt-2" />
  
                  <InputLabel for="observaciones" value="observaciones" class="text-center" />
                  <TextInput id="observaciones" v-model="form.observaciones" autofocus required
                             type="text" class="mt-1 block w-full" />
                  <InputError :message="form.errors.observaciones" class="mt-2" />
  
                  <InputLabel for="img" value="imagen" class="text-center" />
                  <TextInput id="img" v-model="form.img" autofocus required
                             type="text" class="mt-1 block w-full" />
                  <InputError :message="form.errors.img" class="mt-2" />
  
                  <InputLabel for="cliente_institucion" value="Institucion" class="text-center" />
                  <TextInput id="cliente_institucion" v-model="form.cliente_institucion" autofocus required
                             type="text" class="mt-1 block w-full" />
                  <InputError :message="form.errors.cliente_institucion" class="mt-2" />
  
                </div>
              </div>
              <div class="col-span-2 text-center mt-4">
              <PrimaryButton :disabled="form.processing">
                <i class="fa-solid fa-save"></i> Guardar
              </PrimaryButton>
            </div>
            </form>

          </div>
        </div>
      </div>
    </AuthenticatedLayout>
  </template>