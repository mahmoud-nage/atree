let designSide = "front"; // as default value
let lastImg; // Declare lastImg outside to keep track of the last uploaded image
let lastText; // Declare lastImg outside to keep track of the last uploaded image
let cropper;
let isClickedAddDesign = false;
let GLOBAL_PRODUCT = JSON.parse(localStorage.getItem('product'));
let TEM_Product = {...GLOBAL_PRODUCT};
let allProducts;

document.getElementById('file-input-trigger').addEventListener('click', fileInputTrigger)
document.getElementById('file-input').addEventListener('change', handleFileSelect);
document.getElementById('existing-design').addEventListener('click', handleAddExistingDesignClick);
document.getElementById('close-exsiting-designs-div').addEventListener('click', handleCloseExistingDesignClick);
document.getElementById('add-text').addEventListener('click', addText);
document.getElementById('Layers').addEventListener('click', getLayers);
document.getElementById('image-rotate-right-button').addEventListener('click', rotateRightImage);
document.getElementById("image-rotate-left-button").addEventListener('click', rotateLeftImage);
document.getElementById('font-family').addEventListener('change', changeFontFamily);
document.getElementById('bold-text').addEventListener('click', toggleBold);
document.getElementById('italic-text').addEventListener('click', toggleItalic);
document.getElementById('strikethrough-text').addEventListener('click', toggleStrikethrough);
document.getElementById('underline-text-button').addEventListener('click', toggleUnderline);
document.getElementById('front-img-button').addEventListener('click', setFrontImage);
document.getElementById('back-img-button').addEventListener('click', setBackImage);
const finishBtn = document.getElementById('finish-btn');
const cropContainer = document.getElementById('crop-container');
const cropBtn = document.getElementById('crop-btn');
const boundaryBox = document.getElementById('boundary-box');

function fileInputTrigger() {
    document.getElementById('file-input').click();
}

function handleFileSelect(event) {
    const files = event.target.files;
    const designArea = document.getElementById('design-area');
    const imageControls = document.getElementById('image-controls');
    const textControls = document.getElementById('text-controls');
    textControls.style.display = 'none';
    imageControls.classList.add('image-controls');
    imageControls.style.display = 'flex';

    for (const file of files) {
        const img = document.createElement('img');
        img.src = URL.createObjectURL(file);
        // img.style.width = '100px'; // Initial size
        // img.style.height = '100px';
        img.style.width = '50px'; // Initial size
        img.classList.add('draggable', 'resizable');
        img.style.position = 'absolute';
        img.style.top = '0';
        img.style.left = '0';
        img.id = file.lastModified;
        lastImg = img; // Update lastImg to the current image

        img.addEventListener('click', () => {
            lastImg = img;
            imageControls.style.display = 'flex';
            textControls.style.display = 'none';
        });

        // Add delete button to the image
        const deleteButton = document.getElementById('image-delete-button');
        deleteButton.addEventListener('click', () => {

            const inputField = document.getElementById('file-input');
            // inputField.value = '';

            lastImg.remove();
            imageControls.style.display = 'none';
            if (designArea.childNodes.length === 0) {
                imageControls.style.display = 'none';
            }
            const index = TEM_Product[designSide].boundaryBoxChildren.indexOf(lastImg);
            if (index > -1) {
                TEM_Product[designSide].boundaryBoxChildren.splice(index, 1);
            }
        });
        TEM_Product[designSide].boundaryBoxChildren.push(img)
        boundaryBox.appendChild(img);
    }

    const rangeInput = document.getElementById('image-size');
    rangeInput.max = boundaryBox.style.width
    rangeInput.removeEventListener('input', updateImageSize); // Remove previous listener
    rangeInput.addEventListener('input', updateImageSize);

    function updateImageSize() {
        const imageSize = rangeInput.value;
        if (lastImg) { // Ensure lastImg is defined
            lastImg.style.width = `${imageSize}px`;
            const index = TEM_Product[designSide].boundaryBoxChildren.findIndex(child => child.id === lastImg.id);
            TEM_Product[designSide].boundaryBoxChildren[index].style.width = lastImg.style.width;
        }
    }

    centerElement(lastImg);
    initializeInteract();
    const inputField = document.getElementById('file-input');
    // inputField.value = '';
}

function addText() {
    TEM_Product = {...GLOBAL_PRODUCT}
    const designArea = document.getElementById('design-area');
    const textControls = document.getElementById('text-controls');
    const imageControls = document.getElementById('image-controls');
    imageControls.style.display = 'none';
    textControls.classList.add('text-controls');
    textControls.style.display = 'flex';
    const textElement = document.createElement('div');
    textElement.style.maxWidth = boundaryBox.offsetWidth
    textElement.style.maxHeight = boundaryBox.offsetHeight
    textElement.classList.add('text-element', 'draggable', 'resizable');
    textElement.contentEditable = 'true';
    textElement.innerText = 'Enter text here';
    textElement.style.position = 'absolute';
    textElement.style.top = '0';
    textElement.style.left = '0';
    textElement.style.fontSize = '12px';
    textElement.style.fontWeight = "normal";
    textElement.style.fontFamily = 'Arial';
    textElement.style.color = 'rgb(84, 84, 84)';
    textElement.style.padding = '5px';
    lastText = textElement

    textElement.addEventListener('click', () => {

        lastText = textElement;
        textControls.style.display = 'flex';
        imageControls.style.display = 'none';
    });

    const rangeInput = document.getElementById('text-size');
    rangeInput.addEventListener('input', () => {
        const textSize = rangeInput.value;
        lastText.style.fontSize = `${textSize}px`;
    });

    const colorInput = document.getElementById('text-color');
    colorInput.addEventListener('input', () => {
        const textColor = colorInput.value;
        lastText.style.color = textColor;
    });


    // Add delete button to the text element
    const deleteButton = document.getElementById('text-delete-button');
    deleteButton.addEventListener('click', () => {
        lastText.remove();
        textControls.style.display = 'none';
        if (designArea.childNodes.length === 0) {
            textControls.style.display = 'none';
        }
        const index = TEM_Product[designSide].boundaryBoxChildren.indexOf(lastText);
        if (index > -1) {
            TEM_Product[designSide].boundaryBoxChildren.splice(index, 1);
        }
    });

    boundaryBox.appendChild(textElement);
    centerElement(lastText);
    initializeInteract();
    TEM_Product[designSide].boundaryBoxChildren.push(textElement)

}

// Center all elements with class "draggable" initially

function centerElement(target) {
    if (target.tagName !== "DIV") {
        let imageHeight;
        target.addEventListener('load', () => {
            // Get the height of the image element
            imageHeight = target.offsetHeight; // or use imgElement.clientHeight
            const parentRect = boundaryBox.getBoundingClientRect();
            const targetRect = target.getBoundingClientRect();
            const x = (parentRect.width - targetRect.width) / 2;
            const y = (parentRect.height - imageHeight) / 2;
            target.style.transform = `translate(${x}px, ${y}px)`;
            target.setAttribute('data-x', x);
            target.setAttribute('data-y', y);
        });
    } else {
        const parentRect = boundaryBox.getBoundingClientRect();
        const targetRect = target.getBoundingClientRect();
        const x = (parentRect.width - targetRect.width) / 2;
        const y = (parentRect.height - targetRect.height) / 2;


        target.style.transform = `translate(${x}px, ${y}px)`;
        target.setAttribute('data-x', x);
        target.setAttribute('data-y', y);
    }
}

