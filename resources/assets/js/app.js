require('./bootstrap');

import sweetalert from "sweetalert";
import lodash from "lodash";
import Vue from "Vue"
window.swal = sweetalert;
window._ = lodash;

window.Vue = Vue;

import {Dropdown} from "@dymantic/vuetilities";
import Modal from "@dymantic/modal";
import DeleteModal from "./components/ModalForms/DeleteModal";
import Editor from "./components/Editor";
import Singleupload from "./components/Singleupload";
import Categorychooser from "./components/Categorychooser";
import Publishbutton from "./components/Publishbutton";
import ContributorSelector from "./components/ContributorSelector";
import Toggleswitch from "./components/Toggleswitch";
import Tagger from "./components/Tagger";
import Tagmanager from "./components/Tagmanager";
import Dropzone from "./components/Dropzone";
import Galleryshow from "./components/Galleryshow";
import Featuredimages from "./components/Featuredimages";
import Countingtextinput from "./components/Countingtextinput";
import Featuredselector from "./components/Featuredselector";
import NewUser from "./components/ModalForms/NewUser";
import NewContributor from "./components/ModalForms/NewContributor";
import NewMedia from "./components/ModalForms/NewMedia";
import NewVideo from "./components/ModalForms/NewVideo";
import NewCategory from "./components/ModalForms/NewCategory";
import NewArticle from "./components/ModalForms/NewArticle";
import NewTestimonial from "./components/ModalForms/NewTestimonial";
import NewSlideshow from "./components/ModalForms/NewSlideshow";
import TestimonialPublishSwitch from "./components/TestimonialPublishSwitch";

Vue.component('editor', Editor);
Vue.component('modal', Modal);
Vue.component('delete-modal', DeleteModal);
Vue.component('dropdown', Dropdown);
Vue.component('single-upload', Singleupload);
Vue.component('category-chooser', Categorychooser);
Vue.component('publish-button', Publishbutton);
Vue.component('contributor-selector', ContributorSelector);
Vue.component('toggle-switch', Toggleswitch);
Vue.component('tagger', Tagger);
Vue.component('tag-manager', Tagmanager);
Vue.component('dropzone', Dropzone);
Vue.component('gallery-show', Galleryshow);
Vue.component('featured-images', Featuredimages);
Vue.component('counting-textarea', Countingtextinput);
Vue.component('featured-toggle', Featuredselector);
Vue.component('new-user', NewUser);
Vue.component('new-contributor', NewContributor);
Vue.component('new-media', NewMedia);
Vue.component('new-video', NewVideo);
Vue.component('new-category', NewCategory);
Vue.component('new-article', NewArticle);
Vue.component('new-testimonial', NewTestimonial);
Vue.component('new-slideshow', NewSlideshow);
Vue.component('testimonial-publish-switch', TestimonialPublishSwitch);


window.eventHub = new Vue();

const app = new Vue({
    el: '#app',

    created() {
        eventHub.$on('user-alert', this.showAlert)
    },

    methods: {
        showAlert(message) {
            let options = {
                type: message.type,
                title: message.title,
                text: message.text,
                showConfirmButton: message.confirm,
            };

            if(message.timer) {
                options.timer = message.timer;
            }
            swal(options);
        }
    }
});

