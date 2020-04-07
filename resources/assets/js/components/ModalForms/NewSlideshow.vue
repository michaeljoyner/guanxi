<template>
    <span>
        <button class="dd-btn" @click="showForm = true">New Slideshow</button>
        <modal :show="showForm" @close="showForm = false">
            <div class="max-w-md w-screen p-4">
                <p class="text-xl text-brand-purple">Add a slideshow</p>
                <p class="my-8">Give the slideshow a name to get started. Ths name is not seen publicly, it is just for you to refer to the slideshow.</p>
                <form @submit.prevent="submit">
                <div class="my-4" :class="{'border-b border-red-400': formErrors.title}">
                    <label class="form-label" for="title">Title</label>
                    <span class="text-xs text-red-400" v-show="formErrors.title">{{ formErrors.title }}</span>
                    <input type="text" name="title" v-model="formData.title" class="input-text" id="title">
                </div>
                <div class="flex justify-end my-6">
                    <button class="btn btn-grey" type="button" @click="showForm = false">Cancel</button>
                    <button class="dd-btn ml-4" type="submit" :disabled="waiting">Add Slideshow</button>
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
        props: ['article-id'],

        data() {
            return {
                showForm: false,
                formData: {title: ''},
                formErrors: {title: ''},
                waiting: false,
            };
        },

        methods: {
            submit() {
                this.formErrors = clearFormErrors(this.formErrors);
                this.waiting = true;

                axios.post(`/admin/articles/${this.articleId}/slideshows`, this.formData)
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
                this.showForm = false;
                alertError('Unable to create slideshow');
            }
        }
    }
</script>