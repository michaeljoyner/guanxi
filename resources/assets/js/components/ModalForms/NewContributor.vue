<template>
    <span>
        <button @click="showFormModal = true" class="dd-btn">New Contributor</button>
        <modal :show="showFormModal" @close="showFormModal = false">
            <div class="w-screen max-w-md p-4">
                <p class="text-xl">Add a contributor profile</p>
                <form @submit.prevent="submit">
                    <div class="my-4" :class="{'border-b border-red-400': formErrors.name}">
                        <label class="form-label" for="name">Name</label>
                        <span class="text-xs text-red-400" v-show="formErrors.name">{{ formErrors.name }}</span>
                        <input type="text" name="name" v-model="formData.name" class="input-text" id="name">
                    </div>
                    <div class="my-4" :class="{'border-b border-red-400': formErrors.title}">
                        <label class="form-label" for="title">Person's Title/Role</label>
                        <span class="text-xs text-red-400" v-show="formErrors.title">{{ formErrors.title }}</span>
                        <input type="text" name="title" v-model="formData.title" class="input-text" id="title">
                    </div>
                    <div class="my-4" :class="{'border-b border-red-400': formErrors.intro}">
                        <label class="form-label" for="intro">Intro</label>
                        <span class="text-xs text-red-400" v-show="formErrors.intro">{{ formErrors.intro }}</span>
                        <textarea name="intro" v-model="formData.intro" class="input-text h-32" id="intro" />
                    </div>
                    <div class="flex justify-end">
                        <button class="dd-btn btn-grey" type="button" @click="showFormModal = false">Cancel</button>
                        <button :disabled="waiting" class="dd-btn ml-4" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </modal>
    </span>
</template>

<script type="text/babel">
    import {showValidationErrors, clearFormErrors} from "../../utils/forms";

    export default {
        data() {
            return {
                showFormModal: false,
                waiting: false,
                formData: {
                    name: '',
                    title: '',
                    intro: '',
                },
                formErrors: {
                    name: '',
                    title: '',
                    intro: '',
                }
            };
        },

        methods: {
            submit() {
                this.waiting = true;
                this.formErrors = clearFormErrors(this.formErrors);
                axios.post("/admin/profiles", this.formData)
                .then(() => window.location = "/admin/profiles")
                .catch(({response}) => {
                    if(response.status === 422) {
                        return this.formErrors = showValidationErrors(this.formErrors, response.data.errors);
                    }
                    this.showFormModal = false;
                    window.eventHub.$emit('user-alert', {
                        title: 'Oh dear',
                        type: 'error',
                        text: 'Failed to create new user. Please refresh and try again',
                        confirm: true,
                    });
                })
                .then(() => this.waiting = false);
            }
        }
    }
</script>