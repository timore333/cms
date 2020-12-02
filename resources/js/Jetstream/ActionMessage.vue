<template>
    <div>
        <transition leave-active-class="animated flash" >
            <div v-show="on" class="text-success">
                <slot />
            </div>
        </transition>
    </div>
</template>

<script>
    export default {
        props: ['on'],
    }
</script>
