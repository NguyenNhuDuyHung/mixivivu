function handleDropdown(dropInputSelect, dropInputSelectItemList) {
  dropInputSelectItemList.forEach((item) => {
    item.addEventListener("mousedown", () => {
      dropInputSelect.value = item.getAttribute("value");
    });
  });
}

export { handleDropdown };