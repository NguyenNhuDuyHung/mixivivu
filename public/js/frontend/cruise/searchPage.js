import { handleDropdown } from "../../components/dropdown.js";
import handleCheckbox from "../../components/handleCheckbox.js";
const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);
const inputSelects = $$(".select-input input");

inputSelects.forEach((inputSelect) => {
  const dropdownItemList = inputSelect
    .closest(".select-input")
    .querySelectorAll(".dropdown-item");

  handleDropdown(inputSelect, dropdownItemList);
});

handleCheckbox(
  $(".SearchPageDetail-filter-feature"),
  $(".SearchPageDetail-side-bar-header button")
);

const listCheckbox = $$(".SearchPageDetail-filter-item input[type='checkbox']");
const cruiseList = $(".SearchPageDetail-ship-list");
const pagination = $(".Pagination-pagination");
let sortOrder = [];
listCheckbox.forEach((checkbox) => {
  checkbox.addEventListener("change", () => {
    if (checkbox.checked) {
      sortOrder.push(checkbox.id);
    } else {
      // Nếu checkbox bị uncheck, xóa ID khỏi mảng
      sortOrder = sortOrder.filter((id) => id !== checkbox.id);
    }
    if(sortOrder.length === 0){
      return;
    }
    const sortOrderString = sortOrder.join(",");

    fetch(`/web-btl/api/cruise/sortWithCheckbox/${sortOrderString}`, {
      method: "GET",
    })
      .then((res) => res.text())
      .then((data) => {
        console.log(data);
        
        cruiseList.innerHTML = data; // Cập nhật danh sách sản phẩm
        pagination.innerHTML = "";
      })
      .catch((err) => console.log(err));
  });
});

const searchPageDetailSortWithPrice = $(".SearchPageDetail-sort-btn input");
const searchPageDetailSortWithPriceDropdown = $$(
  ".SearchPageDetail-sort-btn .SearchPageDetail-dropdown-item"
);

searchPageDetailSortWithPriceDropdown.forEach((dropdown) => {
  dropdown.addEventListener("mousedown", () => {
    const order = searchPageDetailSortWithPrice.value;

    fetch(`/web-btl/api/cruise/sortWithPrice/${order}`, {
      method: "GET",
    })
      .then((res) => res.text())
      .then((data) => {
        console.log(data);
        cruiseList.innerHTML = data; // Cập nhật danh sách sản phẩm
      })
      .catch((err) => console.log(err));
  });
});
