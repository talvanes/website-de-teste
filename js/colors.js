/*
 * This Javascript code uses tinycolor.js library to extract a complementary color
 */
var colorizeComments = function(){
	// show comments using querySelectorAll()
	var comentarios = document.querySelectorAll("#comments .comment");
	// show users' links using querySelectorAll()
	var usersLinks = document.querySelectorAll("#comments a.no-underline");
	// iterate over the comments array
	for (var index = 0; index < comentarios.length; index += 1){
		// the color of each comment as an hex
		var color;
		if (comentarios[index].style !== undefined){
			color = comentarios[index].style.backgroundColor;
		} else {
			color = "#000";
		}
		// complementary color
		var complementaryColor = tinycolor(color).complement().toHexString();
		// now set their new text color
		if (comentarios[index].style !== undefined){
			comentarios[index].style.color = complementaryColor;
			usersLinks[index].style.color = complementaryColor;
			usersLinks[index].style.backgroundColor = color;
		} else {
			// create a style
		}
	}
}

