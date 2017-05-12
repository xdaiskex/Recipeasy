//Search Yummly using value found in search bar
document.getElementById('foodSearch').onkeyup = function(e) {
    if (!e) var e = window.event;
    if (e.keyCode != 13) return;
    document.getElementById('foodSearch').blur();
    searchFood(document.getElementById('foodSearch').value);
}

function searchFood(food){
	//Yummly credentials
	var id = "09abdc63";
	var key = "84e7799bb6742641ccef20abbcfec710";

	//Gets JSON data from Yummly API based on search
	$.getJSON('http://api.yummly.com/v1/api/recipes?_app_id=' + id + '&_app_key=' + key + '&q=' + food + '&requirePictures=true', function(data){
		$("#food").empty();

		//Set up a counter to see if there are any results
		var count = 0;

		//For each match, create a variable that will store each JSON data
		$.each(data.matches, function(i, item){
			count++;
			var name = data.matches[i].recipeName;
			var image = data.matches[i].imageUrlsBySize["90"];
			var biggerImage = image.replace(90, 500);
			var time = (data.matches[i].totalTimeInSeconds)/60;
			var id = data.matches[i].id;
			var recipe = "http://www.yummly.co/recipe/" + id;

			//Pop out each match in the form of a Materialize card in HTML
			var food_info = 
				"<div class='col l4 m6 s12'>" +
					"<div class='card'>" +
						"<div class='card-image'>" +
							"<img src='" + biggerImage + "' alt='" + id + "' class='food_image' onError=\"this.onerror=null;this.src='img/dead.png';\">" +
							"<span class='card-title'>" + name + "</span>" +
							"<a class='btn-floating halfway-fab waves-effect waves-light red add'><i class='material-icons adding'>add</i></a>" +
						"</div>" +
						"<div class='card-content'>" +
							"<p>" + time + " minutes</p>" +
						"</div>" +
						"<div class='card-action'>" +
							"<a href='" + recipe + "' target='blank' class='black-text'>Recipe Link</a>" +
					"</div>" +
				"</div>";
			$("#food").append(food_info);
		});
		//If there are no matches, show the error message
		if(count == 0){
			$('#loading').fadeOut(function(){
				$('#start').hide();
				$('#error').fadeIn(1000);
			});
		//If there is at least 1 match, show the button that will auto scroll to the matches
		}else{
			$('#error').hide();
			$('#start').delay(700).fadeIn(1000);
		}
	});
}

var clicked;

//Grabs the info of a specific recipe
function searchRecipe(food){
	var id = "09abdc63";
	var key = "84e7799bb6742641ccef20abbcfec710";

	$.getJSON('http://api.yummly.com/v1/api/recipe/'+ food +'?_app_id='+ id + '&_app_key=' + key + '', function(data){
		var name = data.name;
		var link = data.attribution.url;
		var image = data.images["0"].imageUrlsBySize["360"];

		var info = 'name='+ name + '&link='+ link + '&image='+ image;

		//Calls the add php file to add the recipe into your favorites 
		$.post('add.php', info, function(data){
			var result = $.trim(data);

			//Toast for success or failure upon adding
			if(result == "success"){
				Materialize.toast('<b>Recipe added to your favorites</b>', 4000, 'green');
				clicked.empty();
				clicked.html("star");
			}
			else{
				Materialize.toast('<b>Please login to add recipes</b>', 4000, 'red');
			}
		});
	});
}

//Add a food to your favorites when clicking on the add button
$("#food").delegate(".add", "click", function(){
	var recipe = $(this).parent().find("img").attr("alt");
	searchRecipe(recipe);
	clicked = $(this).find("i");
});