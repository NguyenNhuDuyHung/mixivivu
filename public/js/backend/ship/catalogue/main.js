import { Validator } from "../../../components/validator.js";
import { handleFileImageUpload } from "../../../components/upload.js";

const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);

const uploadImage = $("#upload-image");

uploadImage.addEventListener("change", (e) => {
  handleFileImageUpload(
    e.target,
    document.querySelector(".preview-image"),
    document.querySelector(".temp-img"),
    document.querySelector(".upload-image-btn"),
    true
  );
});

Validator({
  form: "#CruiseCatalogueCreateForm",
  formGroupSelector: ".form-group",
  errorMessageSelector: ".error",
  errorDestructiveElement: "div",
  rules: [Validator.isRequired("#name")],
});

Validator({
  form: "#CruiseCatalogueUpdateForm",
  formGroupSelector: ".form-group",
  errorMessageSelector: ".error",
  errorDestructiveElement: "div",
  rules: [Validator.isRequired("#name")],
});
