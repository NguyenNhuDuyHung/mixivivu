import { Validator } from "../../components/validator.js";
import { handleDropdown } from "../../components/dropdown.js";

const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);

const inputSelects = $$(".select-input input");

inputSelects.forEach((inputSelect) => {
  const dropdownItemList = inputSelect
    .closest(".select-input")
    .querySelectorAll(".dropdown-item");

  handleDropdown(inputSelect, dropdownItemList);
});

Validator({
  form: "#ShortDescCreateForm",
  formGroupSelector: ".form-group",
  errorMessageSelector: ".error",
  errorDestructiveElement: "div",
  rules: [
    Validator.isRequired("#description", "Vui lòng nhập trường này"),
    Validator.isRequired("#product_id", "Vui lòng chọn sản phẩm"),
  ],
});

Validator({
  form: "#ShortDescUpdateForm",
  formGroupSelector: ".form-group",
  errorMessageSelector: ".error",
  errorDestructiveElement: "div",
  rules: [
    Validator.isRequired("#description", "Vui lòng nhập trường này"),
    Validator.isRequired("#product_id", "Vui lòng chọn sản phẩm"),
  ],
});
