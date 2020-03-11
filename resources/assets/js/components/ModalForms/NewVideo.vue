<template>
    <span>
        <button @click="showForm = true" class="dd-btn">Add video</button>
        <modal :show="showForm" @close="showForm = false">
            <form @submit.prevent="submit" class="p-4 w-screen max-w-md">
                <p class="text-xl">Add a new Youtube or Vimeo video</p>
                <div class="my-4" :class="{'border-b border-red-400': formErrors.video_url}">
                    <label class="form-label" for="video_url">Video link</label>
                    <span class="text-xs text-red-400" v-show="formErrors.video_url">{{ formErrors.video_url }}</span>
                    <input type="text" name="video_url" v-model="formData.video_url" class="input-text" id="video_url">
                </div>
                <div class="flex justify-end mt-6">
                    <button class="dd-btn btn-grey" type="button" @click="showForm = false">Cancel</button>
                    <button class="ml-4 dd-btn" type="submit" :disabled="waiting">Add video</button>
                </div>
            </form>
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
                    video_url: '',
                },
                formErrors: {
                    video_url: ''
                }
            };
        },

        methods: {
            submit() {
                this.formErrors = clearFormErrors(this.formErrors);
                this.waiting = true;
                axios.post("/admin/media/videos", this.formData)
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
                alertError(data.message || 'Unable to add video');
            }
        }
    }
</script>