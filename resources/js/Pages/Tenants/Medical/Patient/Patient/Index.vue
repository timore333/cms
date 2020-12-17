<template>
    <app-layout>

        <div class="container m-t-30">
            <div class="card">
                <div class="card-body">
                    <div class="card-header">
                        <h4 class="card-title"> {{$__('general.all_patients')}}
                            <inertia-link class="btn btn-success d-none d-lg-block pull-right" href="/patients/create"
                                          method="get">
                                <i class="fa fa-plus-circle"></i> {{$__('general.new_patient')}}
                            </inertia-link>
                        </h4>

                    </div>


                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead>
                            <tr>
                                <th>{{$__('general.id')}}</th>
                                <th>{{$__('general.name')}}</th>
                                <th>{{$__('general.gender')}}</th>
                                <th>{{$__('general.email')}}</th>
                                <th>{{$__('general.address')}}</th>
                                <th>{{$__('general.phones')}}</th>
                                <th>{{$__('general.action')}}</th>
                            </tr>

                            </thead>
                            <tbody>

                            <tr v-for="user in users">
                                <td>{{user.id}}</td>
                                <td>{{ user.name }}</td>
                                <td>{{ user.username }}</td>
                                <td>
                                   <template v-if="user.phones.length > 0">
                                       <ul class="m-b-0 p-l-0" style="list-style-type: none">
                                           <li v-for="phone in user.phones">{{phone.type}}: {{phone.number}}</li>
                                       </ul>
                                   </template>
                                    <template v-else>No phones </template>
                                </td>
                                <td>{{ user.role }}</td>
                                <td>

                                    <inertia-link :href="editUrl( user.id)" class="btn btn-outline-success btn-xs"
                                                  method="get">
                                        <span class="fa fa-edit"></span>
                                    </inertia-link>

                                    <!--  <delete-button default_model='{{user}}' model_class='user' button_class="btn btn-outline-danger btn-xs"><i class="fa fa-trash"></i></delete-button>-->
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
    import AppLayout from "@/Layouts/AppLayout";

    export default {
        components: {AppLayout},
        props: {
            users: Array,
            can: Object,
        },
        methods: {

            editUrl(id) {
                return '/users/' + id +'/edit';
            },


        },

    };
</script>
