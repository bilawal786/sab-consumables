<template>
<div>
    <form @submit.prevent="formSubmit">
        <div class="row">
            <div class="col-md-3">
                <label>Select month</label>
                <div class="input-group mb-3">
                    <input type="month" class="form-control" :value="date" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group m-0">
                    <label>Brands</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group m-0">
                    <label>Quantity</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group m-0">
                    <label>Action</label>
                </div>
            </div>
        </div>

        <div class="stockrow">
            <div class="row" v-for="(item,key,index) in form.table">
                <div class="col-md-3">
                    <div class="input-group mb-3">
                        <div v-if="key == Object.keys(form.table).length-1" class="w-100">
                            <select2 v-if="brands" class="form-control set-w" @change="onChange()" :options="brands" v-model="item.brandId" :disabled="key != Object.keys(form.table).length-1">
                                <option disabled value="0">Select one</option>
                            </select2>
                            <small v-if="ferror.stock == true" class="text-danger">Please select stock.</small>
                            <small v-if="serror.stock == true" class="text-danger">Please save Stock</small>
                        </div>
                        <div v-else class="w-100">
                            <select v-model="item.brandId" class="form-control" :disabled="key != Object.keys(form.table).length-1">
                                <option desable value="0">Select one</option>-->
                                <option v-for="brand in brandsList" :key="brand.id" :value="brand.id">
                                    {{brand.text}}
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <input type="number" :min="1" class="form-control ms_num" placeholder="Quantity" v-model="item.quantity" :disabled="key != Object.keys(form.table).length-1">
                        <small v-if="key == Object.keys(form.table).length-1 && ferror.quantity == true" class="text-danger">Please enter stock.</small>
                        <small v-if="key == Object.keys(form.table).length-1 && ferror.valid_quantity == true" class="text-danger">Maximum Stock available {{ferror.quanity_no}}.</small>
                    </div>
                </div>
                <div class="col-md-3">
                    <button v-if="key == Object.keys(form.table).length-1" type="button" @click="addrow(item.brandId, item.quantity)"
                            class="btn btn-sm btn-icon btn-pure btn-primary on-editing m-r-5 button-save">
                        <i class="icon-plus"></i>
                    </button>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
        <button id="submit1" type="submit" class="btn btn-primary" :disabled="loading">
<!--            Save Damages-->
            <span v-if="loading == false">
                Save Damages
            </span>
            <span v-else>
                <i class="fa fa-spinner fa-spin"></i> Loading
            </span>
        </button>
    </form>
</div>
</template>

<script>
import select2 from "../includes/select2";
export default {
    props:['date'],
    name: "create-damages",
    data(){
        return{
            loading:false,
            form:{
                table:[{brandId: 0,quantity:null,}],
            },
            ferror:{
                stock:false,
                quantity:false,
                valid_quantity: false,
                quanity_no:null
            },
            serror:{
                stock:false,
                sign_confirm: false,
                picture:false,
            },
            employeesdate:null,
            brands:null,
            brandsList:null,
        }
    },
    mounted() {
        this.select2()
    },
    methods: {
        select2: function (){
            axios.get('select2brands').then(response => {
                this.brands = response.data
            })
            axios.get('select2brands').then(response => {
                this.brandsList = response.data
            })
        },
        addrow: function(id, q){
            if(id > 0 && q != null && q != '' && q > 0){
                this.ferror.stock = false
                this.ferror.quantity = false
                axios.get('sabstock/'+id).then(response => {
                    if(q <= response.data ){
                        this.ferror.valid_quantity = false
                        this.ferror.quanity_no = null
                        if(this.brands.length > 0){
                            this.form.table.push({brandId: 0,quantity:null,});
                        }
                        this.brands.forEach((value, index) => {
                            if(value.id == id){
                                this.brands.splice(index, 1)
                            }
                        });
                    }else {
                        this.ferror.valid_quantity = true
                        this.ferror.quanity_no = response.data
                    }
                })
            }else{
                this.ferror.valid_quantity = false
                this.ferror.quanity_no = null
                if(id == 0){
                    this.ferror.stock = true
                }else {
                    this.ferror.stock = false
                }
                if(q == null || q == '' || q < 1){
                    this.ferror.quantity = true
                }else {
                    this.ferror.quantity = false
                }
            }

        },
        formSubmit(e){
            e.preventDefault();
            this.loading = true
            this.form.table.splice(this.form.table.length-1,1)
            if(this.form.table.length > 0){
                this.serror.stock = false
                axios.post('sabdamages?date='+this.date, {
                    'table':JSON.stringify(this.form.table),
                }).then(response=>{
                    if(response.status == 200){
                        this.loading = false
                        window.location.href = '/damages?date='+this.date;
                    }
                })
            }else {
                if(this.form.table.length == 0){
                    this.serror.stock = true
                }else{
                    this.serror.stock = false
                }
            }
            this.form.table.push({brandId: 0,quantity:null,});
        },
    },
    components:{
        select2,
    }
}
</script>

<style scoped>

</style>
