<template>
    <div class="" :class="{'open': open}">

        <img :src="mainSrc" alt="" @click="open = true" v-show="!open">
        <div class="fixed top-16 bottom-0 left-0 right-0 bg-black" ref="box" :class="{'hidden': !open}">
            <p class="my-12 md:my-6 text-white type-h4 text-center" v-show="open">{{ title }}</p>

            <div class="flex items-center">
                <div class="flex-1 hidden  md:flex justify-center items-center text-white text-3xl cursor-pointer hover:text-brand-purple" @click="showPrev" v-show="open && (galleryImages.length > 1)">&larr;</div>

                <div class="w-full md:w-4/5 max-w-full flex justify-center items-center" style="max-height: 70vh" v-show="open">
                    <transition v-for="(image, index) in galleryImages" :key="`image_${index}`" name="slide-fade">
                        <img class="max-h-75vh" :src="image.src" :alt="title + ' image'" v-show="current_pos == index">
                    </transition>
                </div>

                <div class="flex-1 hidden  md:flex justify-center items-center text-white text-3xl cursor-pointer hover:text-brand-purple" @click="showNext" v-show="open && (galleryImages.length > 1)">&rarr;</div>
            </div>

            <div class="absolute bottom-0 w-full text-center left-0 md:hidden">
                <svg id="Layer_1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 83.52 85.46" class="fill-current h-6 block mx-auto text-white my-4">
                    <path
                        d="M2243.12,4895.37v-16.11a6.45,6.45,0,0,0-6.23-6.47h-0.18a8.22,8.22,0,0,0-2.18.29,7.59,7.59,0,0,0-7.34-7H2227a9.32,9.32,0,0,0-4.8,1.26,8,8,0,0,0-6.56-3.69h-0.19a10.25,10.25,0,0,0-4.08.81v-15.08c0.05-.85.17-4.83-2.24-7.45a7.41,7.41,0,0,0-10.51,0c-2.41,2.62-2.3,6.6-2.24,7.45V4873a12.19,12.19,0,0,0-9.2,6.84c-4.45,8.65-1.55,21.13,2.78,29.3,3.89,7.32,11.93,16.06,28.19,16.06,6.66,0,12.17-2.16,16.4-6.4C2243.11,4910.13,2243.12,4896,2243.12,4895.37Zm-5,0c0,0.13,0,12.67-7.13,19.85-3.25,3.27-7.57,4.93-12.85,4.93-8.34,0-15-2.58-19.74-7.68a30.48,30.48,0,0,1-6.83-12.84,42.07,42.07,0,0,1-1.14-5.67c-0.6-4.56-.82-10.06,2.44-13.76a6.8,6.8,0,0,1,2.56-1.83,0.68,0.68,0,0,1,.94.63v10.69a2.6,2.6,0,0,0,2.24,2.63,2.5,2.5,0,0,0,2.76-2.49v-40.58c0-.07,0-0.14,0-0.21-0.07-.79.08-2.84,0.93-3.77a2.47,2.47,0,0,1,3.14,0c0.92,1,1,3.12.94,3.78,0,0.07,0,.14,0,0.21v28.83a2.6,2.6,0,0,0,2.24,2.63,2.5,2.5,0,0,0,2.76-2.49v-6.64a2.45,2.45,0,0,1,.84-1.88,4.87,4.87,0,0,1,3.24-1.09h0.11a3.06,3.06,0,0,1,2.94,3.09v5a2.6,2.6,0,0,0,2.24,2.63,2.5,2.5,0,0,0,2.76-2.49v-3.26a2,2,0,0,1,.72-1.56,4.42,4.42,0,0,1,2.87-.94,2.59,2.59,0,0,1,2.47,2.64V4878s0,0,0,.05v3.44a2.6,2.6,0,0,0,2.24,2.63,2.5,2.5,0,0,0,2.76-2.49v-2.28a1.42,1.42,0,0,1,.7-1.25,3.06,3.06,0,0,1,1.52-.36,1.43,1.43,0,0,1,1.34,1.48v16.13Z"
                        transform="translate(-2161.79 -4839.71)"/>
                    <path
                        d="M2218.17,4845.49h0a71.2,71.2,0,0,1,17.88,2.13l-0.58,1.78a0.63,0.63,0,0,0,.74.82l8.58-1.83a0.63,0.63,0,0,0,.34-1l-5.87-6.51a0.63,0.63,0,0,0-1.08.23l-0.58,1.8a75.81,75.81,0,0,0-19.48-2.37,2.52,2.52,0,0,0-2.26,3.55A2.45,2.45,0,0,0,2218.17,4845.49Z"
                        transform="translate(-2161.79 -4839.71)"/>
                    <path
                        d="M2188.88,4845.49h0a2.45,2.45,0,0,0,2.28-1.45,2.52,2.52,0,0,0-2.26-3.55,76.07,76.07,0,0,0-19.48,2.37l-0.57-1.75a0.67,0.67,0,0,0-1.14-.24l-5.79,6.42a0.67,0.67,0,0,0,.36,1.11l8.45,1.8a0.67,0.67,0,0,0,.78-0.86l-0.56-1.72A70.8,70.8,0,0,1,2188.88,4845.49Z"
                        transform="translate(-2161.79 -4839.71)"/>
                </svg>
            </div>
        </div>
        <p class="hover-action-indicator" @click="open = true">View</p>
        <div class="text-white hover:text-brand-purple cursor-pointer type-h1 fixed leading-5 m-4 md:m-8 top-16 right-0" :class="{'hidden': !open}" @click="open = false">&times;</div>
    </div>
</template>

<script type="text/babel">
    import Hammer from "hammerjs";
    export default {
        props: ['title', 'main-src', 'gallery-images'],

        data() {
            return {
                open: false,
                current_pos: 0
            }
        },

        mounted() {
            document.addEventListener('keydown', this.handleKeys);
            this.handleTouch();
        },

        destroyed() {
            document.removeEventListener('keydown', this.handleKeys)
        },


        methods: {

            handleKeys({key}) {
                switch (key) {
                    case "ArrowLeft":
                        return this.showPrev();
                    case "ArrowRight":
                        return this.showNext();
                    case "Escape":
                        return this.open = false;
                    default:
                        return;
                }
            },

            handleTouch() {
                const hammer = new Hammer(this.$refs.box);
                hammer.get('swipe').set({direction: Hammer.DIRECTION_HORIZONTAL});
                hammer.on('swipe', ({direction}) => {
                    if(direction === Hammer.DIRECTION_LEFT) {
                        return this.showPrev();
                    }
                    this.showNext();
                });
            },

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