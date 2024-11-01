<?php
/*
Plugin Name: Urdu Formatter - Shamil
Plugin URI: http://www.mbilalm.com/blog/
Description: This Plugin automatically detects Urdu posts, comments and posts summery (Excerpt), and If Urdu is found then it sets the proper direction, size and font of text according to Urdu. With this plugin you can carry blogging in both languages (Urdu and English). Find more detail in Settings page or visit plugin site.
Author: M Bilal M
Author URI: http://www.mbilalm.com/
Version: 0.1
*/

function UrduFormatterActivate() {
	update_option("blog_info_mbilalm", "eng_theme");
	update_option("auto_post_mbilalm", "auto_post");
	update_option("auto_comment_mbilalm", "auto_comment");
	update_option("auto_excerpt_mbilalm", "auto_excerpt");
}
register_activation_hook( __FILE__, 'UrduFormatterActivate' );

function UrduFormatterAdminPage()
{
	if(isset($_POST['submitted']))
	{
		$blog_info_mbilalm = $_POST['blog_info_mbilalm'];
		$auto_post_mbilalm = $_POST['auto_post_mbilalm'];
		$auto_comment_mbilalm = $_POST['auto_comment_mbilalm'];
		$auto_excerpt_mbilalm = $_POST['auto_excerpt_mbilalm'];

		update_option("blog_info_mbilalm", $blog_info_mbilalm);
		update_option("auto_post_mbilalm", $auto_post_mbilalm);
		update_option("auto_comment_mbilalm", $auto_comment_mbilalm);
		update_option("auto_excerpt_mbilalm", $auto_excerpt_mbilalm);

		echo "<div id=\"message\" class=\"updated fade\"><p>Urdu Formatter options have been updated!</p></div>";
	}
	else
	{
		$blog_info_mbilalm = get_option("blog_info_mbilalm");
		$auto_post_mbilalm = get_option("auto_post_mbilalm");
		$auto_comment_mbilalm = get_option("auto_comment_mbilalm");
		$auto_excerpt_mbilalm = get_option("auto_excerpt_mbilalm");
	}
    
    echo "<div class=\"wrap\">
	<h2>Urdu Formatter - Shamil Plugin Setup</h2>
    Here you can configure Urdu Formatter - Shamil Plugin's options.";
    ?>
	<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">
  <tr>
    <td valign="top">
	<form method="post" name="options" target="_self">
		<fieldset>
			<h3>Basic Setting of Plugin:</h3>
			Using with:
			<select id="blog_info_mbilalm" name="blog_info_mbilalm">
				<option value="eng_theme" <?php if($blog_info_mbilalm=="eng_theme"){ echo 'selected'; } ?>>English Theme&nbsp;</option>
				<option value="urdu_theme" <?php if($blog_info_mbilalm=="urdu_theme"){ echo 'selected'; } ?>>Urdu Theme</option>
			</select>
		</fieldset>
		<br />
		<fieldset>
			<h3>Auto Formatting On</h3>
			<input name="auto_post_mbilalm" type="checkbox" id="auto_post_mbilalm" value="auto_post" <?php if($auto_post_mbilalm) echo 'checked' ?> />
			Posts<br />
			<input name="auto_comment_mbilalm" type="checkbox" id="auto_comment_mbilalm" value="auto_comment" <?php if($auto_comment_mbilalm) echo 'checked' ?> />
			Comments<br />
			<input name="auto_excerpt_mbilalm" type="checkbox" id="auto_excerpt_mbilalm" value="auto_excerpt" <?php if($auto_excerpt_mbilalm) echo 'checked' ?> />
			Excerpt of Posts
		</fieldset>
		<p class="submit">
			<input name="submitted" type="hidden" value="yes" />
			<input type="submit" name="Submit" value="Update Plugin's Options &raquo;" />
		</p>
	</form>
	<br />
	</td>
    <td align="right"><img border="0" src="<?php echo plugins_url( 'urdu-formatter.gif' , __FILE__ ) ?>" alt="Urdu Formatter"></td>
  </tr>
</table>
	<center><a target="_blank" href="http://www.mbilalm.com/pak-urdu-installer.php" title="Pak Urdu Installer"><img border="0" src="<?php echo plugins_url( 'pak-urdu-installer.jpg' , __FILE__ ) ?>" alt="Pak Urdu Installer"></a></center>
<?php
}
function UrduFormattingOptions() {
    add_submenu_page('options-general.php', 'Urdu Formatter - Shamil', "Urdu Formatter", 10, __FILE__, 'UrduFormatterAdminPage');
}
add_action('admin_menu', 'UrduFormattingOptions');




