var canvas;
var canvasBack;
var a;
var b;
$(document).ready(function () {
    //setup front side canvas
    canvasBack = new fabric.Canvas('canvasBack', {
        hoverCursor: 'pointer',
        selection: false,
        // selectionBorderColor: 'blue',
        // hasBorders:true
    });
    canvas = new fabric.Canvas('tcanvas', {
        hoverCursor: 'pointer',
        selection: true,
        // selectionBorderColor: 'blue',
        // hasBorders:true
    });
    canvas.on({
        'object:moving': function (e) {
            e.target.opacity = 0.5;
            $('#front_image_width').val(Math.ceil(e.target.getWidth()));
            $('#front_image_height').val(Math.ceil(e.target.getHeight()));
            $('#front_image_top').val(Math.ceil(e.target.top));
            $('#front_image_left').val(Math.ceil(e.target.left));
        },
        'object:modified': function (e) {
            e.target.opacity = 1;
            $('#front_image_width').val(Math.ceil(e.target.getWidth()));
            $('#front_image_height').val(Math.ceil(e.target.getHeight()));
            $('#front_image_top').val(Math.ceil(e.target.top));
            $('#front_image_left').val(Math.ceil(e.target.left));
        },
        'object:selected': onObjectSelected,
        'selection:cleared': onSelectedCleared
    });
    // piggyback on `canvas.findTarget`, to fire "object:over" and "object:out" events
    canvas.findTarget = (function (originalFn) {
        return function () {
            var target = originalFn.apply(this, arguments);
            if (target) {
                if (this._hoveredTarget !== target) {
                    canvas.fire('object:over', {target: target});
                    if (this._hoveredTarget) {
                        canvas.fire('object:out', {target: this._hoveredTarget});
                    }
                    this._hoveredTarget = target;
                }
            } else if (this._hoveredTarget) {
                canvas.fire('object:out', {target: this._hoveredTarget});
                this._hoveredTarget = null;
            }
            return target;
        };
    })(canvas.findTarget);

    canvasBack.on({
        'object:moving': function (e) {
            e.target.opacity = 0.5;
            $('#back_image_width').val(Math.ceil(e.target.getWidth()));
            $('#back_image_height').val(Math.ceil(e.target.getHeight()));
            $('#back_image_top').val(Math.ceil(e.target.top));
            $('#back_image_left').val(Math.ceil(e.target.left));
        },
        'object:modified': function (e) {
            e.target.opacity = 1;
            $('#back_image_width').val(Math.ceil(e.target.getWidth()));
            $('#back_image_height').val(Math.ceil(e.target.getHeight()));
            $('#back_image_top').val(Math.ceil(e.target.top));
            $('#back_image_left').val(Math.ceil(e.target.left));
        },
        'object:selected': onObjectSelectedBack,
        'selection:cleared': onSelectedClearedBack
    });
    canvasBack.findTarget = (function (originalFn) {
        return function () {
            var target = originalFn.apply(this, arguments);
            if (target) {
                if (this._hoveredTarget !== target) {
                    canvasBack.fire('object:over', {target: target});
                    if (this._hoveredTarget) {
                        canvasBack.fire('object:out', {target: this._hoveredTarget});
                    }
                    this._hoveredTarget = target;
                }
            } else if (this._hoveredTarget) {
                canvasBack.fire('object:out', {target: this._hoveredTarget});
                this._hoveredTarget = null;
            }
            return target;
        };
    })(canvasBack.findTarget);

    document.getElementById('add-text').onclick = function () {
        var text = $("#text-string").val();
        var textSample = new fabric.Text(text, {
            fontFamily: 'helvetica',
            angle: 0,
            fill: '#000000',
            scaleX: 0.5,
            scaleY: 0.5,
            fontWeight: '',
            editable: true,
            centeredRotation: true,
        });
        if ($('#drawingArea').hasClass('d-none')) {
            console.log('back', canvasBack)
            canvasBack.centerObject(textSample).add(textSample);
            canvasBack.renderAll();
        } else {
            console.log('front', canvas)
            canvas.centerObject(textSample).add(textSample);
            canvas.renderAll();
        }
        $("#texteditor").css('display', 'block');
        $("#imageeditor").css('display', 'block');
    };
    $("#text-string").keyup(function () {
        if ($('#drawingArea').hasClass('d-none')) {
            let activeObject = canvasBack.getActiveObject();
            if (activeObject && activeObject.type === 'text') {
                activeObject.text = this.value;
                canvasBack.renderAll();
            }
        } else {
            let activeObject = canvas.getActiveObject();
            if (activeObject && activeObject.type === 'text') {
                activeObject.text = this.value;
                canvas.renderAll();
            }
        }
    });
    $(".img-polaroid").click(function (e) {
        var el = e.target;
        /*temp code*/
        var offset = 50;
        // var left = fabric.util.getRandomInt(0 + offset, 200 - offset);
        // var top = fabric.util.getRandomInt(0 + offset, 400 - offset);
        var angle = fabric.util.getRandomInt(-20, 40);
        var width = fabric.util.getRandomInt(30, 50);
        var opacity = (function (min, max) {
            return Math.random() * (max - min) + min;
        })(0.5, 1);

        fabric.Image.fromURL(el.src, function (image) {
            image.set({
                // left: left,
                // top: top,
                angle: 0,
                scaleX: 0.2,
                scaleY: 0.2,
                hasRotatingPoint: true
            });
            //image.scale(getRandomNum(0.1, 0.25)).setCoords();
            if ($('#drawingArea').hasClass('d-none')) {
                canvasBack.centerObject(image).add(image);
            } else {
                canvas.centerObject(image).add(image);
            }
        });
    });
    $("#fileToUpload").change(function (e) {
        var reader = new FileReader();
        reader.onload = function (e) {
            var image = new Image();
            image.src = e.target.result;
            image.onload = function () {
                var img = new fabric.Image(image);
                img.set({
                    // left: left,
                    // top: top,
                    angle: 0,
                    scaleX: 0.2,
                    scaleY: 0.2,
                    hasRotatingPoint: true
                });
                if ($('#drawingArea').hasClass('d-none')) {
                    // img.scaleToWidth('{{$record->site_back_width * 0.75}}');
                    canvasBack.centerObject(img);
                    canvasBack.add(img).setActiveObject(img).renderAll();
                } else {
                    // img.scaleToWidth('{{$record->site_front_width * 0.75}}');
                    canvas.centerObject(img);
                    canvas.add(img).setActiveObject(img).renderAll();
                }
            }
        }
        reader.readAsDataURL(e.target.files[0]);
        $("#imageeditor").css('display', 'block');
    });
    document.getElementById('remove-selected').onclick = function () {
        if ($('#drawingArea').hasClass('d-none')) {
            let activeObject = canvasBack.getActiveObject(),
                activeGroup = canvasBack.getActiveGroup();
            if (activeObject) {
                canvasBack.remove(activeObject);
                $("#text-string").val("");
            } else if (activeGroup) {
                let objectsInGroup = activeGroup.getObjects();
                canvasBack.discardActiveGroup();
                objectsInGroup.forEach(function (object) {
                    canvasBack.remove(object);
                });
            }
        } else {
            let activeObject = canvas.getActiveObject(),
                activeGroup = canvas.getActiveGroup();
            if (activeObject) {
                canvas.remove(activeObject);
                $("#text-string").val("");
            } else if (activeGroup) {
                let objectsInGroup = activeGroup.getObjects();
                canvas.discardActiveGroup();
                objectsInGroup.forEach(function (object) {
                    canvas.remove(object);
                });
            }
        }
    };
    $("#text-bold").click(function () {
        if ($('#drawingArea').hasClass('d-none')) {
            let activeObject = canvasBack.getActiveObject();
            if (activeObject && activeObject.type === 'text') {
                activeObject.fontWeight = (activeObject.fontWeight == 'bold' ? '' : 'bold');
                canvasBack.renderAll();
            }
        } else {
            let activeObject = canvas.getActiveObject();
            if (activeObject && activeObject.type === 'text') {
                activeObject.fontWeight = (activeObject.fontWeight == 'bold' ? '' : 'bold');
                canvas.renderAll();
            }
        }
    });
    $("#text-italic").click(function () {
        if ($('#drawingArea').hasClass('d-none')) {
            let activeObject = canvasBack.getActiveObject();
            if (activeObject && activeObject.type === 'text') {
                console.log('italic if')
                activeObject.fontWeight = (activeObject.fontWeight == 'italic' ? '' : 'italic');
                canvasBack.renderAll();
            }
        } else {
            let activeObject = canvas.getActiveObject();
            if (activeObject && activeObject.type === 'text') {
                console.log('italic else')

                activeObject.fontWeight = (activeObject.fontWeight == 'italic' ? '' : 'italic');
                canvas.renderAll();
            }
        }
    });
    $("#text-strike").click(function () {
        if ($('#drawingArea').hasClass('d-none')) {
            let activeObject = canvasBack.getActiveObject();
            if (activeObject && activeObject.type === 'text') {
                console.log('line-through if')

                activeObject.textDecoration = (activeObject.textDecoration == 'line-through' ? '' : 'line-through');
                canvasBack.renderAll();
            }
        } else {
            let activeObject = canvas.getActiveObject();
            if (activeObject && activeObject.type === 'text') {
                console.log('line-through else')

                activeObject.textDecoration = (activeObject.textDecoration == 'line-through' ? '' : 'line-through');
                canvas.renderAll();
            }
        }
    });
    $("#text-underline").click(function () {
        if ($('#drawingArea').hasClass('d-none')) {
            let activeObject = canvasBack.getActiveObject();
            if (activeObject && activeObject.type === 'text') {
                console.log('underline if')

                activeObject.textDecoration = (activeObject.textDecoration == 'underline' ? '' : 'underline');
                canvasBack.renderAll();
            }
        } else {
            let activeObject = canvas.getActiveObject();
            if (activeObject && activeObject.type === 'text') {
                console.log('underline else')

                activeObject.textDecoration = (activeObject.textDecoration == 'underline' ? '' : 'underline');
                canvas.renderAll();
            }
        }
    });
    $("#font-family").change(function () {
        if ($('#drawingArea').hasClass('d-none')) {
            let activeObject = canvasBack.getActiveObject();
            if (activeObject && activeObject.type === 'text') {
                activeObject.fontFamily = this.value;
                canvasBack.renderAll();
            }
        } else {
            let activeObject = canvas.getActiveObject();
            if (activeObject && activeObject.type === 'text') {
                activeObject.fontFamily = this.value;
                canvas.renderAll();
            }
        }

    });
    $("#font-family").click(function () {
        $('#dropdown-menu').toggle();
    });
    $('#text-fontcolor').on('change', function (e) {
        if ($('#drawingArea').hasClass('d-none')) {
            let activeObject = canvasBack.getActiveObject();
            if (activeObject && activeObject.type === 'text') {
                console.log('color if')

                activeObject.fill = this.value;
                canvasBack.renderAll();
            }
        } else {
            let activeObject = canvas.getActiveObject();
            if (activeObject && activeObject.type === 'text') {
                console.log('color else')

                activeObject.fill = this.value;
                canvas.renderAll();
            }
        }
    });

// canvas.add(new fabric.fabric.Object({hasBorders:true,hasControls:false,hasRotatingPoint:true,selectable:true,type:'rect'}));


    $('.color-preview').click(function () {
        var color = $(this).css("background-color");
        document.getElementById("shirtDiv").style.backgroundColor = color;
    });
    $(".clearfix button,a").tooltip();
// Handle download button click
//     document.getElementById("save").onclick = function () {
//         $('#shirtDiv').removeClass('d-none');
//         $('#shirtDivBack').removeClass('d-none');
//         $('#drawingArea').removeClass('d-none');
//         $('#drawingAreaBack').removeClass('d-none');
//
//
//         html2canvas(document.getElementById("shirtDiv"), {removeContainer: false}).then(function (canvas) {
//             console.log('test')
//             // document.body.appendChild(canvas)
//             var data = canvas.toDataURL({
//                 format: "png"
//             });
//             $('#download').val(data);
//         });
//
//         // setTimeout(
//         //     function () {
//         html2canvas(document.getElementById("shirtDivBack"), {removeContainer: false}).then(function (canvas1) {
//             console.log('test1')
//             // document.body.appendChild(canvas)
//             var data = canvas1.toDataURL({
//                 format: "png"
//             });
//             $('#download1').val(data);
//         });
//         // }, 1000);
//
//         $('#shirtDiv').addClass('d-none');
//         $('#shirtDivBack').addClass('d-none');
//         $('#drawingArea').addClass('d-none');
//         $('#drawingAreaBack').addClass('d-none');
//         var pngFrontURL = canvas.toDataURL({
//             format: "png"
//         });
//         var pngBackURL = canvasBack.toDataURL({
//             format: "png"
//         });
//         console.log(pngFrontURL);
//         $('#design_front_photo').val(pngFrontURL);
//         $('#design_back_photo').val(pngBackURL);
//         $('#main_image_width').val($('#tshirtFacing').outerWidth());
//         $('#main_image_height').val($('#tshirtFacing').outerHeight());
//         setTimeout(
//             function () {
//                 // $('#myForm').submit();
//             }, 1000);
//     };
});

