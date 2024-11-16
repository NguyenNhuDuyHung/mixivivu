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

const uploadImages = $("#upload-image");

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
  form: "#RoomCreateForm",
  formGroupSelector: ".form-group",
  errorMessageSelector: ".error",
  errorDestructiveElement: "div",
  rules: [Validator.isRequired("#product_id", "Vui lòng chọn trường này"),
        Validator.isRequired("#title"),
        Validator.isRequired("#size"),
        Validator.isRequired("#max_persons"),
        Validator.isRequired("#price"),
        Validator.isNumber("#price"),
        Validator.isNumber("#sale_prices"),
  ],
});

Validator({
  form: "#RoomUpdateForm",
  formGroupSelector: ".form-group",
  errorMessageSelector: ".error",
  errorDestructiveElement: "div",
  rules: [Validator.isRequired("#product_id", "Vui lòng chọn trường này"),
        Validator.isRequired("#title"),
        Validator.isRequired("#size"),
        Validator.isRequired("#max_persons"),
        Validator.isRequired("#price"),
        Validator.isNumber("#price"),
        Validator.isNumber("#sale_prices"),
  ],
});