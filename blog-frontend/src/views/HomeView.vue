<template>
  <div class="container py-5 text-center">
    <div class="bg-light p-5 rounded shadow">
      <h1 class="display-4">📝 Bienvenido al Blog</h1>
      <p class="lead mt-3">Explora publicaciones, comparte ideas y únete a nuestra comunidad de escritores.</p>
      <router-link to="/publications" class="btn btn-primary btn-lg mt-4">
        Ver publicaciones
      </router-link>
    </div>
  </div>
</template>

<script>
export default {
  name: 'HomeView'
}
</script>

<style scoped>
/* Puedes agregar estilos personalizados aquí si lo necesitas */
</style>