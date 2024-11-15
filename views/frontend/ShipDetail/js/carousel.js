const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);

function Carousel() {
  const previousBtn = $(".Carousel-left-btn");
  const nextBtn = $(".Carousel-right-btn");

  const carouselItems = $$(".Carousel-carouselItem");

  let images = [
    "image1.jpg",
    "image2.jpg",
    "image3.jpg",
    "image4.jpg",
    "image5.jpg",
  ];

  let currentIndex = 0;
  nextBtn.addEventListener("click", () => {
    let temp = [];
    temp.push(carouselItems[0].querySelector("img").src);
    temp.push(carouselItems[1].querySelector("img").src);
    temp.push(carouselItems[2].querySelector("img").src);

    carouselItems[0].querySelector("img").src = temp[1];
    carouselItems[1].querySelector("img").src = temp[2];
    carouselItems[2].querySelector("img").src = images[currentIndex];

    currentIndex++;
    if (currentIndex > images.length - 1) {
      currentIndex = 0;
    }
  });

  previousBtn.addEventListener("click", () => {
    let temp = [];

    temp.push(carouselItems[0].querySelector("img").src);
    temp.push(carouselItems[1].querySelector("img").src);
    temp.push(carouselItems[2].querySelector("img").src);

    carouselItems[2].querySelector("img").src = temp[1];
    carouselItems[1].querySelector("img").src = temp[0];
    carouselItems[0].querySelector("img").src = images[currentIndex];

    currentIndex--;
    if (currentIndex < 0) {
      currentIndex = images.length - 1;
    }
  });
}

export default Carousel;
