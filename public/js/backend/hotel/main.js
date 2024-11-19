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

const uploadThumbnail = $("#upload-thumbnail");
const uploadImages = $("#upload-image");

uploadThumbnail.addEventListener("change", (e) => {
  handleFileImageUpload(
    e.target, // Input element
    document.querySelector(".preview-thumb"), // Preview container
    document.querySelector(".temp-thumb"), // Temp image
    document.querySelector(".upload-thumb-btn"), // Upload button
    true // Flag to replace image
  );
});

uploadImages.addEventListener("change", (e) => {
  handleFileImageUpload(
    e.target, // Input element
    document.querySelector(".preview-image"), // Preview container
    document.querySelector(".temp-img"), // Temp image
    document.querySelector(".upload-images-btn"), // Upload button
    false // Flag to append image
  );
});

Validator({
  form: "#HotelCreateForm",
  formGroupSelector: ".form-group",
  errorMessageSelector: ".error",
  errorDestructiveElement: "div",
  rules: [
    Validator.isRequired("#title"),
    Validator.isRequired("#address"),
    Validator.isRequired("#city_id", "Vui lòng chọn trường này"),
    Validator.isRequired("#active", "Vui lòng chọn trường này"),
    Validator.isRequired("#map_link"),
    Validator.isRequired("#map_iframe_link"),
    Validator.isRequired("#default_price"),
    Validator.isNumber("#default_price"),
    Validator.isRequired("#slug"),
    Validator.isRequired("#admin"),
  ],
});

Validator({
  form: "#HotelUpdateForm",
  formGroupSelector: ".form-group",
  errorMessageSelector: ".error",
  errorDestructiveElement: "div",
  rules: [
    Validator.isRequired("#title"),
    Validator.isRequired("#address"),
    Validator.isRequired("#city_id", "Vui lòng chọn trường này"),
    Validator.isRequired("#active", "Vui lòng chọn trường này"),
    Validator.isRequired("#map_link"),
    Validator.isRequired("#map_iframe_link"),
    Validator.isRequired("#default_price"),
    Validator.isNumber("#default_price"),
    Validator.isRequired("#slug"),
    Validator.isRequired("#admin"),
  ],
});
