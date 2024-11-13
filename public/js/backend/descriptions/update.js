const shortDesc = document.querySelector(".short-desc");

let listDesc = shortDesc.querySelectorAll("textarea[name='description[]']");
let deleteDesc = shortDesc.querySelectorAll(".delete-desc");

deleteDesc.forEach((button) => {
  button.addEventListener("click", function () {
    this.parentElement.remove();

    // Cập nhật lại danh sách sau khi xóa
    listDesc = shortDesc.querySelectorAll("textarea[name='description[]']");
    deleteDesc = shortDesc.querySelectorAll(".delete-desc");
  });
});
