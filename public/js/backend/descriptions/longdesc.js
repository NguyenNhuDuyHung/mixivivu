import { handleFileImageUpload } from "../../components/upload.js";
import { handleDropdown } from "../../components/dropdown.js";
import { Validator } from "../../components/validator.js";

const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);

const inputSelects = $$(".select-input input");

inputSelects.forEach((inputSelect) => {
  const dropdownItemList = inputSelect
    .closest(".select-input")
    .querySelectorAll(".dropdown-item");

  handleDropdown(inputSelect, dropdownItemList);
});

const createHeaderBtn = $(".create-header");
const createParagraphBtn = $(".create-paragraph");
const createImageBtn = $(".create-image");
const longDesc = $(".long-desc");
let listDesc;
let deleteDesc;

createHeaderBtn.addEventListener("click", () => {
  let html = document.createElement("div");
  html.classList.add("flex", "align-center", "gap-8");
  html.innerHTML = `
                <div class="form-group" style="flex: 1">
                    <div class="">
                        <label for="header" class="input-group">
                            <textarea id="header" class="p-md" placeholder="Nhập text" name="text[]" data-type="1"
                                autocomplete="off"></textarea>
                                <input type="hidden" name="type[]" value="1">
                            <label for="header" class="sm input-required">
                                Header
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
  const lastChild = longDesc.lastElementChild;
  longDesc.insertBefore(html, lastChild);

  createHeaderBtn.style.display = "none";

  // Cập nhật danh sách các textarea và các nút delete-desc
  listDesc = longDesc.querySelectorAll("textarea[name='text[]']");
  deleteDesc = longDesc.querySelectorAll(".delete-desc");

  deleteDesc.forEach((button) => {
    button.addEventListener("click", function () {
      this.parentElement.remove();
      createHeaderBtn.style.display = "block";

      // Cập nhật lại danh sách sau khi xóa
      listDesc = longDesc.querySelectorAll("textarea[name='text[]']");
      deleteDesc = longDesc.querySelectorAll(".delete-desc");
    });
  });
});

let countParagraph = 0;
createParagraphBtn.addEventListener("click", () => {
  countParagraph++;
  let html = document.createElement("div");
  html.classList.add("flex", "align-center", "gap-8");
  html.innerHTML = `
                  <div class="form-group" style="flex: 1">
                    <div class="">
                        <label for="paragraph${countParagraph}" class="input-group">
                            <textarea id="paragraph${countParagraph}" class="p-md" placeholder="Nhập text" name="text[]" data-type="2"
                                autocomplete="off"></textarea>
                                <input type="hidden" name="type[]" value="2">
                            <label for="paragraph${countParagraph}" class="sm input-required">
                                Paragraph
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
  const lastChild = longDesc.lastElementChild;
  longDesc.insertBefore(html, lastChild);

  // Cập nhật danh sách các textarea và các nút delete-desc
  listDesc = longDesc.querySelectorAll("textarea[name='text[]']");
  deleteDesc = longDesc.querySelectorAll(".delete-desc");

  deleteDesc.forEach((button) => {
    button.addEventListener("click", function () {
      this.parentElement.remove();

      // Cập nhật lại danh sách sau khi xóa
      listDesc = longDesc.querySelectorAll("textarea[name='text[]']");
      deleteDesc = longDesc.querySelectorAll(".delete-desc");
    });
  });
});

