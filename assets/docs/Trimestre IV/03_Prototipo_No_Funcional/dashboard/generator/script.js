const generateBtn = document.getElementById("generate-btn");
const documentoInput = document.getElementById("documento");
const qrImg = document.querySelector(".qr-code img");
let preValue = '';

generateBtn.addEventListener("click", () => {
    const qrValue = documentoInput.value.trim();
    if (!qrValue || preValue === qrValue) return;
    preValue = qrValue;
    generateBtn.innerText = "Generating QR Code...";
    qrImg.src = `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${qrValue}`;
    qrImg.addEventListener("load", () => {
        generateBtn.innerText = "Generate QR Code";
    });
});

documentoInput.addEventListener("keyup", () => {
    if (!documentoInput.value.trim()) {
        qrImg.src = "";
    }
});
