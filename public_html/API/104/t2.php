<html>
<body>
<heaad>

</heaad>
<body>
<button onclick="ChangeColor()">Set Color</button><br>
<div id="border" style="border: solid; border-width: thick">
    <div id="eddiv" contenteditable="true">
        This text can be edited by the user.
    </div>
</div>
</body>
<script>
    function ChangeColor() {
        replaceSelectedText('[553322]'+getSelectionHtml()+'[-]')
    }
    function getSelectionHtml() {
        var html = "";
        if (typeof window.getSelection != "undefined") {
            var sel = window.getSelection();
            if (sel.rangeCount) {
                var container = document.createElement("div");
                for (var i = 0, len = sel.rangeCount; i < len; ++i) {
                    container.appendChild(sel.getRangeAt(i).cloneContents());
                }
                html = container.innerHTML;
            }
        } else if (typeof document.selection != "undefined") {
            if (document.selection.type == "Text") {
                html = document.selection.createRange().htmlText;
            }
        }
        return html;
    }
    function replaceSelectedText(replacementText) {
        var sel, range;
        if (window.getSelection) {
            sel = window.getSelection();
            if (sel.rangeCount) {
                range = sel.getRangeAt(0);
                range.deleteContents();
                range.insertNode(document.createTextNode(replacementText));
            }
        } else if (document.selection && document.selection.createRange) {
            range = document.selection.createRange();
            range.text = replacementText;
        }
    }
</script>
</html>