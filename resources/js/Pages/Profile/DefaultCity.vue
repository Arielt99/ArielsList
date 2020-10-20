<template>
    <jet-form-section  @submitted="updateProfileDefaultCity">
        <template #title>
            Default City
        </template>

        <template #description>
            Choose your city
        </template>

        <template #form>
            <!-- City -->
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="city" value="City" />
                <select v-model="form.default_city" ref="city" class=" form-input block rounded-md shadow-sm mt-1 w-full border text-gray-700 py-2.5 px-4 pr-8 rounded leading-tight focus:outline-none" id="grid-state">
                    <option v-for="city in cities" :value="city.id" v-bind:key="city.id">{{city.name}}</option>
                </select>
            </div>

        </template>
        <template #actions>
            <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                Saved.
            </jet-action-message>

            <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </jet-button>
        </template>

        <jet-section-border />
    </jet-form-section>
</template>

<jet-section-border />

<script>
    import JetFormSection from './../../Jetstream/FormSection'
    import JetButton from './../../Jetstream/Button'
    import JetDialogModal from './../../Jetstream/DialogModal'
    import JetDangerButton from './../../Jetstream/DangerButton'
    import JetInput from './../../Jetstream/Input'
    import JetInputError from './../../Jetstream/InputError'
    import JetSecondaryButton from './../../Jetstream/SecondaryButton'
    import JetActionMessage from './../../Jetstream/ActionMessage'
    import JetLabel from './../../Jetstream/Label'

    export default {
        components: {
            JetFormSection,
            JetActionMessage,
            JetButton,
            JetDangerButton,
            JetInput,
            JetLabel,
            JetInputError,
            JetSecondaryButton,
        },
        props: ['cities','default_city'],

        data() {
            return {
                form: this.$inertia.form({
                    '_method': 'PUT',
                    default_city: this.default_city,
                },{
                    resetOnSuccess: false,
                })
            }
        },

        methods: {
            updateProfileDefaultCity() {
                this.form.post(route('/user/update-default-city'),{
                    preserveScroll: true
                });
            },
        },
    }
</script>
