<template>
    <app-layout>

        <div class="container m-t-40">
            <div class="card">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs profile-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#settings" role="tab">{{$__('general.personal_info')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " data-toggle="tab" href="#roles" role="tab">{{$__('general.roles')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#permissions" role="tab">{{$__('general.permissions')}}</a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <!--setting tab-->
                    <div class="tab-pane active" id="settings" role="tabpanel">
                        <div class="card-body">
                            <!--  update personal data-->
                            <div class="card row">

                                <div class="card-body">
                                    <form :class="{'form-control-line': form.errors}" class="form-horizontal form-material">

                                        <form-group :has-error="form.error('name')">
                                            <form-label for="name">{{$__('general.name')}}</form-label>
                                            <div class="col-12">
                                                <input-text :has-error="form.error('name')" id="name" v-model="form.name"></input-text>
                                            </div>
                                            <input-error :message="form.error('name')"></input-error>
                                        </form-group>

                                        <form-group :has-error="form.error('username')">
                                            <form-label>{{$__('general.username')}}</form-label>
                                            <div class="col-12">
                                                <input-text :has-error="form.error('username')" v-model="form.username"></input-text>
                                            </div>
                                            <input-error :message="form.error('username')"></input-error>
                                        </form-group>

                                        <form-group :has-error="form.error('email')">
                                            <form-label>{{$__('general.email')}}</form-label>
                                            <div class="col-12">
                                                <input-text :has-error="form.error('email')" v-model="form.email"></input-text>
                                            </div>
                                            <input-error :message="form.error('email')"></input-error>
                                        </form-group>

                                    </form>
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
                                            <a @click.prevent="submit" class="btn btn-success btn-block" href="#">{{ $__('general.update')}}</a>
                                        </div>
                                        <div class="col-4">
                                            <inertia-link class="btn btn-danger btn-block" href="/">{{ $__('general.cancel')}}</inertia-link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--roles tab-->
                    <div class="tab-pane" id="roles" role="tabpanel">
                        <div class="card-body">
                            <div class="col-md-5">
                                <div class="card-body">
                                    <div class="card-title">
                                        Role
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <td>{{user.role}}</td>
                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--permission tab-->
                    <div class="tab-pane" id="permissions" role="tabpanel">
                        <div class="card-body">
                            <div class="col-md-6">
                                <div class="col-md-12 col-sm-12 p-20">
                                    <h4 class="card-title"> Permissions </h4>

                                    <ul class="list-group">
                                        <li class="list-group-item" v-for="permission in userPermissions">{{permission}}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </app-layout>

</template>

<script>
    import AppLayout from "@/Layouts/AppLayout";
    import AddPhone from '@/Jetstream/AddPhone'
    import FormGroup from '@/Jetstream/Form/FormGroup'
    import InputText from "@/Jetstream/Form/Input/InputText";
    import InputError from "@/Jetstream/InputError";
    import FormLabel from "@/Jetstream/Form/FormLabel";
    import ButtonDanger from "@/Jetstream/Form/Button/ButtonDanger";
    import ButtonSuccess from "@/Jetstream/Form/Button/ButtonSuccess";
    import InputPassword from "@/Jetstream/Form/Input/InputPassword";


    import JetButton from '@/Jetstream/Button'
    import JetFormSection from '@/Jetstream/FormSection'
    import JetInput from '@/Jetstream/Input'
    import JetInputError from '@/Jetstream/InputError'
    import JetLabel from '@/Jetstream/Label'
    import JetActionMessage from '@/Jetstream/ActionMessage'
    import JetSecondaryButton from '@/Jetstream/SecondaryButton'

    export default {
        components: {
            AppLayout,
            AddPhone,
            InputPassword,
            ButtonDanger,
            FormLabel,
            InputError,
            InputText,
            ButtonSuccess,
            FormGroup,


            JetActionMessage,
            JetButton,
            JetFormSection,
            JetInput,
            JetInputError,
            JetLabel,
            JetSecondaryButton,
        },
        props: {
            user: Object,
            userPermissions: Array,
        },
        data() {
            return {
                form: this.$inertia.form({
                        name: this.user.name,
                        username: this.user.username,
                        email: this.user.email,
                        phones: this.user.phones,
                    },
                    {
                        bag: 'updateProfileInformation',
                        resetOnSuccess: false,
                    }),

                photoPreview: null,
            }
        },
        methods: {
            showUrl(id) {
                return '/users/' + id;
            },
            editUrl(id) {
                return '/users/' + id + '/edit';
            },

            deletPHone(number) {
                let index = this.form.phones.findIndex(phone => parseInt(phone.number) === parseInt(number));
                this.form.phones.splice(index, 1);
            },

            submit() {
                this.form.put(this.url)
            },





        },
        computed: {
            url() {
                return '/users/' + this.user.id;
            }
        },

        created() {
            Bus.$on('phone-added', (data) => this.form.phones.push(data));
        }

    };
</script>