$blog_info_mbilalm = get_option("blog_info_mbilalm");
$auto_post_mbilalm = get_option("auto_post_mbilalm");
$auto_comment_mbilalm = get_option("auto_comment_mbilalm");
$auto_excerpt_mbilalm = get_option("auto_excerpt_mbilalm");


define('MBILALM_URDU_FONT','Jameel Noori Nastaleeq, Alvi Lahori Nastaleeq, Alvi Nastaleeq, Nafees Web Naskh, Urdu Naskh Asiatype, Arial, Tahoma');
define('MBILALM_ENG_FONT','Lucida Grande, Verdana, Lucida Sans Regular, Lucida Sans Unicode, Arial ,sans-serif');
function check_urdu($text) {
	$fword = substr(str_replace(" ","",strip_tags($text)), 0, 2);
	if($fword=='ا' || $fword=='آ' || $fword=='ب' || $fword=='پ' || $fword=='ت' || $fword=='ٹ' || $fword=='ث' || $fword=='ج' || $fword=='چ' || $fword=='ح' || $fword=='خ' || $fword=='د' || $fword=='ڈ' || $fword=='ذ' || $fword=='ر' || $fword=='ز' || $fword=='ژ' || $fword=='س' || $fword=='ش' || $fword=='ص' || $fword=='ض' || $fword=='ط' || $fword=='ظ' || $fword=='ع' || $fword=='غ' || $fword=='ف' || $fword=='ق' || $fword=='ک' || $fword=='گ' || $fword=='ل' || $fword=='م' || $fword=='ن' || $fword=='و' || $fword=='ہ' || $fword=='ی' || $fword=='ے'){
		return true;
	}
	else {
		return false;
	}
}

function check_english($text) {
	$fword = substr(str_replace(" ","",strip_tags($text)), 0, 2);
	$fword=ord($fword);
	if($fword>64 && $fword<91 || $fword>96 && $fword<123){
		return true;
	}
	else {
		return false;
	}
}

//Urdu Formatting
function UrduFormattingPost($text){
	if (check_urdu($text)) {		
		$text=str_replace('<p>','<p style="text-align: right; font-family: '.MBILALM_URDU_FONT.'; font-size: 19px; line-height: 31px; direction: rtl;">',$text);
	}
	return $text;
}

function UrduFormattingComment($text){
	if (check_urdu($text)) {
		$text=str_replace($text,'<div style="text-align: right; font-family: '.MBILALM_URDU_FONT.'; font-size: 18px; line-height: 31px; direction: rtl;">'.$text.'</div>',$text);
	}
	return $text;
}

function UrduFormattingExcerpt($text){
	if (check_urdu($text)) {
		$text=str_replace('<p>','<p style="text-align: right; font-family: '.MBILALM_URDU_FONT.'; font-size: 19px; line-height: 31px; direction: rtl;">',$text);
	}
	return $text;
}

//Urdu Code Formatting Auto	
function UrduFormattingStartAuto($text_value = array()){
	$text=get_the_content();
	if (check_urdu($text)) {
		if(!$text_value['font_size']){
			$text_value['font_size'] = '19';
		}
		if(!$text_value['line_height']){
			$text_value['line_height'] = '31';
		}
		if(!$text_value['text_align']){
			$text_value['text_align'] = 'right';
		}
		if($text_value['text_color']){
			$text_color = ' color: '.$text_value['text_color'].';';
		}
		echo '<div style="font-family: '.MBILALM_URDU_FONT.'; font-size: '.$text_value['font_size'].'px; line-height: '.$text_value['line_height'].'px; text-align: '.$text_value['text_align'].'; direction: rtl;'.$text_color.'">' ;
	}
	return '';
}
function UrduFormattingHead(){ 
	echo '<meta name="Urdu-Plugin" content="Urdu Formatter - Shamil" />';
	echo '<meta name="Urdu-Plugin-URL" content="www.mbilalm.com" />';
}
function UrduFormattingEndAuto(){
	$text=get_the_content();
	if (check_urdu($text)) {
		echo '</div>' ;
	}
	return '';
}

