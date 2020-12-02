<template>
    <div>
        <a @click.prevent="show" class="btn btn-secondary waves-effect m-t-10" href="">{{$__('auth.logout_other_sessions')}}</a>
        <modal
                :adaptive="true"
                :resizable="false"
                :scrollable="true"
                @before-open="beforeOpen"
                height='auto'
                name="confirm-logout-modal"
        >

            <div class="card m-0">
                <div class="card-body">
                    <h4 class="card-title">{{$__('auth.confirm_logout')}}</h4>
                    <p class="card-text">{{$__('messages.inter_password_to_logout_other_browsers')}}</p>

                    <div class="form-group">
                        <jet-input :placeholder="$__('general.password')" @keyup.enter.native="logoutOtherBrowserSessions" class="form-control"
                                   ref="password"
                                   type="password"
                                   v-model="form.password">
                        </jet-input>
                        <jet-input-error :message="form.error('password')" class="mt-2"/>
                    </div>

                    <div class="form-group pull-right m-b-0">
                        <jet-button :disabled="form.processing" @click.native="logoutOtherBrowserSessions" class="btn btn-info waves-effect">
                            {{$__('auth.logout_other_sessions')}}
                        </jet-button>
                        <button @click="hide" class="btn btn-success">
                            {{$__('general.cancel')}}
                        </button>
                    </div>


                </div>
            </div>


        </modal>

    </div>
</template>

<script>

    import JetInputError from '@/Jetstream/InputError'
    import JetInput from '@/Jetstream/Input'
    import JetButton from '@/Jetstream/Button'

    export default {

        // /////////////////////

        data() {
            return {

                form: this.$inertia.form({
                    '_method': 'DELETE',
                    password: '',
                }, {
                    bag: 'logoutOtherBrowserSessions'
                })
            }

        },
        components: {
            JetInputError,
            JetInput,
            JetButton,
        }
        ,

        // //////////////////////

        methods: {

            show() {
                this.$modal.show('confirm-logout-modal');
            }
            ,
            hide() {
                this.$modal.hide('confirm-logout-modal');
            }
            ,
            beforeOpen() {
            }
            ,

            logoutOtherBrowserSessions() {
                Bus.$emit('logout-confirmed', this.form);
                this.hide();
            }

        }
        ,

        // //////////////////////

        computed: {}
        ,


        // /////////////////////


    }
</script>