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
                <router-link :to="{ name: 'product.create'}" class="btn btn-primary btn-sm rounded shadow mb-20">Add</router-link>
                <div class="card rounded shadow">
                    <div class="card-header">
                        Product List
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Short Description</th>
                                    <th>Description</th>
                                    <th>Regular Price</th>
                                    <th>Sale Price</th>
                                    <th>SKU</th>
                                    <th>Stock Status</th>
                                    <th>Featured</th>
                                    <th>Quantity</th>
                                    <th>Image</th>
                                    <th>Category ID</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(transaction,index) in transactions.data" :key="index">
                                    <td>{{transaction.name}}</td>
                                    <td>{{transaction.slug}}</td>
                                    <td>{{transaction.short_description}}</td>
                                    <td>{{transaction.description}}</td>
                                    <td>{{transaction.regular_price}}</td>
                                    <td>{{transaction.sale_price}}</td>
                                    <td>{{transaction.SKU}}</td>
                                    <td>{{transaction.stock_status}}</td>
                                    <td>{{transaction.featured}}</td>
                                    <td>{{transaction.quantity}}</td>
                                    <td>{{transaction.image}}</td>
                                    <td>{{transaction.category_id}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <router-link :to="{name: 'product.edit', params:{id:transaction.id}}" class="btn btn-sm btn-outline-info"> Edit</router-link>
                                            <button class="btn btn-sm btn-outline-danger" @click.prevent="destroy(transaction.id, index)">Delete</button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
import {onMounted,ref} from 'vue'

export default {
    setup() {
        // reactive state
        let transactions=ref([]);

        onMounted(() =>{
            //get data from api endpoint
            axios.get('http://127.0.0.1:8000/api/product')
            .then((result)=>{
                transactions.value=result.data
            }).catch((err)=>{
                console.log(err.response)
            });
        });

        function destroy(id, index){
             axios.delete(
                `http://127.0.0.1:8000/api/product/${id}`,
            )
            .then(() => {
                transactions.value.data.splice(index,1)
            }).catch((err) =>{
               console.log(err.response.data);
            });
        }
        
        return {
            transactions,
            destroy
        }
    }
}
</script>