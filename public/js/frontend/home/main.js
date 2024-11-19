import { handleDropdown } from "../../components/dropdown.js";
import handleReviewList from "../../components/handleReviewList.js";

const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);

const inputSelects = $$(".focus-dropdown input");

inputSelects.forEach((inputSelect) => {
  const dropdownItemList = inputSelect
    .closest(".focus-dropdown")
    .querySelectorAll(".search-box-dropdown-item");

  handleDropdown(inputSelect, dropdownItemList);
});

handleReviewList();