let countImage = 0;
let uploadImages;
createImageBtn.addEventListener("click", () => {
  countImage++;
  let html = document.createElement("div");
  html.innerHTML = `
                <div class="">
                    <div class="group-input" style="flex: 1">
                        <div class="form-group">
                            <div class="">
                                <label for="caption${countImage}" class="input-group">
                                    <input id="caption${countImage}" class="p-md" placeholder="Nhập caption" name="caption[]"
                                        value="" autocomplete="off">
                                    <label for="caption${countImage}" class="sm input-required">
                                        Caption
                                    </label>
                                </label>
                            </div>
                            <div class="error"></div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for=upload-image${countImage}" class="sm input-required">Chọn 1 ảnh</label>
                        <label for=upload-image${countImage}" class="flex align-center">
                            <div class="flex align-center gap-16">
                                <input type="file" id="upload-image${countImage}" name="image[]" data-type="3">
                                <input type="hidden" name="type[]" value="3">
                                <label for="upload-image${countImage}" class="upload-images-btn btn btn-primary btn-normal">
                                    Choose file
                                </label>
                                <div class="preview-image">
                                    <div class="temp-img">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100" fill="none">
                                            <rect width="100" height="100" rx="5" fill="#E2E6EC" />
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M28.6667 37C28.6667 34.6068 30.6068 32.6667 33.0001 32.6667H67.0001C69.3933 32.6667 71.3334 34.6068 71.3334 37V63.6667C71.3334 66.0599 69.3933 68 67.0001 68H33.0001C30.6068 68 28.6667 66.0599 28.6667 63.6667V37ZM33.0001 34.6667C31.7114 34.6667 30.6667 35.7113 30.6667 37V63.6667C30.6667 64.9553 31.7114 66 33.0001 66H67.0001C68.2887 66 69.3334 64.9553 69.3334 63.6667V37C69.3334 35.7113 68.2887 34.6667 67.0001 34.6667H33.0001Z" fill="#B2B9C4" />
                                            <ellipse cx="38.6668" cy="42" rx="4.33333" ry="4.33333" fill="#B2B9C4" />
                                            <path d="M34.3335 60.3333V58.357C34.3335 57.915 34.5091 57.4911 34.8217 57.1785L40.2098 51.7904C40.8389 51.1613 41.8511 51.1372 42.5094 51.7357L43.8407 52.946C44.4923 53.5383 45.4923 53.5216 46.1236 52.9077L55.8219 43.4789C56.4753 42.8436 57.5178 42.851 58.1622 43.4954L65.8453 51.1785C66.1579 51.4911 66.3335 51.915 66.3335 52.357V60.3333C66.3335 61.2538 65.5873 62 64.6668 62H36.0002C35.0797 62 34.3335 61.2538 34.3335 60.3333Z" fill="#B2B9C4" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </label>
                    <div class="error"></div>
                </div>

                <button type="button" class="btn btn-normal btn-outline btn-iconOnly delete-desc">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                        <path d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z" />
                    </svg>
                </button>
    `;

  const lastChild = longDesc.lastElementChild;
  longDesc.insertBefore(html, lastChild);

  // Lấy input vừa thêm
  const newInput = html.querySelector("input[name='image[]']");

  // Thêm sự kiện change cho input vừa tạo
  newInput.addEventListener("change", (e) => {
    handleFileImageUpload(
      e.target, // Input element
      newInput.parentElement.querySelector(".preview-image"),
      newInput.parentElement
        .querySelector(".preview-image")
        .querySelector(".temp-img"), // Preview container
      newInput.parentElement.querySelector(".upload-images-btn"), // Upload button
      false // Flag to append image
    );
  });

  // Cập nhật danh sách nút delete và sự kiện xóa
  const deleteDesc = longDesc.querySelectorAll(".delete-desc");
  deleteDesc.forEach((button) => {
    button.addEventListener("click", function () {
      this.parentElement.remove();

      // Cập nhật lại danh sách sau khi xóa
      uploadImages = longDesc.querySelectorAll("input[name='image[]']");
    });
  });
});

Validator({
  form: "#LongDescCreateForm",
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
    rules.push(Validator.isRequired(itemId));
  });
  Validator({
    form: "#LongDescCreateForm",
    formGroupSelector: ".form-group",
    errorMessageSelector: ".error",
    errorDestructiveElement: "div",
    rules,
  });
});
