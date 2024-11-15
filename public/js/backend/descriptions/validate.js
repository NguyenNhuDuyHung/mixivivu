import { Validator } from "../../components/validator.js";

const shortDesc = document.querySelector(".short-desc");
const submitForm = document.querySelector(".submitForm");

let listDesc;
let deleteDesc;

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
});
