<template>
  <div class="container d-flex align-items-center justify-content-center min-vh-100">
    <div class="card shadow-lg p-4" style="width: 100%; max-width: 450px;">
      <h3 class="text-center mb-4">Crear una cuenta</h3>
      <form @submit.prevent="handleRegister">
        <div class="form-group">
          <label for="name">Nombre completo</label>
          <input type="text" id="name" v-model="form.name" class="form-control" required />
        </div>

        <div class="form-group">
          <label for="email">Correo electrónico</label>
          <input type="email" id="email" v-model="form.email" class="form-control" required />
        </div>

        <div class="form-group">
          <label for="password">Contraseña</label>
          <input type="password" id="password" v-model="form.password" class="form-control" required />
        </div>

        <div class="form-group">
          <label for="password_confirmation">Confirmar contraseña</label>
          <input type="password" id="password_confirmation" v-model="form.password_confirmation" class="form-control"
            required />
        </div>

        <div v-if="error" class="alert alert-danger mt-3">
          {{ error }}
        </div>

        <button type="submit" class="btn btn-success btn-block mt-3">
          Registrarse
        </button>
      </form>

      <div class="text-center mt-3">
        <router-link to="/login">¿Ya tienes una cuenta? Inicia sesión</router-link>
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
        name: '',
        email: '',
        password: ''
      },
      error: null
    }
  },
  methods: {
    async handleRegister() {
      this.error = null
      try {
        const res = await api.post('/register', this.form)
        localStorage.setItem('token', res.data.token)

        this.$store.dispatch('login')

        this.$router.push('/publications')
      } catch (err) {
        this.error = 'Error al registrarse.'
      }
    }
  }
}
</script>
