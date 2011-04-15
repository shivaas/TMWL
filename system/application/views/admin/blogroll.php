<script type="text/javascript">
$(function(){
	var diagOpts = {
			closeOnEscape : true,
			draggable : false,
			modal : true,
			resizable : false,
			autoOpen: false,
			width : 300,
			title : 'Thank you!',
			position : ['center'],
			show : 'fade',
			hide : 'fade',
			buttons : {
				'Close' : function(){
					$('#dialog').dialog('close');
					$('#add_dialog').dialog('close');
					location.reload();
				}
			}
		};
	$('#dialog').dialog(diagOpts);

	$('#add_dialog').dialog({
	    closeOnEscape : true,
	    draggable : false,
	    modal : true,
	    resizable : false,
	    width : 500,
	    title : $(this).attr('title'),
	    position : ['center', 100],
	    show : 'fade',
	    autoOpen: false,
	    hide : 'fade',
	    buttons : {
	      'Close' : function(){
	        $(this).dialog('close');
	      }
	    }
	  });

	$('#add_blog').click(function(e){
		e.preventDefault();
		var url = $('form#add_form input[name=url]').val();
		var content_title = $('form#add_form input[name=content_title]').val();
		var written_on = $('form#add_form input[name=written_on]').val();
		var content = $('textarea#content').val();
		
		$('#form_status').html('Processing request... <img src="./images/ui-anim_basic_16x16.gif" alt="loading..."/>');
		$('#dialog').dialog('open');
		$.ajax({
			url: "<?php echo site_url() . 'admin/blogroll/do'?>",
			data: "url=" + encodeURI(url) + "&content_title=" + encodeURI(content_title) + "&written_on=" + encodeURI(written_on)  + "&content=" + encodeURI(content),
			success: function(data){
							$('#form_status').hide().html(data).slideDown('slow');
						}
			});
	});
	
	$('#add').click(function(e){
		e.preventDefault();
		$('#add_dialog').dialog('open');
	});

	$('.datepicker').datepicker({
		numberOfMonths : 1,
		constrainInput: true,
		showAnim : 'slideDown',
		dateFormat : 'm/d/yy'
	});
});

function confirm_delete() {
	return confirm('Are you sure you want to delete that blog post?');
}
</script>

<div id="dialog">
	<div id="form_status"></div>
</div>
<div id="add_dialog">
	<form id="add_form" action="#">
		<fieldset>
			<label for="first_name">Blog post link:</label><br/>
			<input type="text" name="url" />
		</fieldset>
		<fieldset>
			<label for="first_name">Post title:</label><br/>
			<input type="text" name="content_title" />
		</fieldset>
		<fieldset>
			<label for="first_name">Post excerpt:</label><br/>
			<textarea rows="5" cols="30" name="content" id="content"></textarea>
		</fieldset>
		<fieldset>
			<label for="first_name">Post date:</label><br/>
			<input type="text" name="written_on" class="datepicker"/>
		</fieldset>
		<fieldset>
			<em>Note: all fields are required.</em><br/><br/>
			<input type="submit" value="Add to Blog Roll" id="add_blog"/>
		</fieldset>
	</form>
</div>

<div class="page_content">
<br/>
  <div id="our_story">
    <h3>Blog Roll</h3> (<a href="#" id="add">Add new</a>)
    <br><br>
    <p><strong>Total blogs on roll: </strong><?php echo count($blogs);?></p><br/>
  </div>
  <div class="clear"></div>
  <div id="">
  <?php if(count($blogs) > 0):?>
	  <table width="100%" class="styled">
	  	<tr>
	  		<th>&nbsp;</th>
	  		<th>Added on</th>
	  		<th>Added by</th>
	  		<th>Post Written on</th>
	  		<th>Title</th>
	  		<th width="400px">Content</th>
	  	</tr>
	  <?php foreach($blogs as $blog):?>
	  	<tr>
	  		<td><a href="<?php echo base_url().'admin/blogroll_delete/'. $blog['blog_id']; ?>" class="button" onclick="return confirm_delete();" title="delete blog post"><span class="ui-icon ui-icon-trash">&nbsp;</span></a></td>
	  		<td><?php echo date('jS, M',strtotime($blog['created_on']));?></td>
	  		<td><?php echo $blog['Users']['username']?></td>
	  		<td><?php echo date('jS, M Y',strtotime($blog['written_on']))?></td>
	  		<td><?php echo $blog['content_title']?></td>
	  		<td><?php echo shorten($blog['content'],35);?></td>
	  	</tr>
	  	
	  <?php endforeach;?>
	  </table>
	 <?php else:?>
	 <p>No blogs on the roll. Get moving lazy ass and find some bloggers!!!</p>
	 <?php endif;?>
  </div>
</div>  