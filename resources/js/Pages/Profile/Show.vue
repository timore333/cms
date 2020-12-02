<template>
    <app-layout>

        <div class="container m-t-30">
            <div class="card m-t-30">
                <div class="card-header">
                    <h5 class="card-title">{{$__('general.personal_info')}}</h5>
                </div>
                <div class="row">
                    <div class="col-md-4 m-t-30 p-20">
                        <h5>{{$__('messages.update_username_and_email')}}</h5>
                    </div>
                    <div class="card-body col-md-7" v-if="$page.jetstream.canUpdateProfileInformation">
                        <update-profile-information-form :user="$page.user"/>
                    </div>
                </div>
            </div>

              <div class="card m-t-30">
                <div class="card-header">
                    <h5 class="card-title">{{$__('general.update')}} {{$__('general.password')}}</h5>
                </div>
                <div class="row">
                    <div class="col-md-4 m-t-30 p-20">
                        <h5> {{$__("messages.password_description")}}</h5>
                    </div>
                    <div class="card-body col-md-7" v-if="$page.jetstream.canUpdatePassword">
                        <update-password-form class="m-t-10"/>
                    </div>
                </div>
            </div>

              <div class="card m-t-30">
                <div class="card-header">
                    <h5 class="card-title">{{$__("general.browser")}} {{$__("general.sessions")}}</h5>
                </div>
                <div class="row">
                    <div class="col-md-4 m-t-30 p-20">
                        <h5> {{$__("messages.manage_logout_subtitle")}}</h5>
                    </div>
                    <div class="card-body col-md-7">
                          <logout-other-browser-sessions-form :sessions="sessions"/>
                    </div>
                </div>
            </div>

            <!--                <div v-if="$page.jetstream.canManageTwoFactorAuthentication">-->
            <!--                    <two-factor-authentication-form class="mt-10 sm:mt-0" />-->

            <!--                    <jet-section-border />-->
            <!--                </div>-->

            <!--                <jet-section-border />-->

            <!--                <delete-user-form class="mt-10 sm:mt-0" />-->

        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import DeleteUserForm from './DeleteUserForm'
    import JetSectionBorder from '@/Jetstream/SectionBorder'
    import LogoutOtherBrowserSessionsForm from './LogoutOtherBrowserSessionsForm'
    import TwoFactorAuthenticationForm from './TwoFactorAuthenticationForm'
    import UpdatePasswordForm from './UpdatePasswordForm'
    import UpdateProfileInformationForm from './UpdateProfileInformationForm'

    export default {
        props: ['sessions'],

        components: {
            AppLayout,
            DeleteUserForm,
            JetSectionBorder,
            LogoutOtherBrowserSessionsForm,
            TwoFactorAuthenticationForm,
            UpdatePasswordForm,
            UpdateProfileInformationForm,
        },
    }
</script>
