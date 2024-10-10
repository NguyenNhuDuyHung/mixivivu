import { Validator, currentRating } from "./validator.js";
import Carousel from "./carousel.js";
import displayDate from "./calendar.js";
import { handleInreaseAndDecreaseBtn } from "./handleBtn.js";

Validator({
  form: "#form-review",
  formGroupSelector: ".form-group",
  errorMessageSelector: ".error",
  errorDestructiveElement: "div",
  rules: [
    Validator.isRequired("#name", "Bạn phải nhập họ và tên"),
    Validator.isRequired("#email"),
    Validator.isEmail("#email", "Email không hợp lệ"),
    Validator.isRequired("#phone", "Bạn phải nhập số điện thoại"),
    Validator.isPhone("#phone"),
    Validator.isRequired("#comment", "Bạn phải nhập đánh giá"),
    Validator.isRequiredRating(".RatingInput-rating", "Bạn phải chọn rating"),
  ],
  onSubmit: function (data) {
    // call API
    data.rating = currentRating;
    console.log(data);
  },
});

Carousel();

handleInreaseAndDecreaseBtn(
  ".RoomPicker-item",
  ".RoomPicker-group-btn",
  null,
  ".RoomPicker-item-value"
);

handleInreaseAndDecreaseBtn(
  ".RoomCard-roomCard",
  ".RoomCard-roomBtn",
  ".ShipDetail-price",
  ".RoomCard-price"
);

displayDate();

const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);

const listBtnActiveModal = $$(".btn-activeModal");
const modalCloseBtn = $(".Modal-close-btn");
const modalOverLay = $(".popup-overlay");

listBtnActiveModal.forEach((btn) => {
  btn.addEventListener("click", () => {
    if ($(".popup-overlay").style.display === "none") {
      $(".popup-overlay").style.display = "flex";
    } else {
      $(".popup-overlay").style.display = "none";
    }
  });
});

modalCloseBtn.addEventListener("click", () => {
  $(".popup-overlay").style.display = "none";
});

$(".popup-overlay").addEventListener("click", (e) => {
  if(e.target === modalOverLay) {
    $(".popup-overlay").style.display = "none";
  }
})