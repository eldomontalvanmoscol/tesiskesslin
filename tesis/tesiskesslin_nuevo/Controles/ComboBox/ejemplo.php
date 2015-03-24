// * Dependencies * 
// this function requires the following snippets:
// JavaScript/Randomizers/randomNumber
// JavaScript/conversions/base_conversion/decToHex
<script type="text/javascript">
function randomBgColor()
{
  var r,g,b;
  r = decToHex(randomNumber(256)-1);
  g = decToHex(randomNumber(256)-1);
  b = decToHex(randomNumber(256)-1);
  document.bgColor = "#" + r + g + b;
}
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
</head>

<body onload="randomBgColor">
</body>
</html>
