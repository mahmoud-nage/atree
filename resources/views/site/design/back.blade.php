<div align="center" style="min-height: 32px;">
    <div class="clearfix">
        <div class="btn-group inline pull-right" id="texteditor"
             style="display:none">
            <button id="font-family"
                    class="btn btn-xs btn-default dropdown-toggle"
                    type="button"
                    data-toggle="dropdown" title="Font Style"><i
                    class="icon-font" style="width:19px;height:19px;"></i>
            </button>
            <ul class="dropdown-menu" role="menu" id="dropdown-menu"
                aria-labelledby="font-family">
                <li><a tabindex="-1" href="#" onclick="setFont('Arial');"
                       class="Arial dropdown-item">Arial</a></li>
                <li><a tabindex="-1" href="#"
                       onclick="setFont('Helvetica');"
                       class="Helvetica dropdown-item">Helvetica</a></li>
                <li><a tabindex="-1" href="#"
                       onclick="setFont('Myriad Pro');"
                       class="MyriadPro dropdown-item">Myriad Pro</a></li>
                <li><a tabindex="-1" href="#"
                       onclick="setFont('Delicious');"
                       class="Delicious dropdown-item">Delicious</a></li>
                <li><a tabindex="-1" href="#" onclick="setFont('Verdana');"
                       class="Verdana dropdown-item">Verdana</a></li>
                <li><a tabindex="-1" href="#" onclick="setFont('Georgia');"
                       class="Georgia dropdown-item">Georgia</a></li>
                <li><a tabindex="-1" href="#" onclick="setFont('Courier');"
                       class="Courier dropdown-item">Courier</a></li>
                <li><a tabindex="-1" href="#"
                       onclick="setFont('Comic Sans MS');"
                       class="ComicSansMS dropdown-item">Comic
                        Sans MS</a></li>
                <li><a tabindex="-1" href="#" onclick="setFont('Impact');"
                       class="Impact dropdown-item">Impact</a></li>
                <li><a tabindex="-1" href="#" onclick="setFont('Monaco');"
                       class="Monaco dropdown-item">Monaco</a></li>
                <li><a tabindex="-1" href="#" onclick="setFont('Optima');"
                       class="Optima dropdown-item">Optima</a></li>
                <li><a tabindex="-1" href="#"
                       onclick="setFont('Hoefler Text');"
                       class="Hoefler Text dropdown-item">Hoefler Text</a></li>
                <li><a tabindex="-1" href="#" onclick="setFont('Plaster');"
                       class="Plaster dropdown-item">Plaster</a></li>
                <li><a tabindex="-1" href="#"
                       onclick="setFont('Engagement');"
                       class="Engagement dropdown-item">Engagement</a></li>
            </ul>
            <button id="text-bold" type="button" class="btn btn-xs btn-default"
                    data-original-title="Bold"><img
                    src="{{ asset('site_assets/designs/img/font_bold.png') }}"
                    height="" width=""></button>
            <button id="text-italic" type="button"
                    class="btn btn-xs btn-default"
                    data-original-title="Italic"><img
                    src="{{ asset('site_assets/designs/img/font_italic.png') }}"
                    height="" width=""></button>
            <button id="text-strike" type="button"
                    class="btn btn-xs btn-default"
                    title="Strike"
                    style=""><img
                    src="{{ asset('site_assets/designs/img/font_strikethrough.png') }}"
                    height="" width=""></button>
            <button id="text-underline" type="button"
                    class="btn btn-xs btn-default"
                    title="Underline" style=""><img
                    src="{{ asset('site_assets/designs/img/font_underline.png') }}">
            </button>
            <input type="color"
                   id="text-fontcolor"
                   class="color-picker btn btn-xs btn-default"
                   title="Text Color"
                   size="7" value="#000000">
            <input type="color" id="text-strokecolor"
                   class="color-picker d-none" title="Border Color"
                   size="7"
                   value="#000000">
        </div>
        <div class="pull-right" align="" id="imageeditor"
             style="display:none">
            <div class="btn-group">
                <button class="btn d-none" type="button" id="bring-to-front"
                        title="Bring to Front"><i
                        class="fa fa-fast-backward rotate d-none"
                        style="height:19px;"></i></button>
                <button class="btn d-none" type="button" id="send-to-back"
                        title="Send to Back"><i
                        class="fa fa-fast-forward rotate"
                        style="height:19px;"></i>
                </button>
                <button id="flip" type="button" class="btn d-none"
                        title="Show Back View"><i class="icon-retweet"
                                                  style="height:19px;"></i>
                </button>
                <button id="remove-selected" type="button"
                        class="btn btn-xs btn-default"
                        title="Delete selected item"><i
                        class="fa fa-trash text-danger"
                        style="height:19px;"></i>
                </button>
            </div>
        </div>
    </div>
</div>
