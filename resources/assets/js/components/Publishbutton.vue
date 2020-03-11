<template>
    <div class="p-4 shadow flex justify-between items-center">
        <div>
            <p class="text-brand-purple uppercase text-sm">Publish status</p>
            <p class="mt-4">{{ publish_status }}</p>
        </div>
        <span class="">
        <button class="dd-btn" v-on:click="handleClick">
            <span :disable="syncing" v-show="!syncing">{{ buttonText }}</span>
        </button>
        <modal :show="showModal" @close="showModal = false">
            <div class="w-screen max-w-md p-4">
                <h3 class="text-lg text-brand-purple">Ready to publish?</h3>
                <p class="my-6">You are about to publish this article for the first time. This is probably a good time to check the following:</p>
                <ul class="list-disc pl-8">
                    <li>You have added a decent featured image.</li>
                    <li>The article is complete for both Chinese and English versions.</li>
                    <li>The article has a decent description for SEO, etc.</li>
                </ul>
                <div class="flex justify-end mt-6">
                    <button class="btn dd-btn btn-grey"
                            @click="showModal = false">
                        Cancel
                    </button>
                    <button class="btn dd-btn ml-4" @click="pushState">
                        Publish
                    </button>
                </div>
            </div>
        </modal>
    </span>
    </div>

</template>

<script type="text/babel">
    export default {

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
                if (this.never_published) {
                    return this.currently_published ? 'Retract' : 'Publish';
                }

                return this.currently_published ? 'Retract' : 'Re-publish';
            },

            never_published() {
                if (this.is_virgin === null) {
                    return this.virgin;
                }

                return this.is_virgin;
            },

            currently_published() {
                if (this.is_published === null) {
                    return this.published;
                }

                return this.is_published;
            },

            publish_status() {
                if(this.currently_published) {
                    return 'This article is currently published and can be read by the general public.';
                }

                if(this.never_published) {
                    return 'This article has never been published and cannot yet be read by the general public.';
                }

                return 'This article is currently retracted, and is not available for the general public.'
            }
        },

        methods: {
            handleClick() {
                if (this.virgin && this.is_virgin === null) {
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