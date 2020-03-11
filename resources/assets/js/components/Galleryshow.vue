<template>
    <div class="gallery-container flex flex-wrap">
        <p class="empty-gallery-note" v-show="images.length === 0">There are currently no images in this gallery</p>
        <div class="m-4 relative w-40 h-40"
             v-for="image in images"
        >
            <div @click="removeImage(image)" class="gallery-item-delete-btn absolute text-white font-bold bg-danger w-6 h-6 rounded-full flex justify-center items-center cursor-pointer" style="top: -0.5rem; right: -0.5rem;">&times;</div>
            <img :src="image.thumb_src" alt="gallery image"/>
        </div>
    </div>
</template>

<script type="text/babel">
    import {alertError} from "../utils/alerts";

    export default {

        props: ['geturl', 'gallery', 'delete-url'],

        data() {
            return {
                images: []
            }
        },

        mounted() {
            this.fetchImages();
            eventHub.$on('image-added', (image) => this.addImage(image));
        },

        methods: {

            fetchImages() {
                axios.get(this.geturl)
                        .then(({data}) => this.images = data)
                        .catch((err) => alertError('There was a problem fetching existing images.'));
            },

            addImage(image) {
                this.images.push(image);
            },

            removeImage(image) {
                axios.delete(this.deleteUrl + image.image_id)
                        .then(() => {
                            this.images.splice(this.images.indexOf(this.images.find(img => img.image_id === image.image_id)), 1)
                        })
                        .catch(() => alertError('Unable to delete image.'));
            }
        }
    }
</script>