<?php
class YouTube
{
	/* Author Information */
	private	$_author;
	private	$_author_url;
	
	/* Video Information */
	private	$_id;
	private $_title;
	private $_description;
	private $_url;
	private	$_embed;
	private	$_thumb;
	private $_duration;
	private $_rating;
	
	/* Feed Information */
	private	$_feed;
	private $_feed_url;
	
	/* Comment Information */
	private $_comments_url;
	private	$_comments_count;
	
	public function __construct( $video_id )
    {
		/* Save the video id */
		$this->_id		 = $video_id;
		
		/* Store the feed url and load it to object */
    	$this->_feed_url = 'http://gdata.youtube.com/feeds/api/videos/' . $video_id;
		$this->_feed	 = (Object) simplexml_load_file( $this->_feed_url );
		
		/* Extract data */
		$this->process();
    }
    
    private function process()
	{
		/* Parse author information */
		$this->_author		= $this->_feed->author->name;
		$this->_author_url	= $this->_feed->author->uri;
		
		/* get nodes in media: namespace for media information */
		$media 				= $this->_feed->children( 'http://search.yahoo.com/mrss/' );
		$this->_title 		= $media->group->title;
		$this->_description	= $media->group->description;
		
		/* Create embed code */
		$this->_embed		= '<object width="640" height="385">'
							. '<param name="movie" value="http://www.youtube.com/v/' . $this->_id . '?fs=1&amp;hl=en_GB"></param>'
							. '<param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param>'
							. '<embed src="http://www.youtube.com/v/' . $this->_id . '?fs=1&amp;hl=en_GB" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="640" height="385"></embed>'
							. '</object>';
		
		/* get video player URL */
		$attrs				= $media->group->player->attributes();
		$this->_url			= $attrs['url']; 
		
		/* get video thumbnail */
		$attrs				= $media->group->thumbnail[0]->attributes();
		$this->_thumb	 	= $attrs['url']; 
            
		/* get <yt:duration> node for video length */
		$yt 				= $media->children( 'http://gdata.youtube.com/schemas/2007' );
		$attrs 				= $yt->duration->attributes();
		$this->_duration	= $attrs['seconds']; 
      
		/* get <yt:stats> node for viewer statistics */
		$yt 				= $this->_feed->children( 'http://gdata.youtube.com/schemas/2007' );
		$attrs				= $yt->statistics->attributes();
		$this->_views		= $attrs['viewCount']; 
      
		/* get <gd:rating> node for video ratings */
		$gd					= $this->_feed->children( 'http://schemas.google.com/g/2005' ); 
		
		if( $gd->rating )
		{ 
			$attrs			= $gd->rating->attributes();
			$this->_rating	= $attrs['average']; 
		}
		else
		{
			$this->_rating	= 0;         
		}
        
		/* get <gd:comments> node for video comments */
		$gd					= $this->_feed->children( 'http://schemas.google.com/g/2005' );
		
		if( $gd->comments->feedLink )
		{ 
			$attrs					= $gd->comments->feedLink->attributes();
			$this->_comments_url	= $attrs['href']; 
			$this->_comments_count	= $attrs['countHint']; 
		}
      
		/* get feed URL for video responses */
		$this->_feed->registerXPathNamespace( 'feed', 'http://www.w3.org/2005/Atom' );
		$nodeset					= $this->_feed->xpath( "feed:link[@rel='http://gdata.youtube.com/schemas/2007#video.responses']" ); 
		
		if( count( $nodeset ) > 0 )
		{
			$this->_responses_url	= $nodeset[0]['href'];      
		}
         
		/* get feed URL for related videos */
		$this->_feed->registerXPathNamespace( 'feed', 'http://www.w3.org/2005/Atom' );
		$nodeset					= $this->_feed->xpath( "feed:link[@rel='http://gdata.youtube.com/schemas/2007#video.related']" ); 
		
		if( count( $nodeset ) > 0 )
		{
			$this->_related_url		= $nodeset[0]['href'];      
		}
	}
	
	/* Returns information regarding the video itself */
	public function get_meta()
	{
		$array					= array();
		$array['id']			= $this->_id;
		$array['title']			= $this->_title;
		$array['description']	= $this->_description;
		$array['url']			= $this->_url;
		$array['embed']			= $this->_embed;
		$array['thumb']			= $this->_thumb;
		$array['duration']		= $this->_duration;
		$array['rating']		= $this->_rating;
		$array['views']			= $this->_views;
		
		return $array;
	}
	
	/* Returns information regarding the author */
	public function get_author()
	{
    	$authorFeed = simplexml_load_file( $this->_author_url );    
	    $authorData = $authorFeed->children('http://gdata.youtube.com/schemas/2007');

		$array				= array();
		$array['username']	= $this->_author;
		$array['age']		= $authorData->age;
		$array['gender']	= strtoupper($authorData->gender);
		$array['location']	= $authorData->location;
		$array['url']		= $this->_author_url;
		
		return $array;
	}
	
	/* Returns information regarding videocomments, max 20 returned */
	public function get_comments()
	{
		$array 			= array();
		$array['url']	= $this->_comments_url;
		$array['total']	= $this->_comments_count;
		
		if( $this->_comments_url && $this->_comments_count > 0 )
		{
			$commentsFeed = simplexml_load_file( $this->_comments_url );    
		
			$array['title']		= $commentsFeed->title;
			$array['comments']	= array();
			
			foreach( $commentsFeed->entry as $comment ) 
			{
				$array['comments'][] = $comment->content;
			}
		}
		
		return $array;
	}
	
	/* Returns video responses */
	public function get_responses()
	{
		$array 			= array();
		$array['url']	= $this->_responses_url;
		
		if( $this->_responses_url )
		{
			$responseFeed		= simplexml_load_file( $this->_responses_url );
			
			$array['title'] 	= $responseFeed->title;
			$array['responses']	= array();
		
			$i = 0;
		
			foreach( $responseFeed->entry as $response )
			{
				// Get the ID
				$explode				= explode( '/', $response->id );
				$array['responses'][]	= new YouTube( $explode[( count( $explode ) - 1 )] );
				
				++$i;
			}
			
			$array['total'] 	= $i;    
		}
		
		return $array;
	}
	
	/* Returns related videos */
	public function get_related()
	{
		$array 			= array();
		$array['url']	= $this->_related_url;
		
		if( $this->_related_url )
		{
			$relatedFeed 		= simplexml_load_file( $this->_related_url );
		  
			$array['title'] 	= $relatedFeed->title;
			$array['related']	= array();
			
			$i = 0;
		  
			foreach( $relatedFeed->entry as $related )
			{
				// Get the ID
				$explode				= explode( '/', $related->id );
				$array['related'][]	= new YouTube( $explode[( count( $explode ) - 1 )] );
				
				++$i;		
			}
			
			$array['total'] 	= $i;    
		}
		
		return $array;
	}
    
    public function __destruct()
    {
    
    }
}
?>