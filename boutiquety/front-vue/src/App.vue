<script setup lang="ts">
import { useUserStore } from './stores/user'
const userStore = useUserStore()
</script>

<template>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <router-link class="navbar-brand" to="/">Our Company</router-link>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <router-link class="nav-link" to="/">Home</router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/products">Products</router-link>
          </li>
        </ul>
        <ul class="navbar-nav">
          <template v-if="userStore.isAuthenticated">
            <li class="nav-item">
              <span class="nav-link">Welcome, {{ userStore.currentUser?.name }}</span>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" @click.prevent="userStore.logout">Logout</a>
            </li>
          </template>
          <template v-else>
            <li class="nav-item">
              <router-link class="nav-link" to="/login">Login</router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" to="/subscribe">Subscribe</router-link>
            </li>
          </template>
        </ul>
      </div>
    </div>
  </nav>

  <router-view></router-view>
</template>

<style>
#app {
  max-width: none;
  margin: 0;
  padding: 0;
  text-align: left;
}
</style>