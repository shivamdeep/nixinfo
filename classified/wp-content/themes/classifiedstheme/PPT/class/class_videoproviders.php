<?php
 
class VideoProvider {
 	protected $height = 400;
	protected $width = 640;
	protected $link = ""; 
 
	// getEmbedCode
	public function getEmbedCode($videoLink, $width = null, $height = null) {
		 
		if ($videoLink != "") {
			if(!is_numeric(strpos($videoLink, "http://"))){
				$videoLink =  "http://".$videoLink;
			}
			$this->link = $videoLink;
			$embedCode = "";
			$videoProvider = $this->decideVideoProvider();	
			if($videoProvider == "") {
				$embedCode = false;
			} else {
				$embedCode = $this->generateEmbedCode($videoProvider);		
			}
		} else {
			$embedCode = false;
		}
		return $embedCode;
	}
	// decide video provider
	private function decideVideoProvider(){
		$videoProvider= "";
		$hostings = array(	'youtube', 
							'vimeo', 
							'break', 
							'dailymotion', 
							'yahoo', 
							'metacafe', 
							'viddler', 
							'blip', 
							'myspace',
							'megavideo',
							'twitcam',
							'ustream',
							'livestream',
							'twitcam.livestream',
							'gametrailers');
							
		for($i=0; $i<count($hostings); $i++) {
			if(is_numeric(strpos($this->link, $hostings[$i]))){
				$videoProvider = $hostings[$i];
			}
		}
		return $videoProvider;
	}	
	// generate video ıd from link
	private function getVideoId ($operand, $optionaOperand = null) {
		$videoId  = null;
		$startPosCode = strpos($this->link, $operand);
		if ($startPosCode != null) {
			$videoId = substr($this->link, $startPosCode + strlen($operand), strlen($this->link)-1);
			if(!is_null($optionaOperand)) {
				$startPosCode = strpos($videoId, $optionaOperand);	
				if ($startPosCode > 0) {
					$videoId = substr($videoId , 0, $startPosCode);	
				}	
			}	
		}
		return $videoId;
	}
	// generate video embed code via using standart templates
	private function generateEmbedCode ($videoProvider) {
		switch($videoProvider) {
			case 'youtube':
			
				$videoId = $this->getVideoId("v=","&");
				
				
				$youtube 	= new YouTube( $videoId );			
				$meta	 	= $youtube->get_meta();
				  
				if(strlen(str_replace("!!**","",$meta['title'])) > 2){
				$rA = array(
				"ID" => $videoId,
				"network" => "youtube",
				"title" => str_replace("!!**","",$meta['title']),
				"image" => str_replace("!!**","",$meta['thumb']),
				"link" => $this->link,
				"embed" => str_replace("!!**","",$meta['embed']),
				"desc" => str_replace("!!**","",$meta['description']),
				"duration" => str_replace("!!**","",$meta['duration']),
				);
				return $rA;
				
				}else{
				
				return false;
				
				}
				 
				break;
			case 'vimeo':
			
				$vimeo = new phpVimeo('f53cab9645f76e61472d86ea321cf145', '28be897bc2e3b159');
					
				$videoId = $this->getVideoId(".com/");
					
				$videoinfo = $vimeo->call('vimeo.videos.getInfo', array('video_id' => $videoId));
				
				if(strlen(str_replace("!!**","",$videoinfo->video[0]->title)) > 2){
				
				$embedCode .= "<object width=\"".$this->width."\" height=\"".$this->height."\">";
						$embedCode .= "<param name=\"allowfullscreen\" value=\"true\" />";
						$embedCode .= "<param name=\"allowscriptaccess\" value=\"always\" />";
						$embedCode .= "<param name=\"movie\" value=\"http://vimeo.com/moogaloop.swf?clip_id=".$videoId;
						$embedCode .= "&amp;server=vimeo.com&amp;show_title=0&amp;show_byline=0&amp;show_portrait=0&amp;color=E8DA28&amp;fullscreen=1\" />";
						$embedCode .= "<embed src=\"http://vimeo.com/moogaloop.swf?clip_id=".$videoId;
						$embedCode .= "&amp;server=vimeo.com&amp;show_title=0&amp;show_byline=0&amp;show_portrait=0&amp;color=E8DA28&amp;fullscreen=1\"";
						$embedCode .= "type=\"application/x-shockwave-flash\"";
						$embedCode .= " allowfullscreen=\"true\" allowscriptaccess=\"always\" width=\"".$this->width."\" height=\"".$this->height."\"></embed>";
						$embedCode .= "</object>";
				
				$rA = array(
						"ID" => $videoId,
						"network" => "vinmeo",
						"title" => str_replace("!!**","",$videoinfo->video[0]->title),
						"image" => $videoinfo->video[0]->thumbnails->thumbnail[0]->_content,
						"link" => $this->link,
						"embed" => $embedCode,
						"desc" => str_replace("!!**","",$videoinfo->video[0]->description),
						"duration" => str_replace("!!**","",$videoinfo->video[0]->duration),
					);
					
				return $rA;
	 
				}else{
				
				return false;
				
				}	 
		  				
				break;
			case 'break':
				$videoId = $this->getBreakInfo($this->link);
				if ($videoId != null) {					
					$embedCode .= "<object width=\"".$this->width."\" height=\"".$this->height."\" id=\"".$videoId."\" type=\"application/x-shockwave-flash\"";
					$embedCode .= "	classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\">";
					$embedCode .= "<param name=\"movie\" value=\"http://embed.break.com/".$videoId."\"></param>";
					$embedCode .= "<param name=\"allowScriptAccess\" value=\"always\"></param>";
					$embedCode .= "<embed src=\"http://embed.break.com/".$videoId."\" type=\"application/x-shockwave-flash\" ";
					$embedCode .= "allowScriptAccess=always width=\"".$this->width."\" height=\"".$this->height."\"></embed></object>";
				} else {
					$embedCode = INVALID_URL;
				}	
				break;
			case 'dailymotion':
				$videoId = $this->getVideoId("video/");	
				if ($videoId != null) {					
					$embedCode .= "<object width=\"".$this->width."\" height=\"".$this->height."\"><param name=\"movie\" ";
					$embedCode .= "value=\"http://www.dailymotion.com/swf/video/".$videoId."\"></param>";
					$embedCode .= "<param name=\"allowFullScreen\" value=\"true\"></param>";
					$embedCode .= "<param name=\"allowScriptAccess\" value=\"always\"></param>";
					$embedCode .= "<embed type=\"application/x-shockwave-flash\" src=\"http://www.dailymotion.com/swf/video/".$videoId."\" ";
					$embedCode .= "width=\"".$this->width."\" height=\"".$this->height."\" allowfullscreen=\"true\" allowscriptaccess=\"always\"></embed>";
					$embedCode .= "</object>";	
				} else {
					$embedCode = INVALID_URL;
				}					
				break;	
			case 'yahoo':
				$videoIds = $this->getVideoId("watch/");
				if(strlen($videoIds) == 0) {
					$videoIds = $this->getVideoId("network/");
				}
				if ($videoIds != null) {					
					$startPosCode = strpos($videoIds, "/");
					$firstID = substr($videoIds , 0, $startPosCode);
					$secondID = substr($videoIds , $startPosCode+1, strlen($this->link)-1);
					$embedCode .= "<object width=\"".$this->width."\" height=\"".$this->height."\">";
					$embedCode .= "<param name=\"movie\" value=\"http://d.yimg.com/static.video.yahoo.com/yep/YV_YEP.swf?ver=2.2.46\" />";
					$embedCode .= "<param name=\"allowFullScreen\" value=\"true\" /><param name=\"AllowScriptAccess\" VALUE=\"always\" />";
					$embedCode .= "<param name=\"bgcolor\" value=\"#000000\" />";
					$embedCode .= "<param name=\"flashVars\" value=\"id=".$secondID."&vid=".$firstID."&lang=en-us&intl=us&embed=0\" />";
					$embedCode .= "<embed src=\"http://d.yimg.com/static.video.yahoo.com/yep/YV_YEP.swf?ver=2.2.46\" ";
					$embedCode .= "type=\"application/x-shockwave-flash\" width=\"".$this->width."\" height=\"".$this->height."\" allowFullScreen=\"true\"";
					$embedCode .= " AllowScriptAccess=\"always\" bgcolor=\"#000000\" flashVars=\"id=".$secondID."&vid=".$firstID;
					$embedCode .= "&lang=en-us&intl=us&embed=0\" >";
					$embedCode .= "</embed></object>";
				} else {
					$embedCode = INVALID_URL;
				}
				break;			
			case 'metacafe':
		 
			
				$videoFullID = $this->getVideoId("watch/");	
				$videoFullID = substr($videoFullID, 0, strlen($videoFullID)-1);	
				$videoId = strpos($videoFullID, "/");
				$videoId = substr($videoFullID, 0, $videoId); 
				 
				$feedURL = 'http://www.metacafe.com/api/item/'.$videoId; 
				$dd = simplexml_load_file($feedURL);
	
				if(strlen(str_replace("!!**","",$dd->channel->item->title)) > 2){ 
	
					$embedCode .= "<embed flashVars=\"playerVars=showStats=no|autoPlay=no|\" ";
					$embedCode .= "src=\"http://www.metacafe.com/fplayer/".$videoFullID.".swf\" "; 
					$embedCode .= "width=\"".$this->width."\" height=\"".$this->height."\" wmode=\"transparent\" allowFullScreen=\"true\" "; 
					$embedCode .= "allowScriptAccess=\"always\" name=\"Metacafe_".$videoId."\" "; 
					$embedCode .= "pluginspage=\"http://www.macromedia.com/go/getflashplayer\" "; 
					$embedCode .= "type=\"application/x-shockwave-flash\"></embed>";
		
					$rA = array(
					"ID" => $videoId,
					"network" => "metacafe",
					"title" => str_replace("!!**","",$dd->channel->item->title),
					"image" => "http://www.metacafe.com/thumb/".$videoId.".jpg",
					"link" => $this->link,
					"embed" => $embedCode,
					"desc" => str_replace("!!**","",strip_tags($dd->channel->item->description)),
					"duration" => "",
					);
					
					return $rA;
				
				}else{
				return false;
				}
	
	 				
				break;	
			case 'viddler':
				$videoId = $this->getViddlerInfo($this->link);	
				if ($videoId != null) {					
					$embedCode .= "<object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" width=\"".$this->width."\" height=\"".$this->height."\" ";
					$embedCode .= "id=\"viddler_1f72e4ee\">";
					$embedCode .= "<param name=\"movie\" value=\"http://www.viddler.com/player/".$videoId."\"/\" />";
					$embedCode .= "<param name=\"allowScriptAccess\" value=\"always\" />";
					$embedCode .= "<param name=\"allowFullScreen\" value=\"true\" />";
					$embedCode .= "<embed src=\"http://www.viddler.com/player/".$videoId."\"/\"";
					$embedCode .= "width=\"".$this->width."\" height=\"".$this->height."\" type=\"application/x-shockwave-flash\" ";
					$embedCode .= "allowScriptAccess=\"always\"";
					$embedCode .= "allowFullScreen=\"true\" name=\"viddler_".$videoId."\"\"></embed></object>";
				} else {
					$embedCode = INVALID_URL;
				}	
		 
				
				break;	
			case 'blip':
			
			$ID = explode("?",str_replace("/","",str_replace("http://blip.tv/file/","",$this->link)));		 
			if(is_numeric($ID[0])){
			 
				$dd = simplexml_load_file("http://www.blip.tv/file/".$ID[0]."?skin=api");
				
				$rA = array(
				"ID" => $ID[0],
				"title" => str_replace("!!**","",$dd->payload->asset->title),
				"image" => "",
				"link" => $this->link,
				"embed" => str_replace("!!**","",$dd->payload->asset->embedCode[0]),
				"desc" => str_replace("!!**","",$dd->payload->asset->description[0]),
				"duration" => str_replace("!!**","",$dd->payload->asset->mediaList->media[0]->duration),
				);
				 
				return $rA;
			
			}else{
			return false;
			}
			 				
				break;
			case 'myspace':
				$this->link = strtolower($this->link);
				$videoId = $this->getVideoId("videoid=","&");
				if ($videoId != null) {
					$embedCode .= "<object width=\"".$this->width."\" height=\"".$this->height."\" ><param name=\"allowFullScreen\" ";
					$embedCode .= "value=\"true\"/><param name=\"wmode\" value=\"transparent\"/><param name=\"movie\" ";
					$embedCode .= "value=\"http://mediaservices.myspace.com/services/media/embed.aspx/m=".$videoId.",t=1,mt=video\"/>";
					$embedCode .= "<embed src=\"http://mediaservices.myspace.com/services/media/embed.aspx/m=".$videoId.",t=1,mt=video\" ";
					$embedCode .= "width=\"".$this->width."\" height=\"".$this->height."\" allowFullScreen=\"true\" type=\"application/x-shockwave-flash\" ";
					$embedCode .= "wmode=\"transparent\"></embed></object>";
				} else {
					$embedCode = INVALID_URL;
				}					
				break;	
			case 'megavideo':
				$videoId = $this->getVideoId("v=");
				if ($videoId != null) {
					$embedCode .="<object width=\"".$this->width."\" height=\"".$this->height."\">";
					$embedCode .="<param name=\"movie\" value=\"http://www.megavideo.com/v/".$videoId."></param>";
					$embedCode .="<param name=\"allowFullScreen\" value=\"true\"></param>";
					$embedCode .="<embed src=\"http://www.megavideo.com/v/".$videoId."\" type=\"application/x-shockwave-flash\" ";
					$embedCode .="allowfullscreen=\"true\" width=\"".$this->width."\" height=\"".$this->height."\"></embed></object>";
				} else {
					$embedCode = INVALID_URL;
				}	
				break;			
			case 'twitcam.livestream':
			case 'twitcam':
				$videoId = $this->getVideoId("com/");
				if ($videoId != null) {
					$embedCode .="<object id=\"twitcamPlayer\" width=\"".$this->width."\" height=\"".$this->height."\" ";
					$embedCode .="classid=\"clsid:d27cdb6e-ae6d-11cf-96b8-444553540000\">";
					$embedCode .="<param name=\"movie\" ";
					$embedCode .="value=\"http://static.livestream.com/chromelessPlayer/wrappers/TwitcamPlayer.swf?hash=".$videoId."\"/>";
					$embedCode .="<param name=\"allowFullScreen\" value=\"true\"/><param name=\"wmode\" value=\"window\"/>";
					$embedCode .="<embed name=\"twitcamPlayer\" ";
					$embedCode .="src=\"http://static.livestream.com/chromelessPlayer/wrappers/TwitcamPlayer.swf?hash=".$videoId."\" ";
					$embedCode .="allowFullScreen=\"true\" type=\"application/x-shockwave-flash\" bgcolor=\"#ffffff\" ";
					$embedCode .="width=\"".$this->width."\" height=\"".$this->height."\" wmode=\"window\" ></embed></object>";
				} else {
					$embedCode = INVALID_URL;
				}	
				break;
				
			case 'ustream':
				$videoId = $this->getVideoId("recorded/",'/');
				if ($videoId != null) {			
					$embedCode .= "<object classid=\"clsid:d27cdb6e-ae6d-11cf-96b8-444553540000\" ";
					$embedCode .= "width=\"".$this->width."\" height=\"".$this->height."\" ";
					$embedCode .= "id=\"utv867721\" name=\"utv_n_859419\"><param name=\"flashvars\" ";
					$embedCode .= "value\"beginPercent=0.0236&amp;endPercent=0.2333&amp;autoplay=false&locale=en_US\" />";
					$embedCode .= "<param name=\"allowfullscreen\" value=\"true\" /><param name=\"allowscriptaccess\" ";			
					$embedCode .= "value=\"always\" />";
					$embedCode .= "<param name=\"src\" value=\"http://www.ustream.tv/flash/video/".$videoId."\" />";
					$embedCode .= "<embed flashvars=\"beginPercent=0.0236&amp;endPercent=0.2333&amp;autoplay=false&locale=en_US\" ";
					$embedCode .= "width=\"".$this->width."\" height=\"".$this->height."\" ";
					$embedCode .= "allowfullscreen=\"true\" allowscriptaccess=\"always\" id=\"utv867721\" ";
					$embedCode .= "name=\"utv_n_859419\" src=\"http://www.ustream.tv/flash/video/".$videoId."\" ";
					$embedCode .= "type=\"application/x-shockwave-flash\" /></object>";
				} else {
					$embedCode = INVALID_URL;
				}
				break;				
			case 'livestream':
				$firstID = $this->getVideoId("com/",'/');
				$secondID = $this->getVideoId("?clipId=",'&');
				if ($firstID != null && $secondID != null) {					
					$embedCode .= "<object width=\"".$this->width."\" height=\"".$this->height."\" id=\"lsplayer\" ";
					$embedCode .= "classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\">";
					$embedCode .= "<param name=\"movie\" ";
					$embedCode .= "value=\"http://cdn.livestream.com/grid/LSPlayer.swf?channel=".$firstID."&amp;";
					$embedCode .= "clip=".$secondID."&amp;autoPlay=false\"></param>";
					$embedCode .= "<param name=\"allowScriptAccess\" value=\"always\"></param><param name=\"allowFullScreen\" ";
					$embedCode .= "value=\"true\"></param><embed name=\"lsplayer\" wmode=\"transparent\" ";
					$embedCode .= "src=\"http://cdn.livestream.com/grid/LSPlayer.swf?channel=".$firstID."&amp;";
					$embedCode .= "clip=".$secondID."&amp;autoPlay=false\" ";
					$embedCode .= "width=\"".$this->width."\" height=\"".$this->height."\" allowScriptAccess=\"always\" allowFullScreen=\"true\" ";
					$embedCode .= "type=\"application/x-shockwave-flash\"></embed></object>	";
				} else {
					$embedCode = INVALID_URL;
				}
				break;			
			case 'gametrailers':
				$videoFullID = $this->getVideoId("video/");
				$videoId  = strpos($videoFullID, "/");
				$videoId = substr($videoFullID, $videoId+1, strlen($videoFullID));
				if ($videoId != null) {
					$embedCode .= "<object classid=\"clsid:d27cdb6e-ae6d-11cf-96b8-444553540000\" ";
					$embedCode .= "codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0\" ";
					$embedCode .= "id=\"gtembed\" width=\"".$this->width."\" height=\"".$this->height."\" ><param name=\"allowScriptAccess\" value=\"sameDomain\" />";
					$embedCode .= "<param name=\"allowFullScreen\" value=\"true\" />";
					$embedCode .= "<param name=\"movie\" value=\"http://www.gametrailers.com/remote_wrap.php?mid=".$videoId."\"/>";
					$embedCode .= "<param name=\"quality\" value=\"high\" /> <embed src=\"http://www.gametrailers.com/remote_wrap.php?mid=".$videoId."\" ";
					$embedCode .= "swLiveConnect=\"true\" name=\"gtembed\" align=\"middle\" allowScriptAccess=\"sameDomain\" allowFullScreen=\"true\" ";
					$embedCode .= "quality=\"high\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\" type=\"application/x-shockwave-flash\" ";
					$embedCode .= "width=\"".$this->width."\" height=\"".$this->height."\" ></embed> </object>";					
				} else {
					$embedCode = INVALID_URL;
				}
				break;
		}
		return $embedCode;
	}
	// get link form page
	private function getBreakInfo($url) {
		return $this->getVideoInfo($url, '/<input.*?id=.hdnContentId.*?value=.(.*?)(\'|")/ms');
	}
	// get link form page
	private function getBlipInfo($url) {
		return $this->getVideoInfo($url, '/<link.*?rel=.video_src.*?href=.(.*?)(\'|")/ms');
	}
	// get link form page
	private function getViddlerInfo($url) {
		return $this->getVideoInfo($url, '/<input.*?name=.movieToken.*?value=.(.*?)(\'|")/ms');
	}
	// get link form page
	private function getVideoInfo($url, $matchCase) {
		$html = $this->geturl($url);
		if(stripos($html, "302 Moved") !== false) {
			$html = $this->geturl(match('/HREF="(.*?)"/ms', $html, 1));
		}
		$arr = $this->match($matchCase, $html, 1);
		return $arr;
	}
	
	private function setDimensions ($width = null, $height = null) {
		if((!is_null($width)) && ($width != "")) {
			$this->width  = $width;
		}		
		
		if((!is_null($height)) && ($height != "")) {
			$this->height = $height;		
		}	
	}
	
	private function geturl($url, $username = null, $password = null) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
		$html = curl_exec($ch);
		curl_close($ch);
		return $html;
	}
	
	private function match($regex, $str, $i = 0)
	{
		if(preg_match($regex, $str, $match) == 1) {
			return $match[$i];
		} else {
			return null;
		}
	}	
}
?>