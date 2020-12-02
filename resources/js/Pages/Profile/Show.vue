<template>
    <app-layout>

        <div class="container m-t-30">
            <div class="card m-t-30">
                <div class="card-header">
                    <h5 class="card-title">{{$__('general.personal_info')}}</h5>
                </div>
                <div class="row">
                    <div class="col-md-4 m-t-30 p-20">
                        <h5>{{$__('messages.update_username_and_email')}}</h5>
                    </div>
                    <div class="card-body col-md-7" v-if="$page.jetstream.canUpdateProfileInformation">
                        <update-profile-information-form :user="$page.user"/>
                    </div>
                </div>
            </div>

            <div class="card m-t-30">
                <div class="card-header">
                    <h5 class="card-title">{{$__('general.update')}} {{$__('general.password')}}</h5>
                </div>
                <div class="row">
                    <div class="col-md-4 m-t-30 p-20">
                        <h5> {{$__("messages.password_description")}}</h5>
                    </div>
                    <div class="card-body col-md-7" v-if="$page.jetstream.canUpdatePassword">
                        <update-password-form class="m-t-10"/>
                    </div>
                </div>
            </div>

            <div class="card m-t-30">
                <div class="card-header">
                    <h5 class="card-title">{{$__("general.edit")}} {{$__("general.phones")}}</h5>
                </div>
                <div class="row">
                    <div class="col-md-4 m-t-30 p-20">
                        <h5>Add or delete phones</h5>
                    </div>
                    <div class="card-body col-md-7">
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
                                    <div class="form-group">
                                        <button @click="addPhone()" class="btn btn-secondary waves-effect pull-right">save</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

            <div class="card m-t-30">
                <div class="card-header">
                    <h5 class="card-title">{{$__("general.browser")}} {{$__("general.sessions")}}</h5>
                </div>
                <div class="row">
                    <div class="col-md-4 m-t-30 p-20">
                        <h5> {{$__("messages.manage_logout_subtitle")}}</h5>
                    </div>
                    <div class="card-body col-md-7">
                        <logout-other-browser-sessions-form :sessions="sessions"/>
                    </div>
                </div>
            </div>


        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import DeleteUserForm from './DeleteUserForm'
    import JetSectionBorder from '@/Jetstream/SectionBorder'
    import AddPhone from '@/Jetstream/AddPhone'
    import LogoutOtherBrowserSessionsForm from './LogoutOtherBrowserSessionsForm'
    import TwoFactorAuthenticationForm from './TwoFactorAuthenticationForm'
    import UpdatePasswordForm from './UpdatePasswordForm'
    import UpdateProfileInformationForm from './UpdateProfileInformationForm'

    export default {
        props: ['sessions'],

        components: {
            AppLayout,
            DeleteUserForm,
            JetSectionBorder,
            LogoutOtherBrowserSessionsForm,
            TwoFactorAuthenticationForm,
            UpdatePasswordForm,
            UpdateProfileInformationForm,
            AddPhone,
        },
        data() {
            return {
                form: this.$inertia.form({
                    name: this.$page.user.name,
                    username: this.$page.user.username,
                    email: this.$page.user.email,
                    phones: this.$page.user.phones,
                }),
            }
        },

        methods: {

            deletPHone(number) {
                let index = this.form.phones.findIndex(phone => parseInt(phone.number) === parseInt(number));
                this.form.phones.splice(index, 1);
            },

            submitPersonalDaata() {
                this.form.put(this.url)
            },

            addPhone() {
                this.form.put(this.url).then(res => window.location.reload());
            },

        },
        computed: {
            url() {
                return '/users/' + this.$page.user.id;
            }
        },
        created() {
            /** send the selected permissions to event **/
            Bus.$on('phone-added', (data) => this.form.phones.push(data));
        }
    }
</script>
