<template>
    <div class="container">
        <br/>
        <div class="row">
            <div class="col-md-12">
                <input class="btn btn-primary" type="button" value="Add Product" @click="EnableForm"><br><br>
                 
                <div v-if="message" class="alert alert-success alert-dismissible fade show" role="alert">
                    {{message}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <br>  
                <div v-if="enableForm">
                    <h3 v-if="edit" class="mb-3">Update Product</h3>
                    <h3 v-else class="mb-3">Add Product</h3>
                    <form class="needs-validation" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" v-model="product.name" id="name" >
                                <div v-if="errors.name">{{errors.name[0]}}</div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="category">Category</label>
                                <select class="form-control" v-model="product.id_category" >
                                    <option v-for="category in categories" :key="category.id" :value="category.id" >
                                        {{category.name}}
                                    </option>
                                </select>
                                <div v-if="errors.id_category">{{errors.id_category[0]}}</div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="price">Price</label>
                                <input type="number" step="0.01" class="form-control" v-model="product.price" id="price">
                                <div v-if="errors.price">{{errors.price[0]}}</div>
                            </div>          
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="description">Description</label>
                                <textarea type="text" class="form-control" v-model="product.description" id="description"></textarea>
                                <div v-if="errors.description">{{errors.description[0]}}</div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <img class="card-img-top" :src="'/img/'+product.image" style="height: 200px; width: 70%; display: block;">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="image">Image</label>
                            <input type="file" name="image" @change="imageChanged" class="form-control-file" id="image">
                            <div v-if="errors.image">{{errors.image[0]}}</div>
                        </div>
                        <input v-if="edit" class="btn btn-success" type="button" value="Update" @click="updateProduct">
                        <input v-else class="btn btn-primary" type="button" value="Add Product" @click="AddProduct" >
                        <input v-if="edit" class="btn btn-danger" type="button" value="Cancel" @click="EnableForm" >
                    </form>
                </div>
            </div>
        </div>
        <hr style="height:1px;border-width:0;color:gray;background-color:gray">
        <h3 class="mb-3">Sort & Filter</h3>
        <div class="col-md-6 mb-3">
        <div class="form-check">
            <input class="form-check-input" v-model="selected.value" value="name" type="radio" name="sort">
            <label class="form-check-label" >Sort By Name</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" v-model="selected.value" value="price" type="radio" name="sort">
            <label class="form-check-label" for="sortByPrice">Sort By Price</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" v-model="selected.value" value="untidy" type="radio" name="sort">
            <label class="form-check-label" for="sortByPrice">Untidy</label>
        </div>
        </div>
        <div class="col-md-6 mb-3">
        <div class="form-group">
            <label for="category">Category</label>
            <select class="form-control" v-model="selected.category">
                <option value="0" >All Products</option>
                <option v-for="category in categories" :key="category.id" :value="category.id" >{{category.name}}</option>
            </select>
        </div>
        </div>

        <input type="button" value="Sort & Filter" class="btn btn-primary" @click="sort_filter()" >

        <br><br><br>
        <h3 class="mb-3">Products list</h3>
        <div v-for="category in categories" :key="category.id" >
        <h5 class="mb-3" v v-if="sort_filter.category == category.id" >Category : {{category.name}}</h5>
        </div>
        <div class="row">
            <div class="col-md-3" v-for="product in products" :key="product.id">
              <div class="card mb-4 box-shadow">
                <img class="card-img-top" :src="'/img/'+product.image" alt="Thumbnail" style="height: 225px; width: 100%; display: block;">
                <div class="card-body">
                    <h5>{{product.name}}</h5>
                    <div>
                    <p class="card-text">Price : <strong>{{product.price}}</strong></p>
                    </div>
                    <div v-for="category in categories" :key="category.id" >
                    <p class="card-text" v-if="product.id_category == category.id">Category : <strong>{{category.name}}</strong></p>
                    </div>
                    <p class="card-text">{{product.description}}</p>
                    <div>
                        <a class="btn btn-success btn-sm" @click="editProduct(product)">Edit</a>
                        <a class="btn btn-danger btn-sm" @click="deleteProduct(product)">Delete</a>
                    </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            edit:false,
            enableForm:false,
            selected:{
                value:'',
                category:''
            },
            product:{
                id:'',
                name:'',
                price:'',
                description:'',
                image:'',
                id_category:'',
            },
            category:{
                id:'',
                name:'',
                id_category_parent:''
            },
            products:[],
            categories:[],
            errors:[],
            message:'',
        }
    },
    methods:{
        EnableForm(){
            this.product = {
                id:'',
                name:'',
                price:'',
                description:'',
                image:'',
                id_category:'',
            }
            this.enableForm = true
            this.edit=false
        },

        sort_filter(){
            axios.post('api/SortFilter',this.selected).then(response=>{
                this.products = response.data.data
            })
        },

        imageChanged(e){
            console.log(e.target.files[0])
            this.product.image = e.target.files[0];
        },

        //Add Product 
        AddProduct(){
            let data = new FormData();
            data.append('name', this.product.name);
            data.append('price', this.product.price);
            data.append('description', this.product.description);
            data.append('id_category', this.product.id_category);
            data.append('image',this.product.image);

            axios.post('api/AddProduct',data).then(response=>{
                if(response.data.status == 'success'){
                    this.GetProducts()
                    this.message = response.data.message
                    this.errors = []
                    this.product = {
                        id:'',
                        name:'',
                        price:0,
                        description:'',
                        image:null,
                        id_category:null,
                    }
                    this.enableForm = false
                }
                else if(response.data.status == 'error'){
                    this.errors = response.data.errors
                }
            })  
        },

        deleteProduct(product){
            if(confirm('Are you sure you want to delete '+product.name+' ?'))
            {
                axios.delete('api/deleteProduct/'+product.id).then(response=>{
                    if(response.data.status == 'success')
                        this.message = response.data.message
                    if(response.data.status == 'error')
                        this.errors = response.data.message
                        this.GetProducts();
                })
            }
        },

        editProduct(product){
            this.product = product
            this.enableForm = true
            this.edit = true
        },

        //Get Products
        GetProducts(){
            axios.get('api/getProducts').then(response=>{
                if(response.data.status == 'success'){
                    this.products = response.data.data
                }
                if(response.data.status == 'error'){
                    this.errors = response.data.errors
                }
            })
        },

        //Get Categories
        GetCategories(){
            axios.get('api/getCategories').then(response=>{
                this.categories = response.data.data
            })
        }
    },
    created(){
        this.GetProducts();
        this.GetCategories();
    },

}
</script>