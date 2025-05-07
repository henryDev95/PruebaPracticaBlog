

<template>
  <div class="container d-flex align-items-center justify-content-center min-vh-100">
    <div class="card shadow-lg p-4" style="width: 100%; max-width: 400px;">
      <h3 class="text-center mb-4">Iniciar sesión</h3>
      <form @submit.prevent="login">
        <div class="form-group">
          <label for="email">Correo electrónico</label>
          <input
            type="email"
            id="email"
            v-model="form.email"
            class="form-control"
            required
          />
        </div>

        <div class="form-group">
          <label for="password">Contraseña</label>
          <input
            type="password"
            id="password"
            v-model="form.password"
            class="form-control"
            required
          />
        </div>

        <div v-if="error" class="alert alert-danger mt-3">
          {{ error }}
        </div>

        <button type="submit" class="btn btn-primary btn-block mt-3">
          Iniciar sesión
        </button>
      </form>

      <div class="text-center mt-3">
        <router-link to="/register">¿No tienes una cuenta? Regístrate</router-link>
      </div>
    </div>
  </div>
</template>


<script>
import api from '@/axios'
import router from '@/router'

export default {
  data() {
    return {
      form: {
        email: '',
        password: '',
      },
      error: null
    }
  },
  methods: {
    async login() {
      try {
        const res = await api.post('/login', this.form)
        localStorage.setItem('token', res.data.token)
        this.$store.dispatch('login')
        router.push('/publications')
      } catch (err) {
        this.error = 'Correo o contraseña incorrectos.'
      }
    }
  }
}
</script>