<template>
    <div class="row">
        <jet-section-title>
            <template #title><slot name="title"></slot></template>
            <template #description><slot name="description"></slot></template>
        </jet-section-title>


            <div class="col-12">
                <slot name="content"></slot>
            </div>

    </div>
</template>

<script>
    import JetSectionTitle from './SectionTitle'

    export default {
        components: {
            JetSectionTitle,
        }
    }
</script>
