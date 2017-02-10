<style></style>

<template>
    <div class="featured-images">
        <p v-show="postImages.length" class="lead">
            Click on a thumbnail image on the left to select a featured image from the article, or upload a new image below.
        </p>
        <p v-show="!postImages.length" class="lead">Upload an image to get started.</p>
        <div class="featured-image-selecter" :class="{'busy': syncing}">
            <div class="current-images">
                <div v-for="postImage in postImages"
                     class="post-image-box"
                     :class="{'featured': postImage.is_feature}"
                     v-on:click="postNewFeaturedImage(postImage)"
                >
                    <img :src="postImage.thumb" alt="">
                </div>
            </div>
            <div class="single-image-uploader-box">
                <p class="lead">The ideal dimensions for a featured image is 1400 &times; 560px, so try use an image of at least 1400px wide and if you do not want the image cropped the height should be 40% of the width.</p>
                <single-upload :url="'/admin/api/content/articles/' + postId + '/images/featured'"
                               default="/images/photo_default.jpg"
                               shape="square"
                               size="preview"
                               :preview-width="900"
                               :preview-height="360"
                               v-on:singleuploadcomplete="addUploadedFeaturedImage"
                               ref="uploader"
                ></single-upload>
            </div>
        </div>
        <div class="loader" v-show="syncing">
            <div class="spinner">
                <div class="bounce1"></div>
                <div class="bounce2"></div>
                <div class="bounce3"></div>
            </div>
        </div>
    </div>
</template>

<script type="text/babel">
    module.exports = {

        props: ['post-id'],

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
                this.$http.get('/admin/api/content/articles/' + this.postId + '/images/featured')
                        .then((res) => this.setFetchedImages(res))
                        .catch(() => console.log('failed'));
            },

            setFetchedImages(res) {
                this.syncing = false;
                this.postImages = res.body;
                this.setNewFeaturedImage(this.featuredImage);
            },

            postNewFeaturedImage(img) {
                this.syncing = true;
                this.$http.patch('/admin/api/content/articles/' + this.postId + '/images/featured', {image_id: img.id})
                        .then((res) => this.setNewFeaturedImage(img))
                        .catch(() => console.log('unable to save'));
            },

            addUploadedFeaturedImage(img) {
                this.clearPreviousFeaturedImages();
                this.postImages.push(img);
            },

            setNewFeaturedImage(image) {
                this.clearPreviousFeaturedImages();
                this.syncing = false;
                image.is_feature = true;
                this.$refs.uploader.setImage(image.url);
            },

            clearPreviousFeaturedImages() {
                this.postImages.forEach((image) => image.is_feature = false);
            }
        }

    }
</script>