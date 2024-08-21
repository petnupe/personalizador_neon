document.addEventListener('DOMContentLoaded', function () {
    const textInput = document.getElementById('text-input');
    const fontSelect = document.getElementById('font-select');
    const colorPicker = document.getElementById('color-picker');
    const sizeSlider = document.getElementById('size-slider');
    const sizeValue = document.getElementById('size-value');
    const intensitySelect = document.getElementById('intensity-select');
    const neonText = document.getElementById('neon-text');
    const preview = document.querySelector('.preview');
    const imageUpload = document.getElementById('image-upload');

    let isDragging = false;
    let startX, startY, initialLeft, initialTop;

    function updateText() {
        neonText.textContent = textInput.value;
        neonText.style.fontFamily = fontSelect.value;
        neonText.style.color = 'white';
        neonText.style.fontSize = sizeSlider.value + 'px';
        sizeValue.textContent = sizeSlider.value + 'px';

        if (intensitySelect.value == '0') {
            neonText.style.textShadow = 'none';
        } else {
            neonText.style.textShadow = `
            0 0 5px  white,
            0 0 5px  white,
            0 0 20px  ${colorPicker.value},
            0 0 20px  ${colorPicker.value},
            0 0 20px  ${colorPicker.value},
            0 0 30px ${colorPicker.value},
            0 0 30px ${colorPicker.value},
            0 0 30px ${colorPicker.value},
            0 0 40px ${colorPicker.value},
            0 0 40px ${colorPicker.value},
            0 0 40px ${colorPicker.value},
            0 0 55px ${colorPicker.value},
            0 0 55px ${colorPicker.value},
            0 0 55px ${colorPicker.value},
            0 0 75px ${colorPicker.value},
            0 0 75px ${colorPicker.value},
            0 0 75px ${colorPicker.value},
            rgb(181 181 181) 0px 1px 0px, rgb(169 169 169) 0px 2px 0px, rgb(148 148 148) 0px 3px 0px, rgb(125 125 125) 0px 4px 0px, rgb(0 0 0 / 23%) 0px 0px 5px, rgb(0 0 0 / 43%) 0px 1px 3px, rgb(0 0 0 / 40%) 1px 4px 6px, rgb(0 0 0 / 38%) 0px 5px 10px, rgb(0 0 0 / 25%) 3px 7px 12px`;
        }
    }

    function startDragging(event) {
        isDragging = true;
        startX = event.clientX || event.touches[0].clientX;
        startY = event.clientY || event.touches[0].clientY;
        const rect = neonText.getBoundingClientRect();
        initialLeft = rect.left - preview.getBoundingClientRect().left;
        initialTop = rect.top - preview.getBoundingClientRect().top;

        document.addEventListener('mousemove', dragText);
        document.addEventListener('mouseup', stopDragging);
        document.addEventListener('touchmove', dragText, { passive: false });
        document.addEventListener('touchend', stopDragging);
    }

    function dragText(event) {
        if (!isDragging) return;

        event.preventDefault(); // Previne o comportamento padrão do toque

        const previewRect = preview.getBoundingClientRect();
        const textRect = neonText.getBoundingClientRect();
        const dx = (event.clientX || event.touches[0].clientX) - startX;
        const dy = (event.clientY || event.touches[0].clientY) - startY;

        let newLeft = initialLeft + dx;
        let newTop = initialTop + dy;

        // Verifica os limites da div.preview
        if (newLeft < 0) newLeft = 0;
        if (newTop < 0) newTop = 0;
        if (newLeft + textRect.width > previewRect.width) newLeft = previewRect.width - textRect.width;
        if (newTop + textRect.height > previewRect.height) newTop = previewRect.height - textRect.height;

        neonText.style.left = newLeft + 'px';
        neonText.style.top = newTop + 'px';
    }

    function stopDragging() {
        isDragging = false;
        document.removeEventListener('mousemove', dragText);
        document.removeEventListener('mouseup', stopDragging);
        document.removeEventListener('touchmove', dragText);
        document.removeEventListener('touchend', stopDragging);
    }

    function handleImageUpload(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.style.backgroundImage = `url(${e.target.result})`;
            };
            reader.readAsDataURL(file);
        } else {
            // Se nenhuma imagem for escolhida, reverte para a imagem padrão
            preview.style.backgroundImage = 'url("./fundo.jpeg")';
        }
    }

    textInput.addEventListener('input', updateText);
    fontSelect.addEventListener('change', updateText);
    colorPicker.addEventListener('input', updateText);
    sizeSlider.addEventListener('input', updateText);
    intensitySelect.addEventListener('change', updateText);
    imageUpload.addEventListener('change', handleImageUpload);

    // Inicializa a exibição
    updateText();

    // Adiciona eventos de arrastar
    neonText.addEventListener('mousedown', startDragging);
    neonText.addEventListener('touchstart', startDragging);
});
