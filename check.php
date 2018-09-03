<?php
$mystring = strtolower($_REQUEST['text']);
$findme   = strtolower('Adayroi|adult massager|adult men toys|adult toys|anal|anus|asshole|bisexual|bitch|Blow job|Blowjob|Cannabis|clitoris|coca leaves|Cocaine|Cock|CPO|crude oil|cunilingus|cunillingus|cunnilingus|cyberfuc|điệp viên|dildo|đồ chơi tình dục|ejaculate|Fake|female vibrations|female vibrator|fire arm|firearm|Fuck|Fucking|Gading Gajah|Gag bondage|Ganja|Gay|gián điện|gián điệp|Gspot|G-spot|Gun Powder|Hàng dựng|Hàng loại 1|Hàng nhái|Heroin|HKS Z6|Homosexual|horny|Hotdeal|Intravaginal|knuckle buster|knucklebuster|Ku Klux Klan|Lesbian|LGBT|Libido|lựu đạn|Marijuana|Masturbation|Morphine|nanchaku|Nazi|nghe lén|nghe trộm|ngụy trang|Nicotine|nipple clamp|nipple clip|Nunchaku|Nun-chaku|Nunchakus|opium|Pembesar Penis|penis|Penis Enlargement|playboy magazine|Porn|Porn Magazine|Porn Movies|pornos|Propyl|Psychotrophic|Pussy|quay lén|quay trộm|quay trộn|Raw Opium|refurbished|replica|Sendo|sex|sex toy|sextoy|sexual|Shock Gun|Shopee|spy|stun gun|stun-gun|stunt gun|Taser Gun|Tear Gas|Thế giới di động|thegioididong|Tiki|transgender|trứng rung|tự vệ|vagina|vaginal|viagra|viên đạn|vuivui|Weed|whore|wine|yes24|middle finger|côn nhị khúc|nhị khúc');
$find = explode('|', $findme);
$data = array();
if($_POST['text'])
{
	for($i=0;$i<count($find);$i++){
		$pos = strpos($mystring, $find[$i]);
		if ($pos === false) {
		    //echo "The string '$findme' was not found in the string '$mystring'";
		} else {
		    $data[] = $find[$i];
		}
	}
	if(count($data) > 0){
		echo 'LỖI:';
		var_dump($data);
	}else{
		echo 'Không có lỗi văn bản xuất hiện';
	}
}
?>
<style type="text/css">
body {
	font: 100%/1 Arial, sans-serif;
	color: #555;
	background: #eee;
	margin: 0;
	padding: 0;
}

#editor {
	margin: 2em auto;
	max-width: 640px;
	padding: 1em;
	background: #fff;
	position: relative;
}

#buttons {
	height: 2em;
	width: 100%;
	position: absolute;
	top: 0;
	left: 0;
	background: #222;
	margin: 0;
	padding: 0;
	list-style: none;
}

#buttons > li {
	float: left;
	height: 100%;
	position: relative;
}

#buttons > li > a {
	height: 100%;
	line-height: 2;
	float: left;
	padding: 0 1em;
	color: #fff;
	text-decoration: none;
}

#bold {
	font-weight: bold;
}

#italic {
	font-style: italic;
	font-family: Georgia, serif;
}

#blockquote {
	font-family: Georgia, serif;
	font-weight: bold;
	font-size: 21px;
}

#editor-form {
	margin-top: 3.5em;
}

textarea {
	display: block;
	font: 1em Arial, sans-serif;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
	background: #f5f5f5;
	border: 1px solid #ccc;
	padding: 0.5em;
	width: 100%;
	height: 15em;
}

textarea:focus {
	outline-style: none;
	background: #fff;
}

input[type="submit"] {
	font: 1em Arial, sans-serif;
	border: none;
	padding: 0.4em 1.4em;
	background: #08c;
	color: #fff;	
}
</style>
<div id="editor">
	<ul id="buttons">
		<li><a href="#" id="bold">B</a></li>
		<li><a href="#" id="italic">I</a></li>
		<li><a href="#" id="blockquote">“</a>
	</ul>
	<form id="editor-form" action="" method="post">
		<div>
			<textarea id="html" name="text" rows="15" cols="20" placeholder="Nhập văn bản ..."></textarea>
		</div>
		<p><input type="submit" value="Check It!" /></p>
	</form>
</div>	
<script type="text/javascript">
	(function() {
	
	function Editor( element ) {
		this.el = document.getElementById( element );
		this.init();
	}
	
	Editor.prototype = {
		init: function() {
			this.buttons = [];
		},
		addButton: function( btn ) {
			var button = document.querySelector( btn );
			this.buttons.push( button );
		},
		_addEvent: function( element, evt, callback ) {
			element.addEventListener( evt, function( e ) {
				e.preventDefault();
				callback( element );
			}, false);
		},
		addAction: function( evtype, action ) {
			var self = this;
			for( var i = 0; i < self.buttons.length; ++i ) {
				var but = self.buttons[i];
				self._addEvent( but, evtype, action );
			}	
		}
	};
	
	document.addEventListener( "DOMContentLoaded", function() {
		var myEditor = new Editor( "editor" );
		myEditor.addButton( "#bold" );
		myEditor.addButton( "#italic" );
		myEditor.addButton( "#blockquote" );
		
		myEditor.addAction( "click", function( bt ) {
			var id = bt.getAttribute( "id" );
			var html = "";
			var textarea = document.querySelector( "#html" );
			var value = textarea.value;
			var startPos = textarea.selectionStart;
			var endPos = textarea.selectionEnd;
			var selectedText = value.substring( startPos, endPos );
			
			switch( id ) {
				case "bold":
					html = "<strong>" + selectedText + "</strong>";
					break;
				case "italic":
					html = "<em>" + selectedText + "</em>";
					break;
				case "blockquote":
				    html = "<blockquote>" + selectedText + "</blockquote>";
				    break;
				default:
					break;
			}
			
			textarea.value = value.replace( selectedText, html );
		});
		
	});
	
	
})();

</script>