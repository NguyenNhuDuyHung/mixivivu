import { Validator } from "../../../components/validator.js";
import { handleFileImageUpload } from "../../../components/upload.js";

const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);

const uploadImage = $("#upload-image");

uploadImage.addEventListener("change", (e) => {
  handleFileImageUpload("upload-image", ".preview-image", ".temp-img", true);
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
