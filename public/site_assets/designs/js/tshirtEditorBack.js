var canvasBack;
var tshirts = new Array(); //prototype: [{style:'x',color:'white',front:'a',back:'b',price:{tshirt:'12.95',frontPrint:'4.99',backPrint:'4.99',total:'22.47'}}]
var a;
var b;
var line1;
var line2;
var line3;
var line4;
$(document).ready(function () {
    //setup front side canvasBack
    canvasBack = new fabric.Canvas('tcanvasBack', {
        hoverCursor: 'pointer',
        selection: true,
        selectionBorderColor: 'blue'
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

    document.getElementById('add-text').onclick = function () {
        var text = $("#text-string").val();
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
        $("#texteditor").css('display', 'block');
        $("#imageeditor").css('display', 'block');
    };
    $("#text-string").keyup(function () {
        var activeObject = canvasBack.getActiveObject();
        if (activeObject && activeObject.type === 'text') {
            activeObject.text = this.value;
            canvasBack.renderAll();
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
                padding: 10,
                cornersize: 10,
                hasRotatingPoint: true
            });
            //image.scale(getRandomNum(0.1, 0.25)).setCoords();

            canvasBack.centerObject(image).add(image);
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
    $("#downloadDesign").click(function (e) {
        this.href = canvasBack.toDataURL({
            format: 'png',
            quality: 0.8
        });
        this.download = 'design.png'
    });
    document.getElementById('remove-selected').onclick = function () {
        var activeObject = canvasBack.getActiveObject(),
            activeGroup = canvasBack.getActiveGroup();
        if (activeObject) {
            canvasBack.remove(activeObject);
            $("#text-string").val("");
        } else if (activeGroup) {
            var objectsInGroup = activeGroup.getObjects();
            canvasBack.discardActiveGroup();
            objectsInGroup.forEach(function (object) {
                canvasBack.remove(object);
            });
        }
    };
    document.getElementById('bring-to-front').onclick = function () {
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
    document.getElementById('send-to-back').onclick = function () {
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
    $("#text-bold").click(function () {
        var activeObject = canvasBack.getActiveObject();
        if (activeObject && activeObject.type === 'text') {
            activeObject.fontWeight = (activeObject.fontWeight == 'bold' ? '' : 'bold');
            canvasBack.renderAll();
        }
    });
    $("#text-italic").click(function () {
        var activeObject = canvasBack.getActiveObject();
        if (activeObject && activeObject.type === 'text') {
            activeObject.fontStyle = (activeObject.fontStyle == 'italic' ? '' : 'italic');
            canvasBack.renderAll();
        }
    });
    $("#text-strike").click(function () {
        var activeObject = canvasBack.getActiveObject();
        if (activeObject && activeObject.type === 'text') {
            activeObject.textDecoration = (activeObject.textDecoration == 'line-through' ? '' : 'line-through');
            canvasBack.renderAll();
        }
    });
    $("#text-underline").click(function () {
        var activeObject = canvasBack.getActiveObject();
        if (activeObject && activeObject.type === 'text') {
            activeObject.textDecoration = (activeObject.textDecoration == 'underline' ? '' : 'underline');
            canvasBack.renderAll();
        }
    });
    $("#text-left").click(function () {
        var activeObject = canvasBack.getActiveObject();
        if (activeObject && activeObject.type === 'text') {
            activeObject.textAlign = 'left';
            canvasBack.renderAll();
        }
    });
    $("#text-center").click(function () {
        var activeObject = canvasBack.getActiveObject();
        if (activeObject && activeObject.type === 'text') {
            activeObject.textAlign = 'center';
            canvasBack.renderAll();
        }
    });
    $("#text-right").click(function () {
        var activeObject = canvasBack.getActiveObject();
        if (activeObject && activeObject.type === 'text') {
            activeObject.textAlign = 'right';
            canvasBack.renderAll();
        }
    });
    $("#font-family").change(function () {
        var activeObject = canvasBack.getActiveObject();
        if (activeObject && activeObject.type === 'text') {
            activeObject.fontFamily = this.value;
            canvasBack.renderAll();
        }
    });
    $('#text-bgcolor').miniColors({
        change: function (hex, rgb) {
            var activeObject = canvasBack.getActiveObject();
            if (activeObject && activeObject.type === 'text') {
                activeObject.backgroundColor = this.value;
                canvasBack.renderAll();
            }
        },
        open: function (hex, rgb) {
            //
        },
        close: function (hex, rgb) {
            //
        }
    });
    $('#text-fontcolor').miniColors({
        change: function (hex, rgb) {
            var activeObject = canvasBack.getActiveObject();
            if (activeObject && activeObject.type === 'text') {
                activeObject.fill = this.value;
                canvasBack.renderAll();
            }
        },
        open: function (hex, rgb) {
            //
        },
        close: function (hex, rgb) {
            //
        }
    });

    $('#text-strokecolor').miniColors({
        change: function (hex, rgb) {
            var activeObject = canvasBack.getActiveObject();
            if (activeObject && activeObject.type === 'text') {
                activeObject.strokeStyle = this.value;
                canvasBack.renderAll();
            }
        },
        open: function (hex, rgb) {
            //
        },
        close: function (hex, rgb) {
            //
        }
    });

    //canvasBack.add(new fabric.fabric.Object({hasBorders:true,hasControls:false,hasRotatingPoint:false,selectable:false,type:'rect'}));
    $("#drawingArea").hover(
        function () {
            canvasBack.add(line1);
            canvasBack.add(line2);
            canvasBack.add(line3);
            canvasBack.add(line4);
            canvasBack.renderAll();
        },
        function () {
            canvasBack.remove(line1);
            canvasBack.remove(line2);
            canvasBack.remove(line3);
            canvasBack.remove(line4);
            canvasBack.renderAll();
        }
    );

    $('.color-preview').click(function () {
        var color = $(this).css("background-color");
        document.getElementById("shirtDiv").style.backgroundColor = color;
    });

    $('#flip').click(
        function () {
            if ($(this).attr("data-original-title") == "Show Back View") {
                $(this).attr('data-original-title', 'Show Front View');
                $("#shirtBack").attr("src", "img/crew_back.png");
                a = JSON.stringify(canvasBack);
                canvasBack.clear();
                try {
                    var json = JSON.parse(b);
                    canvasBack.loadFromJSON(b);
                } catch (e) {
                }

            } else {
                $(this).attr('data-original-title', 'Show Back View');
                $("#shirtBack").attr("src", "img/crew_front.png");
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
    // line1 = new fabric.Line([0, 0, 200, 0], {
    //     "stroke": "#000000",
    //     "strokeWidth": 1,
    //     hasBorders: false,
    //     hasControls: false,
    //     hasRotatingPoint: false,
    //     selectable: false
    // });
    // line2 = new fabric.Line([199, 0, 200, 399], {
    //     "stroke": "#000000",
    //     "strokeWidth": 1,
    //     hasBorders: false,
    //     hasControls: false,
    //     hasRotatingPoint: false,
    //     selectable: false
    // });
    // line3 = new fabric.Line([0, 0, 0, 400], {
    //     "stroke": "#000000",
    //     "strokeWidth": 1,
    //     hasBorders: false,
    //     hasControls: false,
    //     hasRotatingPoint: false,
    //     selectable: false
    // });
    // line4 = new fabric.Line([0, 400, 200, 399], {
    //     "stroke": "#000000",
    //     "strokeWidth": 1,
    //     hasBorders: false,
    //     hasControls: false,
    //     hasRotatingPoint: false,
    //     selectable: false
    // });

    // Handle download button click
    document.getElementById("save").onclick = function () {
        var pngFrontURL = canvasBack.toDataURL({
            format: "png"
        });
        console.log(pngFrontURL);
        $('#design_front_photo').val(pngFrontURL);
        $('main_image_width').val($('#shirtBack').outerWidth());
        $('main_image_height').val($('#shirtBack').outerHeight());
        // $('#myForm').submit();
    };


});//doc ready


function getRandomNum(min, max) {
    return Math.random() * (max - min) + min;
}

function onObjectSelected(e) {
    var selectedObject = e.target;
    $("#text-string").val("");
    selectedObject.hasRotatingPoint = true
    if (selectedObject && selectedObject.type === 'text') {
        //display text editor
        $("#texteditor").css('display', 'block');
        $("#text-string").val(selectedObject.getText());
        $('#text-fontcolor').miniColors('value', selectedObject.fill);
        $('#text-strokecolor').miniColors('value', selectedObject.strokeStyle);
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
