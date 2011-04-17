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