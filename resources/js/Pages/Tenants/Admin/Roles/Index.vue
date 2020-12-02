<template>
    <app-layout>
        <div class="container m-t-40">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{$__('general.roles')}} </h4>

                    <div class="table-responsive">

                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>{{$__('general.id')}}</th>
                                <th>{{$__('general.role')}}</th>
                                <th>{{$__('general.permissions')}}</th>
                                <th class="text-nowrap">{{$__('general.edit')}}</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr v-for="role in roles">
                                <td>{{role.id}}</td>
                                <td>{{role.name}}</td>

                                <template v-if="role.permissions.length > 0">
                                    <td>
                                    <span :class="color()"
                                          v-for="permission in role.permissions"> {{permission.name}}
                                    </span>

                                    </td>
                                </template>
                                <template v-else>
                                    <td><h5 class="text-danger">There is no permission assignd to this role</h5></td>
                                </template>

                                <td class="text-nowrap">
                                    <inertia-link :href="$route('roles.edit', role.id)" >
                                        <i class="fa fa-pencil text-inverse m-r-10"></i>
                                    </inertia-link>
                                </td>

                            </tr>

                            </tbody>
                        </table>

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
            roles: Array,
            colers: Array,
        },
        components: {
            AppLayout,
        },
        methods: {
            color() {
                return 'm-r-5 m-b-5 label label-' + this.colers[_.random(0, 4)]
            },
        },
        computed: {

        },

        created() {

        }
    };
</script>
