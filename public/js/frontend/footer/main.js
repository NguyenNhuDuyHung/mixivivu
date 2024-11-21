import toggleFaq from "../../components/toggleFag.js";
import { Validator } from "../../components/validator.js";
toggleFaq(
  ".Faqs-wrapper .Card-card", // Selector của các thẻ Card
  ".Faqs-custom-header", // Selector của header tùy chỉnh
  ".Collapse-collapse", // Selector của nội dung collapse
  "path" // Selector của phần tử path trong SVG
);

toggleFaq(
  ".TermAndConditions-wrapper .Card-card", // Selector của các thẻ Card
  ".TermAndConditions-custom-header", // Selector của header tùy chỉnh
  ".Collapse-collapse", // Selector của nội dung collapse
  "path" // Selector của phần tử path trong SVG
);

Validator({
  form: "#Contact-form",
  formGroupSelector: ".form-group",
  errorMessageSelector: ".error",
  errorDestructiveElement: "div",
  rules: [
    Validator.isRequired("#full_name", "Bạn phải nhập họ và tên"),
    Validator.isRequired("#email", "Bạn phải nhập email"),
    Validator.isEmail("#email", "Email không hợp lệ"),
    Validator.isRequired("#phone_number", "Bạn phải nhập số điện thoại"),
    Validator.isPhone("#phone_number"),
    Validator.isRequired("#additional_info", "Bạn cần nhập nội dung yêu cầu"),
  ],
});
