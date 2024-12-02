<script setup lang="ts">
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { useUserStore } from '../stores/user'

const router = useRouter()
const userStore = useUserStore()

const name = ref('')
const email = ref('')
const password = ref('')
const error = ref('')

const handleSubscribe = async () => {
  try {
    await userStore.register({
      name: name.value,
      email: email.value
    })
    router.push('/login')
  } catch (e) {
    error.value = 'Registration failed'
  }
}
</script>

<template>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h3 class="text-center">Subscribe</h3>
          </div>
          <div class="card-body">
            <form @submit.prevent="handleSubscribe">
              <div class="mb-3">
                <label class="form-label">Name</label>
                <input 
                  type="text" 
                  class="form-control" 
                  v-model="name" 
                  required
                >
              </div>
              <div class="mb-3">
                <label class="form-label">Email</label>
                <input 
                  type="email" 
                  class="form-control" 
                  v-model="email" 
                  required
                >
              </div>
              <div class="mb-3">
                <label class="form-label">Password</label>
                <input 
                  type="password" 
                  class="form-control" 
                  v-model="password" 
                  required
                >
              </div>
              <div v-if="error" class="alert alert-danger">
                {{ error }}
              </div>
              <button type="submit" class="btn btn-success w-100">Subscribe</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>