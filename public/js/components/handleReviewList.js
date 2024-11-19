const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);

function handleReviewList() {
  const reviewBtnList = $$(".ReviewSection-reviewBtn");
  const reviewQuoteList = $$(".ReviewQuote-quoteBody");

  let currentIndex = 0;

  function setActiveReview(index) {
    $(".ReviewSection-reviewBtn.ReviewSection-defaultBtn").classList.remove(
      "ReviewSection-defaultBtn"
    );
    $(".ReviewQuote-quoteBody.ReviewQuote-quoteBody-active").classList.remove(
      "ReviewQuote-quoteBody-active"
    );

    reviewBtnList[index].classList.add("ReviewSection-defaultBtn");
    reviewQuoteList[index].classList.add("ReviewQuote-quoteBody-active");
  }

  reviewBtnList.forEach((btn, index) => {
    const quote = reviewQuoteList[index];
    btn.onclick = function () {
      setActiveReview(index);
      currentIndex = index;
    };
  });

  setInterval(() => {
    currentIndex = (currentIndex + 1) % reviewBtnList.length;
    setActiveReview(currentIndex);
  }, 2000);
}

export default handleReviewList;
