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
  form: "#FeatureCreateForm",
  formGroupSelector: ".form-group",
  errorMessageSelector: ".error",
  errorDestructiveElement: "div",
  rules: [
    Validator.isRequired("#text"),
    Validator.isRequired("#type", "Vui lòng chọn trường này"),
    Validator.isRequired("#icon"),
  ],
});

Validator({
  form: "#FeatureUpdateForm",
  formGroupSelector: ".form-group",
  errorMessageSelector: ".error",
  errorDestructiveElement: "div",
  rules: [
    Validator.isRequired("#text"),
    Validator.isRequired("#type", "Vui lòng chọn trường này"),
    Validator.isRequired("#icon"),
  ],
});

Validator({
  form: "#FeatureCatalogueCreateForm",
  formGroupSelector: ".form-group",
  errorMessageSelector: ".error",
  errorDestructiveElement: "div",
  rules: [
    Validator.isRequired("#name"),
  ],
});

Validator({
  form: "#FeatureCatalogueUpdateForm",
  formGroupSelector: ".form-group",
  errorMessageSelector: ".error",
  errorDestructiveElement: "div",
  rules: [
    Validator.isRequired("#name"),
  ],
});