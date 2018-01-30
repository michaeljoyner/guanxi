<style></style>

<template>
    <div class="card-grid loaded-content">
        <div class="media-image-card four-piece" v-for="album in albums">
            <dd-lightbox :open="false"
                         :title="album.title"
                         :main-src="album.thumbnail"
                         :gallery-images="album.gallery"
            ></dd-lightbox>
            <p class="media-image-card-title heavy-heading">{{ album.title }}</p>
            <p class="media-image-card-contributor purple-text light-heading">
                <a :href="album.contributor.link">{{ album.contributor.name }}</a>
            </p>
        </div>
        <button @click="fetchAlbums" v-show="remaining" class="dd-btn block" :class="{'alt-state': fetching}">
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
    export default {

        props: ['lang-code', 'url', 'button-text', 'has-more'],

        data() {
            return {
                albums: [],
                remaining: true,
                fetching: false,
                nextPage: 2
            };
        },

        mounted() {
            this.remaining = !! this.hasMore;
        },

        methods: {
            fetchAlbums() {
                axios.get('/' + this.langCode + this.url + this.nextPage)
                        .then(({data}) => this.onSuccess(data))
                        .catch(err => this.onFailure(err));
            },

            onSuccess(data) {
                this.fetching = false;
                data.albums.forEach(album => this.albums.push(album));
                this.remaining = data.remaining;
                this.nextPage++;
            },

            onFailure(err) {
                this.fetching = false;
                console.log(err);
            }
        }
    }
</script>