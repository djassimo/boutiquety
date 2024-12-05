import { defineStore } from 'pinia'
import axios from 'axios'


export interface Category {
  id: number;
  name: string;
  description: string;
  slug: string;
}

export interface Product {
  id: number | null;
  name: string | null;
  slug: string | null;
  description: string | null;
  price: number | null;
  category: Category | null;
}


export const useProductStore = defineStore('product', {
  state: () => ({
    products: [] as Product[]
  }),
  
  actions: {
    async fetchProducts() {
      try {
        // Replace with your actual API endpoint
        const response = await axios.get('http://localhost:8000/api/products')
                

        this.products = JSON.parse(response.data)
      } catch (error) {
        console.error('Failed to fetch products:', error)
        throw error
      }
    },

    async addProduct(product: Product) {
      try {
        const response = await axios.post('http://localhost:8000/api/product/add', product)
        this.products.push(response.data)
        return response.data
      } catch (error) {
        console.error('Failed to add product:', error)
        throw error
      }
    },

    async updateProduct(product: Product) {
      try {
        const response = await axios.put(`/api/products/${product.id}`, product)
        const index = this.products.findIndex(p => p.id === product.id)
        if (index !== -1) {
          this.products[index] = response.data
        }
        return response.data
      } catch (error) {
        console.error('Failed to update product:', error)
        throw error
      }
    },

    async deleteProduct(id: number) {
      try {
        await axios.delete(`/api/products/${id}`)
        this.products = this.products.filter(p => p.id !== id)
      } catch (error) {
        console.error('Failed to delete product:', error)
        throw error
      }
    }
  }
})