<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({ cliente: { type: Object } });
const form = useForm({
  pais: props.cliente.pais,
  ciudad: props.cliente.ciudad,
  institucion: props.cliente.institucion,
  email: props.cliente.email,
  telefono: props.cliente.telefono,
  direccion: props.cliente.direccion,
});
</script>

<template>
    <Head title="Editar Cliente" />
  
    <AuthenticatedLayout>
      <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Editar Cliente</h2>
      </template>
  
      <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg py-12">
            <form @submit.prevent="form.patch(route('clientes.update',cliente))"
                  class="space-y-2 max-w-xl mx-auto grid grid-cols-2 gap-4">

                  <!-- Columna izquierda -->
              <div class="col-span-1">
                <div class="flex flex-col">

                 <label for="pais" value="Pais" class="block font-medium text-gray-700">País</label>
                 <div class="mt-1 relative rounded-md shadow-sm">
                  <select id="pais" v-model="form.pais" required
                  class="block form-select px-4 py-2 w-full rounded-md transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                        <option value="Colombia">Colombia</option>
                        <option value="Costa Rica">Costa Rica</option>
                  </select>
                  <p class="text-red-500 mt-2" v-if="form.errors.pais">{{ form.errors.pais }}</p>
                  </div>
  
                  <InputLabel for="ciudad" value="Ciudad" class="text-center" />
                  <TextInput id="ciudad" v-model="form.ciudad" autofocus required
                             type="text" class="mt-1 block w-full" />
                  <InputError :message="form.errors.ciudad" class="mt-2" />
  
                  <InputLabel for="institucion" value="Institución" class="text-center" />
                  <TextInput id="institucion" v-model="form.institucion" autofocus required
                             type="text" class="mt-1 block w-full" />
                  <InputError :message="form.errors.institucion" class="mt-2" />

                  
                </div>
              </div>
  
              <!-- Columna derecha -->
              <div class="col-span-1" style="margin-top: 0">
                <div class="flex flex-col">
                  <InputLabel for="telefono" value="Teléfono" class="text-center" />
                  <TextInput id="telefono" v-model="form.telefono" autofocus required
                             type="text" class="mt-1 block w-full" />
                  <InputError :message="form.errors.telefono" class="mt-2" />
  
                  <InputLabel for="direccion" value="Dirección" class="text-center" />
                  <TextInput id="direccion" v-model="form.direccion" autofocus required
                             type="text" class="mt-1 block w-full" />
                  <InputError :message="form.errors.direccion" class="mt-2" />

                  <InputLabel for="email" value="Correo" class="text-center" />
                  <TextInput id="email" v-model="form.email" autofocus required
                             type="text" class="mt-1 block w-full align-sub" />
                  <InputError :message="form.errors.email" class="mt-2" />

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
  
  