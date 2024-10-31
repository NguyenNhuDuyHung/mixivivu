import { Validator } from "../../components/validator.js";

Validator({
  form: "#formLogin",
  formGroupSelector: ".LoginAdmin-inputCustom",
  errorMessageSelector: ".error",
  errorDestructiveElement: "div",
  rules: [
    Validator.isRequired("#email", "required"),
    Validator.isEmail("#email"),
    Validator.isRequired("#password", "required"),
  ],
});