function onObjectSelected(e) {
    var selectedObject = e.target;
    selectedObject.selected = true
    $("#text-string").val("");
    selectedObject.hasRotatingPoint = true
    if (selectedObject && selectedObject.type === 'text') {
        //display text editor
        $("#texteditor").css('display', 'block');
        $("#text-string").val(selectedObject.getText());
        $('#text-fontcolor').val(selectedObject.fill);
        $("#imageeditor").css('display', 'block');
    } else if (selectedObject && selectedObject.type === 'image') {
        //display image editor
        $("#texteditor").css('display', 'none');
        $("#imageeditor").css('display', 'block');
    }
}

function onObjectSelectedBack(e) {
    var selectedObject = e.target;
    $("#text-string").val("");
    selectedObject.hasRotatingPoint = true
    selectedObject.selected = true
    if (selectedObject && selectedObject.type === 'text') {
        //display text editor
        $("#texteditor").css('display', 'block');
        $("#text-string").val(selectedObject.getText());
        $('#text-fontcolor').val(selectedObject.fill);
        $("#imageeditor").css('display', 'block');
    } else if (selectedObject && selectedObject.type === 'image') {
        //display image editor
        $("#texteditor").css('display', 'none');
        $("#imageeditor").css('display', 'block');
    }
}

function onSelectedCleared(e) {
    $("#texteditor").css('display', 'none');
    $("#text-string").val("");
    $("#imageeditor").css('display', 'none');
}

