import { Validator } from "../../components/validator.js";

Validator({
  form: "#LongDescCatalogueCreateForm",
  formGroupSelector: ".form-group",
  errorMessageSelector: ".error",
  errorDestructiveElement: "div",
  rules: [Validator.isRequired("#type")],
});

Validator({
  form: "#LongDescCatalogueUpdateForm",
  formGroupSelector: ".form-group",
  errorMessageSelector: ".error",
  errorDestructiveElement: "div",
  rules: [Validator.isRequired("#type")],
});
