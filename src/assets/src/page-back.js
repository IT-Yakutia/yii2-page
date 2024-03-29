function clipboardCopy(elementId) {
    /* Get the text field */
    var copyText = document.getElementById(elementId);
  
    /* Select the text field */
    copyText.select();
    copyText.setSelectionRange(0, 99999); /* For mobile devices */
  
     /* Copy the text inside the text field */
    navigator.clipboard.writeText(copyText.value);
  
    /* Alert the copied text */
    M.toast({html: "Скопирован: <br/>" + copyText.value})
}