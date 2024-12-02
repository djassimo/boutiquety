import { defineStore } from 'pinia'
import axios from 'axios'

interface User {
  id?: number
  email: string
  name: string
}

export const useUserStore = defineStore('user', {
  state: () => ({
    currentUser: null as User | null,
    isAuthenticated: false
  }),
  
  actions: {
    async login(email: string, password: string) {
      try {
        // Replace with your actual API endpoint
        const response = await axios.post('/api/login', { email, password })
        this.currentUser = response.data.user
        this.isAuthenticated = true
        return true
      } catch (error) {
        console.error('Login failed:', error)
        return false
      }
    },

    async register(userData: User) {
      try {
        // Replace with your actual API endpoint
        const response = await axios.post('/api/register', userData)
        return response.data
      } catch (error) {
        console.error('Registration failed:', error)
        throw error
      }
    },

    logout() {
      this.currentUser = null
      this.isAuthenticated = false
    }
  }
})