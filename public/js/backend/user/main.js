import { Validator } from "../../components/validator.js";
import { handleDropdown } from "../../components/dropdown.js";

const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);

const inputSelect = $('.select-input input');
const dropdownItemList = $$(".dropdown-item");

handleDropdown(inputSelect, dropdownItemList);

Validator({
  form: "#UserAddForm",
  formGroupSelector: ".form-group",
  errorMessageSelector: ".error",
  errorDestructiveElement: "div",
  rules: [
    Validator.isRequired("#name", "Vui lòng nhập họ tên"),
    Validator.isRequired("#email", "Vui lòng nhập email"),
    Validator.isEmail("#email"),
    Validator.isPhone("#phone"),
    Validator.isRequired("#role", "Vui lòng chọn vai trò"),
  ],
});

Validator({
  form: "#UserCatalogueAddForm",
  formGroupSelector: ".form-group",
  errorMessageSelector: ".error",
  errorDestructiveElement: "div",
  rules: [Validator.isRequired("#name", "Vui lòng nhập tên nhóm người dùng")],
});
