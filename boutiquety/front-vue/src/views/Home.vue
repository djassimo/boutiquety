<script setup lang="ts">
import { useUserStore } from '../stores/user'
const userStore = useUserStore()
</script>

<template>
  <div class="container mt-5">
    <div class="jumbotron">
      <h1 class="display-4">Welcome to Our Company</h1>
      <p class="lead">We're delighted to have you here!</p>
      <hr class="my-4">
      <p v-if="userStore.isAuthenticated">
        Welcome back, {{ userStore.currentUser?.name }}!
      </p>
      <p v-else>
        <router-link to="/login" class="btn btn-primary me-2">Login</router-link>
        <router-link to="/subscribe" class="btn btn-success">Subscribe</router-link>
      </p>
    </div>
  </div>
</template>