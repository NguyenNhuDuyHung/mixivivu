function handleFileImageUpload(
  inputElement,
  previewImageElement,
  tempImage,
  flag = false
) {
  const fileSelected = document.getElementById(inputElement).files;
  const previewImage = document.querySelector(previewImageElement);
  const tempImg = document.querySelector(tempImage);
  const uploadImgBtn = document.querySelector(".upload-image-btn");
  if (tempImg) {
    previewImage.removeChild(tempImg);
  }

  if (fileSelected.length > 0) {
    for (let i = 0; i < fileSelected.length; i++) {
      var fileToLoad = fileSelected[i];
      var fileReader = new FileReader();
      fileReader.onload = function (fileLoadedEvent) {
        var srcData = fileLoadedEvent.target.result;
        var newImage = document.createElement("img");
        newImage.classList.add("preview-upload-image");
        newImage.src = srcData;
        if (flag) {
          previewImage.innerHTML = "";
          previewImage.appendChild(newImage);
        } else {
          previewImage.innerHTML += newImage.outerHTML;
        }
        uploadImgBtn.style.display = "none";
      };
      fileReader.readAsDataURL(fileToLoad);
    }
  }
}

export { handleFileImageUpload };
