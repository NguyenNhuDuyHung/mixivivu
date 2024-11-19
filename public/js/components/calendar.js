const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);

const datePickerInput = $('input[id="calendar"]');
let datePickerTabLoop;
const datePickerWrapper = $(".DatePicker-wrapper");
let datePickerDates;
let prevBtnCalendar;
let nextBtnCalendar;
let subheadingDatePicker;

let selectedDate = new Date();
let year = selectedDate.getFullYear();
let month = selectedDate.getMonth();

datePickerWrapper.addEventListener("click", () => {
  if (datePickerTabLoop) {
    datePickerTabLoop.remove();
  }

  const mainCalendarElement = document.createElement("div");
  mainCalendarElement.classList.add("DatePicker-tab-loop");
  mainCalendarElement.innerHTML = `
    <div class="DatePicker-popper"
        style="position: absolute; inset: 0px auto auto 0px; transform: translate3d(28.8px, 167.2px, 0px);">
        <div style="display: contents;">
            <div class="DatePicker-DatePicker">
                <div class="DatePicker-header">
                    <div class="DatePicker-header-custom">
                        <button type="button" class="btn btn-sm btn-link-color btn-iconOnly prevBtn">
                            <div class="label sm"></div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M15 6L9 12L15 18" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </button>
                        <div class="subheading sm"></div>
                        <button type="button" class="btn btn-sm btn-link-color btn-iconOnly nextBtn">
                            <div class="label sm"></div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M9 6L15 12L9 18" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="DatePicker-day-names">
                        <div class="DatePicker-day-name">CN</div>
                        <div class="DatePicker-day-name">T2</div>
                        <div class="DatePicker-day-name">T3</div>
                        <div class="DatePicker-day-name">T4</div>
                        <div class="DatePicker-day-name">T5</div>
                        <div class="DatePicker-day-name">T6</div>
                        <div class="DatePicker-day-name">T7</div>
                    </div>
                </div>
                <div class="DatePicker-dates"></div>
            </div>
        </div>
    </div>`;

  $(".DatePicker-mixi-date-picker").appendChild(mainCalendarElement);

  datePickerTabLoop = $(".DatePicker-tab-loop");
  datePickerDates = $(".DatePicker-dates");
  prevBtnCalendar = $(".prevBtn");
  nextBtnCalendar = $(".nextBtn");
  subheadingDatePicker = $(".DatePicker-header-custom .subheading");

  attachEvents();

  subheadingDatePicker.innerText = `Tháng ${month + 1}, ${year}`;
  displayDate();
});

function attachEvents() {
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
}

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

  datePickerTabLoop.remove();
};

const displayDate = () => {
  if (!datePickerDates) return;

  datePickerDates.innerHTML = "";

  const today = new Date();
  today.setHours(0, 0, 0, 0); // Reset giờ để so sánh chính xác

  const lastOfPreviousMonth = new Date(year, month, 0);

  for (let i = 0; i <= lastOfPreviousMonth.getDay(); i++) {
    const text =
      lastOfPreviousMonth.getDate() - lastOfPreviousMonth.getDay() + i;

    const button = createButton(text, true, false, true);
    datePickerDates.appendChild(button);
  }

  const lastOfMonth = new Date(year, month + 1, 0);

  for (let i = 1; i <= lastOfMonth.getDate(); i++) {
    const currentDate = new Date(year, month, i); // Ngày trong tháng hiện tại
    const isToday = today.getTime() === currentDate.getTime();
    const isDisabled = currentDate < today; // Disable nếu ngày nhỏ hơn hôm nay

    const button = createButton(i, isDisabled, isToday);
    if (!isDisabled) {
      button.addEventListener("click", handleDateClick);
    }
    datePickerDates.appendChild(button);
  }

  const firstOfNextMonth = new Date(year, month + 1, 1);

  for (let i = firstOfNextMonth.getDay(); i < 7; i++) {
    const text = firstOfNextMonth.getDate() - firstOfNextMonth.getDay() + i;
    const button = createButton(text, true, false, true);
    datePickerDates.appendChild(button);
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
