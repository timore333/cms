<template>
    <app-layout>

        <div class="container m-t-40">
            <div class="col-12 p-10">
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

                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#deletUser" role="tab">{{$__('general.delete')}}</a>
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
                                                <a @click.prevent="submitPersonalDaata" class="btn btn-success btn-block" href="#">{{ $__('general.update')}}</a>
                                            </div>
                                            <div class="col-4">
                                                <inertia-link class="btn btn-danger btn-block" href="/users">{{ $__('general.cancel')}}</inertia-link>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>

                        <!--roles tab-->
                        <div class="tab-pane" id="roles" role="tabpanel">
                            <div class="card-body">
                                <div class="col-lg-12 ">
                                    <form @submit.prevent="submitRole()">

                                        <h5 class="box-title text-info">{{$__('general.current_role')}}: <b>{{user.role}}</b></h5>
                                        <p class="subtitle">{{$__('messages.roles_title')}}</p>
                                        <p><strong class="text-warning">{{$__('general.note')}}: </strong> {{$__('messages.change_role_note')}}
                                        </p>
                                        <form-group>
                                            <select class="form-control col-4" id="role" v-model="roleForm.role">
                                                <option :selected="role.name == user.role" :value="role.id" v-for="role in roles " :disabled="role.name === 'doctor'">{{role.name}}</option>
                                            </select>
                                        </form-group>
                                        <div class="button-box m-t-20">
                                            <button-success type="submit">{{$__('general.change_role')}}</button-success>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!--permission tab-->
                        <div class="tab-pane" id="permissions" role="tabpanel">
                            <div class="card-body">
                                <div class="col-lg-12 col-xlg-4">
                                    <h5 class="box-title">{{$__('general.direct_permissions')}}</h5>
                                    <p class="subtitle">{{$__('messages.user_permissions_title')}}</p>

                                    <form @submit.prevent="submitPermissions">

                                        <select id="add-permissions" multiple>
                                            <option :selected="selected(permission.id)"
                                                    :value="permission.id"
                                                    v-for="permission in permissions">
                                                {{permission.name}}
                                            </option>
                                        </select>
                                        <div class="button-box m-t-20">
                                            <a class="btn btn-danger" href="javascript:void(0)" id="select-all-permissions">select all</a>
                                            <a class="btn btn-info" href="javascript:void(0)" id="deselect-all-permissions">deselect all</a>

                                            <button class="btn btn-warning" name="submit" type="submit">save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!--Delete tab-->
                        <div class="tab-pane" id="deletUser" role="tabpanel">
                            <div class="card-body">
                                <div class="col-lg-12 col-xlg-4">
                                    <h5 class="box-title">Permanently delete account.</h5>
                                    <p class="subtitle">Once account is deleted, all of its resources and data will be permanently deleted.</p>

                                    <div class="m-t-5">
                                        <button-danger @click.native="confirmUserDeletion">
                                            Delete Account
                                        </button-danger>
                                    </div>

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
    import AppLayout from '@/Layouts/AppLayout'
    import AddPhone from '@/Jetstream/AddPhone'
    import ButtonSuccess from '@/Jetstream/Form/Button/ButtonSuccess'
    import FormGroup from '@/Jetstream/Form/FormGroup'
    import InputText from "@/Jetstream/Form/Input/InputText";
    import InputError from "@/Jetstream/InputError";
    import FormLabel from "@/Jetstream/Form/FormLabel";
    import ButtonDanger from "@/Jetstream/Form/Button/ButtonDanger";
    import InputPassword from "@/Jetstream/Form/Input/InputPassword";

    export default {
        props: {
            user: Object,
            roles: Array,
            permissions: Array,
            userPermissions: Array,
        },
        components: {
            InputPassword,
            ButtonDanger,
            FormLabel,
            InputError,
            InputText,
            AppLayout,
            AddPhone,
            ButtonSuccess,
            FormGroup,
        },
        data() {
            return {
                form: this.$inertia.form({
                    name: this.user.name,
                    username: this.user.username,
                    email: this.user.email,
                    phones: this.user.phones,
                }),

                roleForm: this.$inertia.form({
                    name: this.user.name,
                    username: this.user.username,
                    email: this.user.email,
                    role: this.user.role,

                }),

                permissionsForm: this.$inertia.form({
                    name: this.user.name,
                    username: this.user.username,
                    email: this.user.email,
                    permissions: null
                }),

                confirmingUserDeletion: false,
                deleting: false,

                deletForm: this.$inertia.form({
                    '_method': 'DELETE',
                }, {
                    bag: 'deleteUser'
                }),

                selectedPermissions: this.userPermissions,


            }
        },
        methods: {
            submitPersonalDaata() {
                this.form.put(this.url).then(resp=>window.location.reload());
            },

            submitPermissions() {
                let url = '/users/permissions/' + this.user.id;
                this.permissionsForm.permissions = this.selectedPermissions;
                this.permissionsForm.put(url)
            },

            submitRole() {
                this.roleForm.put(this.url)
            },

            /**
             *  check the permission of this role against all roles
             *  permissions will be added to the selected list
             * @param permission
             * @returns {boolean}
             */
            selected(permission) {
                return _.includes(this.userPermissions, permission);
            },


            /**
             * merge the selected permission or permissions with the role permissions
             * return unique values
             * @param value
             */
            addPermission(values) {
                this.selectedPermissions = _.union(this.selectedPermissions, values)
            },

            /**
             * remove the unselected permission or permissions from
             * the role permissions
             * @param value
             */
            removePermission(value) {
                for (let i = 0; i < value.length; i++) {
                    let index = _.findIndex(this.selectedPermissions, (o) => {
                        return parseInt(o) === parseInt(value[i])
                    });
                    this.selectedPermissions.splice(index, 1);
                }
            },

            deletPHone(number) {
                let index = this.form.phones.findIndex(phone => parseInt(phone.number) === parseInt(number));
                this.form.phones.splice(index, 1);
            },

            confirmUserDeletion() {
                this.confirmingUserDeletion = true;
                this.deleteUser();
                // setTimeout(() => {
                //     this.$refs.password.focus()
                // }, 250)
            },

            deleteUser() {
                this.deletForm.delete(route('users.destroy', this.user.id))
            },


        },
        computed: {
            url() {
                return '/users/' + this.user.id;
            }
        },

        created() {
            /** send the selected permissions to event **/
            Bus.$on('permission-selected', (value) => this.addPermission(value));
            Bus.$on('permission-deselected', (value) => this.removePermission(value));
            Bus.$on('phone-added', (data) => this.form.phones.push(data));
            jQuery(document).ready(function () {
                // For multiselect
                $('#add-permissions').multiSelect({
                    selectableHeader: "<div class='custom-header text-center text-warning'>All Permissions</div>",
                    selectionHeader: "<div class='custom-header text-center text-warning'>User Permissions</div>",
                    dblClick: "true",
                    afterSelect: (values) => {
                        Bus.$emit('permission-selected', values);
                    },
                    afterDeselect: function (values) {
                        Bus.$emit('permission-deselected', values);
                    }
                });
                $('#select-all-permissions').click(function () {
                    $('#add-permissions').multiSelect('select_all');
                    return false;
                });
                $('#deselect-all-permissions').click(function () {
                    $('#add-permissions').multiSelect('deselect_all');
                    return false;
                });

                $('li.ms-elem-selectable').addClass('text-info');
                $('li.ms-elem-selection').addClass('text-success');
            });
        }
    };

</script>

