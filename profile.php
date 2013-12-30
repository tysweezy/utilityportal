<?php include $_SERVER['DOCUMENT_ROOT'] . "/utilityportal/includes/authorizedHeader.php";?>

	<div class="row-fluid">
		
	<?php include $_SERVER['DOCUMENT_ROOT']  . '/utilityportal/includes/nav.php';?>

	<div class="span10 content">
		<!-- body -->
		<h2 id="page-title">Utility Portal  //  <span id="page"><?php echo $fname; ?>'s Page</span></h2>
		
	<div class="r2">
		<h3>Link Board</h3>

		<div id="mLinks">
			<a href="#modal" id="addLink" role="button" data-toggle="modal">Add Link +</a>
			<!--<a href="#etab" id="addTab" role="button" data-togge="modal">Add Tab</a>-->
			<!--<a href="#editb" id="editbtn" class="btn btn-default btn-sm">Edit Board</a>-->

 		</div>

	<!--EDIT LINK BOARD SECTION-->
		<div id="editb" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="tabModalLabel" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
				<h3 id="tabModalLabel">Edit Board/Links</h3>
			</div>

		
			<div class="modal-body">

				<!-- updating categories and links -->
				<h4>Update Tab</h4>
				<form method="post" name="updateTabFrom">

					<select name="updateTitle">

						<!--<option>Choose...</option>-->
						<?php
							$c = $db->prepare("SELECT `tab_title`, `user_id` FROM `category` WHERE category.user_id = $user_id");
							$c->execute();
							$re = $c->fetchAll();

							foreach ($re as $ctitle) {
								echo '<option value="' . $ctitle['tab_title'] . '">' .$ctitle['tab_title']. '</option>';
							}
						?>
					</select>


					<input type="text" name="updateTabText" placeholder="Change Tab Text" required/>

					<input type="submit" name="updateTab" id="updateTab" class="btn btn-primary" value="Update Tab"/>
				</form>
				

				<!--end updating tab-->

				<!--Delete tab section-->
				<h4>Delete Tab</h4>
				<form method="post" name="deleteTabForm"> 

					<select name="deleteTitle">
						<!--<option>Choose...</option>-->
						<?php
							$c = $db->prepare("SELECT `tab_title`, `user_id` FROM `category` WHERE category.user_id = $user_id");
							$c->execute();
							$re = $c->fetchAll();

							foreach ($re as $ctitle) {
								echo '<option value="' . $ctitle['tab_title'] . '">' .$ctitle['tab_title']. '</option>';
							}
						?>
					</select>

					<input type="submit" name="deleteTab" id="deleteTab" class="btn btn-danger" value="Delete Tab"/>

				</form>


			<!--UPDATING LINKS-->
			<h4>Update Link</h4>
			<form mehod="post" name="updateLinksForm">
					
				  <label>Category</label>
					<select name="updateLinksTitle">
						<!--<option>Choose...</option>-->
						<?php

							//set to "my links tab" -- make others static.
							$c = $db->prepare("SELECT `tab_title`, `user_id` FROM `category` WHERE category.user_id = $user_id");
							$c->execute();
							$re = $c->fetchAll();

							foreach ($re as $ctitle) {
								echo '<option value="' . $ctitle['tab_title'] . '">' .$ctitle['tab_title']. '</option>';
							}
						?>
					</select>


					<label>Link</label>
					<select name="linksUpdate">
						<!--option // - link examples as placeholder. Will be query followed by foreach loop-->
						<option value="link1">Link 1</option>
						<option value="link1">Link 2</option>
					</select>

					<input type="text" placeholder="Change Link Title"/>
					<input type="text" placeholder="Change URL"/>

					<input type="submit" name="updateLink" id="updateLinks" class="btn btn-primary" value="Update Link"/>



			</form>
	

			</div><!--/modal-body-->

			<div class="modal-footer">

				<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>

			</div>
		</div><!-- /modal -->

		<!-- ADD/delete/modify tab MODAL BOX -->
		<!-- modal box // add link form -->
		<div id="etab" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="tabModalLabel" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
				<h3 id="tabModalLabel">Add Category</h3>
		</div>

			<!--giggity-->
			<div class="modal-body">
			<?php 
				if(isset($_POST['addCat'])) {
						
						$addTab = $db->prepare("INSERT INTO `category` (`tab_title`, `user_id`) VALUES (?, $user_id)");
						$addTab->execute(array($_POST['addTab']));

				   }	
				?>
				
				<!--add category-->
				<h4>Add Tab</h4>
				<form id="aTab" name="aTab" method="post">
					<input type="text" name="addTab" placeholder="Add Tab" required/>
					<input type="submit" name="addCat" id="atsubmit" class="btn btn-primary" value="Add Category"/>
				</form>

			</div><!--/modal-body-->

			<div class="modal-footer">

				<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>

			</div>
		</div><!-- /modal -->

		<!-- ADD LINK MODAL BOX -->
		<!-- modal box // add link form -->
		<div id="modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
				<h3 id="myModalLabel">Add Link</h3>
				<div id="success" style="display:none;">Link Added</div>
				<div id="fail" style="display:none;">Error: Link was not added</div>
				<div id="loading" style="display:none;">Saving...</div>
			</div>

			<div class="modal-body">
				<em style="color: red; font-family: arial, sans-serif; font-size: 12px; ">*links will be added to "My Links" tab section.</em>
				<form id="alForm" name="alForm">
					<label>Title</label>
					<input type="hidden" name="id"/>

					<input type="text" name="link_title" placeholder="Title" required/>

					<label>Link</label>
					<input type="text" name="link" placeholder="Link" required/>

					<!--<label>Category*</label>
					
					<select name="title">-->
					
						<?php
							/*$c = $db->prepare("SELECT `tab_title`, `user_id` FROM `category` WHERE category.user_id = $user_id");
							$c->execute();
							$re = $c->fetchAll();

							foreach ($re as $ctitle) {
								echo '<option value="' . $ctitle['tab_title'] . '">' .$ctitle['tab_title']. '</option>';
							}*/
						?>
					<!--</select>-->

					<input type="submit" name="save" id="save" class="btn btn-primary" value="Save" />
				</form>
			</div>

			<div class="modal-footer">

				<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>

			</div>
		</div><!-- /modal -->

		<a href="#" data-toggle="tooltip" data-placement="top" id ="lb-info" title="Hint: You can navigate through the link board using your left and right arrow keys. You can also click on arrow buttons below."><img src="img/info.png" alt="info"/></a>

		<div id="link-arrows">
			<a href="javascript:void(0);" id="pArrow"><img src="img/pArrow.png"/></a>
			<a href="javascript:void(0);" id="nArrow"><img src="img/nArrow.png"/></a>
		</div>

	<ul class="nav nav-tabs" id="lb-tabs">
		<li><a href="#mylinks" data-toggle="tab">My Links</a></li>
		<li><a href="#support" data-toggle="tab">Support</a></li>
		<li><a href="#documentation" data-toggle="tab">Documentation</a></li>
    </ul><!-- /nav-tabs -->
    
	
    <div class="tab-content">

        <div class="tab-pane" id="mylinks">
            <div class="links">
                <ul class="col">
				<?php  
					
					$items = $db->prepare("SELECT * FROM `custom_links` WHERE custom_links.user_id = $user_id"); //maybe need to add the $user_id w/ where clause??
					$items->execute();
					$j = $items->fetchAll();

				   foreach($j as $item) {
              			//output the links with the title that matches this content's tab.
             	 		
                        echo '<li><a class="single-link" href="'.$item['link'].'">' .$item['link_title'] . '<span><a class="delete" id="'. $item['id'] . '" href="javascript:void();"><img src="img/delete-link.png"/></a></span></li>';
					}
                    ?>
                </ul>
            </div>
        </div><!-- /tab-pane  -->
       
         <div class="tab-pane" id="support">
            <div class="links">
                <ul class="col">


					<li><a href="#">Link in support tab</a></li>


                </ul>
            </div>
        </div><!-- /tab-pane  -->

        <div class="tab-pane" id="documentation">
            <div class="links">
                <ul class="col">


					<li><a href="#">Link in documentation tab</a></li>


                </ul>
            </div>
        </div><!-- /tab-pane  -->
    
    

    </div><!-- /tab-content  -->

<!-- END OF YOUR CODE -->


</div><!-- /r2 -->

</div><!-- /span10 content -->


</div><!-- row-fluid -->

</div><!-- /container-fluid -->


<!-- Das Javascript -->
<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery.validate.min.js"></script>
<!--<script type="text/javascript" src="js/bootstrap.min.js"></script>-->
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/main.js"></script>
<!-- template engine -->
<!--<script type="text/javascript" src="js/mustache.js"></script>-->

<script type="text/javascript">
	//dropdown menu -- //drop da bass
	$('.dropdown-toggle').dropdown();

	$('#lb-tabs a:first').tab('show') // show first tab onload

	//tooltip
	$('#lb-info').tooltip();

	//modal box(es)
	$('#modal').modal('hide');

	//little modal hack -- bastard wouldn't work
	$('#addTab').click(function() {
		$('#etab').modal();
	});

	//edit board modal box
	$('#editbtn').click(function(){
		$('#editb').modal();
	});

	
</script>
</body>
</html> 