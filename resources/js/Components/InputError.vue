<template>
    <div v-if="message" class="alert alert-danger">
      <p>{{ message }}</p>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      message: String, // A mensagem do erro que será passada como prop
    },
  };
  </script>
  
  <style scoped>
  .alert-danger {
    color: red;
    background-color: #f8d7da;
    border-color: #f5c6cb;
  }
  </style>
  