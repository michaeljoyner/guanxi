<style>

</style>

<template>
    <div class="form-group char-counting-input" :class="{'has-error': hasError}">
        <label :for="fieldName">{{ label }}: </label>
        <span v-if="errorMessage" class="error-message">{{ errorMessage }}</span>
        <textarea :name="fieldName" class="form-control" v-model="field_value"></textarea>
        <div class="usage-notification-bar">
            <p>
                <strong>Character Usage: </strong>
                {{ used_chars }} of {{ char_limit }}.
                {{ usageNote }}
            </p>
        </div>
        <span class="char-count-bar-outer">
            <span class="char-count-bar-inner"
                  :class="{'lacking': tooShort, 'sweetspot': justRight, 'overkill': tooLong}"
                  :style="{ width: usedWidth }"
            ></span>
        </span>
    </div>
</template>

<script type="text/babel">
    export default {
        props: ['has-error', 'label', 'error-message', 'initial-value', 'char_limit', 'field-name'],

        data() {
            return {
                used_chars: 0,
                field_value: ''
            }
        },

        computed: {

            usedWidth() {
                return ((this.used_chars / this.char_limit) * 100) + '%';
            },

            tooShort() {
                return (this.used_chars / this.char_limit) < 0.7;
            },

            justRight() {
                return ((this.used_chars / this.char_limit) >= 0.7) && (this.used_chars < this.char_limit);
            },

            tooLong() {
                return this.used_chars > this.char_limit;
            },

            usageNote() {
                if(this.tooShort) {
                    return 'Too short';
                }

                if(this.justRight) {
                    return 'Just right';
                }

                if(this.tooLong) {
                    return 'Too long!';
                }
            }
        },

        watch: {
            field_value(curr_value) {
                this.used_chars = curr_value.length;
            }
        },

        mounted() {
            this.field_value = this.initialValue;
        }
    }
</script>