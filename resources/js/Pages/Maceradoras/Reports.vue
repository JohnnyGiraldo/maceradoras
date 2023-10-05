<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import {ref} from 'vue';
import InputLabel from '@/Components/InputLabel.vue';
import SelectInput from '@/Components/SelectInput.vue';
import DataTable from 'datatables.net-vue3';
import 'datatables.net-dt/css/jquery.dataTables.css';
import ButtonsHtml5 from 'datatables.net-buttons/js/buttons.html5';
import 'datatables.net-buttons/js/buttons.print';
import 'datatables.net-responsive-dt';
import 'datatables.net-responsive-dt/css/responsive.dataTables.min.css';
import JsZip from 'jszip';
import pdfmake from "pdfmake/build/pdfmake";
import * as pdfFonts from "pdfmake/build/vfs_fonts";
pdfmake.vfs = pdfFonts.pdfMake ? pdfFonts.pdfMake.vfs : pdfmake.vfs;
window.JSZip = JsZip;
DataTable.use(ButtonsHtml5);

const props = defineProps({
    maceradoras:{type:Object},clientes:{type:Object}
});

const columns1 = ref([]);
const columns2 = ref([]);
const buttons1 = ref([]);
const buttons2 = ref([]);
const report = ref('1');
const typesp = [{'id':'1','name':"Maceradoras"},{'id':'2','name':"Clientes"}];

columns1.value= [{data:null,render:function(data,type,row,meta)
    {return (meta.row + 1)}},
    { data: 'serial' },
    { data: 'modelo' },
    { data: 'estado' },
    { data: 'fechaFabricacion' },
    { data: 'tipoAsistencia' },
    { data: 'fechaInstalacion' },
    { data: 'tipoMantenimiento' },
    { data: 'fechaMantenimiento' },
    { data: 'tipoPieza' },
    { data: 'fechaCambioPieza' },
    { data: 'numeroCiclos' },
    { data: 'fechaIncidente' },
    { data: 'observaciones' },
    { data: 'institucion'},
]
columns2.value= [{data:null,render:function(data,type,row,meta)
    {return (meta.row + 1)}},
    { data: 'pais' },
    { data: 'ciudad' },
    { data: 'institucion' },
    { data: 'email' },
    { data: 'telefono' },
    { data: 'direccion' },
]
buttons1.value= [
    {
        title:'Maceradoras',extend:'excelHtml5', 
        text:'<i class="fa-solid fa-file-excel"></i> Excel',
        className:'inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150'
    },
    {
        title:'Maceradoras',extend:'pdfHtml5', 
        text:'<i class="fa-solid fa-file-pdf"></i> PDF',
        orientation: 'landscape',
        pageSize: 'A2',
        
        className:'inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150'
    },
    {
        title:'Maceradoras',extend:'print', 
        text:'<i class="fa-solid fa-print"></i> PRINT',
        className:'inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'
    },
    {
        title:'Maceradoras',extend:'copy', 
        text:'<i class="fa-solid fa-copy"></i> COPY',
        className:'inline-flex items-center px-4 py-2 bg-gray-200 border border-gray-800 rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'
    }
]

buttons2.value= [
    {
        title:'Clientes',extend:'excelHtml5', 
        text:'<i class="fa-solid fa-file-excel"></i> Excel',
        className:'inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150'
    },
    {
        title:'Clientes',extend:'pdfHtml5', 
        text:'<i class="fa-solid fa-file-pdf"></i> PDF',
        className:'inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150'
    },
    {
        title:'Clientes',extend:'print', 
        text:'<i class="fa-solid fa-print"></i> PRINT',
        className:'inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'
    },
    {
        title:'Clientes',extend:'copy', 
        text:'<i class="fa-solid fa-copy"></i> COPY',
        className:'inline-flex items-center px-4 py-2 bg-gray-200 border border-gray-800 rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'
    }
]

</script>

<template>
    <Head title="Reportes" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Reportes</h2>
        </template>

        <div class="py-12">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="px-6 py-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <InputLabel for="reps" Value="Report:"></InputLabel>
                    <SelectInput id="rep" class="mt-1 block w-3/4"
                    v-model="report" :options="typesp"></SelectInput>
                </div>
                <div v-if="report == '1'" class="px-6 py-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <DataTable :data="maceradoras" :columns="columns1"
                    class="w-full border border-gray-400" 
                    :options="{responsive:true, autoWidth:false,dom:'Bfrtip',buttons:buttons1}">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-2 py-2">Nro</th>
                                <th class="px-2 py-2">Serial:</th>
                                <th class="px-2 py-2">Modelo:</th>
                                <th class="px-2 py-2">Estado:</th>
                                <th class="px-2 py-2">Fecha de Fabricación</th>
                                <th class="px-2 py-2">Tipo de Asistencia</th>
                                <th class="px-2 py-2">Fecha de Instalación</th>
                                <th class="px-2 py-2">Tipo de Mantenimiento</th>
                                <th class="px-2 py-2">Fecha de Mantenimiento</th>
                                <th class="px-2 py-2">Tipo de Pieza</th>
                                <th class="px-2 py-2">Fecha de Cambio de Pieza</th>
                                <th class="px-2 py-2">Número de Ciclos</th>
                                <th class="px-2 py-2">Fecha de Incidente</th>
                                <th class="px-2 py-2">Observaciones</th>
                                <th class="px-2 py-2">Institucion</th>
                        </tr>
                    </thead>
                    </DataTable>
                </div>
                <div v-else class="px-6 py-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <DataTable :data="clientes" :columns="columns2"
                    class="w-full border border-gray-400" 
                    :options="{responsive:true, autoWidth:false,dom:'Bfrtip',buttons:buttons2}">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-2 py-2">Nro</th>
                            <th class="px-2 py-2">País</th>
                            <th class="px-2 py-2">Ciudad</th>
                            <th class="px-2 py-2">Institución</th>
                            <th class="px-2 py-2">Email</th>
                            <th class="px-2 py-2">Teléfono</th>
                            <th class="px-2 py-2">Dirección</th>
                        </tr>
                    </thead>
                    </DataTable>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>