<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Social Network: Comments</title>
<link href="css/style.css" rel='stylesheet' type="text/css" />
</head>
<body>
<div id="maincontainer">

<div id="topsection"><div class="innertube"><h1>Imagine This is a Social Network</h1></div></div>

<div id="contentwrapper">
<div id="contentcolumn">
<div class="innertube">
<div class='frm-cont'>
   <?php 
    if(isset($_POST['submit']) && $_POST['submit']  == 'Send'){
	if(!trim($_POST['comment'])){
	  echo "<div style='color:red;text-align:center;font-weight:bold;'>Comments is a required field.</div>";
	  render_form();
	}else{
	require_once('loader.php');
	$words = array('Fuck','Faggot','Loser','Gay','Whore','Slut','Fatty','Asshole','fuck','faggot','loser','gay','whore','slut','fatty','asshole','kill','die','fuck you','you are so gay',
  'murder','rape','cock','dick','will kill you','will die','suck cock','suck my dick','ugly','freak','slept with football team','slept with hockey team','slept with everyone','fucked',"you're such a whore",'you\'re so gay',
  'you\'re such a loser','fat ass','rip your face','fuck your mom','motherfucker','you are so gay','you are such a loser','such a loser','loser, loser','loser!','fap','fap fap fap',
  'fappening','fucker');
  $bw = new aimreza\text\BlackWord($words);
  $ret = $bw->scan($_POST['comment']);
		  if($ret){
		  $black_str = implode(' | ',$bw->getBadWords());
	?>
	        
			<div style="text-align:left; width:auto; height:650px;"> 
			 <div style="width:auto;"><label>Bad Words: </label> <span style="color:red;font-weight:bold"><?php echo $black_str ?></strong> </span></div>
			 <img src='images/warning.jpg'  border="0" style="text-align: center; margin:2px 100px;" width='705' height='577'/>
			</div>	
<?php
			render_form(); 
			}else{
      ?>
			<table width="100%">
				<tr><td>&nbsp;</td><th style="color:blue;" colspan='2' align="left">Your comments has been saved successfully. </th></tr>
				<tr><td class="lbl">Comments</td><td class='cln'>:</td><td><?php echo $_POST['comment'] ?> </td><tr>
				 <tr><td class="lbl">&nbsp;</td><td class="cln">&nbsp;</td><td height="50px;" valign="middle"> <a href='index.php' title="Go Home">Home</a></td></tr>
			</table>
<?php			
      
    }}   
	
	}else{
	
	  render_form();
	
	}
   
  ?>
</div> 


</div>
</div>
</div>

<div id="leftcolumn">
<div class="innertube">
<a href="index.php" title="go home">Home</a>

</div>
</div>

<div id="footer">&copy; <?php echo (date('Y')-1). '-'. date('Y') ?></div>

</div>
</body>
</html>


<?php 
  function render_form(){
?>
	   <form action="index.php" method='POST' name='frm-comment'>
			<table border='0' cellspacing="0" cellpadding="0" width='100%'>
			<tr><td colspan="3" height="20px">&nbsp;</td></tr>
			 <tr><td class='lbl'><div class='comment'>Warning: 
Please note this is site is for a research experiment with hate words. You must be 18 years old and above to participate in this experiment. If you are below 18, please close the window to exit.</div>
<div style='text-align:left;font-weight:bold;'>Instructions:</div>
<div class="comment">
Please read the supplementary form carefully. Start with step 1 and proceed accordingly. Participation is voluntary and you can close the window at any time.</div>
</td><td class="cln">&nbsp;</td><td><textarea name="comment" cols='100' rows='20'> <?php if(isset($_POST['comment'])) echo trim($_POST['comment']); ?> </textarea> </td></tr> 
			 <tr><td class="lbl">&nbsp;</td><td class="cln">&nbsp;</td><td height="50px;" valign="middle"> <input  class='btn' type="submit" name="submit" value="Send"/></td></tr>
			</table>
		</form>
  
<?php 
  }
?>


