var canvasBack;
var a;
var b;
$(document).ready(function () {
    //setup front side canvasBack
    canvasBack = new fabric.Canvas('canvasBack', {
        hoverCursor: 'pointer',
        selection: true,
        selectionBorderColor: 'blue',
        // hasBorders:true
    });
    canvasBack.on({
        'object:moving': function (e) {
            e.target.opacity = 0.5;
        },
        'object:modified': function (e) {
            e.target.opacity = 1;
        },
        'object:selected': onObjectSelected,
        'selection:cleared': onSelectedCleared
    });
    // piggyback on `canvasBack.findTarget`, to fire "object:over" and "object:out" events
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

    canvasBack.on('object:over', function (e) {
        //e.target.setFill('red');
        //canvasBack.renderAll();
    });

    canvasBack.on('object:out', function (e) {
        //e.target.setFill('green');
        //canvasBack.renderAll();
    });

    document.getElementById('add-textBack').onclick = function () {
        var text = $("#text-stringBack").val();
        var textSample = new fabric.Text(text, {
            // left: fabric.util.getRandomInt(0, 200),
            // top: fabric.util.getRandomInt(0, 400),
            fontFamily: 'helvetica',
            angle: 0,
            fill: '#000000',
            scaleX: 0.5,
            scaleY: 0.5,
            fontWeight: '',
            hasRotatingPoint: true
        });
        canvasBack.centerObject(textSample).add(textSample);
        canvasBack.item(canvasBack.item.length - 1).hasRotatingPoint = true;
        $("#texteditorBack").css('display', 'block');
        $("#imageeditorBack").css('display', 'block');
    };
    $("#text-stringBack").keyup(function () {
        var activeObject = canvasBack.getActiveObject();
        if (activeObject && activeObject.type === 'text') {
            activeObject.text = this.value;
            canvasBack.renderAll();
        }
    });
    $(".img-polaroidBack").click(function (e) {
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
                padding: 10,
                cornersize: 10,
                hasRotatingPoint: true
            });
            //image.scale(getRandomNum(0.1, 0.25)).setCoords();

            canvasBack.centerObject(image).add(image);
        });
    });
    $("#fileToUploadBack").change(function (e) {
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
                    padding: 10,
                    cornersize: 10,
                    hasRotatingPoint: true
                });
                canvasBack.centerObject(img);
                canvasBack.add(img).setActiveObject(img).renderAll();
            }
        }
        reader.readAsDataURL(e.target.files[0]);
    });
    $("#downloadDesignBack").click(function (e) {
        this.href = canvasBack.toDataURL({
            format: 'png',
            quality: 0.8
        });
        this.download = 'design.png'
    });
    document.getElementById('remove-selectedBack').onclick = function () {
        var activeObject = canvasBack.getActiveObject(),
            activeGroup = canvasBack.getActiveGroup();
        if (activeObject) {
            canvasBack.remove(activeObject);
            $("#text-stringBack").val("");
        } else if (activeGroup) {
            var objectsInGroup = activeGroup.getObjects();
            canvasBack.discardActiveGroup();
            objectsInGroup.forEach(function (object) {
                canvasBack.remove(object);
            });
        }
    };
    document.getElementById('bring-to-frontBack').onclick = function () {
        var activeObject = canvasBack.getActiveObject(),
            activeGroup = canvasBack.getActiveGroup();
        if (activeObject) {
            activeObject.bringToFront();
        } else if (activeGroup) {
            var objectsInGroup = activeGroup.getObjects();
            canvasBack.discardActiveGroup();
            objectsInGroup.forEach(function (object) {
                object.bringToFront();
            });
        }
    };
    document.getElementById('send-to-backBack').onclick = function () {
        var activeObject = canvasBack.getActiveObject(),
            activeGroup = canvasBack.getActiveGroup();
        if (activeObject) {
            activeObject.sendToBack();
        } else if (activeGroup) {
            var objectsInGroup = activeGroup.getObjects();
            canvasBack.discardActiveGroup();
            objectsInGroup.forEach(function (object) {
                object.sendToBack();
            });
        }
    };
    $("#text-boldBack").click(function () {
        var activeObject = canvasBack.getActiveObject();
        if (activeObject && activeObject.type === 'text') {
            activeObject.fontWeight = (activeObject.fontWeight == 'bold' ? '' : 'bold');
            canvasBack.renderAll();
        }
    });
    $("#text-italicBack").click(function () {
        var activeObject = canvasBack.getActiveObject();
        if (activeObject && activeObject.type === 'text') {
            activeObject.fontStyle = (activeObject.fontStyle == 'italic' ? '' : 'italic');
            canvasBack.renderAll();
        }
    });
    $("#text-strikeBack").click(function () {
        var activeObject = canvasBack.getActiveObject();
        if (activeObject && activeObject.type === 'text') {
            activeObject.textDecoration = (activeObject.textDecoration == 'line-through' ? '' : 'line-through');
            canvasBack.renderAll();
        }
    });
    $("#text-underlineBack").click(function () {
        var activeObject = canvasBack.getActiveObject();
        if (activeObject && activeObject.type === 'text') {
            activeObject.textDecoration = (activeObject.textDecoration == 'underline' ? '' : 'underline');
            canvasBack.renderAll();
        }
    });
    $("#text-leftBack").click(function () {
        var activeObject = canvasBack.getActiveObject();
        if (activeObject && activeObject.type === 'text') {
            activeObject.textAlign = 'left';
            canvasBack.renderAll();
        }
    });
    $("#text-centerBack").click(function () {
        var activeObject = canvasBack.getActiveObject();
        if (activeObject && activeObject.type === 'text') {
            activeObject.textAlign = 'center';
            canvasBack.renderAll();
        }
    });
    $("#text-rightBack").click(function () {
        var activeObject = canvasBack.getActiveObject();
        if (activeObject && activeObject.type === 'text') {
            activeObject.textAlign = 'right';
            canvasBack.renderAll();
        }
    });
    $("#font-familyBack").change(function () {
        var activeObject = canvasBack.getActiveObject();
        if (activeObject && activeObject.type === 'text') {
            activeObject.fontFamily = this.value;
            canvasBack.renderAll();
        }
    });
    $('#text-strokecolorBack').on('change',function (e) {
        var activeObject = canvasBack.getActiveObject();
        if (activeObject && activeObject.type === 'text') {
            activeObject.strokeStyle = this.value;
            canvasBack.renderAll();
        }
    });
    $('#text-fontcolorBack').on('change', function (e) {
        var activeObject = canvasBack.getActiveObject();
        if (activeObject && activeObject.type === 'text') {
            activeObject.fill = this.value;
            canvasBack.renderAll();
        }
    });

    // canvasBack.add(new fabric.fabric.Object({hasBorders:true,hasControls:false,hasRotatingPoint:true,selectable:true,type:'rect'}));


    $('.color-preview').click(function () {
        var color = $(this).css("background-color");
        document.getElementById("shirtDiv").style.backgroundColor = color;
    });

    $('#flip').click(
        function () {
            if ($(this).attr("data-original-title") == "Show Back View") {
                $(this).attr('data-original-title', 'Show Front View');
                $("#tshirtFacingBack").attr("src", "img/crew_back.png");
                a = JSON.stringify(canvasBack);
                canvasBack.clear();
                try {
                    var json = JSON.parse(b);
                    canvasBack.loadFromJSON(b);
                } catch (e) {
                }

            } else {
                $(this).attr('data-original-title', 'Show Back View');
                $("#tshirtFacingBack").attr("src", "img/crew_front.png");
                b = JSON.stringify(canvasBack);
                canvasBack.clear();
                try {
                    var json = JSON.parse(a);
                    canvasBack.loadFromJSON(a);
                } catch (e) {
                }
            }
            canvasBack.renderAll();
            setTimeout(function () {
                canvasBack.calcOffset();
            }, 200);
        });
    $(".clearfix button,a").tooltip();
    // Handle download button click
    document.getElementById("save").onclick = function () {
        var pngFrontURL = canvasBack.toDataURL({
            format: "png"
        });
        console.log(pngFrontURL);
        $('#design_front_photo').val(pngFrontURL);
        $('main_image_width').val($('#tshirtFacingBack').outerWidth());
        $('main_image_height').val($('#tshirtFacingBack').outerHeight());
        // $('#myForm').submit();
    };


});//doc ready


