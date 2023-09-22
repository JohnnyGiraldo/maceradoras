<template>
    <div>
      <input type="file" @change="handleFileChange" />
    </div>
  </template>
  
  <script>
  export default {
    methods: {
      handleFileChange(event) {
        // Accede al archivo seleccionado
        const file = event.target.files[0];
        // Emite un evento personalizado para enviar el archivo al componente padre
        this.$emit('file-selected', file);
      },
    },
  };
  </script>
  