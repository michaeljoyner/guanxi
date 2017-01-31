<style>

</style>

<template>
    <div class="dd-lightbox" :class="{'open': open}">
        <div class="close-lightbox-btn" @click="open = false">&times;</div>
        <div class="lightbox-content">
            <p class="light-heading white-text lightbox-title" v-show="open">{{ title }}</p>
            <img :src="mainSrc" alt="" @click="open = true" v-show="!open">
            <div class="main-lightbox-gallery" v-show="open">
                <transition v-for="(image, index) in galleryImages" name="slide-fade">
                    <img :src="image.src" :alt="title + ' image'" v-show="current_pos == index">
                </transition>

            </div>
            <div class="lightbox-nav-arrow dd-prev-arrow" @click="showPrev" v-show="open && (galleryImages.length > 1)">&larr;</div>
            <div class="dd-next-arrow lightbox-nav-arrow" @click="showNext" v-show="open && (galleryImages.length > 1)">&rarr;</div>
        </div>
    </div>
</template>

<script type="text/babel">
    export default {
        props: ['title', 'main-src', 'gallery-images'],

        data() {
            return {
                open: false,
                current_pos: 0
            }
        },

        mounted() {
            eventHub.$on('escaped', () => this.open = false);
            eventHub.$on('keyed:left', () => this.showPrev());
            eventHub.$on('keyed:right', () => this.showNext());
        },

        methods: {

            showPrev() {
                if (this.current_pos > 0) {
                    return this.current_pos--;
                }

                return this.current_pos = this.galleryImages.length - 1;
            },

            showNext() {
                if (this.current_pos < this.galleryImages.length - 1) {
                    return this.current_pos++;
                }

                return this.current_pos = 0;
            }
        }
    }
</script>