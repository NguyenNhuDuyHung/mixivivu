import { Validator } from "../../components/validator.js";
import { handleDropdown } from "../../components/dropdown.js";
import { handleFileImageUpload } from "../../components/upload.js";

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


const uploadIcon = $("#upload-icon");

uploadIcon.addEventListener("change", (e) => {
  handleFileImageUpload(
    e.target, // Input element
    document.querySelector(".preview-icon"), // Preview container
    document.querySelector(".temp-icon"), // Temp image
    document.querySelector(".upload-icon-btn"), // Upload button
    true // Flag to replace image
  );
});