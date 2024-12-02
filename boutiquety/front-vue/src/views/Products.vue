<script setup lang="ts">
import { ref, onMounted } from 'vue'
import { useProductStore } from '../stores/product'

const productStore = useProductStore()
const showForm = ref(false)
const editingProduct = ref(null)

const newProduct = ref({
  name: '',
  description: '',
  slug: '',
  price: 0
})

onMounted(async () => {
  await productStore.fetchProducts()
})

const handleSubmit = async () => {
  try {
    if (editingProduct.value) {
      await productStore.updateProduct({
        ...newProduct.value,
        id: editingProduct.value.id
      })
    } else {
      await productStore.addProduct(newProduct.value)
    }
    resetForm()
  } catch (error) {
    console.error('Failed to save product:', error)
  }
}

const editProduct = (product) => {
  editingProduct.value = product
  newProduct.value = { ...product }
  showForm.value = true
}

const deleteProduct = async (id) => {
  if (confirm('Are you sure you want to delete this product?')) {
    await productStore.deleteProduct(id)
  }
}

const resetForm = () => {
  newProduct.value = {
    name: '',
    description: '',
    price: 0
  }
  editingProduct.value = null
  showForm.value = false
}
</script>

<template>
  <div class="container mt-5">
    <h2 class="mb-4">Products Management</h2>
    
    <button 
      class="btn btn-primary mb-4" 
      @click="showForm = !showForm"
      v-if="!showForm"
    >
      Add New Product
    </button>

    <div v-if="showForm" class="card mb-4">
      <div class="card-body">
        <h3>{{ editingProduct ? 'Edit Product' : 'Add New Product' }}</h3>
        <form @submit.prevent="handleSubmit">
          <div class="mb-3">
            <label class="form-label">Name</label>
            <input 
              type="text" 
              class="form-control" 
              v-model="newProduct.name" 
              required
            >
          </div>
          <div class="mb-3">
            <label class="form-label">Slug</label>
            <input 
              type="text" 
              class="form-control" 
              v-model="newProduct.slug" 
              required
            >
          </div>
          <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea 
              class="form-control" 
              v-model="newProduct.description" 
              required
            ></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label">Price</label>
            <input 
              type="number" 
              class="form-control" 
              v-model="newProduct.price" 
              required
            >
          </div>
          <button type="submit" class="btn btn-primary me-2">
            {{ editingProduct ? 'Update' : 'Add' }} Product
          </button>
          <button type="button" class="btn btn-secondary" @click="resetForm">
            Cancel
          </button>
        </form>
      </div>
    </div>

    <div class="row">
      <div v-for="product in productStore.products" :key="product.id" class="col-md-6 mb-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">{{ product.name }}</h5>
            <p class="card-text">{{ product.description }}</p>
            <p class="card-text"><strong>Price: ${{ product.price }}</strong></p>
            <button 
              class="btn btn-warning me-2" 
              @click="editProduct(product)"
            >
              Edit
            </button>
            <button 
              class="btn btn-danger" 
              @click="deleteProduct(product.id)"
            >
              Delete
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>