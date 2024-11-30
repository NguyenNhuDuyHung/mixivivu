import handleCheckbox from "../../components/handleCheckbox.js";
import toggleFaq from "../../components/toggleFag.js";

const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);

handleCheckbox(
  $(".SearchPageDetail-filter-feature"),
  $(".SearchPageDetail-side-bar-header button")
);

toggleFaq(
  ".fresnel-container .Card-card", // Selector của các thẻ Card
  ".SearchPageDetail-custom-header", // Selector của header tùy chỉnh
  ".Collapse-collapse-content", // Selector của nội dung collapse
  "path" // Selector của phần tử path trong SVG
);
