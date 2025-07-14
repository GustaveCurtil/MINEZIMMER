document.addEventListener('DOMContentLoaded', function() {
    let rooms = document.querySelectorAll('main .weergave');
    let roomControls = document.querySelectorAll('aside .paneel');

    console.log(roomControls)

    for (let i = 0; i < rooms.length; i++) {
        const room = rooms[i];
        const roomControl = roomControls[i];
        room.addEventListener('click', (e) => {
            if (room.classList.contains('actief')) {
                room.classList.remove('actief');
                roomControl.classList.remove('actief');
            } else {
                rooms.forEach(room => {
                    room.classList.remove('actief');
                });
                room.classList.add('actief');
                roomControls.forEach(control => {
                    control.classList.remove('actief');
                });
                roomControl.classList.add('actief');
            }
        })
    }
}, false);


