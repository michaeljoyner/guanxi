<template>
    <span>
        <button class="dd-btn btn-primary" @click="showForm = true">{{ button_text }}</button>
        <modal :show="showForm" @close="showForm = false">
            <div class="p-4 max-w-md w-screen">
                <p class="text-xl text-brand-purple">{{ modal_title }}</p>
                <form @submit.prevent="submit">
                    <div class="my-4" :class="{'border-b border-red-400': formErrors.name}">
                        <label class="form-label" for="name">English Name</label>
                        <span class="text-xs text-red-400" v-show="formErrors.name">{{ formErrors.name }}</span>
                        <input type="text" name="name" v-model="formData.name" class="input-text" id="en_name">
                    </div>
                    <div class="my-4" :class="{'border-b border-red-400': formErrors.email}">
                        <label class="form-label" for="email">Email</label>
                        <span class="text-xs text-red-400" v-show="formErrors.email">{{ formErrors.email }}</span>
                        <input type="email" name="email" v-model="formData.email" class="input-text" id="email">
                    </div>
                    <div class="my-6">
                        <p>User role:</p>
                        <div>
                            <input id="super_admin" type="radio" v-model="formData.role_id" :value="roles.superadmin">
                            <label for="super_admin">Super Admin</label>
                        </div>
                        <div>
                            <input id="contributor" type="radio" v-model="formData.role_id" :value="roles.contributor">
                            <label for="contributor">Contributor</label>
                        </div>
                    </div>
                    <div class="my-4" :class="{'border-b border-red-400': formErrors.password}">
                        <label class="form-label" for="password">Password</label>
                        <span class="text-xs text-red-400" v-show="formErrors.password">{{ formErrors.password }}</span>
                        <input type="text" name="password" v-model="formData.password" class="input-text" id="password">
                    </div>
                    <div class="my-4" :class="{'border-b border-red-400': formErrors.password_confirmation}">
                        <label class="form-label" for="password_confirmation">Confirm Password</label>
                        <span class="text-xs text-red-400" v-show="formErrors.password_confirmation">{{ formErrors.password_confirmation }}</span>
                        <input type="text" name="password_confirmation" v-model="formData.password_confirmation" class="input-text" id="password_confirmation">
                    </div>
                    <div class="flex justify-end">
                        <button type="button" @click="showForm = false" class="dd-btn btn-grey">Cancel</button>
                        <button type="submit" class="dd-btn ml-4" :disabled="waiting">Submit</button>
                    </div>
                </form>

            </div>
        </modal>
    </span>
</template>

<script type="text/babel">
    import {showValidationErrors, clearFormErrors} from "../../utils/forms";

    export default {
        props: ['roles', 'profile-name', 'profile-id'],
        data() {
            return {
                showForm: false,
                waiting: false,
                formData: {
                    name: this.profileName || '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                    role_id: this.roles.contributor,
                },
                formErrors: {
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                    role_id: '',
                }
            };
        },

        computed: {
            postUrl() {
                if(this.profileId) {
                    return `/admin/profiles/${this.profileId}/user`;
                }
                return '/admin/users';
            },

            modal_title() {
                if(this.profileId) {
                    return `Create a login account for ${this.profileName}`;
                }

                return 'Register a new user';
            },

            button_text() {
                if(this.profileId) {
                    return 'Add as user';
                }

                return 'New User';
            }
        },

        methods: {
            submit() {
                this.waiting = true;
                this.formErrors = clearFormErrors(this.formErrors);
                axios.post(this.postUrl, this.formData)
                .then(() => window.location = '/admin/users')
                .catch(({response}) => {
                    if(response.status === 422) {
                        return this.formErrors = showValidationErrors(this.formErrors, response.data.errors);
                    }
                    this.showForm = false;
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