<template>
    <div class="container mt-5">
      <h2 class="text-center mb-4">📚 Publicaciones Recientes</h2>
  
      <div class="row">
        <div
          v-for="publication in publications"
          :key="publication.id"
          class="col-md-6 col-lg-4 mb-4"
        >
          <div class="card h-100 shadow-sm">
            <div class="card-body d-flex flex-column">
              <h5 class="card-title">{{ publication.title }}</h5>
              <p class="card-text text-muted small">
                {{ formatDate(publication.created_at) }}
              </p>
              <p class="card-text flex-grow-1">
                {{ truncate(publication.content, 100) }}
              </p>
              <router-link
                :to="`/publications/${publication.id}`"
                class="btn btn-primary mt-auto"
              >
                Ver más
              </router-link>
            </div>
          </div>
        </div>
      </div>
  
      <div v-if="publications.length === 0" class="alert alert-info text-center">
        No hay publicaciones disponibles.
      </div>
    </div>
</template>
  
<script setup>
import { onMounted, ref } from 'vue'
import api from '@/axios'

const publications = ref([])

const fetchPublications = async () => {
  try {
    const res = await api.get('/publications')
    publications.value = res.data
  } catch (error) {
    console.error('Error al cargar publicaciones:', error)
  }
}

const truncate = (text, length) => {
  return text.length > length ? text.substring(0, length) + '...' : text
}


const formatDate = (dateString) => {
  const date = new Date(dateString)
  return date.toLocaleDateString('es-ES', {
    day: 'numeric',
    month: 'long',
    year: 'numeric'
  })
}

onMounted(fetchPublications)

</script>