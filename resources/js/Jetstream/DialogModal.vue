<template>
    <modal :show="show" :max-width="maxWidth" :closeable="closeable" @close="close">
        <div class="card m-t-40">
            <div class="card-header">
                <slot name="title"></slot>
            </div>

            <div class="card-body">
                <slot name="content">
                </slot>
            </div>
        </div>

        <div class="card-footer">
            <slot name="footer">
            </slot>
        </div>
    </modal>
</template>

<script>
    import Modal from './Modal'

    export default {
        components: {
            Modal,
        },

        props: {
            show: {
                default: false
            },
            maxWidth: {
                default: '2xl'
            },
            closeable: {
                default: true
            },
        },

        methods: {
            close() {
                this.$emit('close')
            },
        }
    }
</script>
