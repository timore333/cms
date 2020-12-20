<template>
<modal 
name="add-insurance-card-modal"
:adaptive="true"
:resizable="true"
:scrollable="true"
width="900"
height='auto'
@before-open="beforeOpen"
>

<div class="card border-danger m-0">

    <div class="card-header bg-danger">
        <h4 class="m-b-0 text-white">Add Insurance Card <a href="#" class="pull-right text-white" @click="hide()">X</a></h4>
    </div>

    <div class="card-body">


        <div >
            <hr class="m-t-0 m-b-40">
            <!--/row-->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="control-label text-right col-md-3">Card ID</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" v-model="insurance.card_id">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="control-label text-right col-md-3">Insurance No</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" v-model="insurance.insurance_no">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="control-label text-right col-md-3">Insurance Company</label>
                        <div class="col-md-9">
                            <select class="form-control custom-select" v-model="insurance.insurance_company_id">
                                <option v-for="company in companies" :value="company.id">{{company.name}}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!--/span-->

                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="control-label text-right col-md-3">Effective</label>
                        <div class="col-md-9">
                            <input type="date" class="form-control" v-model="insurance.effective">
                        </div>
                    </div>
                </div>
                <!--/span-->
            </div>
            <!--/row-->

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="control-label text-right col-md-3">Expiry</label>
                        <div class="col-md-9">
                            <input type="date" class="form-control" v-model="insurance.expiry">
                        </div>
                    </div>
                </div>
                <!--/span-->
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="control-label text-right col-md-3">Deductible</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" v-model="insurance.deductible">
                        </div>
                    </div>
                </div>
                <!--/span-->
            </div>
            <!--/row-->

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="control-label text-right col-md-3">Co Ins</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" v-model="insurance.co_ins">
                        </div>
                    </div>
                </div>
                <!--/span-->
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="control-label text-right col-md-3">Job Company</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" v-model="insurance.job_company">
                        </div>
                    </div>
                </div>
                <!--/span-->

            </div>
            <!--/row-->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="control-label text-right col-md-3">Policy Holder</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" v-model="insurance.policy_holder">
                        </div>
                    </div>
                </div>
                <!--/span-->

                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="control-label text-right col-md-3">Network</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" v-model="insurance.network">
                        </div>
                    </div>
                </div>
                <!--/span-->

            </div>
            <!--/row-->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="control-label text-right col-md-3">Category</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" v-model="insurance.category">
                        </div>
                    </div>
                </div>
                <!--/span-->

                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="control-label text-right col-md-3">Dental</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" v-model="insurance.dental">
                        </div>
                    </div>
                </div>
                <!--/span-->

            </div>
            <!--/row-->
            <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label  col-md-3">Image</label>
                  <div class="col-md-9">
                    <a href="#" class="form-control" @click.prevent="setImage">{{ imageButtonText }}</a>
                  </div>
                </div>
            </div>


            <div class="row">
                <div class="text-center col-md-3 offset-md-4">
                      <button class="btn btn-primary btn-block" @click.prevent="saveCard">Save</button>
                </div>
              
            </div>
        </div> 


    </div>


</div>

<add-image></add-image>

</modal>
</template>

<!-- ************************************************************************************************ -->
<script>

export default {


  props:[],
///////////////////////////////////////////
  data() {
    return {

        insurance:{
            card_id:'',
            insurance_no:'',
            insurance_company_id:'',
            effective:'',
            expiry:'',
            deductible:'',
            co_ins:'',
            job_company:'',
            policy_holder:'',
            network:'',
            category:'',
            dental:'',

        },
        companies:[],
        imageButtonText:'Add Image',
        flag:'addInsuranceCard'

    }
  },

///////////////////////////////////////////
    methods:{
        beforeOpen(data){
            this.companies = data.params.insuranceCompanies
        },

        show () {
            this.$modal.show('add-insurance-card-modal');
        },

        hide () {
            this.$modal.hide('add-insurance-card-modal');
        },

        setImage(){
           this.$modal.show('add-image',{flag:this.flag}) 
        },

        saveCard(){
            Bus.$emit('card-added', this.insurance);
            this.hide()
        },


    },

    mounted(){
        Bus.$on('image-added',(obj)=>{
            if (obj.flag === this.flag) {
                this.insurance.image = obj.image;
                this.imageButtonText= "Change Image" 
            }

        });

    }

};

</script>

