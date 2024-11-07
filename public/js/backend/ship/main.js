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
  form: "#CruiseCreateForm",
  formGroupSelector: ".form-group",
  errorMessageSelector: ".error",
  errorDestructiveElement: "div",
  rules: [
    Validator.isRequired("#title", "Vui lòng nhập tiêu đề"),
    Validator.isRequired("#address", "Vui lòng nhập địa chỉ"),
    Validator.isRequired("#shell", "Vui lòng nhập thân vỏ"),
    Validator.isRequired("#year", "Vui lòng nhập năm hạ thủy"),
    Validator.isYear("#year"),
    Validator.isRequired("#cabin", "Vui lòng nhập số cabin"),
    Validator.isNumber("#cabin"),
    Validator.isRequired("#admin", "Vui lòng nhập tên công ty điều hành"),
    Validator.isRequired("#map_link", "Vui lòng nhập map link"),
    Validator.isRequired("#map_iframe_link", "Vui lòng nhập map iframe link"),
    Validator.isRequired("#schedule", "Vui lòng nhập lịch trình"),
    Validator.isRequired("#trip", "Vui lòng nhập hành trình"),
    Validator.isRequired("#slug", "Vui lòng nhập slug"),
    Validator.isRequired("#type_product", "Vui lòng chọn loại sản phẩm"),
    Validator.isRequired("#active", "Vui lòng chọn trạng thái"),
    Validator.isRequired("#category_id", "Vui lòng chọn loại sản phẩm"),
  ],
});

Validator({
  form: "#CruiseCreateForm",
  formGroupSelector: ".form-group",
  errorMessageSelector: ".error",
  errorDestructiveElement: "div",
  rules: [
    Validator.isRequired("#title", "Vui lòng nhập tiêu đề"),
    Validator.isRequired("#address", "Vui lòng nhập địa chỉ"),
    Validator.isRequired("#shell", "Vui lòng nhập thân vỏ"),
    Validator.isRequired("#year", "Vui lòng nhập năm hạ thủy"),
    Validator.isYear("#year"),
    Validator.isRequired("#cabin", "Vui lòng nhập số cabin"),
    Validator.isNumber("#cabin"),
    Validator.isRequired("#admin", "Vui lòng nhập tên công ty điều hành"),
    Validator.isRequired("#map_link", "Vui lòng nhập map link"),
    Validator.isRequired("#map_iframe_link", "Vui lòng nhập map iframe link"),
    Validator.isRequired("#schedule", "Vui lòng nhập lịch trình"),
    Validator.isRequired("#trip", "Vui lòng nhập hành trình"),
    Validator.isRequired("#slug", "Vui lòng nhập slug"),
    Validator.isRequired("#type_product", "Vui lòng chọn loại sản phẩm"),
    Validator.isRequired("#active", "Vui lòng chọn trạng thái"),
    Validator.isRequired("#category_id", "Vui lòng chọn loại sản phẩm"),
  ],
});
