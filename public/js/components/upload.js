function handleFileImageUpload(
  inputElement,
  previewImageElement,
  tempImage,
  uploadBtn,
  flag = false
) {
  const fileSelected = inputElement.files;
 
  if (tempImage && previewImageElement.contains(tempImage)) {
    previewImageElement.removeChild(tempImage);
  }

  if (fileSelected.length > 0) {
    let tempImage = [];
    for (let i = 0; i < fileSelected.length; i++) {
      const fileToLoad = fileSelected[i];
      const fileReader = new FileReader();
      fileReader.onload = function (fileLoadedEvent) {
        const srcData = fileLoadedEvent.target.result;
        const newImage = document.createElement("img");
        newImage.classList.add("preview-upload-image");
        newImage.src = srcData;
        if (flag) {
          previewImageElement.innerHTML = "";
          previewImageElement.appendChild(newImage);
        } else {
          tempImage.push(newImage);
          previewImageElement.appendChild(newImage);
        }
        uploadBtn.style.display = "none";
      };
      fileReader.readAsDataURL(fileToLoad);
    }
  }
}

export { handleFileImageUpload };
