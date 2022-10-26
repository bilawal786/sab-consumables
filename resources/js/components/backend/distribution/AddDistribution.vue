<template>
<div>
    <div class="row">
        <div class="col-md-3">
            <label>Select month</label>
            <div class="input-group mb-3">
                <form class="navbar-form search-form">
                    <input v-model="date" name="date" class="form-control" type="month"
                           style="padding-right: 40px;">
                    <button type="button" @click="employees(date)" class="btn btn-default">
                        <i class="icon-magnifier"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <div class="dataTables_wrapper">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div class="dataTables_length" >
                        <label>Show
                            <select  class="form-control" @change="employees" v-model="limit">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                            entries</label>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="dataTables_filter">
                        <label>Search:<input type="search" class="form-control" placeholder="" v-model="search"  @keyup="employees"></label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table
                        class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Employee No.</th>
                            <th>Inital</th>
                            <th>Surname</th>
                            <th>Paypoint</th>
                            <th>Selection 1</th>
                            <th>Selection 2</th>
                            <th>Selection 3</th>
                            <th>Shift_bear</th>
                            <th>Other_bear</th>
                            <th>Signature</th>
                            <th>Y/N</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="employee in employeesdate.data">
                            <td>
                                <input @click="getEmployeeId(employee.id)" name="distribution" :value="employee.id" type="radio">
                            </td>
                            <td>{{employee.employee_no}}</td>
                            <td>{{employee.inital}}</td>
                            <td>{{employee.surname}}</td>
                            <td>{{employee.paypoint}}</td>
                            <td>{{employee.selection_1}}</td>
                            <td>{{employee.selection_2}}</td>
                            <td>{{employee.selection_3}}</td>
                            <td>{{employee.shift_bear}}</td>
                            <td>{{employee.other_bear}}</td>
                            <td>{{employee.signature}}</td>
                            <td>
                                <span v-if="employee.status == 0" class="badge badge-danger">No</span>
                                <span v-if="employee.status == 1" class="badge badge-success">Yes</span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-5">
                    <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">Showing {{employeesdate.from}} to {{employeesdate.to}} of {{employeesdate.total}} entries</div>
                </div>
                <div class="col-sm-12 col-md-7">
                    <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                        <LaravelVuePagination :data="employeesdate" :limit="3" @pagination-change-page="employees" ></LaravelVuePagination>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form class="stockForm" @submit.prevent="formSubmit" enctype="multipart/form-data" v-if="form.employeeId">
<!--        <pre>{{ JSON.stringify(form.table) }}</pre>-->
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
                    <button v-if="key == Object.keys(form.table).length-1 && loading==false" type="button" @click="addrow(item.brandId, item.quantity)"
                            class="btn btn-sm btn-icon btn-pure btn-primary on-editing m-r-5 button-save" :disabled="loading">
                        <i class="icon-plus"></i>
                    </button>
                </div>
                <div class="col-md-3"></div>
            </div>
            <div class="row">
                <div class="col-md-3">

                </div>
                <div class="col-md-3">

                </div>
                <div class="col-md-3">

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Signature</label>
                    <!-- Signature -->
                    <VueSignaturePad class="form-control" :class="{'is-invalid' : serror.sign_confirm }" style="height: 200px" ref="signaturePad"></VueSignaturePad>
                    <br/>
                    <input class="btn btn-info btn-sm" type='button' @click="confirmSign()"
                           value='Confirm Sign'>
                    <input class="btn btn-warning btn-sm" style="color: #FFF;" type='button' @click="clearSign()"
                           id='clear' value='Clear'>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Preview Signature</label>
                    <div class="form-control" :class="{'is-invalid' : serror.sign_confirm }" style="height: 200px; width: 100%">
                        <img v-if="form.signature" :src='form.signature' class="img-fluid" alt="Responsive image" />
                    </div>
                    <small v-if="serror.sign_confirm == true" class="text-danger">Please Confirm Signature</small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Picture</label>
                    <input type="file" class="form-control" :class="{'is-invalid' : serror.picture }" v-on:change="onFileChange">
<!--                    <vue-dropify :class="{'is-invalid' : serror.picture }" message="Please Select image" uploadIcon="fa fa-upload" :text="text"  :src="form.picture" @change="onFileChange" ></vue-dropify>-->


                    <small v-if="serror.picture == true" class="text-danger">Please Select picture</small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12" style="margin: 40px 0;">
                <button type="submit" class="btn btn-primary" :disabled="submitloading">Distribute</button>
            </div>
        </div>
    </form>
</div>
</template>
<script>
import select2 from "../includes/select2";
import LaravelVuePagination from 'laravel-vue-pagination';
import VueDropify from 'vue-dropify';
export default {
    name: "AddDistribution",
    data(){
        return{
            date: new Date().getFullYear()+'-'+("0" + ((new Date()).getMonth() + 1)).slice(-2),
            form:{
                employeeId:null,
                signature:null,
                picture:null,
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
            limit:5,
            search:'',
            loading:false,
            text:{
                clear:'Clear image',
                remove:'Remove image'
            },
            submitloading:false
        }
    },
    mounted() {
        this.select2()
        this.employees()
    },
    watch:{

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
        employees(page = 1){
            axios.get('sabemployees?date='+this.date+'&limit='+this.limit+'&search='+this.search+'&page='+ page).then(response => {
                this.employeesdate = response.data
            })
        },
        getEmployeeId(id){
            this.form.employeeId = id
        },
        addrow: function(id, q){

            if(id > 0 && q != null && q != '' && q > 0){
                this.loading = true
                this.ferror.stock = false
                this.ferror.quantity = false
                axios.get('sabstock/'+id).then(response => {
                    if(q <= response.data ){
                        this.loading = false
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
                        this.loading = false
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
        confirmSign(){
            const { isEmpty, data } = this.$refs.signaturePad.saveSignature();

            if(isEmpty == true){
                this.form.signature = null
            }else{
                this.form.signature = data
            }
        },
        clearSign(){
            this.$refs.signaturePad.clearSignature();
        },
        formSubmit(e){
            e.preventDefault();
            this.form.table.splice(this.form.table.length-1,1)
            const config = {
                headers: { 'content-type': 'multipart/form-data' }
            }
            if(this.form.employeeId != null && this.form.signature !=null && this.form.picture !=null && this.form.table.length > 0){
                this.submitloading=true
                this.serror.stock = false
                this.serror.sign_confirm = false
                this.serror.picture = false
                axios.post('sabdistribution?date='+this.date, {
                    'employeeId':this.form.employeeId,
                    'signature':this.form.signature,
                    'picture':this.form.picture,
                    'table':JSON.stringify(this.form.table),
                }, config).then(response=>{
                    this.submitloading=false
                    this.form.employeeId=null
                    this.form.signature=null
                    this.form.picture=null
                    this.form.table=[{brandId: 0,quantity:null,}]
                    this.select2()
                    this.employees(this.date)
                    window.scroll(0,0);

                })
            }else {
                if(this.form.table.length == 0){
                    this.serror.stock = true
                }else{
                    this.serror.stock = false
                }
                if(this.form.signature == null){
                    this.serror.sign_confirm = true
                }else{
                    this.serror.sign_confirm = false
                }
                if(this.form.picture == null){
                    this.serror.picture = true
                }else{
                    this.serror.picture = false
                }
            }
            this.form.table.push({brandId: 0,quantity:null,});
        },
        onFileChange(e){
            this.form.picture = e.target.files[0];
        },
        onChange(value) {

        }

    },
    components:{
        select2,
        LaravelVuePagination,
        VueDropify
    }

}
</script>

<style scoped>

</style>
