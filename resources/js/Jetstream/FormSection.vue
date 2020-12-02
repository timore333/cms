<template>
    <div class="">
        <form @submit.prevent="$emit('submitted')">
            <div class="card-body b-all">
                <slot name="form"></slot>

                <div class="" v-if="hasActions">
                    <slot name="actions"></slot>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    import JetSectionTitle from './SectionTitle'

    export default {
        components: {
            JetSectionTitle,
        },

        computed: {
            hasActions() {
                return !!this.$slots.actions
            }
        }
    }
</script>
