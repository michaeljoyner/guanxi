export default {

    init() {
        const trigger = document.querySelector('#nav-trigger');
        trigger.addEventListener('change', (ev) => this.toggleMenuStates(ev), false);
    },

    toggleMenuStates(ev) {
        if(ev.target.checked) {
           return document.body.classList.add('overlaid');
        } else {
            return document.body.classList.remove('overlaid');
        }
    }
}