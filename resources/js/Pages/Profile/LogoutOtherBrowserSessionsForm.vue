<template>
    <div>
        <jet-action-section>
            <template #content>
                <div class="card-subtitle col-12">
                    {{$__('messages.logout_other_browsers_subtitle')}}
                </div>

                <!-- Other Browser Sessions -->
                <div class="m-t-5 " v-if="sessions.length > 0">
                    <div :key="i" class="col-12" v-for="(session, i) in sessions">
                        <div>
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" style="width: 50px; height: 50px" v-if="session.agent.is_desktop" viewBox="0 0 24 24">
                                <path d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>

                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" style="width: 50px; height: 50px" v-else viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0 0h24v24H0z" stroke="none"></path>
                                <rect height="16" rx="1" width="10" x="7" y="4"></rect>
                                <path d="M11 5h2M12 17v.01"></path>
                            </svg>
                        </div>

                        <div class="ml-3">
                            <div>
                                {{ session.agent.platform }} - {{ session.agent.browser }}
                            </div>

                            <div>
                                <div>
                                    {{ session.ip_address }},

                                    <span class="text-success" v-if="session.is_current_device">{{$__('general.this_device')}}</span>
                                    <span v-else>{{$__('general.last_active ')}} {{ session.last_active }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <confirm-logout-modal></confirm-logout-modal>
                    <jet-action-message :on="form.recentlySuccessful">
                       {{$__('general.done ')}}
                    </jet-action-message>
                </div>

            </template>
        </jet-action-section>
    </div>
</template>

<script>
    import JetActionMessage from '@/Jetstream/ActionMessage'
    import JetActionSection from '@/Jetstream/ActionSection'
    import JetButton from '@/Jetstream/Button'
    import JetDialogModal from '@/Jetstream/DialogModal'
    import JetInput from '@/Jetstream/Input'
    import JetInputError from '@/Jetstream/InputError'
    import JetSecondaryButton from '@/Jetstream/SecondaryButton'
    import ConfirmLogoutModal from '@/Jetstream/Modals/ConfirmLogoutModal'

    export default {
        props: ['sessions'],

        components: {
            JetActionMessage,
            JetActionSection,
            JetButton,
            JetDialogModal,
            JetInput,
            JetInputError,
            JetSecondaryButton,
            ConfirmLogoutModal,
        },

        data() {
            return {
                confirmingLogout: false,

                form: this.$inertia.form({
                    '_method': 'DELETE',
                    password: '',
                }, {
                    bag: 'logoutOtherBrowserSessions'
                })
            }
        },

        methods: {
            confirmLogout(data) {
                this.form.password = data.password;

                this.logoutOtherBrowserSessions();

            },

            logoutOtherBrowserSessions() {
                this.form.post(route('other-browser-sessions.destroy'), {
                    preserveScroll: true
                }).then(response => {
                    if (this.form.hasErrors()) {
                        this.$modal.show('confirm-logout-modal');
                    }
                })
            },
        },

        created() {
            Bus.$on('logout-confirmed', (data)=> this.confirmLogout(data))
        }
    }
</script>
