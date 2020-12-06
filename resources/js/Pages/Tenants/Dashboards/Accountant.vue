<template>
    <app-layout>
<h1>Accountant Dashboard</h1>
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
