<template>
    <app-layout>
        <div class="container m-t-40">
            <div class="card">
                <div class="card-body">
                    <form @submit.prevent="submit()" action="#" class="form-horizontal">

                        <div class="form-body">

                            <h3 class="box-title">{{ $__('general.personal_info') }}</h3>
                            <hr class="m-t-0 m-b-40">

                            <div class="row">
                                <div class="col-md-6">
                                    <div :class="{' has-danger':form.error('name')}" class="form-group row">
                                        <label class="control-label text-right col-md-3">{{
                                            $__('general.patient_name') }}</label>
                                        <div class="col-md-9">
                                            <input :class="{' form-control-danger':form.error('name')}" :placeholder="$__('general.patient_name')" class="form-control"
                                                   type="text"
                                                   v-model="form.name">
                                            <small class="form-control-feedback" v-if="form.error('name')">{{form.errors.get('name')}}</small>
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group row"
                                         v-bind:class="{' has-danger':form.error('address')}">
                                        <label class="control-label text-right col-md-3">{{ $__('general.address') }}</label>
                                        <div class="col-md-9">
                                            <input :placeholder="$__('general.address')" class="form-control" type="text"
                                                   v-bind:class="{' form-control-danger':form.error('address')}"
                                                   v-model="form.address">
                                            <small class="form-control-feedback" v-if="form.error('address')">{{form.errors.get('address')}}</small>

                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row"
                                         v-bind:class="{' has-danger':form.error('gender')}">
                                        <label class="control-label text-right col-md-3">{{ $__('general.gender') }}</label>
                                        <div class="col-md-9">
                                            <select class="form-control custom-select" v-bind:class="{'form-control-danger': form.error('gender')}"
                                                    v-model="form.gender">
                                                <option selected value="male">{{ $__('general.male') }}</option>
                                                <option value="female">{{ $__('general.female') }}</option>
                                            </select>

                                            <small class="form-control-feedback" v-if="form.error('gender')">{{form.errors.get('gender')}}</small>

                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group row"
                                         v-bind:class="{' has-danger':form.error('birth_date')}">
                                        <label class="control-label text-right col-md-3">{{ $__('general.birth_date') }}</label>
                                        <div class="col-md-9">
                                            <input class="form-control" placeholder="dd/mm/yyyy" type="date"
                                                   v-bind:class="{'form-control-danger' : form.error('birth_date')}"
                                                   v-model="form.birth_date">

                                            <small class="form-control-feedback" v-if="form.error('birth_date')">{{form.errors.get('birth_date')}}</small>

                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row form.errors.get('email') ? ' has-danger' : '' }}">
                                        <label class="control-label text-right col-md-3">{{ $__('general.email') }}</label>
                                        <div class="col-md-9">
                                            <input :placeholder="$__('general.email')" class="form-control form.errors.get('email') ? ' form-control-danger' : '' }}"
                                                   type="email"
                                                   v-model="form.email">

                                            <small class="form-control-feedback" v-if="form.error('email')">{{form.errors.get('emial')}}</small>

                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="control-label text-right col-md-3">{{ $__('general.payment') }}</label>
                                        <div class="col-md-9">
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" id="customRadio3" type="radio"
                                                       v-model="form.payment" value="cash">
                                                <label class="custom-control-label" for="customRadio3">{{ $__('general.safe') }}</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" id="customRadio4" type="radio"
                                                       v-model="form.payment" value="insurance">
                                                <label class="custom-control-label" for="customRadio4">{{ $__('general.insurance') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="control-label text-right col-md-3">{{ $__('general.profile_image') }}</label>
                                        <div class="form-group col-md-9 ">
                                            <a @click.prevent="setImage" class="form-control" href="#">{{ $__('general.' + imageButtonText) }} </a>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-6" v-if="form.payment === 'insurance'">
                                    <div class="form-group row">
                                        <label class="control-label text-right col-md-3">{{ $__('general.insurance') }} </label>
                                        <div class="form-group col-md-9 ">
                                            <a @click.prevent="setInsuranceImage" href="">{{ $__('general.add_insurance_details') }} </a>
                                        </div>
                                    </div>
                                </div>


                                <!--/span-->
                            </div>
                            <!--/row-->

                            <!-- Phones -->
                            <h3 class="box-title">{{ $__('general.phones') }}
                                <a @click.prevent="addPhone()" class="btn btn-success pull-right" href=""><span><i
                                        class="fa fa-plus"></i></span>{{ $__('general.add_phone') }} </a>
                            </h3>
                            <hr class="m-t-0 m-b-40">
                            <div class="row" v-for="phone in form.phones">
                                <div class="col-md-3">
                                    <div class="form-group row">
                                        <label class="control-label text-right col-md-6">{{ $__('general.type') }} </label>
                                        <div class="col-md-6">
                                            <select class="form-control custom-select" v-model="phone.type">
                                                <option value="mobile">{{ $__('general.mobile') }}</option>
                                                <option value="home">{{ $__('general.phone_home') }}</option>
                                                <option value="work">{{ $__('general.work') }}</option>
                                                <option value="fax">{{ $__('general.fax') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <div class="col-md-9">
                                            <input :placeholder="$__('general.number')" class="form-control" type="text"
                                                   v-model="phone.number">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <a @click.prevent="removePhone(phone.number)" class="text-right" href=""><span><i
                                            class="fa fa-close text-danger"></i></span> {{ $__('general.remove') }} </a>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->

                        </div>
                        <hr>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-2 ">
                                    <button @click="canceled" class="btn btn-inverse btn-block" type="button">{{ $__('general.cancel') }}
                                    </button>
                                </div>

                                <div class="col-md-2">
                                    <button :disabled="!canSubmit" class="btn btn-info btn-block" type="submit">{{ $__('general.save') }}
                                    </button>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
     <add-insurance-card-modal></add-insurance-card-modal>
        <add-image></add-image>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import FormGroup from '@/Jetstream/Form/FormGroup'
    import FormLabel from "@/Jetstream/Form/FormLabel";
    import InputText from '@/Jetstream/Form/Input/InputText'
    import InputEmail from '@/Jetstream/Form/Input/InputEmail'
    import InputError from "@/Jetstream/Form/Input/InputError";
    import InputPassword from "@/Jetstream/Form/Input/InputPassword";
    import AddPhone from "@/Jetstream/Tenants/General/AddPhone";
    import ButtonSuccess from "@/Jetstream/Form/Button/ButtonSuccess";
    import ButtonDanger from "@/Jetstream/Form/Button/ButtonDanger";
    import AddImage from "@/Jetstream/Tenants/General/addImage";
    import AddInsuranceCardModal from "@/Jetstream/Tenants/Medical/Insurance/AddInsuranceCardModal";

    export default {
        props: {
            errors: Object,
        },
        components: {
            AddInsuranceCardModal,
            AddImage,
            ButtonSuccess,
            ButtonDanger,
            InputPassword,
            InputError,
            AppLayout,
            FormGroup,
            InputText,
            InputEmail,
            FormLabel,
            AddPhone,
        },

        data() {
            return {
                flag: 'patientCreate',
                imageButtonText: 'add_image',
                posting: false,
                companies: '',
                form: this.$inertia.form({
                    name: '',
                    profile_image: '',
                    address: '',
                    birth_date: '',
                    gender: '',
                    email: '',
                    payment: '',
                    phones: [{type: '', number: ''}],
                    insurance: {
                        card_id: '',
                        insurance_no: '',
                        insurance_company_id: '',
                        effective: '',
                        expiry: '',
                        deductible: '',
                        co_ins: '',
                        job_company: '',
                        policy_holder: '',
                        network: '',
                        category: '',
                        dental: '',
                        image: '',
                    },
                }),
            }
        },
        computed: {

            url: function () {
                return "/patients"
            },

            canSubmit: function () {
                return true;
                if (this.posting) {
                    return false;
                }

                if (this.form.name.trim() === '') {
                    return false;
                }
                if (!this.form.gender) {
                    return false;
                }
                if (!this.form.birth_date) {
                    return false;
                }

                if (this.form.errors) {
                    return false;
                }

                return true;
            }

        },
        methods: {

            submit() {
                this.posting = true;
                this.form.post(this.url)
                    .then(response => {
                        window.location.href = "/patients";
                    })
                    .catch(error => {
                        this.posting = false;
                    })
            },

            canceled() {
                window.location.href = "/reception";
            },

            setImage() {
                this.$modal.show('add-image', {flag: this.flag})
            },


            addPhone() {
                this.form.phones.push({});
            },

            removePhone(number) {
                this.removeValueFromArray(number, this.form.phones);
            },

            removeValueFromArray(value, array) {
                return array.splice(array.findIndex(function (el) {
                    return value === el.number
                }), 1)
            },

            setInsuranceImage() {
                this.$modal.show('add-insurance-card-modal', {insuranceCompanies: this.companies})
            },


        },

        mounted: function () {
            Bus.$on('card-added', (card) => {
                this.form.insurance = card
            });

            Bus.$on('image-added', (obj) => {
                if (obj.flag === this.flag) {
                    this.form.profile_image = obj.image;
                    this.imageButtonText = "change_image";
                }
            });

        }

    }
</script>