function initializeInteract() {

    interact('.draggable').draggable({
        listeners: {
            move(event) {
                const target = event.target;
                const x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx;
                const y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;

                // Restrict movement within the container
                const parentRect = boundaryBox.getBoundingClientRect();
                const targetRect = target.getBoundingClientRect();

                // Calculate the new position
                const newX = Math.min(Math.max(x, 0), parentRect.width - targetRect.width);
                const newY = Math.min(Math.max(y, 0), parentRect.height - targetRect.height);

                target.style.transform = `translate(${newX}px, ${newY}px) rotate(${target.dataset.rotation || 0}deg)`;
                target.setAttribute('data-x', newX);
                target.setAttribute('data-y', newY);
            }
        },
        modifiers: [
            interact.modifiers.restrict({
                restriction: 'parent',
                endOnly: true
            })
        ]
    });

    interact('.resizable').resizable({
        edges: {left: true, right: true, bottom: true, top: true},
        listeners: {
            move(event) {
                const target = event.target;
                let x = (parseFloat(target.getAttribute('data-x')) || 0);
                let y = (parseFloat(target.getAttribute('data-y')) || 0);

                // Update the element's style
                target.style.width = `${event.rect.width}px`;
                target.style.height = `${event.rect.height}px`;

                // Translate when resizing from top or left edges
                x += event.deltaRect.left;
                y += event.deltaRect.top;

                target.style.transform = `translate(${x}px, ${y}px)`;

                target.setAttribute('data-x', x);
                target.setAttribute('data-y', y);
            }
        },
        modifiers: [
            interact.modifiers.restrictSize({
                min: {width: 50, height: 50}
            }),
            interact.modifiers.restrictEdges({
                outer: 'parent',
                endOnly: true
            })
        ],
        inertia: true
    });
}

function generateCards() {
    isClickedAddDesign = true;
    const designArea = document.getElementById('design-area');
    const designAreaClone = designArea.cloneNode(true);
    designAreaClone.style.width = `${designArea.offsetWidth}px`;
    designAreaClone.style.height = `${designArea.offsetHeight}px`;
    const productItem = document.createElement('li');
    designAreaClone.childNodes[1].style.border = 'none';

    TEM_Product.front.boundaryBoxChildren.forEach(child => {
        if (designAreaClone.childNodes[1].childNodes.length) {
            if (child.nodeType === 1) {
                const x = parseFloat(child.getAttribute('data-x')) || 0;
                const y = parseFloat(child.getAttribute('data-y')) || 0;

                if (child.tagName === 'IMG') {
                    child.classList.remove('draggable', 'resizable');
                    let translateValues = child.style.transform.match(/translate\(([^)]+)\)/)[1].split(',');
                    child.dataset.translateValues = translateValues;
                    child.style.transform = `rotate(${child.dataset.rotation || 0}deg)`;
                    const width = parseFloat(child.style.width);
                    const height = parseFloat(child.style.height);
                    child.style.width = `${width}px`;
                    child.style.height = `${height}px`;
                }

                if (child.tagName === 'DIV' && child.classList.contains('text-element')) {
                    child.classList.remove('draggable', 'resizable');
                    let translateValues = child.style.transform.match(/translate\(([^)]+)\)/)[1].split(',');
                    child.dataset.translateValues = translateValues;
                    child.style.transform = ''; // Remove transform styles
                    const fontSize = parseFloat(window.getComputedStyle(child).fontSize);
                    child.style.fontSize = `${fontSize}px`;
                    const padding = parseFloat(window.getComputedStyle(child).padding);
                    child.style.padding = `${padding}px`;
                    child.style.textWrap = "nowrap";
                }

                child.style.position = 'absolute';
                child.style.left = `${x}px`;
                child.style.top = `${y}px`;
            }
            productItem.appendChild(designAreaClone);
        }
    });

    TEM_Product.back.boundaryBoxChildren.forEach(child => {
        if (designAreaClone.childNodes[1].childNodes.length) {
            if (child.nodeType === 1) {
                const x = parseFloat(child.getAttribute('data-x')) || 0;
                const y = parseFloat(child.getAttribute('data-y')) || 0;

                if (child.tagName === 'IMG') {
                    child.classList.remove('draggable', 'resizable');
                    let translateValues = child.style.transform.match(/translate\(([^)]+)\)/)[1].split(',');
                    child.dataset.translateValues = translateValues;
                    child.style.transform = `rotate(${child.dataset.rotation || 0}deg)`;
                    const width = parseFloat(child.style.width);
                    const height = parseFloat(child.style.height);
                    child.style.width = `${width}px`;
                    child.style.height = `${height}px`;
                }

                if (child.tagName === 'DIV' && child.classList.contains('text-element')) {
                    child.classList.remove('draggable', 'resizable');
                    let translateValues = child.style.transform.match(/translate\(([^)]+)\)/)[1].split(',');
                    child.dataset.translateValues = translateValues;
                    child.style.transform = ''; // Remove transform styles
                    const fontSize = parseFloat(window.getComputedStyle(child).fontSize);
                    child.style.fontSize = `${fontSize}px`;
                    const padding = parseFloat(window.getComputedStyle(child).padding);
                    child.style.padding = `${padding}px`;
                }

                child.style.position = 'absolute';
                child.style.left = `${x}px`;
                child.style.top = `${y}px`;
            }
            productItem.appendChild(designAreaClone);
        }
    });

    const myDesignObject = generateDesignObject(TEM_Product);

    const productDesign = document.createElement('li');

    const boundaryBoxChildrenHTMLFront = myDesignObject.front.boundaryBoxChildren.map(child => {
        const {tagName, attributes, innerText} = child;
        let attributesString = Object.entries(attributes).map(([key, value]) => `${key}='${value}'`).join(' ');
        if (innerText) {
            return `<${tagName} ${attributesString}>${innerText}</${tagName}>`;
        } else {
            return `<${tagName} ${attributesString}></${tagName}>`;
        }
    }).join('');

    const boundaryBoxChildrenHTMLBack = myDesignObject.back.boundaryBoxChildren.map(child => {
        const {tagName, attributes, innerText} = child;
        let attributesString = Object.entries(attributes).map(([key, value]) => `${key}='${value}'`).join(' ');
        if (innerText) {
            return `<${tagName} ${attributesString}>${innerText}</${tagName}>`;
        } else {
            return `<${tagName} ${attributesString}></${tagName}>`;
        }
    }).join('');

    productDesign.innerHTML = `
            <div id="image-front" style="border: 0px dashed rgb(255, 5, 5); position: relative; width: ${myDesignObject[designSide].boundaryBox.width}; height:${myDesignObject[designSide].boundaryBox.height}; top: ${myDesignObject[designSide].boundaryBox.top}; left: ${myDesignObject[designSide].boundaryBox.left};">${boundaryBoxChildrenHTMLFront}</div>
            <div id="image-back" style="border: 0px dashed rgb(255, 5, 5); position: relative; width: ${myDesignObject[designSide].boundaryBox.width}; height:${myDesignObject[designSide].boundaryBox.height}; top: ${myDesignObject[designSide].boundaryBox.top}; left: ${myDesignObject[designSide].boundaryBox.left};">${boundaryBoxChildrenHTMLBack}</div>
    `;


    // Append the productDesign to the DOM
    document.body.appendChild(productDesign);

    // Convert the front and back to images after a short delay to ensure the DOM updates
    setTimeout(() => {
        convertFrontToImage(productDesign);
        convertBackToImage(productDesign);
    }, 100);

    return productDesign;
}

