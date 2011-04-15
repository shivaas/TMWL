var tempheartspace_level = 0;
var limitLinks = 4;
var autoheartspace_level = {};
var heartspace_pointer = '/wp-content/themes/2mamawithlove/assets/Heartspace-pointer.png';
var heartspace_pointer_o = '/wp-content/themes/2mamawithlove/assets/Heartspace-pointer-rollover.png';
var is_heart_hover = false;
jQuery(document).ready(function($){

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

$.getJSON('http://tomamawithlove.org/ajax/heartspace-map', function(data) {
    createheartspace = unescape(self.document.location.hash.substring(1));
    pathArray = window.location.pathname.split( '/' );
    if(pathArray[1] == 'heartspace-editor') {
        heartspace_hotspot();
        if( $("input[name='new_x']").val() != '' && $("input[name='new_y']").val() != '' ) {
            $('#heartspace_pointer').css({'top':$("input[name='new_y']").val()+'px','left':$("input[name='new_x']").val()+'px','position':'relative'});
        } else {
            $('#heartspace_pointer').hide();
        }
    } else {
        $.each(data, function(index, heartspace) {
            var cssObj = {
                'left' : heartspace.custom_fields.x + 'px',
                'top' : Math.round(heartspace.custom_fields.y - 30) + 'px',
                'height': '35px',
                'width': '35px'
            }
            
            var cssObj2 = {
                'left' : heartspace.custom_fields.x + 'px',
                'top' : Math.round(heartspace.custom_fields.y - 20) + 'px',
                'position': 'absolute',
                'z-index' : 1000 
            }

            eval("autoheartspace_level.zindex_"+index+" = '"+Math.round(1)+"';");
            var html = '';
/*            var html = '<div class="heartspace-icon"><a href="' + heartspace.guid + '" style="z-index:1000;">';
                html += '<span class="heartspace-hover"><img src="'+heartspace_pointer+'" /></span>';
                html += '<div id="hsp-'+index+'" class="heartspace-preview">';
                html += '<div class="mama-name">'+heartspace.custom_fields.name_mama+'</div>';
                html += '<div class="mama-title">'+heartspace.post_title + '</div>';
                html += '<img class="mama-avatar" src="'+heartspace.mama_photo + '" /><div class="mama-more">More ></div></div>';
                html += '</a></div>';
                */ 
                html += '<div class="heartspace-icon" style="z-index:0"><a href="' + heartspace.guid + '" class="heartspace-hover" >';
                html += '<img src="'+heartspace_pointer+'" />';
                html += '</a></div>';
                
                html += '<div class="heart-wrapper"><a style="display:block;text-decoration:none" href="' + heartspace.guid + '">';
                html += '<div id="hsp-'+index+'" class="heartspace-preview">';
                html += '<div class="mama-name">'+heartspace.custom_fields.name_mama+'</div>';
                html += '<div class="mama-title">'+heartspace.post_title + '</div>';
                html += '<img class="mama-avatar" src="'+heartspace.mama_photo + '" /><div class="mama-more">More ></div></div>';
                html += '</a></div>';
                
//            $('.heart-wrapper').css(cssObj);                
            $(html).hide().appendTo('#heartspace-selection').fadeIn("slow");
            $('#heartspace-selection .heartspace-icon:last').css(cssObj);
			$('#heartspace-selection .heart-wrapper:last').css(cssObj2);
            
        });
    }
    autoheartspaces();
    $('#titleLimit').keyup(function(){
    	limitChars('#titleLimit', 48, '#titleLimitInfo');
    });
    $('#notelimit').keyup(function(){
    	limitChars('#notelimit', 1000, '#notelimitInfo');
    });
    $('#advicelimit').keyup(function(){
    	limitChars('#advicelimit', 140, '#advicelimitInfo');
    });
    
    var repeatableCnt = jQuery('.repeatable');
    var lastRepeatable = repeatableCnt.length - 1;
    
    /*    
    $('.repeatable').each(function(index){
    	$(this).removeClass('repeatable');
    	$(this).wrap('<li></li>').after('<img src="/wp-content/themes/2mamawithlove/assets/icons/add.png" class="addthis" />');
		if (index == lastRepeatable){
			linkRepeatable('.addthis');
		}
    });
    */
    $('.addthis').each(function(index){
    	$(this).click(function(){
		  var liID = $('#' + $(this).attr('id') + '-list li');
          var li = $(liID).first().clone();
          $('#' + $(this).attr('id') + '-list').append('<li>'+li.html()+'</li>');
          $(liID).last().find('input').val('');
        });
    });
    
$('.heartspace-icon').hover(
	function(){
		is_heart_hover = true;
		$(this).css('z-index','10000');
		$(this).children().find('img').attr('src',heartspace_pointer_o);
		$(this).next().find(".heartspace-preview").show();
	},
	function(event){
			$(this).css('z-index','1');
			$(this).children().find('img').attr('src',heartspace_pointer);
			//$(this).next().find(".heartspace-preview").hide();
		
	}
);

$(".heartspace-preview").hover(
			function(){
				// do nothing
				is_heart_hover = true;
				$(this).show();
			},
			function(){
				is_heart_hover = false;
				//$(this).parent().css('z-index','1');
				//$(this).parent().children().find('img').attr('src',heartspace_pointer);
				$(this).hide();
			}
		);
		
/*
    $('.heartspace-icon a').hover(
      function (event) {
      if(!$(event.target).is('.heartspace-hover')){
        tempheartspace_level = $(this).css('z-index');
        $(this).css('z-index','100');
        $(this).find(".heartspace-hover img").attr('src', heartspace_pointer_o);
        $(this).parent().next().find(".heartspace-preview").show();
        }
      }, 
      function (event) {
      if(!$(event.target).is(this) && !$(event.target).is('.heartspace-hover a')  && !$(event.target).is('.heartspace-icon')) {
	        $(this).css('z-index',tempheartspace_level);
    	    $(this).find(".heartspace-hover img").attr('src', heartspace_pointer);
        	$(this).parent().next().find(".heartspace-preview").hide();
        }
      }
    );
  */   
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