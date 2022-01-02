<template>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">Admin</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/">Category</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/product">Product</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
     <div class="container my-30">
        <div class="row justify-content-center">
            <div class="col-30">
                <router-link :to="{ name: 'category.index'}" class="btn btn-primary btn-sm rounded shadow mb-3">Back</router-link>
                <div class="card rounded shadow">
                    <div class="card-header">
                        Product Create
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="store()">
                            <div class="mb-3">
                                <label for="" class="form-label">Name</label>
                                <input type="text" class="form-control" v-model="transaction.name">
                                <div v-if="validation.name" class="text-danger">
                                    {{validation.name[0]}}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Slug</label>
                                <input type="text" class="form-control" v-model="transaction.slug">
                               <div v-if="validation.slug" class="text-danger">
                                    {{validation.slug[0]}}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Short Description</label>
                                <input type="text" class="form-control" v-model="transaction.short_description">
                               <div v-if="validation.short_description" class="text-danger">
                                    {{validation.short_description[0]}}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Description</label>
                                <input type="text" class="form-control" v-model="transaction.description">
                               <div v-if="validation.description" class="text-danger">
                                    {{validation.description[0]}}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Regular Price</label>
                                <input type="number" class="form-control" v-model="transaction.regular_price">
                               <div v-if="validation.regular_price" class="text-danger">
                                    {{validation.regular_price[0]}}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Sale Price</label>
                                <input type="number" class="form-control" v-model="transaction.sale_price">
                               <div v-if="validation.sale_price" class="text-danger">
                                    {{validation.sale_price[0]}}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">SKU</label>
                                <input type="text" class="form-control" v-model="transaction.SKU">
                               <div v-if="validation.SKU" class="text-danger">
                                    {{validation.SKU[0]}}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Stock Status</label>
                                <select id="" class="form-select" v-model="transaction.stock_status">
                                    <option value="instock">In Stock</option>
                                    <option value="outofstock">Out Of Stock</option>
                                </select>
                               <div v-if="validation.stock_status" class="text-danger">
                                    {{validation.stock_status[0]}}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Featured</label>
                                <select id="" class="form-select" v-model="transaction.featured">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                               <div v-if="validation.featured" class="text-danger">
                                    {{validation.featured[0]}}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Quantity</label>
                                <input type="number" class="form-control" v-model="transaction.quantity">
                               <div v-if="validation.quantity" class="text-danger">
                                    {{validation.quantity[0]}}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Image</label>
                                <input type="text" class="form-control" v-model="transaction.image">
                               <div v-if="validation.image" class="text-danger">
                                    {{validation.image[0]}}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Category ID</label>
                                <input type="text" class="form-control" v-model="transaction.category_id">
                               <div v-if="validation.category_id" class="text-danger">
                                    {{validation.category_id[0]}}
                                </div>
                            </div>
                            <button class="btn btn-outline-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {reactive, ref} from 'vue'
import {useRouter} from 'vue-router'
import axios from 'axios'
export default {
    setup() {
        //data binding
        const transaction = reactive({
            name: '',
            slug: '',
            short_description: '',
            description: '',
            regular_price: '',
            sale_price: '',
            SKU: '',
            stock_status: '',
            featured: '',
            quantity: '',
            image: '',
            category_id: '',
        });

        const validation = ref([]);
        const router = useRouter();

        function store() {
            axios.post(
                'http://127.0.0.1:8000/api/product',
                transaction
            )
            .then(() => {
                router.push({
                    name: 'product.index'
                });
            }).catch((err) =>{
                validation.value=err.response.data
            });
        }

        return{
            transaction,
            validation,
            router,
            store
        }
    }
}
</script>