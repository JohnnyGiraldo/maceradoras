<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head,useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
import { ref } from 'vue';

const operation = ref(1);

const form = useForm({
    pais:'',
    ciudad:'',
    institucion:'',
    email:'',
    telefono:'',
    direccion:'',
});
const save = () => {
    const onSuccessMessage = operation.value === 1 ? 'Cliente creado' : 'Cliente actualizado';
    const routeName = operation.value === 1 ? 'clientes.store' : `clientes.update/${id.value}`;

    form.post(route(routeName), {
        onSuccess: () => {
            ok(onSuccessMessage);
        }
    });
};
const ok = (msj) => {
    form.reset();
    Swal.fire({ title: msj, icon: 'success' });
};

</script>

<template>
    <Head title="Crear Cliente" />
  
    <AuthenticatedLayout>
      <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Crear Cliente</h2>
      </template>
  
      <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg py-12">
            <form @submit.prevent class=" space-y-2 max-w-xl mx-auto grid grid-cols-2 gap-4">
  
              <!-- Columna izquierda -->
              <div class="col-span-1">
                <div class="flex flex-col">

              
                 <label for="pais" class="block font-medium text-gray-700 text-center">País</label>
                 <div class="mt-1 relative rounded-md shadow-sm">
                  <select id="pais" v-model="form.pais" required
                  class="block form-select px-4 py-2 w-full rounded-md transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                        <option value="Colombia">Colombia</option>
                        <option value="Costa Rica">Costa Rica</option>
                  </select>
                  <p class="text-red-500 mt-2" v-if="form.errors.pais">{{ form.errors.pais }}</p>
                  </div>

                  <InputLabel for="ciudad" value="Ciudad" class="text-center"></InputLabel>
                  <TextInput id="ciudad" v-model="form.ciudad" required
                    type="text" class="mt-1 block w-full"></TextInput>
                  <InputError :message="form.errors.ciudad" class="mt-2"></InputError>

                  <InputLabel for="email" value="Correo" class="text-center"></InputLabel>
                  <TextInput id="email" v-model="form.email" required
                  type="text" class="mt-1 block w-full"></TextInput>
                  <InputError :message="form.errors.email" class="mt-2"></InputError>

                </div>
              </div>

  
                  <!-- Columna derecha -->
              <div class="col-span-1" style="margin-top: 0">
                <div class="flex flex-col">
                  <InputLabel for="telefono" value="Teléfono" class="text-center"></InputLabel>
                  <TextInput id="telefono" v-model="form.telefono" required
                   type="text" class="mt-1 block w-full"></TextInput>
                  <InputError :message="form.errors.telefono" class="mt-2"></InputError>
  
                  <InputLabel for="direccion" value="Dirección" class="text-center"></InputLabel>
                  <TextInput id="direccion" v-model="form.direccion" required
                    type="text" class="mt-1 block w-full"></TextInput>
                  <InputError :message="form.errors.direccion" class="mt-2"></InputError>
                  
                </div>

                <InputLabel for="institucion" value="Institución" class="text-center"></InputLabel>
                  <TextInput id="institucion" v-model="form.institucion" required
                    type="text" class="mt-1 block w-full"></TextInput>
                  <InputError :message="form.errors.institucion" class="mt-2"></InputError>
                  
              </div>
                
                <div class="col-span-2 text-center mt-2">
                <PrimaryButton :disabled="form.processing" @click="save">
                  <i class="fa-solid fa-save"></i> Guardar
                </PrimaryButton>
                </div>
            </form>
          </div>
        </div>
      </div>
    </AuthenticatedLayout>
  </template>