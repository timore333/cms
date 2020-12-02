<template>
    <app-layout>
        <div class="contianer m-t-40">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h3>{{$__('general.edit')}} {{$__('general.role')}}: {{role.name}}</h3></div>
                    <div class="card-body">
                        <form @submit.prevent="submit">

                            <div class="col-lg-12 col-xlg-4">

                                <p class="subtitle">{{$__('messages.roles_permission_subtitle')}}</p>

                                <select id="add-permissions" multiple>
                                    <option :selected="selected(permission.id)"
                                            :value="permission.id"
                                            v-for="permission in permissions">
                                        {{permission.name}}
                                    </option>
                                </select>
                                <div class="row button-box m-t-20">
                                    <div class=" col col-md-7">
                                        <a class="btn btn-outline-success" href="javascript:void(0)"
                                           id="select-all-permissions">{{$__('general.select_all')}}</a>
                                        <a class="btn btn-outline-warning" href="javascript:void(0)"
                                           id="deselect-all-permissions">{{$__('general.deselect_all')}}</a>
                                    </div>
                                    <div class=" col col-md-5 text-right">
                                        <button :disabled="posting" class="btn btn-success" name="submit" type="submit">
                                            {{$__('general.edit_role')}}
                                        </button>
                                        <inertia-link
                                                :href="$route('roles.index')"
                                                @click="posting=true"
                                                :disabled="posting"
                                                class="btn btn-danger"
                                        >{{$__('general.cancel')}}
                                        </inertia-link>
                                    </div>
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

    export default {
        props: {
            permissions: Array,
            role: Object,
            rolePermissions: Array,
        },
        components: {
            AppLayout,
        },

        data() {
            return {
                form: this.$inertia.form({
                    role: this.role,
                    permissions: null
                }),
                selectedPermissions: this.rolePermissions,
                posting: false
            }
        },
        methods: {

            submit() {
                this.posting = true;
                this.form.permissions = this.selectedPermissions;
                this.$inertia.put(this.url, this.form);
            },

            /**
             *  check the permission of this role against all roles
             *  permissions will be added to the selected list
             * @param permission
             * @returns {boolean}
             */
            selected(permission) {
                return _.includes(this.rolePermissions, permission);
            },


            /**
             * merge the selected permission or permissions with the role permissions
             * return unique values
             * @param value
             */
            addPermission(value) {
                this.selectedPermissions = _.union(this.selectedPermissions, value)
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
        },
        computed: {
            url() {
                return '/roles/' + this.role.id;
            },

            canSubmit() {
                return this.posting
            }
        },

        created() {
            /** send the selected permissions to event **/
            Bus.$on('permission-selected', (value) => this.addPermission(value));
            Bus.$on('permission-deselected', (value) => this.removePermission(value));

            jQuery(document).ready(function () {
                // For multiselect
                $('#add-permissions').multiSelect({
                    selectableHeader: "<div class='custom-header text-center text-info'>All Permissions</div>",
                    selectionHeader: "<div class='custom-header text-center text-info'>Role Permissions</div>",
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

                $('li.ms-elem-selectable').addClass('text-warning');
                $('li.ms-elem-selection').addClass('text-success');
            });

        }
    };

</script>

