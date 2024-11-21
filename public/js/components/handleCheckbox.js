function handleCheckbox(selectorCheckboxList, selectRemoveCheckedAll = null) {
  const checkboxList = selectorCheckboxList.querySelectorAll(
    "input[type='checkbox']"
  );

  if (!selectRemoveCheckedAll) return;
  selectRemoveCheckedAll.addEventListener("click", () => {
    checkboxList.forEach((checkbox) => {
      checkbox.checked = false;
    });
  });
}

export default handleCheckbox;