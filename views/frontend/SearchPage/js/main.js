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


const checkbox = document.querySelector('.Checkbox-container input[type="checkbox"]');
const productLabel = document.querySelector('.xs');

checkbox.addEventListener('change', () => {
    if (checkbox.checked) {
        productLabel.style.display = 'block'; 
    } else {
        productLabel.style.display = 'none'; 
    }
});

