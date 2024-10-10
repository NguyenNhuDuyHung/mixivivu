const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);

function handleInreaseAndDecreaseBtn(
  listElementSelector,
  listBtnSelector,
  totalOutputSelector = null,
  listOutputSelector = null
) {
  let sumPrice = 0;

  const listElementList = $$(listElementSelector);
  const listBtnList = $$(listBtnSelector);
  const listOutputList = $$(listOutputSelector);
  const totalOutput = $(totalOutputSelector);

  listElementList.forEach((listElement, index) => {
    const minusBtn = listBtnList[index].querySelector("div:first-child");
    const plusBtn = listBtnList[index].querySelector("div:last-child");

    minusBtn.addEventListener("click", () => {
      if (!totalOutputSelector) {
        if (listOutputList[index].innerText > 0)
          listOutputList[index].innerText--;
      } else {
        if (
          listBtnList[index].querySelector("div[class='label md']").innerText >
          0
        ) {
          listBtnList[index].querySelector("div[class='label md']").innerText--;
          sumPrice -= Number(
            listOutputList[index].innerText.slice(0, -2).replace(/,/g, "")
          );
          totalOutput.innerText = sumPrice.toLocaleString() + " đ";
        }
      }
    });

    plusBtn.addEventListener("click", () => {
      if (!totalOutputSelector) {
        listOutputList[index].innerText++;
      } else {
        listBtnList[index].querySelector("div[class='label md']").innerText++;
        sumPrice += Number(
          listOutputList[index].innerText.slice(0, -2).replace(/,/g, "")
        );
        totalOutput.innerText = sumPrice.toLocaleString() + " đ";
      }
    });
  });
}

export { handleInreaseAndDecreaseBtn };
