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