//Urdu Tag Formatting
	function UrduFormattingTextTag( $atts, $content = null ) {
		if(!$atts['size']){
			$atts['size'] = '19';
		}
		if(!$atts['align']){
			$atts['align'] = 'right';
		}
		return '<div style="text-align: '.$atts['align'].'; font-family: '.MBILALM_URDU_FONT.'; font-size: '.$atts['size'].'px; line-height: 31px; direction: rtl;">' . $content . '</div>';
	}
	
	function UrduFormattingWordTag( $atts, $content = null ) {
		if(!$atts['size']){
			$atts['size'] = '17';
		}
		return '<font style="font: '.$atts['size'].'px '.MBILALM_URDU_FONT.';">' . $content . '</font>';
	}

//English Formatting
function EnglishFormattingPost($text){
		if (check_english($text)) {
			$text=str_replace('<p>','<p style="text-align: left; font-family: '.MBILALM_ENG_FONT.'; font-size: 13px; line-height: 20px; direction: ltr;">',$text);
		}
		return $text;
	}
	
	function EnglishFormattingComment($text){
		if (check_english($text)) {
			$text=str_replace($text,'<div style="text-align: left; font-family: '.MBILALM_ENG_FONT.'; font-size: 13px; line-height: 20px; direction: ltr;">'.$text.'</div>',$text);
		}
		return $text;
	}
	
	function EnglishFormattingExcerpt($text){
		if (check_english($text)) {
			$text=str_replace('<p>','<p style="text-align: left; font-family: '.MBILALM_ENG_FONT.'; font-size: 13px; line-height: 20px; direction: ltr;">',$text);
		}
		return $text;
	}

//English Tag Formatting
	function EnglishFormattingTextTag( $atts, $content = null ) {
		if(!$atts['size']){
			$atts['size'] = '13px';
		}
		if(!$atts['align']){
			$atts['align'] = 'left';
		}
		return '<div style="text-align: '.$atts['align'].'; font-family: '.MBILALM_ENG_FONT.'; font-size: '.$atts['size'].'; line-height: 20px; direction: ltr;">' . $content . '</div>';
	}
	
	function EnglishFormattingWordTag( $atts, $content = null ) {
		if(!$atts['size']){
			$atts['size'] = '16px';
		}
		return '<font style="font: '.$atts['size'].' '.MBILALM_ENG_FONT.';">' . $content . '</font>';
	}

if($blog_info_mbilalm=="eng_theme"){
	if($auto_post_mbilalm){
		add_filter( 'the_content', 'UrduFormattingPost' );
	}

	if($auto_comment_mbilalm){
		add_filter( 'comment_text', 'UrduFormattingComment' );
	}

	if($auto_excerpt_mbilalm){
		add_filter( 'the_excerpt', 'UrduFormattingExcerpt' );
	}
}
else if($blog_info_mbilalm=="urdu_theme"){
	if($auto_post_mbilalm){
		add_filter( 'the_content', 'EnglishFormattingPost' );
	}

	if($auto_comment_mbilalm){
		add_filter( 'comment_text', 'EnglishFormattingComment' );
	}

	if($auto_excerpt_mbilalm){
		add_filter( 'the_excerpt', 'EnglishFormattingExcerpt' );
	}
}
add_action( 'urdu_start', 'UrduFormattingStartAuto' );
add_action( 'urdu_end', 'UrduFormattingEndAuto' );
add_shortcode( 'english_text', 'EnglishFormattingTextTag' );
add_shortcode( 'english', 'EnglishFormattingWordTag' );
add_action( 'wp_head', 'UrduFormattingHead' );
add_shortcode( 'urdu_text', 'UrduFormattingTextTag' );
add_shortcode( 'urdu', 'UrduFormattingWordTag' );
?>