<?php
/*
Template Name: Z
*/
?>
<?php get_header();?>
<div id="content1" class="answer">
<?php			
			if(isset($_GET['qid']))
			{
				include(CHILD_TEMPLATEPATH."/include/adtop.php");
				include(CHILD_TEMPLATEPATH."/include/adtop.php");
				$question =	get_question_by_ID($_GET['qid']);
			}
			else echo '<p>A Question ID is needed to display the information. Please use the format: <a href="http://www.ask-oracle.com/answers/?qid=20060616190713AAo4Qes">http://www.ask-oracle.com/answers/?qid=20060616190713AAo4Qes</a>.</p><p>The application works best when accessed via links on Horoscopes related pages. Check out <a title="Cancer Daily Horoscope" href="http://www.ask-oracle.com/2009-horoscopes/daily/cancer/">Cancer Daily Horoscope</a> page and see the application in action in the sidebar(right side).';
?>

<h2><?php echo $question['question']; ?></h2>
<p><strong><?php echo nl2br($question['q_detail']); ?></strong></p>
Asked By: <strong><?php echo $question['q_user']; ?></strong>
<br /><span><a rel="nofollow" style="float: right;" href="http://developer.yahoo.com/"><img src="http://l.yimg.com/us.yimg.com/i/us/nt/bdg/websrv_120_1.gif" border="0" alt="" /></a>Powered by <a rel="nofollow" href="http://answers.yahoo.com/">Yahoo! Answers</a></span><br /><br />
<h3>Best Answer</h3>
<div id="commentlist">Answered By: <strong><?php echo $question['q_best_user']; ?></strong>
	<blockquote><p><?php echo nl2br($question['q_best_ans']); ?></p></blockquote></div>
<h3>Other Answers</h3>
<?php 
	if(!empty($question['answer']))
	{
		foreach($question['answer'] as $ans)
		{      
			echo '<div id="commentlist">Answered By: <strong>' . $ans['user'] . '</strong><blockquote><p>' . nl2br($ans['answer']) . '</p></blockquote></div>';
		}
	}
	else echo 'Not Available';

?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>



