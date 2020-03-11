<template>
    <span>
        <button class="dd-btn" @click="showForm = true">New Article</button>
        <modal :show="showForm" @close="showForm = false">
            <div class="w-screen max-w-md p-4">
                <p class="text-lg text-brand-purple">Start a new Article</p>
                <form @submit.prevent="submit">
                    <div class="my-4" :class="{'border-b border-red-400': formErrors.title}">
                        <label class="form-label" for="title">Article title</label>
                        <span class="text-xs text-red-400" v-show="formErrors.title">{{ formErrors.title }}</span>
                        <input type="text" name="title" v-model="formData.title" class="input-text" id="title">
                    </div>
                    <div class="my-6">
                        <span class="form-label">This title is in:</span>
                        <div class="flex">
                            <div>
                                <label for="en_title_locale" class="form-label">English</label>
                                <input type="radio" v-model="formData.lang" value="en" id="en_title_locale">
                            </div>
                            <div class="mx-6">
                                <label for="zh_title_locale" class="form-label">Chinese</label>
                                <input type="radio" v-model="formData.lang" value="zh" id="zh_title_locale">
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end">
                        <button class="dd-btn btn-grey" type="button" @click="showForm = false">Cancel</button>
                        <button :disabled="waiting" class="dd-btn ml-4" type="submit">Submit</button>
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
        data() {
            return {
                showForm: false,
                waiting: false,
                formData: {
                    title: '',
                    lang: 'en'
                },
                formErrors: {
                    title: '',
                    lang: ''
                }
            };
        },

        methods: {
            submit() {
                this.formErrors = clearFormErrors(this.formErrors);
                this.waiting = true;

                axios.post("/admin/content/articles", this.formData)
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
                alertError("Unable to create article");
            }
        }
    }
</script>