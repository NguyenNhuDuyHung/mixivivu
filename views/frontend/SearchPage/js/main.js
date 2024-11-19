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
    const productLabel = $$('.main fresnel-container-div');
    
    for (let i = 0; i < checkboxes.length; i++) {
        checkboxes[i].addEventListener('change', () => {
            if (checkboxes[i].checked) {
                productDivs[i].style.display = 'block'; 
            } else {
                productDivs[i].style.display = 'none'; 
            }
        });
    }
}

function initoder () {
    const buttons = $('.btn btn-sm');

    buttons.forEach(button => {
        button.addEventListener('click', function() {
            window.location.href = '/'; 
        });
    });
}


document.addEventListener("DOMContentLoaded", function () {
    const pageSizeInput = document.querySelector('.Pagination-page-size input'); 
    const prevButton = document.querySelector('.Pagination-pagination-left-item');
    const nextButton = document.querySelector('.Pagination-pagination-right-item');
    const pageItems = document.querySelectorAll('.Pagination-pagination-item:not(.Pagination-dots)');
    const totalItemsText = document.querySelector('.Pagination-left-pagination p.sm:last-child');
    
    let currentPage = 1; 
    let pageSize = parseInt(pageSizeInput.value); 
    const totalItems = 64; 
    const totalPages = Math.ceil(totalItems / pageSize);
    
   
    function updatePagination() {
        pageItems.forEach(item => {
            if (parseInt(item.textContent) === currentPage) {
                item.classList.add('Pagination-selected');
            } else {
                item.classList.remove('Pagination-selected');
            }
        });

        prevButton.classList.toggle('Pagination-disabled', currentPage === 1);
        nextButton.classList.toggle('Pagination-disabled', currentPage === totalPages);

        totalItemsText.textContent = `của ${totalItems}`;
    }

    pageSizeInput.addEventListener('input', function (e) {
        pageSize = Math.max(1, Math.min(20, parseInt(e.target.value))); 
        updatePagination();
    });

    pageItems.forEach(item => {
        item.addEventListener('click', function () {
            const page = parseInt(this.textContent);
            if (!isNaN(page)) {
                currentPage = page;
                updatePagination();
            }
        });
    });

    prevButton.addEventListener('click', function () {
        if (currentPage > 1) {
            currentPage--;
            updatePagination();
        }
    });

    nextButton.addEventListener('click', function () {
        if (currentPage < totalPages) {
            currentPage++;
            updatePagination();
        }
    });

    updatePagination();
});
