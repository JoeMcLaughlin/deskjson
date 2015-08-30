<?php
/**
 * ... X.php does.... 
 * 
 * @package GRN
 * @author David Wall <dwall@goodroadnetwork.com> 
 * @author Bill Newman <bnewman@goodroadnetwork.com>
 * @author Joe McLaughlin
 * @version 1 2015/05/15
 * @link http://www.goodroadnetwork.com/
 * http://www.apache.org/licenses/LICENSE-2.0
 * @see 
 * @todo 
 */

require '../inc_0700/config_inc.php';
require '../../support_api/support_inc.php';



$result = deskApiArticles();
$result = json_decode($result);

$resultTopics = deskApiTopics();
$resultTopics = json_decode($resultTopics);
//dumpDie($resultTopics);

/*
if(isset($_GET['id']) && (int)$_GET['id'] > 0) {
	 $config->ID = (int)$_GET['id'];
} else {
	myRedirect(VIRTUAL_PATH . "artists.php");
}
*/
/*
$artist = new Artist;
$artist = $artist->single($config->ID);

if( $artist == false ) {
	feedback('That artist was not found.','info');
	myRedirect('artists.php');
}
*/

$config->pageID = 'Support';
//$config->table = PREFIX . 'support';
//$config->tableID = 'ArtistID';

$config->titleTag = $config->pageID . ' - GoodRoadNetwork';
//$config->metaDescription = $artist['ArtistName'] . ' on GoodRoadNetwork. We make touring easy.';
//$config->metaKeywords = 'Venues,'. $config->pageID . ',' . $config->metaKeywords;

//$config->shareable = true;

//$permission = Member::permission('artist', $config->ID);
//$canEdit = $permission > 2 ? true : false;
/*
if( isset($_GET['public']) )
    $config->publicView = true;

enqueue('script', 'assets/blog');
enqueue('jquery', "$('#add-post').add_post();");
enqueue('jquery', "$('#post-list').stream({entity: 'artist', id: $config->ID});");
enqueue('jquery', "$('#event-list').infiniteScroll({file: './ajax/events_ajax.php', limit: 5, term: 'events', entity: 'artist', id: $config->ID, compact: true});");
*/
$config->loadhead .= "<style>#main-content { background-color: #f0f0f0; }</style>";



get_header(); #defaults to theme header or header_inc.php
?>


<div class="container ">
<div class="row ">
	

	<div class="col-sm-8">
	
	
	<?php 
	$i = 0;
	$j = 1;
	
	foreach ($resultTopics->_embedded->entries as $entry)
	{		
		if(isset($resultTopics->_embedded->entries[$i]) && isset($resultTopics->_embedded->entries[$j]))
		{
			//
			//	I broke this page putting it here instead of support-topic 
			//
			
			
			$topicID1 = $resultTopics->_embedded->entries[$i]->id;
			$topicID2 = $resultTopics->_embedded->entries[$j]->id;
			
            createRowTopic($topicID1,$topicID2,$resultTopics,$i,$j);
			$i = $i + 2;
			$j = $j + 2;	
		}else if(isset($resultTopics->_embedded->entries[$i])){
			echo
			'
				<div class="row">
					<div class="col-sm-6">
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="col-sm-4">
									<i class="fa fa-question-circle fa-5x text-center green"></i>
								</div><!--/4-->
								<div class="col-sm-8">
									<h4><a href="support-topic.php"> '. $resultTopics->_embedded->entries[$i]->name . ' </a></h4>
									<p>Find answers to your questions</p>
								</div><!--/8--> 
							</div>
						</div>
					</div>
				</div>
			';
			$i = $i +1;
		}else{
			
		}		
	}
	?>
	</div><!--/8--> 
		<!--NEXT COLUMN ======================================================= -->
		<div class="col-sm-4">
		<h4>Not a member? It's free to join!</h4>
		<p><a href="register.php">Sign up</a> for a free membership and learn how we make touring easy!</p>
		<br/> <br/>
		<p class="small">Advertisements</p>
		</div>
	</div>
	<div>
		<?php
			foreach ($resultTopics->_embedded->entries as $entry)
			{	
				//var_dump($entry);
				echo '$entry->name: ' . $entry->name . '<br />';
				//dumpDie($result->_embedded->entries);
			}
			
		?>	
	</div>
</div>

<!-- /container-->
<p>&nbsp;</p> 
<!-- Footer ============================================================ -->

<?php
get_footer();