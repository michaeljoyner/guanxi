export default {

    init() {
        const trigger = document.querySelector('#nav-trigger');
        const hashLinks = Array.prototype.slice.call(document.querySelectorAll('.about-nav a'));
        trigger.addEventListener('change', (ev) => this.toggleMenuStates(ev), false);
        hashLinks.forEach(link => link.addEventListener('click', () => this.closeMenu(), false));
    },

    toggleMenuStates(ev) {
        if(ev.target.checked) {
           return document.body.classList.add('overlaid');
        } else {
            return document.body.classList.remove('overlaid');
        }
    },

    closeMenu() {
        document.querySelector('#nav-trigger').checked = false;
    }
}