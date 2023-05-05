<template>
  <h1 class="text-lg font-semibold">Order Builder</h1>
  <!-- Order Items -->
  <div class="overflow-hidden overflow-x-auto relative">
    <table class="w-full divide-y divide-gray-100 dark:divide-gray-700">
      <thead class="bg-gray-50 dark:bg-gray-800">
        <tr>
          <th class="text-left">Item</th>
          <th class="text-left w-48">Quantity</th>
          <th class="text-left w-48">Unit Price</th>
          <th class="text-center">Total</th>
          <th class="text-center w-48">Actions</th>
        </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-100 dark:divide-gray-700 dark:bg-gray-800">
        <tr v-for="item in order.items" :key="item.id" class="p-1">
        
          <td class="pl-5">
            {{ item.product.name }} ({{item.variant.name}})
          </td>
          <td>
            <input type="number" v-model="item.quantity" @change="updateItem(item)" class="w-full form-control form-input form-input-bordered"/>
          </td>
          <td>
            <input type="number" v-model="item.price" @change="updateItem(item)" class="w-full form-control form-input form-input-bordered" />
          </td>
          <td class="text-center">
            {{(item.price * item.quantity)}}
          </td>
          <td class="text-center">
            <OptionsPicker :item="item" @update="updateItem(item)" />
            <button @click="removeItem(item.id)" class="flex-shrink0 shadow rounded focus:outline-none ring-primary-200 dark:ring-gray-600 focus:ring bg-red-500 hover:bg-red-400 active:bg-red-600 text-white dark:text-gray-800 inline-flex items-center font-bold px-4 h-9 text-sm flex-shrink-0">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
              </svg>
            </button>
          </td>
        
        </tr>
      </tbody>
    </table>
  </div>
  <ul>
    
    
    <!-- Order Totals -->
    <li>
      <div class="flex flex-1 bg-white">
        <div class="flex-auto pl-5 pt-2">Subtotal</div>
        <div class="pt-2 text-center w-48">{{order.subtotal}}</div>
      </div>
      <div>
        <div class="flex flex-1 bg-white">
          <div class="flex-auto pl-5 pt-2">Tax</div>
          <div class="pt-2 text-center w-48">{{order.tax}}</div>
        </div>
      </div>
      <div>
        <div class="flex flex-1 bg-white">
          <div class="flex-auto pl-5 pt-2">Total</div>
          <div class="pt-2 text-center w-48">{{order.total}}</div>
        </div>
      </div>
    </li>
    <!-- New Entry line -->
    <li>
      <div class="flex">
        <div class="flex-auto">
          <v-select :options="products" label="name" v-model="product" @update:modelValue="loadVariants" />
        </div>
        <div class="flex-auto">
          <v-select v-model="variant" :options="variants" label="name" />
        </div>
        <div class="flex-auto">
          <input v-model="quantity" type="number" class="w-full form-control form-input form-input-bordered" />
        </div>
        <div><button class="flex-shrink0 shadow rounded focus:outline-none ring-primary-200 dark:ring-gray-600 focus:ring bg-primary-500 hover:bg-primary-400 active:bg-primary-600 text-white dark:text-gray-800 inline-flex items-center font-bold px-4 h-9 text-sm flex-shrink-0" @click="addItem">Add Item</button></div>
      </div>
    </li>
  </ul>
  </template>

<script>
import "vue-select/dist/vue-select.css";
import OptionsPicker from "./OptionsPicker.vue";
export default {
    props: ["resourceName", "resourceId", "panel"],
    data() {
        return {
            product: null,
            variant: null,
            quantity: 1,
            products: [],
            variants: [],
            order: {
                subtotal: 0,
                tax: 0,
                total: 0
            }
        };
    },
    mounted() {
        this.loadOrder();
        this.loadProducts();
    },
    methods: {
        loadOrder() {
            Nova.request().get(`/nova-vendor/order-builder/order/${this.resourceId}`)
                .then(response => {
                this.order = response.data;
                this.items = response.data.items;
            });
        },
        loadProducts() {
            Nova.request()
                .get("/nova-vendor/order-builder/products")
                .then((response) => {
                this.products = response.data;
            });
        },
        loadVariants(value) {
            console.log(value);
            Nova.request()
                .get("/nova-vendor/order-builder/products/" + value.id + "/variants")
                .then((response) => {
                this.variants = response.data;
            });
        },
        addItem() {
            const item = this.items.find(item => item.variant.id == this.variant);
            Nova.request()
                .post("/nova-vendor/order-builder/order/" + this.resourceId + "/items", {
                product_id: this.product.id,
                variant_id: this.variant.id,
                quantity: this.quantity,
            })
                .then((response) => {
                this.order = response.data;
            });
        },
        updateItem(item) {
            Nova.request()
                .put("/nova-vendor/order-builder/order/" + this.resourceId + "/items/" + item.id, {
                quantity: item.quantity,
                price: item.price,
                options: item.options
            })
                .then((response) => {
                this.order = response.data;
            });
        },
        removeItem(id) {
            Nova.request()
                .delete("/nova-vendor/order-builder/order/" + this.resourceId + "/items/" + id)
                .then((response) => {
                this.order = response.data;
            });
        },
    },
    components: { OptionsPicker }
}
</script>
