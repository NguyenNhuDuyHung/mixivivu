const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);

const datePickerInput = $('input[id="calendar"]');
const datePickerTabLoop = $(".DatePicker-tab-loop");
const datePickerWrapper = $(".DatePicker-wrapper");
const datePickerDates = $(".DatePicker-dates");
const prevBtnCalendar = $(".DatePicker-header-custom button:first-child");
const nextBtnCalendar = $(".DatePicker-header-custom button:last-child");
const subheadingDatePicker = $(".DatePicker-header-custom .subheading");


let selectedDate = new Date();
let year = selectedDate.getFullYear();
let month = selectedDate.getMonth();

subheadingDatePicker.innerText = `Tháng ${month + 1}, ${year}`;

datePickerWrapper.addEventListener("click", () => {
  datePickerTabLoop.hidden = false;
});

nextBtnCalendar.addEventListener("click", () => {
  if (month === 11) year++;
  month = (month + 1) % 12;
  subheadingDatePicker.innerText = `Tháng ${month + 1}, ${year}`;
  displayDate();
});

prevBtnCalendar.addEventListener("click", () => {
  if (month === 0) year--;
  month = (month - 1 + 12) % 12;
  subheadingDatePicker.innerText = `Tháng ${month + 1}, ${year}`;
  displayDate();
});

const handleDateClick = (e) => {
  const button = e.target;

  const selected = datePickerDates.querySelector(
    ".DatePicker-day-btn-selectedDate"
  );
  selected && selected.classList.remove("DatePicker-day-btn-selectedDate");
  button.classList.toggle("DatePicker-day-btn-selectedDate");

  if (button.classList.contains("DatePicker-day-btn-outsideMonth")) {
    selectedDate = new Date(year, month + 1, parseInt(button.textContent));
  } else {
    selectedDate = new Date(year, month, parseInt(button.textContent));
  }

  datePickerInput.value = selectedDate.toLocaleDateString("en-GB", {
    year: "numeric",
    month: "2-digit",
    day: "2-digit",
  });

  datePickerTabLoop.hidden = true;

  // get value
  // console.log(datePickerInput.value);
};

const displayDate = () => {
  datePickerDates.innerHTML = "";

  const lastOfPreviousMonth = new Date(year, month, 0);

  for (let i = 0; i <= lastOfPreviousMonth.getDay(); i++) {
    const text =
      lastOfPreviousMonth.getDate() - lastOfPreviousMonth.getDay() + i;

    if (month > selectedDate.getMonth() || year > selectedDate.getFullYear()) {
      const button = createButton(text, false, false);
      datePickerDates.appendChild(button);
    } else {
      const button = createButton(text, true, false);
      datePickerDates.appendChild(button);
    }
  }

  const lastOfMonth = new Date(year, month + 1, 0);

  for (let i = 1; i <= lastOfMonth.getDate(); i++) {
    const isToday =
      selectedDate.getDate() === i &&
      selectedDate.getMonth() === month &&
      selectedDate.getFullYear() === year;

    const isPastDate =
      year < selectedDate.getFullYear() ||
      (year === selectedDate.getFullYear() &&
        month < selectedDate.getMonth()) ||
      (year === selectedDate.getFullYear() &&
        month === selectedDate.getMonth() &&
        i < selectedDate.getDate());

    if (isPastDate) {
      const button = createButton(i, true, false);
      button.addEventListener("click", handleDateClick);
      datePickerDates.appendChild(button);
    } else {
      const button = createButton(i, false, isToday);
      button.addEventListener("click", handleDateClick);
      datePickerDates.appendChild(button);
    }
  }

  const firstOfNextMonth = new Date(year, month + 1, 1);

  for (let i = firstOfNextMonth.getDay(); i < 7; i++) {
    const text = firstOfNextMonth.getDate() - firstOfNextMonth.getDay() + i;
    if (month < selectedDate.getMonth() || year < selectedDate.getFullYear()) {
      const button = createButton(text, true, false);
      button.addEventListener("click", handleDateClick);
      datePickerDates.appendChild(button);
    } else {
      const button = createButton(text, false, false, true);
      button.addEventListener("click", handleDateClick);
      datePickerDates.appendChild(button);
    }
  }
};

const createButton = (
  text,
  isDisabled = false,
  isToday = false,
  isOutsideMonth = false
) => {
  const button = document.createElement("button");
  button.type = "button";
  button.classList.add("DatePicker-day-btn");
  button.textContent = text;
  button.disabled = isDisabled;
  if (isOutsideMonth) button.classList.add("DatePicker-day-btn-outsideMonth");
  button.classList.toggle("DatePicker-day-btn-today", isToday);
  return button;
};

export default displayDate;
