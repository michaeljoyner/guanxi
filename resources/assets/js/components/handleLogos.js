function handleLogos() {
    const nav_logo = document.querySelector('.nav-logo');
    const banner_logo = document.querySelector('.banner-logo');

    if(!banner_logo || !canObserve()) {
        return nav_logo.classList.add('show');
    }

    observe(banner_logo, nav_logo);
}

function observe(banner_logo, navlogo) {
    const ioOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0,
    };

    const ioCallback = (entries, observer) => {
        entries.forEach(({target, isIntersecting}) => {
            if(target !== banner_logo) {
                return;
            }
            if(!isIntersecting) {
                return navlogo.classList.add('show');
            }
            navlogo.classList.remove('show');
        });
    };

    const io = new IntersectionObserver(ioCallback, ioOptions);
    io.observe(banner_logo);
}

function canObserve() {
    return 'IntersectionObserver' in window &&
        'IntersectionObserverEntry' in window &&
        'intersectionRatio' in window.IntersectionObserverEntry.prototype &&
        'isIntersecting' in window.IntersectionObserverEntry.prototype;
}

export {handleLogos};