document.addEventListener("DOMContentLoaded", function () {
    const searchButton = document.querySelector(".SearchBox_submit-btn");
    const searchInput = document.querySelector("#searchQuery");
    const searchLocation = document.querySelector("#searchLocation");
    const searchPrice = document.querySelector("#searchPrice");

    searchButton.addEventListener("click", function () {
        const searchQuery = searchInput.value.trim();
        const location = searchLocation.value;
        const price = searchPrice.value;

        if (searchQuery === "") {
            alert("Vui lòng nhập tên du thuyền để tìm kiếm!");
        } else {
            console.log(`Đang tìm kiếm: ${searchQuery}, Địa điểm: ${location}, Mức giá: ${price}`);
            alert(`Đã tìm kiếm du thuyền với từ khóa: "${searchQuery}"`);
        }
    });

    searchInput.addEventListener("keypress", function (e) {
        if (e.key === "Enter") {
            searchButton.click();
        }
    });
});
