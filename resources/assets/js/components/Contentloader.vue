<style></style>

<template>
    <div class="loaded-content">
        <button @click="fetchContent" v-show="remaining" class="dd-btn block">
            <span v-show="!fetching">{{ buttonText }}</span>
            <div class="spinner" v-show="fetching">
                <div class="bounce1"></div>
                <div class="bounce2"></div>
                <div class="bounce3"></div>
            </div>
        </button>
    </div>
</template>

<script type="text/babel">
    export default  {

        props: ['url', 'page-size', 'has-more', 'container-id', 'button-text'],

        data() {
            return {
                remaining: null,
                nextPage: 2,
                fetching: false
            }
        },

        mounted() {
            this.remaining = this.hasMore;
        },

        methods: {

            fetchContent() {
                this.fetching = true;
                this.$http.get(this.url + '?page=' + this.nextPage)
                        .then(res => this.onSuccess(res))
                        .catch(err => this.onFailure(err));
            },

            onSuccess(res) {
                this.fetching = false;
                this.remaining = res.data.remaining;
                this.nextPage++;
                this.addContent(res.data.content_html);
            },

            onFailure(err) {
                this.fetching = false;
                console.log(err);
            },

            addContent(content) {
                document.querySelector('#' + this.containerId).innerHTML += content;
            }
        }
    }
</script>