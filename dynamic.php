<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $("input").keyup(function(){
        txt = $("input").val();
        $("span").load("data.php", {suggest: txt});
    });
});
</script>
</head>
<body>

<p>Start typing a name in the input field below:</p>
First name:

<input type="text">

<p>Suggestions: <span></span></p>


</body>
</html>
