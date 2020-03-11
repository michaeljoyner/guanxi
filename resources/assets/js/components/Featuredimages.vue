<template>
    <div class="">
        <div class="flex justify-between">
            <div class="w-80 h-48 bg-gray-100">
                <img :src="featuredImage.url" alt="" class="w-full h-full object-cover">
            </div>
            <div class="pl-8 flex-1">
                <p class="text-5xl">{{ articleTitle}}</p>
                <p v-if="postImages.length" class="my-6">To change the featured image, click on a thumbnail image below, or upload a new image below at the bottom of this page.</p>
                <p v-else class="my-6">Upload an image below to set the title image.</p>
            </div>
        </div>

        <div class="p-4 shadow my-12" :class="{'opacity-50': syncing}">
            <p class="text-sm text-brand-purple uppercase mb-6">Select an existing image from this article</p>
            <div class="flex flex-wrap">
                <div v-for="postImage in postImages"
                     class="w-40 h-32 m-2"
                     :class="{'border-2 border-brand-purple': postImage.is_feature}"
                     v-on:click="postNewFeaturedImage(postImage)"
                >
                    <img :src="postImage.thumb" alt="" class="h-full w-full object-cover">
                </div>
            </div>


        </div>
        <div class="p-4 my-12 shadow">
            <p class="text-sm text-brand-purple uppercase mb-6">Upload an image</p>
            <div class="flex justify-between">
                <p class="px-6 w-1/3">The ideal dimensions for a featured image is 1400 &times; 560px, so try use an image of at least 1400px wide and if you do not want the image cropped the height should be 40% of the width.</p>
                <div class="single-image-uploader-box w-1/2 px-6">
                    <single-upload :url="'/admin/api/content/articles/' + postId + '/images/featured'"
                                   default="/images/defaults/default_1400x560.jpg"
                                   shape="square"
                                   size="preview"
                                   :preview-width="900"
                                   :preview-height="360"
                                   @singleuploadcomplete="addUploadedFeaturedImage"
                                   ref="uploader"
                    />
                </div>
            </div>
        </div>

    </div>
</template>

<script type="text/babel">
    import {alertError} from "../utils/alerts";

    export default {

        props: ['post-id', 'article-title'],

        data() {
            return {
                syncing: false,
                postImages: []
            }
        },

        computed: {
            featuredImage() {
                let featured = this.postImages.find((image) => image.is_feature);

                return featured ? featured : '';
            }
        },

        mounted() {
            this.syncing = true;
            this.fetchImages();
        },

        methods: {

            fetchImages() {
                axios.get('/admin/api/content/articles/' + this.postId + '/images/featured')
                        .then(({data}) => this.setFetchedImages(data))
                        .catch(() => alertError('Failed to fetch article images.'));
            },

            setFetchedImages(data) {
                this.syncing = false;
                this.postImages = data;
                this.setNewFeaturedImage(this.featuredImage);
            },

            postNewFeaturedImage(img) {
                this.syncing = true;
                axios.patch(`/admin/api/content/articles/${this.postId}/images/featured`, {image_id: img.id})
                        .then(() => this.setNewFeaturedImage(img))
                        .catch(() => alertError('Unable to save title image'));
            },

            addUploadedFeaturedImage(img) {
                this.clearPreviousFeaturedImages();
                this.postImages.push(img);
            },

            setNewFeaturedImage(image) {
                this.clearPreviousFeaturedImages();
                this.syncing = false;
                image.is_feature = true;
            },

            clearPreviousFeaturedImages() {
                this.postImages.forEach((image) => image.is_feature = false);
            }
        }

    }
</script>