<template>
  <div class="container mt-5">
    <div class="card shadow">
      <div class="card-header bg-warning text-white">
        <h3 class="mb-0">Editar publicación</h3>
      </div>
      <div class="card-body">
        <form @submit.prevent="updatePost">
          <div class="mb-3">
            <label for="title" class="form-label">Título</label>
            <input
              id="title"
              v-model="form.title"
              type="text"
              class="form-control"
              placeholder="Título de la publicación"
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
              placeholder="Contenido"
              required
            ></textarea>
          </div>

          <button type="submit" class="btn btn-primary">
            Guardar cambios
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
  async created() {
    const res = await api.get(`/publications/${this.$route.params.id}`)
    this.form = {
      title: res.data.title,
      content: res.data.content
    }
  },
  methods: {
    async updatePost() {
      try {
        await api.put(`/publications/${this.$route.params.id}`, this.form)
        this.$router.push(`/publications/${this.$route.params.id}`)
      } catch (err) {
        alert('Error al actualizar publicación')
      }
    }
  }
}
</script>