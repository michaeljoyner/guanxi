function alertError(message) {
    window.eventHub.$emit('user-alert', {
        title: 'Oh dear',
        type: 'error',
        text: `${message}. Please refresh and try again`,
        confirm: true,
    });
}

function alertComplete(message) {
    window.eventHub.$emit('user-alert', {
        title: 'All done!',
        type: 'success',
        text: `${message}.`,
        timer: 1500,
        confirm: false,
    });
}

export {alertError, alertComplete};