function convertFrontToImage(productDesign) {
    html2canvas(productDesign, {useCORS: true, allowTaint: true}).then(canvas => {
        let img = canvas.toDataURL("image/png");
        let imgElement = document.createElement("img");
        imgElement.src = img;
        const elementnew = document.createElement("input")
        elementnew.value(imgElement);
    }).catch(error => {
        console.error("Error converting front to image: ", error);
    });
}

function convertBackToImage(productDesign) {
    html2canvas(productDesign, {useCORS: true, allowTaint: true}).then(canvas => {
        let img = canvas.toDataURL("image/png");
        let imgElement = document.createElement("img");
        imgElement.src = img;
        const elementnew = document.getElementById("card-product1")
        elementnew.appendChild(imgElement);
    }).catch(error => {
        console.error("Error converting back to image: ", error);
    });
}


function getLayers() {
    const layersContainer = document.getElementById('layers-container');
    const designArea = document.getElementById('design-area');

    // Function to update the layers
    function updateLayers() {
        // Clear the layers container before adding new layers
        while (layersContainer.firstChild) {
            layersContainer.removeChild(layersContainer.firstChild);
        }

        // Create and style the hide button
        const hideButton = document.createElement('button');
        hideButton.innerHTML = '<i class="fa-solid fa-xmark"></i>';
        hideButton.classList.add('btn-custom', 'btn-primary', 'bg-primary-gridant');

        hideButton.style.backgroundColor = 'red';
        hideButton.style.color = 'white';
        hideButton.style.display = 'flex';
        hideButton.style.justifyContent = 'center';
        hideButton.style.alignItems = 'center';
        hideButton.style.width = '20px';
        hideButton.style.height = '30px';

        hideButton.style.position = 'absolute';
        hideButton.style.top = '10px';
        hideButton.style.left = '10px';
        hideButton.addEventListener('click', () => {
            layersContainer.style.display = 'none';
        });
        layersContainer.appendChild(hideButton);

        const header = document.createElement('h3');
        header.innerText = 'Layers';
        header.style.display = 'flex';
        header.style.justifyContent = 'center';
        layersContainer.appendChild(header);

        let hasChildren = false;

        for (const child of designArea.childNodes[1].childNodes) {
            if (child.tagName === 'IMG' || child.classList?.contains('text-element')) {
                hasChildren = true;

                const deleteButton = document.createElement('button');
                deleteButton.innerHTML = '<i class="fa-solid fa-trash"></i>';
                deleteButton.classList.add('btn-custom', 'btn-primary', 'bg-primary-gridant');
                deleteButton.style.marginLeft = '0';
                deleteButton.style.marginRight = '0';

                const clone = child.cloneNode(true);
                const layerItem = document.createElement('div');

                layerItem.classList.add('layer-item', 'exsiting-designs-item');
                layerItem.style.borderBottom = '0.1px solid rgba(113, 113, 110, 0.2)';
                clone.classList.remove('draggable', 'resizable', 'text-element');
                clone.style.display = 'flex';
                clone.contentEditable = "false";
                clone.style = '';


                if (clone.tagName === 'IMG') {
                    clone.style.height = '50px';
                }

                deleteButton.addEventListener('click', () => {
                    // Remove the element from the design area
                    designArea.childNodes[1].removeChild(child);

                    // Remove the image from the TEM_Product[designSide].boundaryBoxChildren array
                    const index = TEM_Product[designSide].boundaryBoxChildren.findIndex(el => el.id === child.id);
                    if (index > -1) {
                        TEM_Product[designSide].boundaryBoxChildren.splice(index, 1);
                    }

                    // Update the layers
                    updateLayers();
                });

                layerItem.appendChild(clone);
                layerItem.appendChild(deleteButton);
                layerItem.classList.add("w-100");
                layersContainer.appendChild(layerItem);
                layersContainer.classList.add('col-3', 'col-md-4', 'my-2');
            }
        }

        if (!hasChildren) {
            layersContainer.style.display = "none";
        } else {
            layersContainer.style.display = "flex";
        }
    }

    // Create a MutationObserver to watch for changes in the design area
    const observer = new MutationObserver(updateLayers);

    // Configure the observer to watch for changes to child elements and their attributes
    observer.observe(designArea.childNodes[1], {
        childList: true,
        attributes: true,
        subtree: true
    });

    // Initial update of layers
    updateLayers();
}


function rotateRightImage() {
    if (lastImg) {
        const currentRotation = lastImg.dataset.rotation || 0;
        const newRotation = (parseFloat(currentRotation) + 45) % 360;
        lastImg.style.transform = `translate(${lastImg.getAttribute('data-x') || 0}px, ${lastImg.getAttribute('data-y') || 0}px) rotate(${newRotation}deg)`;
        lastImg.dataset.rotation = newRotation;
    }
}

function rotateLeftImage() {
    if (lastImg) {
        const currentRotation = lastImg.dataset.rotation || 0;
        const newRotation = (parseFloat(currentRotation) - 45) % 360;
        lastImg.style.transform = `translate(${lastImg.getAttribute('data-x') || 0}px, ${lastImg.getAttribute('data-y') || 0}px) rotate(${newRotation}deg)`;
        lastImg.dataset.rotation = newRotation;
    }
}

function changeFontFamily() {
    const fontFamily = document.getElementById('font-family').value;
    if (lastText) {
        lastText.style.fontFamily = fontFamily;
    }
}

cropBtn.addEventListener('click', () => {
    cropper = new Cropper(lastImg, {
        aspectRatio: 0,
        viewMode: 0,
    });
    cropBtn.disabled = false;
    if (cropper) {
        if (cropper.cropped) {
            const croppedImage = cropper.getCroppedCanvas().toDataURL();
            cropper.destroy();
            lastImg.src = croppedImage;
            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 1,
                autoCropArea: 1,
            });
        } else {
            cropper.crop();
        }
        cropBtn.style.display = 'none';
        finishBtn.style.display = 'flex';
    }
});

finishBtn.addEventListener('click', () => {

    if (cropper) {
        const croppedImage = cropper.getCroppedCanvas().toDataURL();
        cropper.destroy();
        lastImg.src = croppedImage;
    }
    cropBtn.style.display = 'flex';
    finishBtn.style.display = 'none';
});

function toggleBold() {
    if (lastText) {
        if (lastText.style.fontWeight === 'bold') {
            lastText.style.fontWeight = 'normal';
        } else {
            lastText.style.fontWeight = 'bold';
        }
    }
}

function toggleItalic() {
    if (lastText) {
        if (lastText.style.fontStyle === 'italic') {
            lastText.style.fontStyle = 'normal';
        } else {
            lastText.style.fontStyle = 'italic';
        }
    }
}

