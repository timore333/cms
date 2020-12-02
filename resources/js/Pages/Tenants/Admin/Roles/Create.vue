<template>
    <app-layout>
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form @submit.prevent="submit">

                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group" :class=" {'has-danger':form.error('name') }">
                                        <input type="text" v-model="form.name" id="name"
                                               class="form-control"
                                               :class=" {'form-control-danger':form.error('name') }"
                                               :placeholder="$__('general.name')">

                                        <small v-if="form.error('name')" class="form-control-feedback">
                                            {{form.error('name')}} </small>

                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" name="submit" class="btn btn-success pull-right">
                                        {{$__('general.submit')}}
                                    </button>
                                </div>
                            </div>

                            <div class="col-lg-12 col-xlg-4">
                                <h5 class="box-title"><strong>{{$__('general.permissions')}}</strong></h5>
                                <hr>
                                <p class="subtitle">{{$__('messages.roles_permission_subtitle')}}</p>
                                <select multiple id="add-permissions" name="permissions[]">

                                    <option v-for="permission in permissions" :value="permission.id">
                                        {{permission.name}}
                                    </option>

                                </select>
                                <div class="button-box m-t-20">
                                    <a id="select-all-permissions" class="btn btn-outline-success"
                                       href="javascript:void(0)">select all</a>
                                    <a id="deselect-all-permissions" class="btn btn-outline-warning"
                                       href="javascript:void(0)">deselect all</a>
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
            permissions: Array
        },
        components: {
            AppLayout,
        },
        data() {
            return {
                form: this.$inertia.form({
                    name: this.name,
                }, {
                    // bag: 'updateProfileInformation',
                    resetOnSuccess: true,
                }),
            }
        },
        methods: {
            submit() {
                this.form.post('/roles', {
                    preserveScroll: true
                })
            },
        },

        created() {
            jQuery(document).ready(function () {
                // For multiselect
                $('#add-permissions').multiSelect({
                    selectableHeader: "<div class='custom-header text-center text-info'>All Permissions</div>",
                    selectionHeader: "<div class='custom-header text-center text-info'>Role Permissions</div>",
                    dblClick: "true"
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

