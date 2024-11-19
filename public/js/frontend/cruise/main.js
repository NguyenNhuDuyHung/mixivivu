import { Validator, currentRating } from "../../components/validator.js";
import displayDate from "../../components/calendar.js";
import { handleInreaseAndDecreaseBtn } from "../../components/handleBtn.js";

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

// Validator({
//   form: "#booking-form",
//   formGroupSelector: ".form-group",
//   errorMessageSelector: ".error",
//   errorDestructiveElement: "div",
//   rules: [
//     Validator.isRequired("#full_name", "Bạn phải nhập họ và tên"),
//     Validator.isRequired("#email"),
//     Validator.isEmail("#email", "Email không hợp lệ"),
//     Validator.isRequired("#phone_number", "Bạn phải nhập số điện thoại"),
//     Validator.isPhone("#phone_number"),
//   ],
//   onSubmit: function (data) {
//     // call API
//     data.rating = currentRating;
//     console.log(data);
//   },
// });

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
  ".RoomCard-price",
  ".quantity-input"
);

displayDate();

const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);

const listBtnActiveModal = $$(".btn-activeModal");

const modalCloseBtn = $(".Modal-close-btn");
const modalOverLay = $(".popup-overlay");

function removeHiddenInputs() {
  const bookingForm = document.getElementById("booking-form");

  // Tìm và xóa tất cả các input hidden
  const hiddenInputs = bookingForm.querySelectorAll(
    'input[name="cruiseRoomId[]"], input[name="cruiseRoomQuantity[]"]'
  );
  hiddenInputs.forEach((input) => {
    bookingForm.removeChild(input);
  });
}

listBtnActiveModal.forEach((btn) => {
  btn.addEventListener("click", () => {
    if ($(".popup-overlay").style.display === "none") {
      $(".popup-overlay").style.display = "flex";
      const totalPriceModal = $(
        ".ShipDetail-booking-detail-modal-footer .ShipDetail-price"
      );
      totalPriceModal.textContent = $(
        ".ShipDetail-rooms-footer .ShipDetail-price"
      ).textContent;

      const inputRoomIdHidden = document.createElement("input");
      inputRoomIdHidden.type = "hidden";
      inputRoomIdHidden.name = "cruiseRoomId[]";
      inputRoomIdHidden.value = $('input[name="cruiseRoomIdOutside[]"').value;

      const inputRoomQuantityHidden = document.createElement("input");
      inputRoomQuantityHidden.type = "hidden";
      inputRoomQuantityHidden.name = "cruiseRoomQuantity[]";

      const allQuantities = [];
      $$(".quantity-input").forEach((input) => {
        allQuantities.push(input.value);
      });

      inputRoomQuantityHidden.value = allQuantities.join(",");

      document.getElementById("booking-form").appendChild(inputRoomIdHidden);
      document
        .getElementById("booking-form")
        .appendChild(inputRoomQuantityHidden);

      console.log(inputRoomQuantityHidden.value);
    } else {
      $(".popup-overlay").style.display = "none";
      removeHiddenInputs();
    }
  });
});

modalCloseBtn.addEventListener("click", () => {
  $(".popup-overlay").style.display = "none";
  removeHiddenInputs();
});

$(".popup-overlay").addEventListener("click", (e) => {
  if (e.target === modalOverLay) {
    $(".popup-overlay").style.display = "none";
    removeHiddenInputs();
  }
});

const roomPicker = $(".RoomPicker-room-picker div");

const roomPickerdropdown = $(".RoomPicker-room-picker-dropdown");
const roomPickerActionBtn = $(".RoomPicker-actions button");
const listRoomPickerItemValue = $$(".RoomPicker-item-value");
roomPicker.addEventListener("click", () => {
  roomPickerdropdown.classList.toggle("show");
});

roomPickerActionBtn.addEventListener("click", () => {
  let text = "";
  listRoomPickerItemValue.forEach((item) => {
    text +=
      item.textContent +
      " " +
      item.parentElement.querySelector(".lg").textContent +
      " - ";
  });
  $(".RoomPicker-room-picker input").value = text.slice(0, -3);
  roomPickerdropdown.classList.remove("show");
});