function toggleStrikethrough() {
    if (lastText) {
        if (lastText.style.textDecoration === 'line-through') {
            lastText.style.textDecoration = 'none';
        } else {
            lastText.style.textDecoration = 'line-through';
        }
    }
}

function toggleUnderline() {
    if (lastText) {
        if (lastText.style.textDecoration === 'underline') {
            lastText.style.textDecoration = 'none';
        } else {
            lastText.style.textDecoration = 'underline';
        }
    }
}

function setFrontImage() {
    let product = TEM_Product || GLOBAL_PRODUCT;
    designSide = "front";
    const frontDiv = document.getElementById('front-img-button');
    const backDiv = document.getElementById('back-img-button');
    frontDiv.style.backgroundColor = '#6200ea';
    frontDiv.style.color = 'white';
    backDiv.style.backgroundColor = 'white';
    backDiv.style.color = '#6200ea';
    lastImg = "";
    const imageControls = document.getElementById('image-controls');
    const textControls = document.getElementById('text-controls');
    textControls.style.display = 'none';
    imageControls.style.display = 'none';
    isClickedAddDesign ? initializeMainProduct(product, designSide) : initializeMainProductBeforNewDesign(product, designSide)
}

function setBackImage() {
    let product = TEM_Product || GLOBAL_PRODUCT;
    designSide = "back";
    isClickedAddDesign ? initializeMainProduct(product, designSide) : initializeMainProductBeforNewDesign(product, designSide)
    const frontDiv = document.getElementById('front-img-button');
    const backDiv = document.getElementById('back-img-button');
    backDiv.style.backgroundColor = '#6200ea';
    backDiv.style.color = 'white';
    frontDiv.style.backgroundColor = 'white';
    frontDiv.style.color = '#6200ea';
    lastImg = "";
    const imageControls = document.getElementById('image-controls');
    const textControls = document.getElementById('text-controls');
    textControls.style.display = 'none';
    imageControls.style.display = 'none';
}

// Function to check the media query and add/remove class
function handleMediaQueryChange(event) {
    const designArea = document.getElementById('design-area');
    if (event.matches) {
        // Media query matches
        designArea.classList.add('d-flex');
    } else {
        // Media query does not match
        designArea.classList.remove('d-flex');
    }
}

// Define the media query
const mediaQuery = window.matchMedia('(max-width: 900px)');

// Add listener to the media query
mediaQuery.addListener(handleMediaQueryChange);

// Initial check
handleMediaQueryChange(mediaQuery);
async function initPage(product) {
    // Retrieve the product data from local storage

    const productJSON = {...product}
    if (productJSON) {
        const product = productJSON;
        // const sidebar = document.getElementById('sidebar-product-image');
        initializeMainProduct(product, "front")
    } else {
        alert('No product data found!');
    }
}

window.onload = () => initPage(GLOBAL_PRODUCT)
// Function to render products on the page
function renderProducts(products, designSide) {
    const productsList = document.getElementById("products-list");
    productsList.innerHTML = '';
    products.forEach((product, index) => {
        const productItem = document.createElement('li');

        const boundaryBoxChildrenHTMLFront = product.front.boundaryBoxChildren.map(child => {
            const {tagName, attributes, style, innerText} = child;
            const styleString = Object.entries(style).map(([key, value]) => `${key}: ${value};`).join(' ');

            let attributesString = Object.entries(attributes).map(([key, value]) => `${key}="${value}"`).join(' ');
            if (innerText) {
                return `<${tagName}  ${attributesString} ${styleString}>${innerText}</${tagName}>`;
            } else {
                return `<${tagName}  ${attributesString} ${styleString}></${tagName}>`;
            }
        }).join('');
        const boundaryBoxChildrenHTMLBack = product.back.boundaryBoxChildren.map(child => {
            const {tagName, attributes, style, innerText} = child;
            const styleString = Object.entries(style).map(([key, value]) => `${key}: ${value};`).join(' ');

            let attributesString = Object.entries(attributes).map(([key, value]) => `${key}="${value}"`).join(' ');
            if (innerText) {
                return `<${tagName}  ${attributesString} ${styleString}>${innerText}</${tagName}>`;
            } else {
                return `<${tagName}  ${attributesString} ${styleString}></${tagName}>`;
            }
        }).join('');

        productItem.innerHTML = `
            <div class="product-container">
                <a class="image-container" data-image="${product[designSide].frontImage}">
                    <div class="card-front"  id="${index}-card-front" style="background-image: url(${product.front.frontImage});background-color:${product.color}; background-size: contain; background-position: center; background-repeat: no-repeat;">
                    <div style="border: 0px dashed rgb(255, 5, 5); position: relative; width: ${product[designSide].boundaryBox.width}; height:${product[designSide].boundaryBox.height}; top: ${product[designSide].boundaryBox.top}; left: ${product[designSide].boundaryBox.left};">${boundaryBoxChildrenHTMLFront}</div>
                    </div>
                    <div class="card-back" id="${index}-card-back" style="position: relative; background-image: url(${product.back.backImage});background-color:${product.color}; background-size: contain; background-position: center; background-repeat: no-repeat;">
                    <div  style="border: 0px dashed rgb(255, 5, 5); position: relative; width: ${product[designSide].boundaryBox.width}; height:${product[designSide].boundaryBox.height}; top: ${product[designSide].boundaryBox.top}; left: ${product[designSide].boundaryBox.left};">${boundaryBoxChildrenHTMLBack}</div>
                    </div>
                </a>
                <ul class="color-list">
                    ${product[designSide].colors.map(color => `
                        <li class="color-item" onClick="changeDesignProductColor('${color.color}')" onmouseover="changeCardColor('${color.color}','${index}-card-front')" onmouseleave="changeCardColor('${product.color}','${index}-card-front')" style="background:${color.color}" data-image="${color.image}" id="color-Button"></li>
                    `).join('')}
                </ul>
            </div>
            <a class="users-list-name" href="Product-details.html">${product[designSide].name}</a>
            <div class="users-list-date">${product[designSide].price} <span>${product[designSide].currency}</span></div>
        `;

        // Append the product item to the products list
        productsList.appendChild(productItem);
        // Add click event listener to the product image
        const img = productItem.querySelector(".image-container");
        img.onclick = () => changeDesignProduct(product);
    });
}

// Function to change the design area background image
function changeDesignProduct(newProduct) {
    const productJSON = JSON.stringify(newProduct);
    localStorage.setItem('product', productJSON);
    GLOBAL_PRODUCT = newProduct
    TEM_Product = newProduct
    initPage(newProduct)
}

function changeDesignProductColor(color) {
    const designArea = document.getElementById('design-area');
    designArea.style.backgroundColor = color;
}

function changeCardColor(color, id) {
    const card = document.getElementById(id);
    card.style.backgroundColor = color;

}

