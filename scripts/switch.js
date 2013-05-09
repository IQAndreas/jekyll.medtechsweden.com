var quotes=new Array()

//change the quotes if desired. Add/ delete additional quotes as desired.

quotes[0]='<IMG SRC="images/small-1.jpg" WIDTH=533 HEIGHT=140 BORDER=0 ALT="" USEMAP="#1">'
quotes[1]='<IMG SRC="images/small-2.jpg" WIDTH=533 HEIGHT=140 BORDER=0 ALT="" USEMAP="#2">'
quotes[2]='<IMG SRC="images/small-3.jpg" WIDTH=533 HEIGHT=140 BORDER=0 ALT="" USEMAP="#3">'
quotes[3]='<IMG SRC="images/small-4.jpg" WIDTH=533 HEIGHT=140 BORDER=0 ALT="" USEMAP="#4">'

var whichquote=Math.floor(Math.random()*(quotes.length))
document.write(quotes[whichquote])