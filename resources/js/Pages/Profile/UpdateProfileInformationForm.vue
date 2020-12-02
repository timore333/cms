<template>
    <jet-form-section @submitted="updateProfileInformation">
        <template #form>
            <!-- Name -->
            <div class="form-group">
                <label for="name">{{$__('general.name')}}</label>
                <input id="name" type="text" class="form-control" v-model="form.name" autocomplete="name" />
                <jet-input-error :message="form.error('name')"/>
            </div>

            <!-- username -->
            <div class="form-group">
                <label for="username" >{{$__('general.username')}}</label>
                <input id="username" type="text" class="form-control" v-model="form.username" />
                <jet-input-error :message="form.error('username')"/>
            </div>
            <!-- Email -->
            <div class="form-group">
                <label for="email" >{{$__('general.email')}}</label>
                <input id="email" type="email" class="form-control" v-model="form.email" />
                <jet-input-error :message="form.error('email')"/>
            </div>
        </template>

        <template #actions>
            <jet-action-message :on="form.recentlySuccessful" class="m-r-3">
              {{$__('general.saved')}}
            </jet-action-message>

            <button class="btn btn-secondary waves-effect pull-right" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                {{$__('general.save')}}
            </button>
        </template>
    </jet-form-section>
</template>

<script>
    import JetButton from '@/Jetstream/Button'
    import JetFormSection from '@/Jetstream/FormSection'
    import JetInput from '@/Jetstream/Input'
    import JetInputError from '@/Jetstream/InputError'
    import JetLabel from '@/Jetstream/Label'
    import JetActionMessage from '@/Jetstream/ActionMessage'
    import JetSecondaryButton from '@/Jetstream/SecondaryButton'

    export default {
        components: {
            JetActionMessage,
            JetButton,
            JetFormSection,
            JetInput,
            JetInputError,
            JetLabel,
            JetSecondaryButton,
        },

        props: ['user'],

        data() {
            return {
                form: this.$inertia.form({
                    '_method': 'PUT',
                    name: this.user.name,
                    email: this.user.email,
                    username: this.user.username,
                    photo: null,
                }, {
                    bag: 'updateProfileInformation',
                    resetOnSuccess: false,
                }),

                photoPreview: null,
            }
        },

        methods: {
            updateProfileInformation() {
                if (this.$refs.photo) {
                    this.form.photo = this.$refs.photo.files[0]
                }

                this.form.post(route('user-profile-information.update'), {
                    preserveScroll: true
                });
            },

            selectNewPhoto() {
                this.$refs.photo.click();
            },

            updatePhotoPreview() {
                const reader = new FileReader();

                reader.onload = (e) => {
                    this.photoPreview = e.target.result;
                };

                reader.readAsDataURL(this.$refs.photo.files[0]);
            },

            deletePhoto() {
                this.$inertia.delete(route('current-user-photo.destroy'), {
                    preserveScroll: true,
                }).then(() => {
                    this.photoPreview = null
                });
            },
        },
    }
</script>
