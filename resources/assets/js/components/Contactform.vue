<template>
    <div>
        <form @submit.prevent="submit" class="text-left max-w-md mx-auto">
            <div class="my-4" :class="{'border-b border-red-400': formErrors.name}">
                <label class="text-left font-display text-brand-purple mb-1 font-bold" for="name">{{ labels.name }}</label>
                <span class="text-xs text-red-400" v-show="formErrors.name">{{ formErrors.name }}</span>
                <input type="text" name="name" v-model="formData.name" class="block w-full p-2 border border-black" id="name">
            </div>
            <div class="my-4" :class="{'border-b border-red-400': formErrors.email}">
                <label class="text-left font-display text-brand-purple mb-1 font-bold" for="email">{{ labels.email }}</label>
                <span class="text-xs text-red-400" v-show="formErrors.email">{{ formErrors.email }}</span>
                <input type="email" name="email" v-model="formData.email" class="block w-full p-2 border border-black" id="email">
            </div>
            <div class="my-4" :class="{'border-b border-red-400': formErrors.enquiry}">
                <label class="text-left font-display text-brand-purple mb-1 font-bold" for="enquiry">{{ labels.enquiry }}</label>
                <span class="text-xs text-red-400" v-show="formErrors.enquiry">{{ formErrors.enquiry }}</span>
                <textarea name="enquiry" v-model="formData.enquiry" class="block w-full p-2 border border-black h-32 resize-none" id="enquiry" />
            </div>
            <div class="my-6 text-center">
                <waiting-button :waiting="waiting" :text="labels.submit"></waiting-button>
            </div>
        </form>
        <modal :show="showSuccessDialog" @close="showSuccessDialog = false">
            <div class="w-screen max-w-md p-4">
                <p class="type-h2 text-brand-purple font-bold">{{ dialogs.success.heading }}{{ sent_from }}</p>
                <p class="my-12 type-b1">{{ dialogs.success.text }}</p>
                <div class="text-center mt-16">
                    <button type="button" class="btn" @click="showSuccessDialog = false">{{ dialogs.success.button }}</button>
                </div>
            </div>
        </modal>
        <modal :show="showErrorDialog" @close="showErrorDialog = false">
            <div class="w-screen max-w-md p-4">
                <p class="type-h2 text-danger font-bold">{{ dialogs.error.heading  }}{{ sent_from }}</p>
                <p class="my-12 type-b1">{{ dialogs.error.text }}</p>
                <div class="text-center mt-16">
                    <button type="button" class="btn" @click="showErrorDialog = false">{{ dialogs.error.button }}</button>
                </div>
            </div>
        </modal>
    </div>
</template>

<script type="text/babel">
    import {clearFormErrors, showValidationErrors} from "../utils/forms";
    import WaitingButton from "./WaitingButton";

    export default {

        components: {
            WaitingButton,
        },

        props: ['labels', 'dialogs'],

        data() {
            return {
                formData: {
                    name: '',
                    email: '',
                    enquiry: '',
                },
                formErrors: {
                    name: '',
                    email: '',
                    enquiry: '',
                },
                waiting: false,
                showSuccessDialog: false,
                showErrorDialog: false,
                sent_from: 'there'
            }
        },

        methods: {

            submit() {
                this.sent_from = this.formData.name;
                this.waiting = true;
                this.formErrors = clearFormErrors(this.formErrors);
                axios.post('/contact', this.formData)
                     .then(this.onSuccess)
                     .catch(({response}) => this.onError(response))
                     .then(() => this.waiting = false);
            },

            onSuccess() {
                this.showSuccessDialog = true;
                this.formData = {
                    name: '',
                    email: '',
                    enquiry: '',
                };
            },

            onError({status, data}) {
                if(status === 422) {
                    return this.formErrors = showValidationErrors(this.formErrors, data.errors);
                }
                this.showErrorDialog = true;
            },
        }
    }
</script>