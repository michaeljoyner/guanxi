<template>
    <button type="button" @click="$emit('click')" class="focus:outline-none" :disabled="disabled">
        <span class="inline-block w-8 h-2 bg-gray-300 rounded relative">
            <span class="inline-block bulb w-4 h-4 rounded-full absolute" :class="bulb_class"></span>
        </span>
    </button>
</template>

<script type="text/babel">
    export default {
        props: ['state', 'disabled'],

        computed: {
            bulb_class() {
                if(this.state === 'on') {
                    return 'on bg-brand-purple';
                }

                if(this.state === 'off') {
                    return 'off bg-gray-400';
                }

                return 'undecided bg-gray-200';
            }
        }
    }
</script>

<style scoped>
    .bulb {
        top: -.25rem;
        left: -.25rem;
        transition: transform .3s ease-in-out;
    }

    .bulb.on {
        transform: translate3d(0,0,0);
    }

    .bulb.undecided {
        transform: translate3d(0.75rem,0,0);
    }

    .bulb.off {
        transform: translate3d(1.75rem,0,0);
    }
</style>