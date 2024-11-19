const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);


// button sắp xếp
function initButtonDropdown() {
    const buttons = $$('.SearchPageDetail-sort-btn .btn');
    const dropdowns = $$('.SearchPageDetail-dropdown');

    dropdowns.forEach(dropdown => {
        dropdown.style.display = 'none';
    });

    buttons.forEach(button => {
        button.addEventListener('click', (event) => {
            event.stopPropagation();

            const dropdown = button.nextElementSibling; 

            dropdowns.forEach(d => {
                if (d !== dropdown) d.style.display = 'none';
            });

            dropdown.style.display = dropdown.style.display === 'none' ? 'block' : 'none';
        });
    });

    document.addEventListener('click', () => {
        dropdowns.forEach(dropdown => {
            dropdown.style.display = 'none';
        });
    });

    dropdowns.forEach(dropdown => {
        dropdown.addEventListener('click', (event) => {
            event.stopPropagation(); 
        });
    });
}

initButtonDropdown();

function initcheckbox () {
    const checkbox = $('.Checkbox-container input[type="checkbox"]');
    const productLabel = $$(' fresnel-container-div .xs');
    
    checkboxes.forEach((checkbox, index) => {
        checkbox.addEventListener('change', () => {
            if (checkbox.checked) {
                productLabels[index].style.display = 'block';
            } else {
                productLabels[index].style.display = 'none';
            }
        });
    });
}