<template>
    <app-layout>
        <div class="container m-t-40">
            <div class="card">
                <div class="card-body">
                    <div id="patients-toolbar">
                        <a class="btn btn-info" href="/patients/create" v-if="can.create_patients">create new</a>
                    </div>
                    <bootstrap-table
                            :columns="Columns"
                            :data="patients"
                            :options="options"
                    />
                </div>
            </div>


        </div>

    </app-layout>

</template>

<script>
    import BootstrapTable from 'bootstrap-table/dist/bootstrap-table-vue.min.js'
    import AppLayout from "@/Layouts/AppLayout";

    export default {
        components: {AppLayout, BootstrapTable},
        props: {
            patients: Array,
            can: Object,
        },
        data() {
            return {
                options: {
                    search: true,
                    pagination: true,
                    showCoulumns: true,
                    showExport: true,
                    showPrint: true,
                    filterControl: true,
                    pageList: "[10, 25, 50, 100, 200, All]",
                    exportDataType: 'all',
                    exportTypes: ['csv', 'excel', 'xlsx', 'pdf'],
                    toolbar: '#patients-toolbar'
                },
                Columns: [
                    {
                        'field': 'id',
                        'title': 'ID',
                        'sortable': true,
                        'filterControl': 'input',
                        'width': '80px',
                        'align': 'center'
                    },
                    {'field': 'name', 'title': 'Name', 'sortable': true, 'filterControl': 'input'},
                    {'field': 'address', 'title': 'Address', 'sortable': true, 'filterControl': 'input'},
                    {'field': 'email', 'title': 'Email', 'sortable': true, 'filterControl': 'input'},
                    {
                        field: 'phones', title: 'Phones', sortable: true, filterControl: 'input',
                        formatter: (value, row) => {
                            return this.phoneFormatter(value, row)
                        },
                    },
                    {
                        field: 'view', title: 'Patient file', align: 'center', width: '100px',
                        formatter:
                            '<button class="btn btn-success btn-xs show"><i class="fa fa-eye"></i></button>',
                        events: {
                            'click .show': (e, value, row) => {
                                window.location.assign('/patients/' + row.id)
                            },
                        }
                    },
                ],


            }
        },

        computed: {},


        methods: {
            phoneFormatter(value, row) {
                let phones = row.phones;
                let string = '';
                string = phones.map((el) => {
                    return `<li><b>Type:</b>   ${el.type}  <br><b>Number:</b>  ${el.number}  </li>`
                });
                return '<ul>' + string.join('') + '</ul>';
            },

        },


    }
</script>
