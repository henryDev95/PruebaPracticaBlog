<template>
    <div class="container mt-5">
      <div class="card mb-4 shadow">
        <div class="card-body">
          <h2 class="card-title">{{ publication.title }}</h2>
          <p class="card-text">{{ publication.content }}</p>
          <p class="text-muted">
            <i>Por: {{ publication.user?.name }}</i>
          </p>
  
          <div v-if="isAuthor" class="mt-3">
            <router-link :to="`/edit/${publication.id}`" class="btn btn-warning me-2">
                <i class="bi bi-pencil-fill me-1"></i> Editar
            </router-link>
            <button @click="deletePost" class="btn btn-danger">
                <i class="bi bi-trash-fill me-1"></i> Eliminar
            </button>
          </div>
        </div>
      </div>
  
      <!-- Formulario para comentar -->
      <div class="card mb-4">
        <div class="card-header bg-primary text-white">
          Añadir un comentario
        </div>
        <div class="card-body">
          <form @submit.prevent="addComment">
            <div class="mb-3">
              <textarea
                v-model="commentText"
                class="form-control"
                rows="3"
                placeholder="Escribe un comentario"
                required
              ></textarea>
            </div>
            <button class="btn btn-success" type="submit">Comentar</button>
          </form>
        </div>
      </div>
  
      <!-- Comentarios -->
      <div class="card">
        <div class="card-header bg-secondary text-white">
          Comentarios
        </div>
        <ul class="list-group list-group-flush">
          <li v-for="comment in comments" :key="comment.id" class="list-group-item">
            <strong>{{ comment.user?.name || 'Anónimo' }}</strong>: {{ comment.content }}
          </li>
        </ul>
      </div>
    </div>
  </template>
  
  <script>
  import api from '@/axios'
  
  export default {
    data() {
      return {
        publication: {},
        comments: [],
        commentText: ''
      }
    },
    async created() {
      const id = this.$route.params.id
      this.loadPublication(id)
      this.loadComments(id)
    },
    computed: {
      isAuthor() {
        const userId = JSON.parse(localStorage.getItem('user'))?.id
        return this.publication.user?.id === userId
      }
    },
    methods: {
      async loadPublication(id) {
        const res = await api.get(`/publications/${id}`)
        this.publication = res.data
      },
      async loadComments(id) {
        const res = await api.get(`/publications/${id}/comments`)
        this.comments = res.data
      },
      async addComment() {
        const id = this.$route.params.id
        try {
          const res = await api.post(`/publications/${id}/comments`, {
            content: this.commentText
          })
          this.comments.unshift(res.data)
          this.commentText = ''
        } catch (err) {
          alert('Error al comentar (¿estás logueado?)')
        }
      },
      async deletePost() {
        if (!confirm('¿Seguro que quieres eliminar esta publicación?')) return
        try {
          await api.delete(`/publications/${this.publication.id}`)
          this.$router.push('/publications')
        } catch (err) {
          alert('Error al eliminar')
        }
      }
    }
  }
  </script>