function generateDesignObject(product) {
    const designAreaClone = document.getElementById('design-area')
    const boundaryBoxElement = document.getElementById('boundary-box');
    const color = designAreaClone.style.backgroundColor
    // Get boundary box styles directly from the element
    const boundaryBox = {
        top: boundaryBoxElement.style.top || boundaryBoxElement.offsetTop + 'px',
        left: boundaryBoxElement.style.left || boundaryBoxElement.offsetLeft + 'px',
        width: boundaryBoxElement.style.width || boundaryBoxElement.offsetWidth + 'px',
        height: boundaryBoxElement.style.height || boundaryBoxElement.offsetHeight + 'px'
    };

    // Define the object structure
    const designObject = {
        id: "####",
        color: color,
        front: {
            boundaryBox: boundaryBox,
            boundaryBoxChildren: [],
            name: "T-shirt",
            price: 200,
            currency: "SAR",
            frontImage: product.front.frontImage,
            colors: [
                {color: "black", image: "img/color-1.jpg"},
                {color: "darkblue", image: "img/color-3.jpg"},
                {color: "fcdb86", image: "img/color-2.jpg"}
            ]
        },
        back: {
            boundaryBox: boundaryBox,
            boundaryBoxChildren: [],
            name: "T-shirt",
            price: 200,
            currency: "SAR",
            backImage: product.back.backImage,
            colors: [
                {color: "black", image: "img/color-1.jpg"},
                {color: "darkblue", image: "img/color-3.jpg"},
                {color: "fcdb86", image: "img/color-2.jpg"}
            ]
        }
    };

    // Extract all children within the boundary box
    ['front', 'back'].forEach(side => {
        Array.from(product[side].boundaryBoxChildren).forEach(child => {
            if (child instanceof Element) {  // Ensure child is a DOM element
                const childStyle = window.getComputedStyle(child);
                const childData = {
                    tagName: child.tagName,
                    classList: Array.from(child.classList),
                    style: {
                        top: child.style.top || child.offsetTop + 'px',
                        left: child.style.left || child.offsetLeft + 'px',
                        width: child.style.width || child.offsetWidth + 'px',
                        height: child.style.height || child.offsetHeight + 'px',
                        fontSize: childStyle.fontSize,
                        padding: childStyle.padding,
                        transform: childStyle.transform
                    },
                    attributes: {}
                };

                // Add all attributes of the child element
                Array.from(child.attributes).forEach(attr => {
                    childData.attributes[attr.name] = attr.value;
                });

                // If the child is an image, add the src attribute
                if (child.tagName === 'IMG') {
                    childData.src = child.src;
                }
                if (child.tagName === 'DIV' && child.classList.contains('text-element')) {
                    childData.innerText = child.innerText;
                }

                // Add the child data to the design object
                designObject[side].boundaryBoxChildren.push(childData);
            } else {
                console.warn('Invalid element found in boundaryBoxChildren:', child);
            }
        });
    });

    return designObject;
}

function extractImagePath(backgroundImage) {
    const urlMatch = backgroundImage.match(/url\(["']?([^"']*)["']?\)/);
    return urlMatch ? urlMatch[1] : '';
}

function initializeMainProduct(newProduct, designSide) {
    const designArea = document.getElementById('design-area');
    designArea.style.backgroundColor = newProduct.color
    const boundaryBox = document.getElementById('boundary-box');
    const oldWidth = parseFloat(boundaryBox.style.width);
    const newWidth = parseFloat(newProduct[designSide].boundaryBox.width);
    const precentageX = oldWidth / newWidth;
    const oldHeight = parseFloat(boundaryBox.style.height);
    const newHeight = parseFloat(newProduct[designSide].boundaryBox.height);
    const precentageY = oldHeight / newHeight;
    boundaryBox.style.width = newProduct[designSide].boundaryBox.width;
    boundaryBox.style.height = newProduct[designSide].boundaryBox.height;
    boundaryBox.style.left = newProduct[designSide].boundaryBox.left;
    boundaryBox.style.top = newProduct[designSide].boundaryBox.top;
    const boundaryBoxChildrenHTMLFront = newProduct.front.boundaryBoxChildren.map(child => {
        const {tagName, attributes, style, innerText} = child;
        const styleString = Object.entries(style).map(([key, value]) => `${key}: ${value};`).join(' ');
        let attributesString = Object.entries(attributes).map(([key, value]) => `${key}="${value}"`).join(' ');
        if (innerText) {
            return `<${tagName}  ${attributesString} ${styleString}>${innerText}</${tagName}>`;
        } else {
            return `<${tagName}  ${attributesString} ${styleString}></${tagName}>`;
        }
    }).join('');
    const boundaryBoxChildrenHTMLBack = newProduct.back.boundaryBoxChildren.map(child => {
        const {tagName, attributes, style, innerText} = child;
        const styleString = Object.entries(style).map(([key, value]) => `${key}: ${value};`).join(' ');

        let attributesString = Object.entries(attributes).map(([key, value]) => `${key}="${value}"`).join(' ');
        if (innerText) {
            return `<${tagName}  ${attributesString} ${styleString}>${innerText}</${tagName}>`;
        } else {
            return `<${tagName}  ${attributesString} ${styleString}></${tagName}>`;
        }
    }).join('');

    if (designSide === "front") {

        boundaryBox.innerHTML = boundaryBoxChildrenHTMLFront;
        designArea.style.backgroundImage = `url(${newProduct[designSide].frontImage})`;
    }
    if (designSide === "back") {
        boundaryBox.innerHTML = boundaryBoxChildrenHTMLBack;
        designArea.style.backgroundImage = `url(${newProduct[designSide].backImage})`;
    }
    designArea.childNodes[1].childNodes.forEach(child => {
        if (designArea.childNodes[1].childNodes.length) {
            if (child.nodeType === 1) {
                const x = parseFloat(child.getAttribute('data-x'));
                const y = parseFloat(child.getAttribute('data-y'));

                if (child.tagName === 'IMG') {
                    child.classList.add('draggable', 'resizable');
                    let transform = child.style.transform;
                    let translateValues;
                    let translateX;
                    let translateY;
                    if (child.dataset.translateValues) {
                        translateValues = child.dataset.translateValues.split(',');
                        translateX = parseFloat(translateValues[0]);
                        translateY = parseFloat(translateValues[1]);
                    }
                    child.style.transform = `translate(${translateX}px, ${translateY}px) rotate(${child.dataset.rotation || 0}deg)`;
                    const width = parseFloat(child.style.width);
                    const height = parseFloat(child.style.height);
                    child.style.width = `${width / 0.3}px`;
                    child.style.height = `${height / 0.397}px`;
                    child.style.top = "0px";
                    child.style.left = "0px";
                    child.addEventListener("click", () => {
                        lastImg = child
                        const imageControls = document.getElementById('image-controls');
                        const textControls = document.getElementById('text-controls');
                        imageControls.style.display = 'flex';
                        textControls.style.display = 'none';
                    });
                }

                if (child.tagName === 'DIV' && child.classList.contains('text-element')) {
                    child.classList.add('draggable', 'resizable');
                    let translateValues = child.dataset.translateValues.split(',');
                    let translateX = parseFloat(translateValues[0]);
                    let translateY = parseFloat(translateValues[1]);
                    child.style.transform = `translate(${translateX}px, ${translateY}px) rotate(${child.dataset.rotation || 0}deg)`;
                    const fontSize = parseFloat(window.getComputedStyle(child).fontSize);
                    child.style.fontSize = `${fontSize / 0.3}px`;
                    const padding = parseFloat(window.getComputedStyle(child).padding);
                    child.style.padding = `${padding / 0.3}px`;
                    child.style.top = "0px";
                    child.style.left = "0px";
                    child.addEventListener("click", () => {
                        lastText = child
                        const imageControls = document.getElementById('image-controls');
                        const textControls = document.getElementById('text-controls');
                        textControls.style.display = 'flex';
                        imageControls.style.display = 'none';
                    });

                }
                child.style.position = 'absolute';
            }
        }
    });
    product = newProduct
}


