import { handleDropdown } from "../../components/dropdown.js";
import { handleInreaseAndDecreaseBtn } from "../../components/handleBtn.js";

const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);

const inputSelects = $$(".select-input input");
inputSelects.forEach((inputSelect) => {
  const dropdownItemList = inputSelect
    .closest(".select-input")
    .querySelectorAll(".dropdown-item");

  handleDropdown(inputSelect, dropdownItemList);
});

const submitBtn = $(".submitBtn");

function removeHiddenInputs() {
  const bookingForm = document.getElementById("booking-form");

  // Tìm và xóa tất cả các input hidden
  const hiddenInputs = bookingForm.querySelectorAll(
    'input[name="cruiseRoomId[]"], input[name="roomQuantity[]"]'
  );
  hiddenInputs.forEach((input) => {
    bookingForm.removeChild(input);
  });
}

submitBtn.addEventListener("click", () => {
  const inputRoomIdHidden = document.createElement("input");
  inputRoomIdHidden.type = "hidden";
  inputRoomIdHidden.name = "cruiseRoomId[]";
  inputRoomIdHidden.value = $('input[name="roomIdOutside[]"').value;

  const inputRoomQuantityHidden = document.createElement("input");
  inputRoomQuantityHidden.type = "hidden";
  inputRoomQuantityHidden.name = "roomQuantity[]";

  const allQuantities = [];
  $$(".quantity-input").forEach((input) => {
    allQuantities.push(input.value);
  });

  inputRoomQuantityHidden.value = allQuantities.join(",");

  document.getElementById("booking-form").appendChild(inputRoomIdHidden);
  document.getElementById("booking-form").appendChild(inputRoomQuantityHidden);

  console.log(inputRoomQuantityHidden.value);
});

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
