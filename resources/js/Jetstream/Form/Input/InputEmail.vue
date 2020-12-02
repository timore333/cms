<template>
    <input
            type="email"
            class="form-control"
            :class="{'form-control-danger': hasError}"
            :value="value"
            @input="$emit('input', $event.target.value)"
            ref="input">
</template>

<script>
    export default {
        props: ['value','hasError'],

        methods: {
            focus() {
                this.$refs.input.focus()
            }
        }
    }
</script>

