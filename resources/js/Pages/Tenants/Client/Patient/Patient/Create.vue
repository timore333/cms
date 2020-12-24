<template>
    <app-layout>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form @submit.prevent="submit()" action="#" class="form-horizontal">

                            <div class="form-body">

                                <h3 class="box-title">{{ $__('general.personal_info') }}</h3>
                                <hr class="m-t-0 m-b-40">

                                <div class="row">
                                    <!-- Name -->
                                    <div class="col-md-6">
                                        <form-group :has-error="errors.name">
                                            <form-label for="name">{{$__('general.name')}}</form-label>
                                            <div class="col-10">
                                                <input-text :has-error="errors.name" :placeholder="$__('general.name')"
                                                            id="name"
                                                            v-model="form.name"></input-text>
                                                <input-error :message="errors.name"></input-error>
                                            </div>
                                        </form-group>
                                    </div>

                                    <!-- address -->
                                    <div class="col-md-6">
                                        <form-group :has-error="errors.address">
                                            <form-label for="address">{{$__('general.address')}}</form-label>
                                            <div class="col-10">
                                                <input-text :has-error="errors.address" :placeholder="$__('general.address')"
                                                            id="address"
                                                            v-model="form.address"></input-text>
                                                <input-error :message="errors.address"></input-error>
                                            </div>
                                        </form-group>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <form-group :has-error="errors.gender">
                                            <form-label for="gender">{{ $__('general.gender') }}</form-label>
                                            <div class="col-md-9">
                                                <select class="form-control custom-select" v-bind:class="{'form-control-danger': errors.gender}"
                                                        v-model="form.gender">
                                                    <option selected value="male">{{ $__('general.male') }}</option>
                                                    <option value="female">{{ $__('general.female') }}</option>
                                                </select>

                                                <input-error :message="errors.gender"></input-error>

                                            </div>
                                        </form-group>
                                    </div>
                                    <!--/span-->
                                    <div class="col-md-6">
                                        <form-group :has-error="errors.birth_date">
                                            <form-label for="birth_date">{{ $__('general.birth_date') }}</form-label>
                                            <div class="col-md-9">
                                                <input-date :has-error="errors.birth_date"  v-model="form.birth_date" id="birth_date"></input-date >
                                               <input-error :message="errors.birth_date"></input-error>

                                            </div>
                                        </form-group>
                                    </div>
                                    <!--/span-->
                                </div>

                                <!--/row-->
                                <div class="row">
                                    <div class="col-md-6">
                                        <!--  email -->
                                        <form-group :has-error="errors.email">
                                            <form-label for="email">{{$__('general.email')}}</form-label>
                                            <div class="col-10">
                                                <input-email :has-error="errors.email" :placeholder="$__('general.email')"
                                                             id="email"
                                                             v-model="form.email"></input-email>
                                                <input-error :message="errors.email"></input-error>
                                            </div>
                                        </form-group>
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
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import FormGroup from '@/Jetstream/Form/FormGroup'
    import FormLabel from "@/Jetstream/Form/FormLabel";
    import InputText from '@/Jetstream/Form/Input/InputText'
    import InputDate from '@/Jetstream/Form/Input/InputDate'
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
            InputDate,
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
                    phones: [],
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
                // return true;
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

                return true;
            }

        },
        methods: {

            submit() {
                this.posting = true;
                this.form.post(this.url)
            },

            canceled() {
                window.location.href = "/patients";
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
