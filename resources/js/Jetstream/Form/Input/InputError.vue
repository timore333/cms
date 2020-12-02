<template>
     <small v-show="message" class="form-control-feedback"> {{message}}</small>
</template>

<script>
    export default {
        props: ['message'],
    }
</script>
