<template>
    <span>
        <button @click="showForm = true" class="dd-btn">New Gallery</button>
        <modal :show="showForm" @close="showForm = false">
            <div class="w-screen max-w-md p-4">
                <p class="text-lg text-brand-purple mb-8">{{ header }}</p>
                <form @submit.prevent="submit">
                    <div class="my-4" :class="{'border-b border-red-400': formErrors.title}">
                        <label class="form-label" for="title">Title</label>
                        <span class="text-xs text-red-400" v-show="formErrors.title">{{ formErrors.title }}</span>
                        <input type="text"
                               name="title"
                               :placeholder="placeholder"
                               v-model="formData.title"
                               class="input-text"
                               id="title">
                    </div>
                    <div class="mt-6 flex justify-end">
                        <button class="dd-btn btn-grey" @click="showForm = false" type="button">Cancel</button>
                        <button :disabled="waiting" class="dd-btn ml-4" type="submit">Create</button>
                    </div>
                </form>
            </div>
        </modal>
    </span>
</template>

<script type="text/babel">
    import {showValidationErrors, clearFormErrors} from "../../utils/forms";
    import {alertError} from "../../utils/alerts";

    export default {
        props: ['type'],

        data() {
            return {
                showForm: false,
                waiting: false,
                formData: {
                    title: '',
                },
                formErrors: {
                    title: '',
                }
            };
        },

        computed: {
            post_url() {
                if(this.type === 'photo') {
                    return '/admin/media/photos';
                }

                if(this.type === 'artwork') {
                    return '/admin/media/artworks';
                }
            },

            placeholder() {
                if(this.type === 'photo') {
                    return 'Give the gallery a title to get started';
                }

                if(this.type === 'artwork') {
                    return 'Give the artwork a title to get started';
                }
            },

            header() {
                if(this.type === 'photo') {
                    return 'Create a new photo gallery';
                }

                if(this.type === 'artwork') {
                    return 'Create a new artwork gallery';
                }
            }
        },

        methods: {
            submit() {
                this.waiting = true;
                this.formErrors = clearFormErrors(this.formErrors);

                axios.post(this.post_url, this.formData)
                .then(({data}) => this.onSuccess(data))
                .catch(({response}) => this.onError(response))
                .then(() => this.waiting = false);
            },

            onSuccess({redirect}) {
                window.location = redirect;
            },

            onError({status, data}) {
                if(status === 422) {
                    return this.formErrors = showValidationErrors(this.formErrors, data.errors);
                }

                alertError('Failed to create gallery');
                this.showForm = false;
            }
        }
    }
</script>