<template>
    <div class="form-group  row " :class="{'has-danger': hasError}">
        <slot></slot>
    </div>
</template>

<script>
    export default {
        props:['hasError'],
    }
</script>
