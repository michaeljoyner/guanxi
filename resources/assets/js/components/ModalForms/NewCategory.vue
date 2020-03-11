<template>
    <span>
        <button @click="showForm = true" class="dd-btn">Add Category</button>
        <modal :show="showForm" @close="showForm = false">
            <div class="w-screen max-w-md p-4">
                <p class="text-lg text-brand-purple">Add a new Category</p>
                <form @submit.prevent="submit">
                    <div class="my-4" :class="{'border-b border-red-400': formErrors.name}">
                        <label class="form-label" for="name">Name</label>
                        <span class="text-xs text-red-400" v-show="formErrors.name">{{ formErrors.name }}</span>
                        <input type="text" name="name" v-model="formData.name" class="input-text" id="name">
                    </div>
                    <div class="my-4" :class="{'border-b border-red-400': formErrors.zh_name}">
                        <label class="form-label" for="zh_name">Chinese Name</label>
                        <span class="text-xs text-red-400" v-show="formErrors.zh_name">{{ formErrors.zh_name }}</span>
                        <input type="text" name="zh_name" v-model="formData.zh_name" class="input-text" id="zh_name">
                    </div>
                    <div class="my-4" :class="{'border-b border-red-400': formErrors.description}">
                        <label class="form-label" for="description">Description</label>
                        <span class="text-xs text-red-400" v-show="formErrors.description">{{ formErrors.description }}</span>
                        <textarea name="description" v-model="formData.description" class="input-text h-24" id="description" />
                    </div>
                    <div class="my-4" :class="{'border-b border-red-400': formErrors.zh_description}">
                        <label class="form-label" for="zh_description">Chinese Description</label>
                        <span class="text-xs text-red-400" v-show="formErrors.zh_description">{{ formErrors.zh_description }}</span>
                        <textarea name="zh_description" v-model="formData.zh_description" class="input-text h-24" id="zh_description" />
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
                    name: '',
                    zh_name: '',
                    description: '',
                    zh_description: '',
                },
                formErrors: {
                    name: '',
                    zh_name: '',
                    description: '',
                    zh_description: '',},
            };
        },

        methods: {
            submit() {
                this.waiting = true;
                this.formErrors = clearFormErrors(this.formErrors);

                axios.post("/admin/content/categories", this.formData)
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
                alertError("Unable to create new category.");
            }
        }
    }
</script>