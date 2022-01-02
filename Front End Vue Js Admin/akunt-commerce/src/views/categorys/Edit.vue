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
     <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-8">
                <router-link :to="{ name: 'category.index'}" class="btn btn-primary btn-sm rounded shadow mb-3">Back</router-link>
                <div class="card rounded shadow">
                    <div class="card-header">
                        Category Edit
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="update()">
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
                            <button class="btn btn-outline-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {reactive, ref, onMounted} from 'vue'
import {useRouter, useRoute} from 'vue-router'
import axios from 'axios'
export default {
    setup() {
        //data binding
        let transaction = reactive({
            name: '',
            slug: '',
        });

        const validation = ref([]);
        const router = useRouter();
        const route = useRoute();

        onMounted(()=>{
            axios.get(`http://127.0.0.1:8000/api/category/${route.params.id}`)
            .then((result)=>{
                transaction.name = result.data.data.name
                transaction.slug = result.data.data.slug

            }).catch((err)=>{
                console.log(err.response.data)
            });
        });

        function update() {
            axios.put(
                `http://127.0.0.1:8000/api/category/${route.params.id}`,
                transaction
            )
            .then(() => {
                router.push({
                    name: 'category.index'
                });
            }).catch((err) =>{
                validation.value=err.response.data
            });
        }

        return{
            transaction,
            validation,
            router,
            update
        }
    }
}
</script>