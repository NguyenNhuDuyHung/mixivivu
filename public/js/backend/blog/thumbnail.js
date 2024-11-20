import { handleFileImageUpload } from "../../components/upload.js";
const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);

const uploadThumbnail = $("#upload-thumbnail");

uploadThumbnail.addEventListener("change", (e) => {
  handleFileImageUpload(
    e.target, // Input element
    document.querySelector(".preview-thumb"), // Preview container
    document.querySelector(".temp-thumb"), // Temp image
    document.querySelector(".upload-thumb-btn"), // Upload button
    true // Flag to replace image
  );
});