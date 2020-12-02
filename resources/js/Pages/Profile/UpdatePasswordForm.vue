<template>
    <jet-form-section @submitted="updatePassword">

        <template #form>
            <div class="form-group">
                <label for="current_password">{{$__('general.current')}} {{$__('general.password')}}</label>
                <input autocomplete="current-password" class="form-control" id="current_password" ref="current_password" type="password" v-model="form.current_password"/>
                <jet-input-error :message="form.error('current_password')"/>
            </div>

            <div class="form-group">
                <label for="password">{{$__('general.new')}} {{$__('general.password')}}</label>
                <input autocomplete="new-password" class="form-control" id="password" type="password" v-model="form.password"/>
                <jet-input-error :message="form.error('password')"/>
            </div>

            <div class="form-group">
                <label for="password_confirmation">{{$__('general.confirm')}} {{$__('general.password')}}</label>
                <input autocomplete="new-password" class="form-control" id="password_confirmation" type="password" v-model="form.password_confirmation"/>
                <jet-input-error :message="form.error('password_confirmation')"/>
            </div>
        </template>

        <template #actions>

            <button :class="{ 'opacity-25': form.processing }" :disabled="form.processing" class="btn btn-secondary waves-effect pull-right">
                {{$__('general.save')}}
            </button>
            <jet-action-message :on="form.recentlySuccessful">
                {{$__('general.saved')}}
            </jet-action-message>

        </template>
    </jet-form-section>
</template>

<script>
    import JetActionMessage from '@/Jetstream/ActionMessage'
    import JetButton from '@/Jetstream/Button'
    import JetFormSection from '@/Jetstream/FormSection'
    import JetInput from '@/Jetstream/Input'
    import JetInputError from '@/Jetstream/InputError'
    import JetLabel from '@/Jetstream/Label'

    export default {
        components: {
            JetActionMessage,
            JetButton,
            JetFormSection,
            JetInput,
            JetInputError,
            JetLabel,
        },

        data() {
            return {
                form: this.$inertia.form({
                    current_password: '',
                    password: '',
                    password_confirmation: '',
                }, {
                    bag: 'updatePassword',
                }),
            }
        },

        methods: {
            updatePassword() {
                this.form.put(route('user-password.update'), {
                    preserveScroll: true
                }).then(() => {
                    this.$refs.current_password.focus()
                })
            },
        },
    }
</script>
