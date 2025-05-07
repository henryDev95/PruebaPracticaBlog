<template>
  <div class="container mt-5">
    <div class="card shadow">
      <div class="card-header bg-primary text-white">
        <h3 class="mb-0">Crear nueva publicación</h3>
      </div>
      <div class="card-body">
        <form @submit.prevent="createPost">
          <div class="mb-3">
            <label for="title" class="form-label">Título</label>
            <input
              id="title"
              v-model="form.title"
              type="text"
              class="form-control"
              placeholder="Ingresa el título"
              required
            />
          </div>

          <div class="mb-3">
            <label for="content" class="form-label">Contenido</label>
            <textarea
              id="content"
              v-model="form.content"
              class="form-control"
              rows="5"
              placeholder="Escribe el contenido de la publicación"
              required
            ></textarea>
          </div>

          <button type="submit" class="btn btn-success">
            Publicar
          </button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>

import api from '@/axios'

export default {
  data() {
    return {
      form: {
        title: '',
        content: ''
      }
    }
  },
  methods: {
    async createPost() {
      try {
        await api.post('/publications', this.form)
        this.$router.push('/publications')
      } catch (err) {
        alert('Error al crear publicación')
      }
    }
  }
}
</script>