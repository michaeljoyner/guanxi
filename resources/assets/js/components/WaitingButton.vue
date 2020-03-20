<template>
    <button class="btn" :disabled="waiting">
        <span v-show="!waiting">{{ text }}</span>
        <div class="spinner flex justify-center" v-show="waiting">
            <div class="w-3 h-3 bg-black rounded-full m-2"></div>
            <div class="w-3 h-3 bg-black rounded-full m-2"></div>
            <div class="w-3 h-3 bg-black rounded-full m-2"></div>
        </div>
    </button>
</template>

<script type="text/babel">
    export default {
        props: ['waiting', 'text']
    }
</script>

<style scoped>
    .spinner > div {
        animation-name: fadeInOut;
        animation-direction: alternate;
        animation-iteration-count: infinite;
        animation-timing-function: ease-in-out;
        animation-duration: 1s;
        animation-fill-mode: forwards;
    }

    .spinner > div:nth-child(1) {
        animation-delay: .2s;
    }

    .spinner > div:nth-child(2) {
        animation-delay: .4s;
    }

    .spinner > div:nth-child(3) {
        animation-delay: .6s;
    }

    @keyframes fadeInOut {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }
</style>