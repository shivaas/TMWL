var tempheartspace_level = 0;
var limitLinks = 4;
var autoheartspace_level = {};
var heartspace_pointer = '/wp-content/themes/2mamawithlove/assets/Heartspace-pointer.png';
var heartspace_pointer_o = '/wp-content/themes/2mamawithlove/assets/Heartspace-pointer-rollover.png';
var is_heart_hover = false;
$(function($){

    $("#tabs").tabs();

    $(".oembed").oembed(null, {
        embedMethod: "append", 
        maxWidth: 450,
        maxHeight: 400,
        youtube: { height:"460", width:"360"},
        flickr: { maxheight:"500", maxwidth:"500"}
        });
        
	$('#blog-embed').click(function (e) {
		$('#blog-embed-window').modal();
	});

	$('#heartspace-search').click(function (e) {
		$('#heartspace-search-form').modal();
	});
    $('#heartspace-search-query').submit(function() {
      heartspaceSearch();
      return false;
    });
    
	$('#heartspace-query').click(function (e) {
        heartspaceSearch();
	});

	$.Juitter.start({
		searchType:"searchWord", // needed, you can use "searchWord", "fromUser", "toUser"
		searchObject:"epicchange",
		live:"live-15", // the number after "live-" indicates the time in seconds to wait before request the Twitter API for updates.
		placeHolder:"twitterFeed", // Set a place holder DIV which will receive the list of tweets example <div id="juitterContainer"></div>
		loadMSG: "Loading messages...",
		total: 4, // number of tweets to be show - max 100
		readMore: "Read it on Twitter", // read more message to be show after the tweet content
		nameUser:"image", // insert "image" to show avatar of "text" to show the name of the user that sent the tweet 
		openExternalLinks:"newWindow" // here you can choose how to open link to external websites, "newWindow" or "sameWindow"
	});

    jQuery('#heartspace-photos').jcarousel({
        scroll: 1
    });

/*
$('.heartspace-new').click(function(){
    $('#heartspace-selection').find('div').fadeOut("slow").remove();
    heartspace_hotspot();
});
*/
$('.hover').hover(
  function () {
    hover = $(this).attr('hover');
    $(this).attr('hover', $(this).attr('src') );
    $(this).attr('src', hover );
  }, 
  function () {
    src = $(this).attr('src');
    $(this).attr('src', $(this).attr('hover') );
    $(this).attr('hover', src );
  }
);

});
function autoheartspaces() {
    var times = $(".heartspace-icon").length;
    $(document).everyTime(3000, function(i) {
    	if(!is_heart_hover){
       		$(".heartspace-preview:visible").fadeOut("slow");
        	$(".heartspace-icon").removeClass('autoheartspace');
        	$(this).addClass('autoheartspace');
	        $(this).find(".heartspace-preview:eq("+(i-1)+")").fadeIn("slow");
    	  if(times == i) {
        	autoheartspaces();
	      }
      	}
    }, times);
}
function heartspaceSearch() {
    $('#heartspace-search-results').html('Loading search results');
    $.getJSON('http://tomamawithlove.org/ajax/heartspace-search',$('#heartspace-search-query').serialize(), function(data) {
        $('#heartspace-search-results').html('');
        $.each(data, function(index, heartspace) { 
            var html = '<div class="heartspace-search-result">';
                html += '<img src="/wp-content/themes/2mamawithlove/assets/dotted-line.jpg" border="0" />';
                html += '<a href="' + heartspace.guid + '">';
                html += '<div class="mama-name">'+heartspace.custom_fields.name_mama+'</div>';
                html += '<div class="mama-title">'+heartspace.post_title + '</div>';
                html += '</a></div>';
            $(html).hide().appendTo('#heartspace-search-results').fadeIn("slow");
        });
    });
}
function mycarousel_initCallback(carousel) {
    // Disable autoscrolling if the user clicks the prev or next button.
    carousel.buttonNext.bind('click', function() {
        carousel.startAuto(0);
    });

    carousel.buttonPrev.bind('click', function() {
        carousel.startAuto(0);
    });

    // Pause autoscrolling if the user moves with the cursor over the clip.
    carousel.clip.hover(function() {
        carousel.stopAuto();
    }, function() {
        carousel.startAuto();
    });
};
		

function linkRepeatable(iObj) {
	$(iObj).each(function(){
		$(this).click(function() {
		  var li = $(this).parent().html();
		  $(this).closest('ul').append('<li>'+li+'</li>');
		});	
	});
}
function heartspace_hotspot() {
    $('#heartspace-selection').click(function(e){
    	var location = $("#heartspace-selection").offset();
        var x = Math.round(e.pageX - location.left)-15;
        var y = Math.round(e.pageY - location.top)-15;
        //alert(x + "::" + y);
        $("input[name='new_x']").val(x); 
        $("input[name='new_y']").val(y);
        $('#heartspace_pointer').css({'top':y+'px','left':x+'px','position':'relative'});
        //$("#heartspace-coord").submit();    
    });
}
function limitChars(textid, limit, infodiv) {
	var text = $(textid).val(); 
	var textlength = text.length;
	if(textlength > limit) {
		$(infodiv).html('You cannot write more then '+limit+' characters!');
		$(textid).val(text.substr(0,limit));
		return false;
	} else {
		$(infodiv).html('You have '+ (limit - textlength) +' characters left.');
		return true;
	}
}