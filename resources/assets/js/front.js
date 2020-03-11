
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./frontbootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */
import Modal from "@dymantic/modal";
import Lightbox from "./components/Lightbox";
import Contactform from "./components/Contactform";
import Contentloader from "./components/Contentloader";
import StaticMedialist from "./components/StaticMedialist";

Vue.component('modal', Modal);
Vue.component('dd-lightbox', Lightbox);
Vue.component('contact-form', Contactform);
Vue.component('content-loader', Contentloader);
Vue.component('media-list', StaticMedialist);



window.eventHub = new Vue();

if(document.body.classList.contains('scripted')) {
    const app = new Vue({
        el: '#app',

        data: {
            keycodes: {
                27: 'escaped',
                37: 'keyed:left',
                39: 'keyed:right'
            }
        },

        created() {
            eventHub.$on('user-alert', this.showAlert);
            document.addEventListener('keydown', ev => this.emitKeyedEvent(ev.keyCode));
        },

        methods: {
            showAlert(message) {
                console.log(message);
                swal({
                    type: message.type,
                    title: message.title,
                    text: message.text,
                    showConfirmButton: message.confirm
                });
            },

            emitKeyedEvent(keyCode) {
                if(this.keycodes.hasOwnProperty(keyCode)) {
                    return eventHub.$emit(this.keycodes[keyCode]);
                }
            }
        }
    });
}


import menuAssist from './components/Menuassistant.js';

window.menuAssist = menuAssist;
window.menuAssist.init();