<template>
    <div class="bg-eggshell p-4">
        <p class="text-sm text-brand-purple uppercase mb-2">Contributor</p>
        <div class="flex">
            <img :src="current_author.thumbnail" :alt="current_author.name" class="w-40 h-40 rounded-full">
            <div class="pl-8">
                <p class="profile-intro-card-name">{{ current_author.name }}</p>
                <p class="profile-intro-card-intro">{{ current_author.intro }}</p>
            </div>
        </div>
        <div class="flex justify-end" v-if="canUpdate">
            <button class="btn dd-btn btn-light" @click="modalOpen = true">Re-attribute</button>
        </div>
        <modal :show="modalOpen" @close="modalOpen = false">
            <div class="w-screen max-w-3xl p-4 bg-white">
                <h3 class="text-xl mb-8">Who contributed this content?</h3>
                <div class="overflow-y-auto flex justify-between flex-wrap" style="max-height: 70vh;">
                    <div v-for="person in contributors"
                         v-on:click="selectAuthor(person)"
                         :class="{'bg-brand-super-soft-purple': current_author && current_author.id === person.id }"
                         class="w-2/5 mb-3 cursor-pointer p-2"
                    >
                        <div class="flex items-center">
                            <img :src="person.thumbnail" :alt="person.name" class="w-16 h-16 rounded-full">
                            <p class="pl-8">{{ person.name }}</p>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end mt-6">
                    <button class="btn dd-btn btn-grey" @click="cancelAction">
                        Cancel
                    </button>
                    <button :disabled="saving" class="ml-4 btn dd-btn btn-dark" @click="setAuthor">
                        Set Contributor
                    </button>
                </div>
            </div>

        </modal>
    </div>
</template>

<script type="text/babel">
    export default {

        props: ['initial-thumbnail', 'initial-name', 'initial-intro', 'can-update', 'article-id', 'url-base'],

        data() {
            return {
                current_author: {},
                contributors: [],
                currently_selected: null,
                last_known_selected: null,
                modalOpen: false,
                saving: false
            };
        },

        mounted() {
            this.setCurrentAuthorFromProps();
            this.fetchContributors();
        },

        methods: {

            fetchContributors() {
                axios.get('/admin/api/profiles')
                        .then(({data}) => this.contributors = data)
                        .catch((err) => this.alertError('Unable to get list of possible authors. If you need to set the author, please refresh and try again.'));
            },

            setAuthor() {
                this.saving = true;
                axios.post(this.urlBase + this.current_author.id)
                        .then(({data}) => this.onSuccess(data))
                        .catch((err) => this.onFailure(err));
            },

            onSuccess(data) {
                this.last_known_selected = this.contributors.find((con) => con.id === data.id);
                this.saving = false;
                this.modalOpen = false;
            },

            onFailure(err) {
                this.saving = false;
                this.modalOpen = false;
                this.alertError('Failed to set the contributor of this content. Please refresh and try again.');
            },

            selectAuthor(person) {
                this.current_author = person;
            },

            cancelAction() {
                this.modalOpen = false;
                if (this.last_known_selected) {
                    return this.current_author = this.last_known_selected;
                }

                this.setCurrentAuthorFromProps();
            },

            setCurrentAuthorFromProps() {
                this.current_author = {
                    name: this.initialName,
                    intro: this.initialIntro,
                    thumbnail: this.initialThumbnail
                };
            },

            alertError(message) {
                eventHub.$emit('user-alert', {
                    type: 'error',
                    title: 'Oh dear! An error!',
                    text: message,
                    confirm: true
                });
            }
        }
    }
</script>