function getRandomNum(min, max) {
    return Math.random() * (max - min) + min;
}

function onObjectSelected(e) {
    var selectedObject = e.target;
    $("#text-stringBack").val("");
    selectedObject.hasRotatingPoint = true
    if (selectedObject && selectedObject.type === 'text') {
        //display text editor
        $("#texteditorBack").css('display', 'block');
        $("#text-stringBack").val(selectedObject.getText());
        $('#text-fontcolorBack').miniColors('value', selectedObject.fill);
        $('#text-strokecolorBack').miniColors('value', selectedObject.strokeStyle);
        $("#imageeditorBack").css('display', 'block');
    } else if (selectedObject && selectedObject.type === 'image') {
        //display image editor
        $("#texteditorBack").css('display', 'none');
        $("#imageeditorBack").css('display', 'block');
    }
}

function onSelectedCleared(e) {
    $("#texteditorBack").css('display', 'none');
    $("#text-stringBack").val("");
    $("#imageeditorBack").css('display', 'none');
}

function setFont(font) {
    var activeObject = canvasBack.getActiveObject();
    if (activeObject && activeObject.type === 'text') {
        activeObject.fontFamily = font;
        canvasBack.renderAll();
    }
}

function removeWhite() {
    var activeObject = canvasBack.getActiveObject();
    if (activeObject && activeObject.type === 'image') {
        activeObject.filters[2] = new fabric.Image.filters.RemoveWhite({hreshold: 100, distance: 10});//0-255, 0-255
        activeObject.applyFilters(canvasBack.renderAll.bind(canvasBack));
    }
}
