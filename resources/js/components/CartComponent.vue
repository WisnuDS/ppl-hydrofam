<template>
    <div>
        `<section class="ftco-section ftco-cart">
            <div class="container">
                <!-- SECTION PRODUCT LIST IN CART -->
                <div class="row">
                    <div class="col-md-12 ftco-animate">
                        <div class="cart-list">
                            <table class="table">
                                <thead class="thead-primary">
                                <tr class="text-center">
                                    <th>Menu</th>
                                    <th>Product Image</th>
                                    <th>Product name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <template v-for="(datum,index) in cart">
                                        <tr class="text-center" id="item1">
                                            <td class="product-remove">
                                                <template v-if="datum.item.unit > 0">
                                                    <a href="#" data-toggle="modal" data-target="#editCart" class="mr-2"
                                                       onclick="modal('item1')" @click="openModal(datum.quantity,index,datum.item.item_name,datum.id)">
                                                        <span class="ion-ios-create">Edit</span>
                                                    </a>
                                                    <a href="#" data-toggle="modal" data-target="#removeCart" @click="openModal(datum.quantity,index,datum.item.item_name,datum.id)">
                                                        <span class="ion-ios-trash">Remove</span>
                                                    </a>
                                                </template>
                                                <template v-else>
                                                    Out of Stock
                                                    <a href="#" data-toggle="modal" data-target="#removeCart" @click="openModal(datum.quantity,index,datum.item.item_name,datum.id)">
                                                        <span class="ion-ios-trash">Remove</span>
                                                    </a>
                                                </template>
                                            </td>

                                            <td class="image-prod">
                                                <div class="img" :style="'background-image:url(/storage/product/'+datum.item.image+')'">
                                                </div>
                                            </td>

                                            <td class="product-name">
                                                <h3>{{datum.item.item_name}}</h3>
                                            </td>

                                            <td class="price" id="price">{{datum.item.price}}</td>

                                            <td class="quantity">
                                                <div class="input-group mb-3">
                                                    <input type="text" id="quantity_item1" name="quantity_item1"
                                                           class="form-control input-number" :value="datum.quantity" disabled>
                                                </div>
                                            </td>

                                            <td class="price" id="total_price_item1">{{datum.item.price*datum.quantity}}</td>
                                        </tr><!-- END TR-->
                                    </template>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- END SECTION PRODUCT LIST IN CART -->


                <div class="row justify-content-end">
                    <!-- ADDRESS/DESTINATION SHOW -->
                    <div class="col-lg-8 mt-5 cart-wrap ftco-animate">
                        <div class="cart-total mb-3">
                            <h3>Destination</h3>
                            <div action="#" class="info d-flex">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="province">Province</label>
                                        <input type="text" class="form-control text-left px-3" placeholder="Jawa Timur"
                                               readonly id="province" name="province" v-model="address.province">
                                    </div>
                                    <div class="form-group">
                                        <label for="city">City</label>
                                        <input type="text" class="form-control text-left px-3" placeholder="Kab.Jember"
                                               readonly id="city" name="city" v-model="address.city">
                                    </div>
                                    <div class="form-group">
                                        <label for="sub_district">Sub District</label>
                                        <input type="text" class="form-control text-left px-3" placeholder="Sumbersari"
                                               readonly id="sub-district" name="sub-district" v-model="address.sub_district">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="postal_code">Postal Code</label>
                                        <input type="text" class="form-control text-left px-3" placeholder="68121" readonly
                                               id="postal_code" name="postal_code" v-model="address.postal_code">
                                    </div>
                                    <div class="form-group">
                                        <label for="postal_code">Details Address</label>
                                        <textarea name="details_address" id="details_address" cols="30" rows="10"
                                                  class="form-control text-left pl-3 pt-1"
                                                  placeholder="Kampus Tegalboto, Jl. Kalimantan No.37, Krajan Timur, Sumbersari"
                                                  readonly>{{address.detail}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END ADDRESS/DESTINATION SHOW -->

                    <!-- SIDE CART CALCULATION -->
                    <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
                        <div class="cart-total mb-3">
                            <h3>Cart Totals</h3>
                            <p class="d-flex">
                                <span>Subtotal</span>
                                <span>Rp {{total}}</span>
                            </p>
                            <p class="d-flex">
                                <span>Delivery</span>
                                <span>Rp 0</span>
                            </p>
                            <p class="d-flex">
                                <span>Discount</span>
                                <span>Rp 0</span>
                            </p>
                            <hr>
                            <p class="d-flex total-price">
                                <span>Total</span>
                                <span>Rp {{total}}</span>
                            </p>
                        </div>
                        <p><a href="checkout.html" class="btn btn-primary py-3 px-4"
                              onclick="return confirm('Are you sure want to checkout your cart?')">Proceed to Checkout</a>
                        </p>
                    </div>
                    <!-- END SIDE CART CALCULATION -->
                </div>
            </div>
        </section>
        <!-- MODAL EDIT CONFIRM -->
        <div class="modal fade" id="editCart" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" ref="modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal_edit_cart_title">Changes</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="modal_edit_cart_body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-4">Product Name</div>
                                <div class="col-md-4 ml-auto" id="modal_edit_cart_body_product_name">{{productName}}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">Quantity</div>
                                <div class="col-md-4 ml-auto">
                                    <input type="text" v-model="editQuantity" id="modal_edit_cart_body_product_quantity"
                                           name="modal_edit_cart_body_product_quantity" class="form-control" value="1">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-around">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" data-dismiss="modal" @click="updateCart">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MODAL EDIT CONFIRM -->

        <!-- MODAL LOGOUT CONFIRM -->
        <div class="modal fade" id="removeCart" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Caution</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">Are you sure to remove this item from your cart?</div>
                    <div class="modal-footer d-flex justify-content-around">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal" @click="deleteCart">Yes</button>
                    </div>
                </div>
            </div>Edit
        </div>
        <!-- END MODAL LOGOUT CONFIRM -->
    </div>
</template>

<script>
    import axios from 'axios'
    export default {
        name: "CartComponent",
        props:['cart'],
        data(){
            return{
                address:{},
                editQuantity:0,
                indexEdit:0,
                productName:'',
                idProduct:0,
            }
        },
        mounted() {
            this.loadAddress()
        },
        computed:{
            total(){
                let total = 0;
                for (let item of this.cart){
                    total += (item.quantity*item.item.price)
                }
                return total
            }
        },
        methods:{
            loadAddress(){
                axios.get('/api/address').then(result => {
                    if (result.data.status === 200){
                        this.address = result.data.data
                    }else {
                        toastr.error("Failed to load address")
                    }
                }).catch(err => {
                    toastr.error("Failed to load address")
                })
            },
            openModal(quantity,index,productName,id){
                this.editQuantity = quantity
                this.indexEdit = index
                this.productName = productName
                this.idProduct = id
            },
            updateCart(){
                axios.post('/api/cart/update/'+this.idProduct,{
                    quantity:this.editQuantity,
                    _token: window.token
                }).then(result => {
                    if (result.data.status === 200){
                        toastr.success(result.data.message)
                        this.$parent.loadCart();

                    }else {
                        toastr.error(result.data.message)
                    }
                }).catch(err => {
                    toastr.error("Failed Update Cart")
                })
            },
            deleteCart(){
                axios.delete('/api/cart/delete/'+this.idProduct,{
                    quantity:this.editQuantity,
                    _token: window.token
                }).then(result => {
                    if (result.data.status === 200){
                        toastr.success(result.data.message)
                        this.$parent.loadCart();

                    }else {
                        toastr.error(result.data.message)
                    }
                }).catch(err => {
                    toastr.error("Failed Delete Cart")
                })
            }
        }
    }
</script>

<style scoped>

</style>
