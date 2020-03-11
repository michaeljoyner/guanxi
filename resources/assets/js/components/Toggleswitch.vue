<template>
    <div class="flex items-center justify-center mx-auto">
        <p class="mr-3" :class="{'chosen': currentStatus}">{{ trueLabel }}</p>
        <label class="w-10 h-2 bg-brand-super-soft-purple relative rounded" :for="'toggle-switch-' + identifier">
            <input type="checkbox" :id="'toggle-switch-' + identifier" @change="toggleState"
                   v-model="currentStatus" class="hidden">
            <div class="switch-bulb w-4 h-4 rounded-full absolute" :class="bulbClasses"></div>
        </label>
        <p class="ml-3" :class="{'chosen': ! currentStatus}">{{ falseLabel }}</p>
    </div>
</template>

<script type="text/babel">
    export default {
        props: ['identifier', 'true-label', 'false-label', 'initial-state', 'toggle-url', 'toggle-attribute'],

        data() {
            return {
                currentStatus: null
            }
        },

        mounted() {
            this.currentStatus = this.initialState;
        },

        computed: {
            currentLabel() {
                return this.currentStatus ? this.trueLabel : this.falseLabel;
            },

            bulbClasses() {
                if(this.currentStatus) {
                    return 'bg-brand-purple on';
                }

                return 'bg-gray-600 off';
            }
        },

        methods: {
            toggleState: function () {
                let initialState = !this.currentStatus;
                axios.post(this.toggleUrl, this.makePayloadFor(this.currentStatus))
                        .then(({data}) => this.onSuccess(data))
                        .catch(() => this.currentStatus = initialState);
            },

            onSuccess(data) {
                this.currentStatus = data.new_state;
                this.$emit('changed-toggle-state', this.currentStatus);
            },

            makePayloadFor(attributeState) {
                let body = {};
                body[this.toggleAttribute] = attributeState;
                return body;
            }
        }
    }
</script>

<style scoped>
    .switch-bulb {
        top: -.25rem;
        left: 0;
        transition: .3s;
    }

    .switch-bulb.on {
        transform: translate3d(0,0,0);
    }

    .switch-bulb.off {
        transform: translate3d(1.5rem,0,0);
    }
</style>