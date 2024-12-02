# E-commerce Project

This project is an e-commerce site built using Symfony for the backend and Vue.js for the frontend. The backend handles the business logic, database interactions, and API endpoints, while the frontend provides a responsive and interactive user interface.

## Project Structure


## Backend (Symfony)

The backend is built using Symfony and provides the following features:

- User authentication and management
- Product management (CRUD operations)
- Category management (CRUD operations)
- API endpoints for frontend interaction

### Key Files

- `.env`: Environment variables configuration
- `services.yaml`: Service configuration
- `doctrine.yaml`: Doctrine ORM configuration
- `Product.php`: Product entity
- `Category.php`: Category entity
- `CrudController.php`: CRUD operations for products
- `ProductRepository.php`: Product repository

## Frontend (Vue.js)

The frontend is built using Vue.js and provides the following features:

- User authentication
- Product listing and management
- Category listing and management
- Responsive design

### Key Files

- `main.ts`: Main entry point for the Vue application
- `index.ts`: Vue Router configuration
- `product.ts`: Pinia store for product management
- `Products.vue`: Products view
- `Home.vue`: Home view
- `Login.vue`: Login view
- `Subscribe.vue`: Subscribe view

## Installation

### Backend

1. Navigate to the `back_symfony` directory:
   ```sh
   cd back_symfony

2. Install dependencies:
   ```sh
   composer install

3. Set up the database
4. Start the Symfony server
    ```sh
    symfony server:start

 ### Frontend
 1. Navigate to the front-vue directory:
     ```sh
     cd front-vue

2. Install dependencies:
    ```sh
    npm install

3. Start the development server:
    ```sh
    npm run dev

### Usage
    NB: The port is pre-configured or you can take the default
    
    Access the frontend at http://localhost:3000
    Access the backend API at http://localhost:8000/api

  