function initializeMainProductBeforNewDesign(newProduct, designSide) {
    const designArea = document.getElementById('design-area');
    const boundaryBox = document.getElementById('boundary-box');
    const oldWidth = parseFloat(boundaryBox.style.width);
    const newWidth = parseFloat(newProduct[designSide].boundaryBox.width);
    const precentageX = oldWidth / newWidth;
    const oldHeight = parseFloat(boundaryBox.style.height);
    const newHeight = parseFloat(newProduct[designSide].boundaryBox.height);
    const precentageY = oldHeight / newHeight;
    boundaryBox.style.width = newProduct[designSide].boundaryBox.width;
    boundaryBox.style.height = newProduct[designSide].boundaryBox.height;
    boundaryBox.style.left = newProduct[designSide].boundaryBox.left;
    boundaryBox.style.top = newProduct[designSide].boundaryBox.top;
    const boundaryBoxChildrenHTMLFront = newProduct.front.boundaryBoxChildren.map(child => {
        const {tagName, innerText} = child;

        // Get all attributes
        const attributesString = Array.from(child.attributes).map(attr => `${attr.name}="${attr.value}"`).join(' ');

        // Get inline styles as a string
        const styleString = child.getAttribute('style') ? `style="${child.getAttribute('style')}"` : '';

        // Construct the HTML string
        if (innerText) {
            return `<${tagName} ${attributesString}>${innerText}</${tagName}>`;
        } else {
            return `<${tagName} ${attributesString}></${tagName}>`;
        }
    }).join('');
    const boundaryBoxChildrenHTMLBack = newProduct.back.boundaryBoxChildren.map(child => {
        const {tagName, innerText} = child;

        // Get all attributes
        const attributesString = Array.from(child.attributes).map(attr => `${attr.name}="${attr.value}"`).join(' ');

        // Get inline styles as a string
        const styleString = child.getAttribute('style') ? `style="${child.getAttribute('style')}"` : '';

        // Construct the HTML string
        if (innerText) {
            return `<${tagName} ${attributesString} >${innerText}</${tagName}>`;
        } else {
            return `<${tagName} ${attributesString} ></${tagName}>`;
        }
    }).join('');

    if (designSide === "front") {

        boundaryBox.innerHTML = boundaryBoxChildrenHTMLFront;
        designArea.style.backgroundImage = `url(${newProduct[designSide].frontImage})`;

    }
    if (designSide === "back") {
        boundaryBox.innerHTML = boundaryBoxChildrenHTMLBack;
        designArea.style.backgroundImage = `url(${newProduct[designSide].backImage})`;

    }
    designArea.childNodes[1].childNodes.forEach(child => {
        if (designArea.childNodes[1].childNodes.length) {
            if (child.nodeType === 1) {
                const x = parseFloat(child.getAttribute('data-x'));
                const y = parseFloat(child.getAttribute('data-y'));

                if (child.tagName === 'IMG') {
                    let transform = child.style.transform;
                    let translateX;
                    let translateY;
                    if (child.dataset.translateValues) {
                        let translateValues = child.dataset.translateValues.split(',');
                        translateX = parseFloat(translateValues[0]);
                        translateY = parseFloat(translateValues[1]);
                    } else {
                        translateX = 0;
                        translateY = 0;
                    }
                    transform = `translate(${translateX}px, ${translateY}px) rotate(${child.dataset.rotation || 0}deg)`;

                    child.style.top = "0px";
                    child.style.left = "0px";
                    child.addEventListener("click", () => {
                        lastImg = child
                        const imageControls = document.getElementById('image-controls');
                        const textControls = document.getElementById('text-controls');
                        imageControls.style.display = 'flex';
                        textControls.style.display = 'none';
                    });
                }

                if (child.tagName === 'DIV' && child.classList.contains('text-element')) {
                    child.style.top = "0px";
                    child.style.left = "0px";
                    child.addEventListener("click", () => {
                        lastText = child
                        const imageControls = document.getElementById('image-controls');
                        const textControls = document.getElementById('text-controls');
                        textControls.style.display = 'flex';
                        imageControls.style.display = 'none';
                    });

                }
                child.style.position = 'absolute';
            }

        }
    });
}


