import { Validator, currentRating } from "./validator.js";
import Carousel from "./carousel.js";
import displayDate from "./calendar.js";

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

const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);

const roomCardList = $$(".RoomCard-roomCard");
const roomCardBtnList = $$(".RoomCard-roomBtn");
const roomCardPriceList = $$(".RoomCard-price");
const shipDetailPrice = $(".ShipDetail-price");

let sumPrice = 0;

roomCardList.forEach((roomCard, index) => {
  const minusBtn = roomCardBtnList[index].querySelector("div:first-child");
  const plusBtn = roomCardBtnList[index].querySelector("div:last-child");
  const roomCardPriceValue = Number(
    roomCardPriceList[index].innerText.slice(0, -2).replace(/,/g, "")
  );

  minusBtn.addEventListener("click", () => {
    if (
      roomCardBtnList[index].querySelector("div[class='label md']").innerText >
      0
    ) {
      roomCardBtnList[index].querySelector("div[class='label md']").innerText--;
      sumPrice -= roomCardPriceValue;
      shipDetailPrice.innerText = sumPrice.toLocaleString() + " đ";
    }
  });

  plusBtn.addEventListener("click", () => {
    roomCardBtnList[index].querySelector("div[class='label md']").innerText++;
    sumPrice += roomCardPriceValue;
    shipDetailPrice.innerText = sumPrice.toLocaleString() + " đ";
  });
});

displayDate();
