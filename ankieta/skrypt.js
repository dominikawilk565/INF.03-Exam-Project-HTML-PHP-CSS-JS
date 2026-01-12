document.addEventListener('DOMContentLoaded', () => {

    const nic = document.getElementById("nic");
    const opcje = document.querySelectorAll("#pytanie1 .opcja");

    function updateJezykiVisual() {
        if (nic.checked) {
            opcje.forEach(opt => opt.parentElement.classList.add('disabled-look'));
        } else {
            opcje.forEach(opt => opt.parentElement.classList.remove('disabled-look'));
        }
    }

    nic.addEventListener('change', () => {
        if (nic.checked) opcje.forEach(opt => opt.checked = false);
        updateJezykiVisual();
    });

    opcje.forEach(opt => {
        opt.addEventListener('change', () => {
            if (opt.checked) nic.checked = false;
            updateJezykiVisual();
        });
    });

        const selectNauczyciel = document.getElementById('nauczyciel');
    const inputWpisany = document.getElementById('wpisany');

    selectNauczyciel.addEventListener('change', () => {
        if (selectNauczyciel.value === 'inny') {
            inputWpisany.style.display = 'inline-block';
        } else {
            inputWpisany.style.display = 'none';
            inputWpisany.value = '';
        }
    });

    function setupRating(containerId, hiddenInputId) {
        const container = document.getElementById(containerId);
        const hiddenInput = document.getElementById(hiddenInputId);
        const images = container.querySelectorAll('img');

        images.forEach(img => {
            img.addEventListener('click', () => {
                images.forEach(i => i.classList.remove('selected'));
                img.classList.add('selected');
                hiddenInput.value = img.dataset.value;
            });
        });
    }

    setupRating('ocena_prowadzacego', 'ocena');
    setupRating('materialy', 'materialy1');


    const pytaniaRadios = document.querySelectorAll('input[name="pytania"]');
    const pytania1Div = document.getElementById('unikalne');
    const pytania1Inputs = document.querySelectorAll('input[name="pytania1"]');

    pytaniaRadios.forEach(radio => {
        radio.addEventListener('change', () => {
            if (radio.value === 'Tak') {
                pytania1Div.style.display = 'block';
                pytania1Inputs.forEach(input => input.removeAttribute('disabled'));
            } else {
                pytania1Div.style.display = 'none';
                pytania1Inputs.forEach(input => input.checked = false);
                pytania1Inputs.forEach(input => input.setAttribute('disabled', true));
            }
        });
    });


const radioWykorzystam = document.querySelectorAll('input[name="urzycie"]');
const divWiedza = document.getElementById("wiedza");

radioWykorzystam.forEach(radio => {
    radio.addEventListener('change', () => {
        if (radio.value === 'Tak' && radio.checked) {
            divWiedza.style.display = 'block';
        } else {
            divWiedza.style.display = 'none';
        }
    });
});
});



