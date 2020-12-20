<template>
    <app-layout>
        <div class="container m-t-40">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{$__('general.create')}} {{$__('general.users')}}</h4>
                    <div class="col-8">
                        <form @submit.prevent="submit" class="form m-t-40">

                            <!-- Name -->
                            <form-group :has-error="errors.name">
                                <form-label for="name">{{$__('general.name')}}</form-label>
                                <div class="col-10">
                                    <input-text :has-error="errors.name" :placeholder="$__('general.name')"
                                                id="name"
                                                v-model="form.name"></input-text>
                                    <input-error :message="errors.name"></input-error>
                                </div>
                            </form-group>

                            <!--  Username -->
                            <form-group :has-error=" errors.username">
                                <form-label for="username">{{$__('general.username')}}</form-label>
                                <div class="col-10">
                                    <input-text :has-error="errors.username" :placeholder="$__('general.username')"
                                                id="username" v-model="form.username"></input-text>
                                    <input-error :message="errors.username"></input-error>
                                </div>
                            </form-group>

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

                            <!-- Role -->
                            <form-group :has-error="errors.role">
                                <form-label for="role">{{$__('general.role')}}</form-label>
                                <div class="col-10">
                                    <select :class="{'form-contorl-danger':errors.role }" class="custom-select"
                                            id="role"
                                            v-model="form.role">
                                        <option selected="" value="">Choose Role</option>
                                        <option :value="role" v-for="role in roles"> {{role.name}}</option>
                                    </select>
                                    <input-error :message="errors.role"></input-error>
                                </div>
                            </form-group>

                            <!--  Doctor-->
                            <div v-if="form.role.name === 'doctor'">
                                <h4>{{$__('general.medical_data')}}</h4>
                                <hr>
                                <!-- medical_id-->
                                <form-group :has-error="errors.medical_id">
                                    <form-label for="medical_id">{{$__('general.medical_id')}}</form-label>
                                    <div class="col-10">
                                        <input-text :has-error="errors.medical_id" :placeholder="$__('general.medical_id')"
                                                    id="medical_id"
                                                    v-model="form.medical_id"></input-text>
                                        <input-error :message="errors.medical_id"></input-error>
                                    </div>
                                </form-group>

                                <!--  position -->
                                <form-group :eroor="errors.position">
                                    <form-label for="position">{{$__('general.position')}}</form-label>
                                    <div class="col-10">
                                        <input-text :has-error="errors.position" :placeholder="$__('general.position')"
                                                    id="position"
                                                    v-model="form.position"></input-text>
                                        <input-error :message="errors.position"></input-error>
                                    </div>
                                </form-group>

                                <!--  speciality -->
                                <form-group :has-error="errors.speciality">
                                    <form-label for="speciality">{{$__('general.speciality')}}</form-label>
                                    <div class="col-10">
                                        <input-text :has-error="errors.speciality" :placeholder="$__('general.position')"
                                                    id="speciality" v-model="form.speciality"></input-text>
                                        <input-error :message="errors.speciality"></input-error>
                                    </div>
                                </form-group>

                                <!--  address -->
                                <form-group :has-error="errors.address">
                                    <form-label for="address">{{$__('general.address')}}</form-label>
                                    <div class="col-10">
                                        <input-text :has-error="errors.address" :placeholder="$__('general.address')" id="address"
                                                    type="text" v-model="form.address"></input-text>
                                        <input-error :message="errors.address"></input-error>
                                    </div>
                                </form-group>
                                <hr class="m-t-40 m-b-40">
                            </div>

                            <!-- Password-->
                            <form-group :has-error="errors.password">
                                <form-label for="password">{{$__('general.password')}}</form-label>
                                <div class="col-10">
                                    <input-password :has-error="errors.password" :placeholder="$__('general.password')"
                                                    id="password"
                                                    v-model="form.password"></input-password>
                                    <input-error :message="errors.password"></input-error>
                                </div>
                            </form-group>

                            <!--  Password confirmation -->
                            <form-group :has-error="errors.password_confirmation">
                                <form-label for="password_confirmation">{{$__('general.password_confirmation')}}
                                </form-label>
                                <div class="col-10">
                                    <input-password :has-error="errors.password_confirmation"
                                                    :placeholder="$__('general.password_confirmation')"
                                                    id="password_confirmation"
                                                    v-model="form.password_confirmation"></input-password>
                                    <input-error :message="errors.password_confirmation"></input-error>
                                </div>
                            </form-group>

                            <add-phone></add-phone>
                            <div v-if="form.phones.length > 0">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tbody>
                                                <tr v-for="phone in form.phones">
                                                    <td>{{phone.type}}</td>
                                                    <td>{{phone.number}}</td>
                                                    <td><a @click.prevent="deletPHone(phone.number)" href="#"><i class="fa fa-close text-danger"></i></a></td>
                                                </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="m-t-40 m-b-20">
                            <div class="row">
                                <div class="col-4">
                                    <button-success class="btn-block">{{ $__('general.go')}}</button-success>
                                </div>
                                <div class="col-4">
                                    <inertia-link class="btn btn-danger btn-block" href="/users">{{ $__('general.cancel')}}</inertia-link>
                                </div>
                            </div>


                        </form>
                    </div>

                </div>
            </div>
        </div>
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

    export default {
        props: {
            errors: Object,
            roles: Array,

        },
        components: {
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
                form: {
                    name: null,
                    username: null,
                    email: null,
                    password: null,
                    password_confirmation: null,
                    role: {id: '', name: ''},
                    medical_id: '',
                    position: '',
                    speciality: '',
                    address: '',
                    phones: [],
                },
            }
        },
        methods: {
            submit() {
                this.$inertia.post('/users', this.form)
            },
            deletPHone(number) {
                let index = this.form.phones.findIndex(phone => parseInt(phone.number) === parseInt(number));
                this.form.phones.splice(index, 1);
            }
        },

        created() {
            Bus.$on('phone-added', (data) => this.form.phones.push(data));
        }
    }
</script>
