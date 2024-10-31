import { Validator } from "../../components/validator.js";

Validator({
  form: "#UserAddForm",
  formGroupSelector: ".form-group",
  errorMessageSelector: ".error",
  errorDestructiveElement: "div",
  rules: [
    Validator.isRequired("#name", "Vui lòng nhập họ tên"),
    Validator.isRequired("#email", "Vui lòng nhập email"),
    Validator.isEmail("#email"),
    Validator.isRequired("#phone", "Vui lòng nhập số điện thoại"),
    Validator.isPhone("#phone"),
    Validator.isRequired("#role", "Vui lòng chọn vai trò"),
  ],
});
