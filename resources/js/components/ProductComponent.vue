<template>
    <section class="ftco-section">
        <div class="container">
            <!-- BUTTON NEW PRODUCT -->
            <div class="row justify-content-end" v-if="role === 'admin' || role === 'super'">
                <div class="col-md-3 mb-5 text-center">
                    <ul class="product-category">
                        <a v-if="role === 'admin'" :href="'/admin/shop/'+singleProduct.id+'/edit'" class="btn btn-primary"><i class="fas fa-plus"></i>
                            Edit Product</a>
                        <a v-else :href="'/super/shop/'+singleProduct.id+'/edit'" class="btn btn-primary"><i class="fas fa-plus"></i>
                            Edit Product</a>
                    </ul>
                </div>
            </div>
            <!-- END BUTTON NEW PRODUCT -->
            <div class="row">
                <div class="col-lg-6 mb-5 ftco-animate">
                    <a :href="'/storage/product/'+singleProduct.image" class="image-popup"><img :src="'/storage/product/'+singleProduct.image"
                                                         class="img-fluid" alt="Colorlib Template"></a>
                </div>
                <div class="col-lg-6 product-details pl-md-5 ftco-animate">
                    <h3>{{singleProduct.item_name}}</h3>
                    <div class="rating d-flex">
                        <p class="text-left">
                            <a href="#" class="mr-2" style="color: #000;">{{singleProduct.unit*0.2}} Kg
                                <span v-if="singleProduct.unit !== 0" style="color: #bbb;">Available</span>
                                <span v-else style="color: #f00;">Sold Out</span>
                            </a>
                        </p>
                    </div>
                    <p class="price"><span>Rp {{singleProduct.price}}</span></p>
                    <p>{{singleProduct.item_description}}
                    </p>
                    <template v-if="singleProduct.unit === 0">
                        <div class="row mt-4">
                            <div class="w-100"></div>
                            <div class="col-md-12 pt-3 text-center" style="color: #ffffff;background-color: grey;">
                                <p>Product Not Available</p>
                            </div>
                        </div>
                    </template>
                    <template v-else>
                        <div class="row mt-4">
                            <div class="w-100"></div>
                            <div class="input-group col-md-6 d-flex mb-3">
							<span class="input-group-btn mr-2">
								<button type="button" class="quantity-left-minus btn" data-type="minus" data-field="" @click="quantity-1 < 0 ? quantity : quantity--">
									<i class="ion-ios-remove"></i>
								</button>
							</span>
                                <input type="text" v-model="quantity" id="quantity" name="quantity" class="form-control input-number" value="1"
                                       min="1" max="100">
                                <span class="input-group-btn ml-2">
								<button type="button" class="quantity-right-plus btn" data-type="plus" data-field="" @click="quantity+1 > singleProduct.unit ? quantity : quantity++">
									<i class="ion-ios-add"></i>
								</button>
							</span>
                            </div>
                        </div>
                        <p>
                            200 grams per items
                            <small class="text-danger">
                                *Outside Jember a minimum purchase must be 10 kg
                            </small>
                        </p>

                        <p v-if="role !== 'guest'"><a href="cart.html" class="btn btn-black py-3 px-5" data-toggle="modal"
                              data-target="#cartVerifyModal">Add to Cart</a></p>
                        <p v-else>You must Login for add to Cart</p>
                    </template>
                </div>
            </div>
        </div>
        <!-- MODAL CARTVERIFY CONFIRM -->
        <div class="modal fade" id="cartVerifyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Caution</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">Add this product to cart?</div>
                    <div class="modal-footer d-flex justify-content-around">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal" @click="addToChart">Yes</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MODAL CARTVERIFY CONFIRM -->
    </section>
</template>

<script>
    import axios from 'axios'
    export default {
        name: "ProductComponent",
        props:['product','role'],
        data(){
            return {
                singleProduct : [],
                quantity : 0,
            }
        },
        mounted() {
            axios.get('/api/product/'+this.product).then(result => {
                this.singleProduct = result.data
            }).catch(err => {
                toastr.error("Something went wrong")
            })
        },
        watch:{
            quantity(newVal, oldVal){
                if (newVal > this.singleProduct.unit){
                    this.quantity = this.singleProduct.unit
                    toastr.error("Your input exceeds the available stock")
                }else if (newVal < 0){
                    this.quantity = 0
                    toastr.error("Input cannot be less than 0")
                }else if (newVal == '00'){
                    this.quantity = 0
                }
            }
        },
        methods:{
            addToChart(){
                if (this.quantity !== 0 && this.quantity < this.singleProduct.unit){
                    axios.post('/api/cart/add',{
                        item_id : this.singleProduct.id,
                        quantity : this.quantity,
                        _token : window.token
                    }).then(result => {
                        if (result.data.status === 200){
                            this.$parent.$data.totalCart++;
                            toastr.success("Item successfully added to cart")
                        }else {
                            toastr.error("Something went wrong")
                        }
                    }).catch(err => {
                        toastr.error("Something went wrong")
                    })
                }else {
                    toastr.error("Your input exceeds the available stock")
                }
            }
        }
    }
</script>

<style scoped>

</style>
