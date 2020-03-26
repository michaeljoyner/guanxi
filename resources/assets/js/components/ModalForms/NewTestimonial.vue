<template>
    <span>
        <button class="dd-btn" @click="showForm = true">Add Testimonial</button>
        <modal :show="showForm" @close="showForm = false">
            <div class="p-4 w-screen max-w-md">
                <p class="text-xl text-brand-purple mb-6">Add a new Testimonial</p>
                <form @submit.prevent="submit">
                    <div class="my-4" :class="{'border-b border-red-400': formErrors.name}">
                        <label class="form-label" for="name">Name</label>
                        <span class="text-xs text-red-400" v-show="formErrors.name">{{ formErrors.name }}</span>
                        <input type="text" name="name" v-model="formData.name" class="input-text" id="name">
                    </div>
                    <div class="my-6">
                        <p class="form-label">Language:</p>
                        <div class="flex mt-3 pl-2">
                            <div class="mr-6">
                                <label for="english">English</label>
                                <input type="radio" id="english" v-model="formData.language" value="en">
                            </div>
                            <div>
                                <label for="chinese">Chinese</label>
                                <input type="radio" id="chinese" v-model="formData.language" value="zh">
                            </div>
                        </div>
                    </div>
                    <div class="my-4" :class="{'border-b border-red-400': formErrors.content}">
                        <label class="form-label" for="content">Content</label>
                        <span class="text-xs text-red-400" v-show="formErrors.content">{{ formErrors.content }}</span>
                        <textarea name="content" v-model="formData.content" class="input-text h-40" />
                    </div>
                    <div class="flex justify-end">
                        <button type="button" class="dd-btn btn-grey" @click="showForm = false">Cancel</button>
                        <button :disabled="waiting" class="dd-btn ml-4" type="submit">Save</button>
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
                    name: '',
                    content: '',
                    language: 'en',
                },
                formErrors: {
                    name: '',
                    content: '',
                    language: '',
                }
            };
        },

        methods: {

            submit() {
                this.waiting = true;
                this.formErrors = clearFormErrors(this.formErrors);

                axios.post("/admin/testimonials", this.formData)
                .then(({data}) => this.onSuccess(data))
                .catch(({response}) => this.onError(response))
                .then(() => this.waiting = false);
            },

            onSuccess({redirect}) {
                window.location = redirect;
            },

            onError({status, data}) {
                if(status === 422) {
                    return this.formErrors = showValidationErrors(this.formErrors, data);
                }

                this.showForm = false;
                alertError('Unable to save new testimonial.');
            }
        }
    }
</script>