const longDesc = document.querySelector(".long-desc");

let textListDesc = longDesc.querySelectorAll("textarea[name='text[]']");
let imageListDesc = longDesc.querySelectorAll("input[name='image[]']");
let deleteDesc = longDesc.querySelectorAll(".delete-desc");

deleteDesc.forEach((button) => {
  button.addEventListener("click", function () {
    this.parentElement.remove();

    // Cập nhật lại danh sách sau khi xóa
    textListDesc = longDesc.querySelectorAll("textarea[name='text[]']");
    imageListDesc = longDesc.querySelectorAll("input[name='image[]']");
    deleteDesc = longDesc.querySelectorAll(".delete-desc");
  });
});
