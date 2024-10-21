import { Validator } from "../../components/validator.js";

Validator({
  form: "#formLogin",
  formGroupSelector: ".LoginAdmin-inputCustom",
  errorMessageSelector: ".error",
  errorDestructiveElement: "div",
  rules: [
    Validator.isRequired("#username", "required"),
    Validator.isRequired("#password", "required"),
  ],
});
