<HTML>
<HEAD>
<TITLE>Elements Array</TITLE>
<SCRIPT LANGUAGE="JavaScript">
function verifyIt() {
    var form = document.forms["test"];
    for (i = 0; i < form.elements.length; i++) {
        if (form.elements[i].type == "text" && form.elements[i].value == ""){
            alert("Please fill out all fields.")
            form.elements[i].focus()
            break
        }
    }
}

function secandform() {
    var form = document.forms["test2"];
    for (i = 0; i < form.elements.length; i++) {
        if (form.elements[i].type == "text" && form.elements[i].value == ""){
            alert("Please fill out all fields.")
            form.elements[i].focus()
            break
        }
    }
}


</SCRIPT>
</HEAD>
<BODY>

<form mame ="test2">
	<input type="text" name="" id="">
	<input type="text" name="" id="">
		
<INPUT TYPE="button" NAME="act" VALUE="Verify" onClick="secandform()">


</form>



<FORM name ="test">
Enter your first name:<INPUT TYPE="text" NAME="firstName"><P>
Enter your last name:<INPUT TYPE="text" NAME="lastName"><P>
<INPUT TYPE="radio" NAME="gender">Male
<INPUT TYPE="radio" NAME="gender">Female <P>
Enter your address:<INPUT TYPE="text" NAME="address"><P>
Enter your city:<INPUT TYPE="text" NAME="city"><P>
<INPUT TYPE="checkbox" NAME="retired">I am retired
</FORM>
<FORM>
<INPUT TYPE="button" NAME="act" VALUE="Verify" onClick="verifyIt()">
</FORM>
</BODY>
</HTML>