const toggleFaq = (
  cardSelector,
  headerSelector,
  collapseSelector,
  pathSelector
) => {
  const listCards = document.querySelectorAll(cardSelector);
  const listHeaders = document.querySelectorAll(headerSelector);
  const listCollapses = document.querySelectorAll(collapseSelector);

  listHeaders.forEach((card, index) => {
    card.addEventListener("click", () => {
      // Toggle class cho header và collapse
      listHeaders[index].classList.toggle("Collapse-open-header");
      listCollapses[index].classList.toggle("Collapse-collapse-content");

      // Thay đổi chiều cao của collapse
      listCollapses[index].style.height =
        listCollapses[index].scrollHeight + "px";

      // Thay đổi biểu tượng (+/-)
      const path = card.querySelector(pathSelector);
      if (path) {
        const isMinus = path.getAttribute("d") === "M6 12L18 12"; // Đường dẫn của dấu "-"
        path.setAttribute("d", isMinus ? "M6 12H18M12 6V18" : "M6 12L18 12"); // Đổi giữa "+" và "-"
      }

      // Đặt chiều cao về 0 khi đóng
      if (
        listCollapses[index].classList.contains("Collapse-collapse-content")
      ) {
        listCollapses[index].style.height = "0px";
      }
    });
  });
};

export default toggleFaq;