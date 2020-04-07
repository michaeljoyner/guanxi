require('./frontbootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */
import Flickity from "flickity";
import "flickity-imagesloaded";
import Modal from "@dymantic/modal";
import Lightbox from "./components/Lightbox";
import Contentloader from "./components/Contentloader";
import StaticMedialist from "./components/StaticMedialist";
import Contactform from "./components/Contactform";
import {handleLogos} from "./components/handleLogos";

Vue.component('modal', Modal);
Vue.component('dd-lightbox', Lightbox);
Vue.component('contact-form', Contactform);
Vue.component('content-loader', Contentloader);
Vue.component('media-list', StaticMedialist);

const app = new Vue({
    el: '#app',
});

window.addEventListener('load', () => {
    const trigger = document.querySelector('#nav-trigger');
    trigger.addEventListener('click', () => {
        const navbar = document.querySelector('.main-nav');
        navbar.classList.toggle('open');
    });

    handleLogos();

    const slideshows = document.querySelectorAll('.guanxi-article-slideshow');

    slideshows.forEach(slideshow => {
        new Flickity(slideshow, {
            contain: true,
            freeScroll: true,
            pageDots: false,
            imagesLoaded: true,
        });
    })

});