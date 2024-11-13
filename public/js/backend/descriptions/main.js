import { Validator } from "../../components/validator.js";
import { handleDropdown } from "../../components/dropdown.js";

const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);

const inputSelects = $$(".select-input input");

inputSelects.forEach((inputSelect) => {
  const dropdownItemList = inputSelect
    .closest(".select-input")
    .querySelectorAll(".dropdown-item");

  handleDropdown(inputSelect, dropdownItemList);
});

const createDescBtn = $(".create-desc");
const shortDesc = $(".short-desc");
let count = 0;
let listDesc;
let deleteDesc;

createDescBtn.addEventListener("click", () => {
  count++;
  let html = document.createElement("div");
  html.classList.add("flex", "align-center", "gap-8");
  html.innerHTML = `
                <div class="form-group" style="flex: 1">
                    <div class="">
                        <label for="description" class="input-group">
                            <textarea id="description${count}" class="p-md" placeholder="Nhập mô tả ngắn" name="description[]"
                                autocomplete="off"></textarea>
                            <label for="description" class="sm input-required">
                                Description
                            </label>
                        </label>
                    </div>
                    <div class="error"></div>
                </div>
                <button type="button" class="btn btn-normal btn-outline btn-iconOnly delete-desc">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path
                            d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z" />
                    </svg>
                </button>
  `;
  const lastChild = shortDesc.lastElementChild;
  shortDesc.insertBefore(html, lastChild);

  // Cập nhật danh sách các textarea và các nút delete-desc
  listDesc = shortDesc.querySelectorAll("textarea[name='description[]']");
  deleteDesc = shortDesc.querySelectorAll(".delete-desc");

  deleteDesc.forEach((button) => {
    button.addEventListener("click", function () {
      this.parentElement.remove();

      // Cập nhật lại danh sách sau khi xóa
      listDesc = shortDesc.querySelectorAll("textarea[name='description[]']");
      deleteDesc = shortDesc.querySelectorAll(".delete-desc");
    });
  });
});

Validator({
  form: "#ShortDescCreateForm",
  formGroupSelector: ".form-group",
  errorMessageSelector: ".error",
  errorDestructiveElement: "div",
  rules: [Validator.isRequired("#product_id", "Vui lòng chọn sản phẩm")],
});

Validator({
  form: "#ShortDescUpdateForm",
  formGroupSelector: ".form-group",
  errorMessageSelector: ".error",
  errorDestructiveElement: "div",
  rules: [Validator.isRequired("#product_id", "Vui lòng chọn sản phẩm")],
});

const submitForm = $(".submitForm");
submitForm.addEventListener("click", () => {
  const rules = [Validator.isRequired("#product_id", "Vui lòng chọn sản phẩm")];
  listDesc.forEach((item) => {
    const itemId = "#" + item.getAttribute("id");
    rules.push(Validator.isRequired(itemId, "Vui lòng nhập trường này"));
  });
  Validator({
    form: "#ShortDescCreateForm",
    formGroupSelector: ".form-group",
    errorMessageSelector: ".error",
    errorDestructiveElement: "div",
    rules: rules,
  });

  Validator({
    form: "#ShortDescUpdateForm",
    formGroupSelector: ".form-group",
    errorMessageSelector: ".error",
    errorDestructiveElement: "div",
    rules: rules,
  });
});
