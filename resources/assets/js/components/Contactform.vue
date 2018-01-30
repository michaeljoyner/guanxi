<style></style>

<script type="text/babel">
    module.exports = {


        data() {
            return {
                name: '',
                email: '',
                enquiry: '',
                spent: false,
                sending: false,
            }
        },

        methods: {

            submitForm() {
                this.sending = true;
                axios.post('/contact', this.messageObject())
                        .then(this.onSuccess)
                        .catch(err => this.onFail(err));
            },

            onSuccess() {
                this.sending = false;
                this.spent = true;
            },

            onFail() {
                this.sending = false;
                eventHub.$emit('user-alert', {
                    type: 'error',
                    title: 'Oh dear, sorry ' + this.name,
                    text: 'There was a problem getting your message through. Please try again, or contact us using our details on this page.',
                    confirm: true
                });
            },

            messageObject() {
                return {
                    name: this.name,
                    email: this.email,
                    enquiry: this.enquiry
                }
            },

            resetForm() {
                this.name = '';
                this.email = '';
                this.enquiry = '';
                this.spent = false;
            }
        }
    }
</script>