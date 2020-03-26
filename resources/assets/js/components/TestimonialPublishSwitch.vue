<template>
    <span class="inline-flex items-center">
        <span class="mr-4">{{ state ? 'Public' : 'Private' }}</span>
        <simple-toggle @click="toggle" :state="toggle_state" :disabled="waiting"></simple-toggle>
    </span>
</template>

<script type="text/babel">
    import SimpleToggle from "./SimpleToggle";

    export default {

        components: {
            SimpleToggle,
        },

        props: ['testimonial-id', 'public'],

        data() {
            return {
                waiting: false,
                state: this.public,
            }
        },

        computed: {
          toggle_state() {
              if(this.state && (!this.waiting)) {
                  return 'on';
              }

              if((!this.state) && (!this.waiting)) {
                  return 'off';
              }

              return 'undecided';
          }
        },

        methods: {

            toggle() {
                this.waiting = true;
                if(this.state) {
                    return this.retract();
                }

                this.publish();
            },

            retract() {
                axios.delete(`/admin/published-testimonials/${this.testimonialId}`)
                .then(() => this.state = false)
                .then(() => this.waiting = false);
            },

            publish() {
                axios.post("/admin/published-testimonials", {testimonial_id: this.testimonialId})
                .then(() => this.state = true)
                 .then(() => this.waiting = false);
            }
        }
    }
</script>