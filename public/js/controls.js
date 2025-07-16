document.addEventListener('DOMContentLoaded', function() {
    let rooms = document.querySelectorAll('main .weergave');
    let roomControls = document.querySelectorAll('aside #view>.room');

    let controlButtons = document.querySelectorAll('#controls button');
    let createForms = document.querySelectorAll('#view .create');
        console.log("jo")

    for (let i = 0; i < rooms.length; i++) {
        const room = rooms[i];
        const roomControl = roomControls[i];
        room.addEventListener('click', (e) => {
                    console.log("jo")
            if (room.classList.contains('actief')) {
                room.classList.remove('actief');
                roomControl.classList.remove('actief');
            } else {
                deactivateAll();
                room.classList.add('actief');
                roomControl.classList.add('actief');
            }
        })
    }


    for (let i = 0; i <  controlButtons.length; i++) {
        const button = controlButtons[i];
        const form = createForms[i];
        button.addEventListener('click', (e) => {
            if (button.classList.contains('actief')) {
                button.classList.remove('actief');
                form.classList.remove('actief');
            } else {
                deactivateAll();

                button.classList.add('actief');
                form.classList.add('actief');
            }
        })
    };

    function deactivate(items) {
        items.forEach(item => {
            item.classList.remove('actief');
        });
        console.log("jo")
    }

    function deactivateAll() {
        deactivate(rooms)
        deactivate(roomControls)               
        deactivate(controlButtons)
        deactivate(createForms)
    }

}, false);



