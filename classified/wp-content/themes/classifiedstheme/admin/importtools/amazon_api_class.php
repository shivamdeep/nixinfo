<?php

    
    require_once 'aws_signed_request.php';

    class AmazonProductAPI
    {
        /**
         * Your Amazon Access Key Id
         * @access private
         * @var string
         */
        private $public_key     = "AKIAI5IN4MZ6OBOZH4ZQ";
        
        /**
         * Your Amazon Secret Access Key
         * @access private
         * @var string
         */
        private $private_key    = "OU+kJwuDWVG7y4vBJgQ8CPISK8NnE8370ecaz+4a";
        
        /**
         * Check if the xml received from Amazon is valid
         * 
         * @param mixed $response xml response to check
         * @return bool false if the xml is invalid
         * @return mixed the xml response if it is valid
         * @return exception if we could not connect to Amazon
         */
        private function verifyXmlResponse($response)
        {
            if ($response === False)
            {
                throw new Exception("Could not connect to Amazon");
            }
            else
            {
 
				if (isset($response->Items->Item->ItemAttributes->Title))
                {
                    return ($response);
                
                }elseif (isset($response->Cart))
                {
                    return ($response);
                }
				elseif(isset($response->Items->Request->Errors->Error->Message)){
				throw new Exception("<h1>There was an error but don't panic..</h1><p>".$response->Items->Request->Errors->Error->Message[0]."</p>");
				}
                else
                {
                    throw new Exception("<h1>We did not find any matches for your request</h1>");
                }
            }
        }
        
        
        /**
         * Query Amazon with the issued parameters
         * 
         * @param array $parameters parameters to query around
         * @return simpleXmlObject xml query response
         */
        private function queryAmazon($parameters, $country="com")
        {
            return aws_signed_request($country, $parameters, $this->public_key, $this->private_key);
        }
        
        
        /**
         * Return details of products searched by various types
         * 
         * @param string $search search term
         * @param string $category search category         
         * @param string $searchType type of search
         * @return mixed simpleXML object
         */
        public function searchProducts($search, $category, $values)
        { 
		
		if(strlen($values['minprice']) > 1){
		$values['minprice'].="00";
		}
		
		if(strlen($values['maxprice']) > 1){
		$values['maxprice'].="00";
		}
 
		if($category =="All"){
		$parameters = array(
		"Operation"  	=> "ItemSearch",
		"Keywords" 		=> $search,
		"SearchIndex"   => $category,
		"ResponseGroup" => "ItemAttributes,Offers,Images,EditorialReview,Reviews",
		"MinimumPrice" 	=> $values['minprice'],
		"MaximumPrice" 	=> $values['maxprice'],
		"ItemPage" 		=> $values['start_page'],
		"Brand"	 		=> $values['brand'],		
		"Condition" 	=> $values['condition'],
		//"Sort" 			=> $values['Sort'],
		"MerchantId"	=> $values['merchantid']);
		}else{
		$parameters = array(
		"Operation"  	=> "ItemSearch",
		"Title" 		=> $search,
		"SearchIndex"   => $category,
		"ResponseGroup" => "ItemAttributes,Offers,Images,EditorialReview,Reviews",
		"MinimumPrice" 	=> $values['minprice'],
		"MaximumPrice" 	=> $values['maxprice'],
		"ItemPage" 		=> $values['start_page'],
		"BrowseNode"	=> $values['node'],
		"Brand"	 		=> $values['brand'],
		"Condition" 	=> $values['condition'],
		"Sort" 			=> $values['Sort'],
		"MerchantId"	=> $values['merchantid']);
		}
		
		
		
		//die(print_r($parameters));
		 
             
            $xml_response = $this->queryAmazon($parameters, $values['country']);
            
            return $this->verifyXmlResponse($xml_response);

        }
        
        
        /**
         * Return details of a product searched by UPC
         * 
         * @param int $upc_code UPC code of the product to search
         * @param string $product_type type of the product
         * @return mixed simpleXML object
         */
        public function getItemByUpc($upc_code, $product_type)
        {
            $parameters = array("Operation"     => "ItemLookup",
                                "ItemId"        => $upc_code,
                                "SearchIndex"   => $product_type,
                                "IdType"        => "UPC",
                                "ResponseGroup" => "Medium");
                                
            $xml_response = $this->queryAmazon($parameters);
            
            return $this->verifyXmlResponse($xml_response);

        }
        
        
        /**
         * Return details of a product searched by ASIN
         * 
         * @param int $asin_code ASIN code of the product to search
         * @return mixed simpleXML object
         */
        public function getItemByAsin($asin_code, $country)
        {
            $parameters = array("Operation"     => "ItemLookup",
                                "ItemId"        => $asin_code,
                                "ResponseGroup" => "ItemAttributes,Offers,Images,EditorialReview,Reviews");
                                
            $xml_response = $this->queryAmazon($parameters, $country);
            
            return $this->verifyXmlResponse($xml_response);
        }
        
        
        /**
         * Return details of a product searched by keyword
         * 
         * @param string $keyword keyword to search
         * @param string $product_type type of the product
         * @return mixed simpleXML object
         */
        public function getItemByKeyword($keyword, $product_type)
        {
            $parameters = array("Operation"   => "ItemSearch",
                                "Keywords"    => $keyword,
                                "SearchIndex" => $product_type);
                                
            $xml_response = $this->queryAmazon($parameters);
            
            return $this->verifyXmlResponse($xml_response);
        }

 

        public function CreateCart($parameters,$country="com")
        {
           
                                
            $xml_response = $this->queryAmazon($parameters,$country);
            
            return $this->verifyXmlResponse($xml_response);

        }

    }

?>