function onSelectedClearedBack(e) {
    $("#texteditor").css('display', 'none');
    $("#text-string").val("");
    $("#imageeditor").css('display', 'none');
}

function setFont(font) {
    if ($('#drawingArea').hasClass('d-none')) {
        let activeObject = canvasBack.getActiveObject();
        if (activeObject && activeObject.type === 'text') {
            activeObject.fontFamily = font;
            canvasBack.renderAll();
        }
    } else {
        let activeObject = canvas.getActiveObject();
        if (activeObject && activeObject.type === 'text') {
            activeObject.fontFamily = font;
            canvas.renderAll();
        }
    }
    $('#dropdown-menu').toggle();
}

function removeWhite() {
    if ($('#drawingArea').hasClass('d-none')) {
        let activeObject = canvasBack.getActiveObject();
        if (activeObject && activeObject.type === 'image') {
            activeObject.filters[2] = new fabric.Image.filters.RemoveWhite({hreshold: 100, distance: 10});//0-255, 0-255
            activeObject.applyFilters(canvasBack.renderAll.bind(canvasBack));
        }
    } else {
        let activeObject = canvas.getActiveObject();
        if (activeObject && activeObject.type === 'image') {
            activeObject.filters[2] = new fabric.Image.filters.RemoveWhite({hreshold: 100, distance: 10});//0-255, 0-255
            activeObject.applyFilters(canvas.renderAll.bind(canvas));
        }
    }
}
