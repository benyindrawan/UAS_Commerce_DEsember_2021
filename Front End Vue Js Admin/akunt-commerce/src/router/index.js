import {createRouter, createWebHistory } from 'vue-router'


const routes = [

    //Category
    {
        path: '/',
        name: 'category.index',
        component: () => import("../views/categorys/Index.vue")
    },

    {
        path: '/category/create',
        name: 'category.create',
        component: () => import("../views/categorys/Create.vue")
    },

    {
        path: '/category/edit/:id',
        name: 'category.edit',
        component: () => import("../views/categorys/Edit.vue")
    },
    //Product
    {
        path: '/product',
        name: 'product.index',
        component: () => import("../views/products/IndexProduct.vue")
    },

    {
        path: '/product/create',
        name: 'product.create',
        component: () => import("../views/products/CreateProduct.vue")
    },

    {
        path: '/product/edit/:id',
        name: 'product.edit',
        component: () => import("../views/products/EditProduct.vue")
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});


export default router;