function changeNewDesignProduct(productId) {
    const productElementFront = document.querySelector(`#${productId}.card-front`);
    const boundaryBoxFront = productElementFront.childNodes[1];
    const productElementBack = document.querySelector(`#${productId}.card-back`);
    const boundaryBoxBack = productElementBack.childNodes[1];


    if (productElementFront) {
        const styleStringFront = productElementFront.getAttribute("style");
        const styleObjectFront = {};
        const styleStringBoundaryBoxFront = boundaryBoxFront.getAttribute("style");
        const styleBoundaryBoxFront = {};
        const styleStringBack = productElementBack.getAttribute("style");
        const styleObjectBack = {};
        const styleStringBoundaryBoxBack = boundaryBoxBack.getAttribute("style");
        const styleBoundaryBoxBack = {};

        // Split the style string into individual styles
        styleStringFront.split(';').forEach(style => {
            if (style.trim() !== "") {
                // Split each style into a key and value
                const [key, value] = style.split(':');
                // Add the key and value to the styleObject
                styleObjectFront[key.trim()] = value.trim();
            }
        });
        // Split the style string into individual styles
        styleStringBoundaryBoxFront.split(';').forEach(style => {
            if (style.trim() !== "") {
                // Split each style into a key and value
                const [key, value] = style.split(':');
                // Add the key and value to the styleObject
                styleBoundaryBoxFront[key.trim()] = value.trim();
            }
        });
        // Split the style string into individual styles
        styleStringBack.split(';').forEach(style => {
            if (style.trim() !== "") {
                // Split each style into a key and value
                const [key, value] = style.split(':');
                // Add the key and value to the styleObject
                styleObjectBack[key.trim()] = value.trim();
            }
        });
        // Split the style string into individual styles
        styleStringBoundaryBoxBack.split(';').forEach(style => {
            if (style.trim() !== "") {
                // Split each style into a key and value
                const [key, value] = style.split(':');
                // Add the key and value to the styleObject
                styleBoundaryBoxBack[key.trim()] = value.trim();
            }
        });
        const designObject = {
            id: productElementFront.id,
            color: styleObjectFront['background-color'],
            front: {
                boundaryBox: styleBoundaryBoxFront,
                boundaryBoxChildren: [],
                name: "T-shirt",
                price: 200,
                currency: "SAR",
                frontImage: styleObjectFront['background-image'].slice(4, -1).replace(/"/g, ""),
                colors: [
                    {color: "black", image: "img/color-1.jpg"},
                    {color: "darkblue", image: "img/color-3.jpg"},
                    {color: "fcdb86", image: "img/color-2.jpg"}
                ]
            },
            back: {
                boundaryBox: styleBoundaryBoxBack,
                boundaryBoxChildren: [],
                name: "T-shirt",
                price: 200,
                currency: "SAR",
                backImage: styleObjectBack['background-image'].slice(4, -1).replace(/"/g, ""),
                colors: [
                    {color: "black", image: "img/color-1.jpg"},
                    {color: "darkblue", image: "img/color-3.jpg"},
                    {color: "fcdb86", image: "img/color-2.jpg"}
                ]
            }
        };

        changeDesignProduct(designObject)
        setFrontImage();
    } else {
        console.log('Element not found');
    }
}

document.getElementById('convertToImage').addEventListener('click', function () {
    const sides = ["front", "back"];

    function processSide(side) {
        if (side === "front") {
            setFrontImage();
        } else {
            setBackImage();
        }

        var box = document.getElementById('boundary-box');
        if (!box) {
            console.error('Boundary box not found');
            return;
        }

        var originalBorder = box.style.border;
        box.style.border = 'none';

        if (side === "front") {
            var texts = box.getElementsByTagName('div');
            var textValues = [];
            var values = [];
            for (var ii = 0; ii < texts.length; ii++) {
                values['content'] = texts[ii].innerText;
                values['font_family'] = texts[ii].style.fontFamily;
                values['color'] = texts[ii].style.color;
                values['size'] = texts[ii].style.fontSize;
                values['weight'] = texts[ii].style.fontWeight;
                textValues = textValues.push(values);
            }
            $('[name="texts"]').val(JSON.stringify(textValues));
        } else {
            var text_backs = box.getElementsByTagName('div');
            var textValuesBack = [];
            var values_back = [];
            for (var ii = 0; ii < text_backs.length; ii++) {
                values_back['content'] = text_backs[ii].innerText;
                values_back['font_family'] = text_backs[ii].style.fontFamily;
                values_back['color'] = text_backs[ii].style.color;
                values_back['size'] = text_backs[ii].style.fontSize;
                values_back['weight'] = text_backs[ii].style.fontWeight;
                textValuesBack.push(values_back);
            }
            $('[name="texts_back"]').val(JSON.stringify(textValuesBack));
        }
        var images = box.getElementsByTagName('img');
        var loadCount = 0;

        function checkImagesLoaded() {
            loadCount++;
            if (loadCount === images.length) {
                captureCanvas();
            }
        }

        for (var i = 0; i < images.length; i++) {
            if (images[i].complete) {
                checkImagesLoaded();
            } else {
                images[i].onload = checkImagesLoaded;
                images[i].onerror = checkImagesLoaded;
            }
        }

        if (images.length === 0) {
            captureCanvas();
        }

        function captureCanvas() {
            html2canvas(box, {
                useCORS: true,
                backgroundColor: 'rgba(0,0,0,0)', // Set background to transparent
                // scale: 2 // Increase the scale for better resolution
            }).then(canvas => {
                var imgData = canvas.toDataURL('image/png');
                var imgElement = document.createElement('img');
                imgElement.src = imgData;
                imgElement.id = (side === "front") ? "frontdesign" : "backdesign";

                // Create a file input element to hold the image data
                var fileInput = document.createElement('input');
                fileInput.type = 'hidden';
                fileInput.id = `${side}ImageFile`;
                fileInput.name = `${side}ImageFile`;
                fileInput.value = `${imgData}`;

                // Convert the base64 data to a blob and create a file from it
                fetch(imgData)
                    .then(res => res.blob())
                    .then(blob => {
                        const file = new File([blob], `${side}Design.png`, {type: 'image/png'});
                        const dataTransfer = new DataTransfer();
                        dataTransfer.items.add(file);
                        fileInput.files = dataTransfer.files;
                    });

                document.getElementById('cart-destails').appendChild(fileInput);

                box.style.border = originalBorder;
            }).catch(error => {
                console.error("Error capturing canvas: ", error);
                box.style.border = originalBorder;
            });
        }
    }

    sides.forEach(side => {
        processSide(side);
    });
    getDetails()

    setTimeout(
        function () {
            $('#myForm').submit();
        }, 1000);
});
document.getElementById('convertToImage1').addEventListener('click', function () {
    $("#submit_type").val(1);
    const sides = ["front", "back"];

    function processSide(side) {
        if (side === "front") {
            setFrontImage();
        } else {
            setBackImage();
        }

        var box = document.getElementById('boundary-box');
        if (!box) {
            console.error('Boundary box not found');
            return;
        }

        var originalBorder = box.style.border;
        box.style.border = 'none';

        if (side === "front") {
            var texts = box.getElementsByTagName('div');
            var textValues = [];
            var values = [];
            for (var ii = 0; ii < texts.length; ii++) {
                values['content'] = texts[ii].innerText;
                values['font_family'] = texts[ii].style.fontFamily;
                values['color'] = texts[ii].style.color;
                values['size'] = texts[ii].style.fontSize;
                values['weight'] = texts[ii].style.fontWeight;
                textValues = textValues.push(values);
            }
            $('[name="texts"]').val(JSON.stringify(textValues));
        } else {
            var text_backs = box.getElementsByTagName('div');
            var textValuesBack = [];
            var values_back = [];
            for (var ii = 0; ii < text_backs.length; ii++) {
                values_back['content'] = text_backs[ii].innerText;
                values_back['font_family'] = text_backs[ii].style.fontFamily;
                values_back['color'] = text_backs[ii].style.color;
                values_back['size'] = text_backs[ii].style.fontSize;
                values_back['weight'] = text_backs[ii].style.fontWeight;
                textValuesBack.push(values_back);
            }
            $('[name="texts_back"]').val(JSON.stringify(textValuesBack));
        }
        var images = box.getElementsByTagName('img');
        var loadCount = 0;

        function checkImagesLoaded() {
            loadCount++;
            if (loadCount === images.length) {
                captureCanvas();
            }
        }

        for (var i = 0; i < images.length; i++) {
            if (images[i].complete) {
                checkImagesLoaded();
            } else {
                images[i].onload = checkImagesLoaded;
                images[i].onerror = checkImagesLoaded;
            }
        }

        if (images.length === 0) {
            captureCanvas();
        }

        function captureCanvas() {
            html2canvas(box, {
                useCORS: true,
                backgroundColor: 'rgba(0,0,0,0)', // Set background to transparent
                // scale: 2 // Increase the scale for better resolution
            }).then(canvas => {
                var imgData = canvas.toDataURL('image/png');
                var imgElement = document.createElement('img');
                imgElement.src = imgData;
                imgElement.id = (side === "front") ? "frontdesign" : "backdesign";

                // Create a file input element to hold the image data
                var fileInput = document.createElement('input');
                fileInput.type = 'hidden';
                fileInput.id = `${side}ImageFile`;
                fileInput.name = `${side}ImageFile`;
                fileInput.value = `${imgData}`;

                // Convert the base64 data to a blob and create a file from it
                fetch(imgData)
                    .then(res => res.blob())
                    .then(blob => {
                        const file = new File([blob], `${side}Design.png`, {type: 'image/png'});
                        const dataTransfer = new DataTransfer();
                        dataTransfer.items.add(file);
                        fileInput.files = dataTransfer.files;
                    });

                document.getElementById('cart-destails').appendChild(fileInput);

                box.style.border = originalBorder;
            }).catch(error => {
                console.error("Error capturing canvas: ", error);
                box.style.border = originalBorder;
            });
        }
    }

    sides.forEach(side => {
        processSide(side);
    });
    getDetails()

    setTimeout(
        function () {
            $('#myForm').submit();
        }, 1000);
});

function handleUploadExistingDesign(src) {
    const designArea = document.getElementById('design-area');
    const imageControls = document.getElementById('image-controls');
    const textControls = document.getElementById('text-controls');
    textControls.style.display = 'none';
    imageControls.classList.add('image-controls');
    imageControls.style.display = 'flex';


    const img = document.createElement('img');
    img.src = src;
    img.style.width = '100px'; // Initial size
    // img.style.height = '100px';
    img.classList.add('draggable', 'resizable');
    img.style.position = 'absolute';
    img.style.top = '0';
    img.style.left = '0';
    lastImg = img; // Update lastImg to the current image

    img.addEventListener('click', () => {
        lastImg = img;
        imageControls.style.display = 'flex';
        textControls.style.display = 'none';
    });

    // Add delete button to the image
    const deleteButton = document.getElementById('image-delete-button');
    deleteButton.addEventListener('click', () => {

        const inputField = document.getElementById('file-input');
        // inputField.value = '';

        lastImg.remove();
        imageControls.style.display = 'none';
        if (designArea.childNodes.length === 0) {
            imageControls.style.display = 'none';
        }
    });
    TEM_Product[designSide].boundaryBoxChildren.push(img)
    boundaryBox.appendChild(img);


    const rangeInput = document.getElementById('image-size');
    rangeInput.removeEventListener('input', updateImageSize); // Remove previous listener
    rangeInput.addEventListener('input', updateImageSize);

    function updateImageSize() {
        const imageSize = rangeInput.value;
        if (lastImg) { // Ensure lastImg is defined
            lastImg.style.width = `${imageSize}px`;
            // lastImg.style.height = `${imageSize}px`;
        }
    }

    centerElement(lastImg);
    initializeInteract();

}

function getDetails() {
    const boundaryBox = document.getElementById("boundary-box");
    const boundaryBoxChildrenHTMLFront = GLOBAL_PRODUCT.front.boundaryBoxChildren.map(child => {
        const {tagName, innerText} = child;
        // Get all attributes
        const attributesString = Array.from(child.attributes).map(attr => `${attr.name}="${attr.value}"`).join(' ');
        // Construct the HTML string
        if (innerText) {
            return `<${tagName.toLowerCase()} ${attributesString}>${innerText}</${tagName.toLowerCase()}>`;
        } else {
            return `<${tagName.toLowerCase()} ${attributesString}/>`;
        }
    }).join('');
    const boundaryBoxChildrenHTMLBack = GLOBAL_PRODUCT.back.boundaryBoxChildren.map(child => {
        const {tagName, innerText} = child;
        // Get all attributes
        const attributesString = Array.from(child.attributes).map(attr => `${attr.name}="${attr.value}"`).join(' ');
        // Construct the HTML string
        if (innerText) {
            return `<${tagName.toLowerCase()} ${attributesString} >${innerText}</${tagName.toLowerCase()}>`;
        } else {
            return `<${tagName.toLowerCase()} ${attributesString}/>`;
        }
    }).join('');
    let frontBox = document.createElement("div");
    let backBox = document.createElement("div");
    frontBox.innerHTML = boundaryBoxChildrenHTMLFront;
    backBox.innerHTML = boundaryBoxChildrenHTMLBack;

    // Function to create hidden input
    function createHiddenInput(name, value) {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = name;
        input.value = value;
        return input;
    }

    // Process the front box
    frontBox.childNodes.forEach(async (child, index) => {
        if (child.tagName === 'IMG') {
            async function fetchBlob(url) {
                const response = await fetch(url);
                const blob = await response.blob();
                return blob;
            }

            const blobURL = await fetchBlob(child.getAttribute('src'))

            const reader = new FileReader();
            reader.readAsDataURL(blobURL);
            reader.onloadend = function () {
                const base64data = reader.result;

                // Create a hidden input for the image src
                const imgSrcInput = createHiddenInput(`front_image[]`, base64data);
                let div = document.getElementById('cart-destails')
                div.appendChild(imgSrcInput);
            };
        }

        if (child.tagName === 'DIV' && child.classList.contains('text-element')) {
            // Get the needed style values
            const textContent = child.textContent;
            const fontSize = child.style.fontSize;
            const fontFamily = child.style.fontFamily;
            const color = child.style.color;
            const fontWeight = child.style.fontWeight;
            // Create hidden inputs for text properties
            const textContentInput = createHiddenInput(`front_text_content[]`, textContent);
            const fontSizeInput = createHiddenInput(`front_font_size[]`, fontSize);
            const fontFamilyInput = createHiddenInput(`front_font_family[]`, fontFamily);
            const colorInput = createHiddenInput(`front_color[]`, color);
            const fontWeightInput = createHiddenInput(`front_font_weight[]`, fontWeight);

            let div = document.getElementById('cart-destails')
            // Append hidden inputs to the body or form
            div.appendChild(textContentInput);
            div.appendChild(fontSizeInput);
            div.appendChild(fontFamilyInput);
            div.appendChild(colorInput);
            div.appendChild(fontWeightInput);
        }
    });

    // Process the back box
    backBox.childNodes.forEach(async (child, index) => {
        if (child.tagName === 'IMG') {
            async function fetchBlob(url) {
                const response = await fetch(url);
                const blob = await response.blob();
                return blob;
            }

            const blobURL = await fetchBlob(child.getAttribute('src'))


            const reader = new FileReader();
            reader.readAsDataURL(blobURL);
            reader.onloadend = function () {
                const base64data = reader.result;

                // Create a hidden input for the image src
                const imgSrcInput = createHiddenInput(`back_image[]`, base64data);
                let div = document.getElementById('cart-destails')
                div.appendChild(imgSrcInput);
            };
        }

        if (child.tagName === 'DIV' && child.classList.contains('text-element')) {

            // Get the needed style values
            const textContent = child.textContent;
            const fontSize = child.style.fontSize;
            const fontFamily = child.style.fontFamily;
            const color = child.style.color;
            const fontWeight = child.style.fontWeight;

            // Create hidden inputs for text properties
            const textContentInput = createHiddenInput(`back_text_content[]`, textContent);
            const fontSizeInput = createHiddenInput(`back_font_size[]`, fontSize);
            const fontFamilyInput = createHiddenInput(`back_font_family[]`, fontFamily);
            const colorInput = createHiddenInput(`back_color[]`, color);
            const fontWeightInput = createHiddenInput(`back_font_weight[]`, fontWeight);

            let div = document.getElementById('myForm')
            // Append hidden inputs to the body or form
            div.appendChild(textContentInput);
            div.appendChild(fontSizeInput);
            div.appendChild(fontFamilyInput);
            div.appendChild(colorInput);
            div.appendChild(fontWeightInput);
        }
    });
}

function handleAddExistingDesignClick() {
    const addExistingDesignElement = document.getElementById('exsiting-designs-container')
    addExistingDesignElement.style.display = "flex"
}

function handleCloseExistingDesignClick() {
    const addExistingDesignElement = document.getElementById('exsiting-designs-container')
    addExistingDesignElement.style.display = "none"
}

window.addEventListener('popstate', function (event) {
    localStorage.removeItem('product');
});

