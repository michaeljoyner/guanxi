<style></style>

<template>
    <span class="publish-button-box">
        <button class="btn dd-btn btn-dark" v-on:click="handleClick">
            <span v-show="!syncing">{{ buttonText }}</span>
            <div class="spinner" v-show="syncing">
                <div class="bounce1"></div>
                <div class="bounce2"></div>
                <div class="bounce3"></div>
            </div>
        </button>
        <modal :show="showModal">
            <div slot="header">
                <h3>Ready to publish</h3>
            </div>
            <div slot="body">
                <p class="lead">You are about to publish this article for the first time. This is probably a good time to check the following:</p>
                <ul class="list-group">
                    <li>You have added a decent featured image.</li>
                    <li>The article is complete for both Chinese and English versions.</li>
                    <li>The article has a decent description for SEO, etc.</li>
                </ul>
            </div>
            <div slot="footer">
                <button class="btn dd-btn btn-grey"
                        @click="showModal = false">
                    Cancel
                </button>
                <button class="btn dd-btn btn-dark" @click="pushState">
                    Publish
                </button>
            </div>
        </modal>
    </span>
</template>

<script type="text/babel">
    module.exports = {

        props: ['url', 'published', 'virgin'],

        data() {
            return {
                showModal: false,
                syncing: false,
                is_virgin: null,
                is_published: null
            }
        },

        computed: {
            buttonText() {
                if(this.never_published) {
                    return this.currently_published ? 'Retract' : 'Publish';
                }

                return this.currently_published ? 'Retract' : 'Re-publish';
            },

            never_published() {
                if(this.is_virgin === null) {
                    return this.virgin;
                }

                return this.is_virgin;
            },

            currently_published() {
                if(this.is_published === null) {
                    return this.published;
                }

                return this.is_published;
            }
        },

        methods: {
            handleClick() {
                if(this.virgin && this.is_virgin === null) {
                    return this.showModal = true;
                }

                this.pushState();
            },

            pushState() {
                this.showModal = false;
                this.syncing = true;
                axios.post(this.url, {publish: !this.currently_published})
                        .then(({data}) => this.onSuccess(data))
                        .catch(this.onFail);
                this.is_virgin = false;
            },

            onSuccess(data) {
                this.is_published = data.new_state;
                this.syncing = false;
            },

            onFail() {
                eventHub.$emit('user-alert', {
                    type: 'error',
                    title: 'Sorry, there was a problem',
                    text: 'Unable to save new published state. Please refresh and try again. Thanks.'
                });
                this.syncing = false;
            }
        }
    }
</script>