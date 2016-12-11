<style></style>

<template>
    <div class="article-author-component clearfix">
        <p class="h6 text-uppercase">Author</p>
        <div class="profile-intro-card">
            <div class="profile-intro-card-avatar-box">
                <img :src="current_author.thumbnail" :alt="current_author.name">
            </div>
            <div class="profile-intro-card-text-box">
                <p class="profile-intro-card-name">{{ current_author.name }}</p>
                <p class="profile-intro-card-intro">{{ current_author.intro }}</p>
            </div>
        </div>
        <div class="component-actions pull-right" v-if="canUpdate">
            <button class="btn dd-btn btn-light" v-on:click="modalOpen = true">Re-attribute</button>
        </div>
        <modal :show="modalOpen" :wider="true">
            <div slot="header">
                <h3>Select the author of this article</h3>
            </div>
            <div slot="body">
                <div v-for="person in contributors"
                     v-on:click="selectAuthor(person)"
                     :class="{'selected': current_author && current_author.id === person.id }"
                     class="selectable-profile"
                >
                    <div class="profile-intro-card">
                        <div class="profile-intro-card-avatar-box">
                            <img :src="person.thumbnail" :alt="person.name">
                        </div>
                        <div class="profile-intro-card-text-box">
                            <p class="profile-intro-card-name">{{ person.name }}</p>
                            <p class="profile-intro-card-intro">{{ person.intro }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div slot="footer">
                <button class="btn dd-btn btn-grey"
                        v-on:click="cancelAction">
                    Cancel
                </button>
                <button class="btn dd-btn btn-dark" v-on:click="setAuthor">
                    <span v-show="!saving">Set as Author</span>
                    <div class="spinner" v-show="saving">
                        <div class="bounce1"></div>
                        <div class="bounce2"></div>
                        <div class="bounce3"></div>
                    </div>
                </button>
            </div>
        </modal>
    </div>
</template>

<script type="text/babel">
    module.exports = {

        props: ['initial-thumbnail', 'initial-name', 'initial-intro', 'can-update', 'article-id'],

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
                this.$http.get('/admin/api/profiles')
                        .then((res) => this.contributors = res.body)
                        .catch((err) => this.alertError('Unable to get list of possible authors. If you need to set the author, please refresh and try again.'));
            },

            setAuthor() {
                this.saving = true;
                this.$http.post('/admin/content/articles/' + this.articleId + '/author/' + this.current_author.id)
                        .then((res) => this.onSuccess(res))
                        .catch((err) => this.onFailure(err));
            },

            onSuccess(res) {
                const person = this.contributors.find((con) => con.id === res.body.id);
                this.last_known_selected = person;
                this.saving = false;
                this.modalOpen = false;
            },

            onFailure(err) {
                this.saving = false;
                this.modalOpen = false;
                this.alertError('Failed to save the articles author. Please refresh and try again.');
            },

            selectAuthor(person) {
                this.current_author = person;
            },

            cancelAction() {
                this.modalOpen = false;
                if(this.last_known_selected) {
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