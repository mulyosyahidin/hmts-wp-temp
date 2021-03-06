<?php
/**
 * @package Unlimited Elements
 * @author UniteCMS.net
 * @copyright (C) 2012 Unite CMS, All Rights Reserved. 
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * */
defined('UNLIMITED_ELEMENTS_INC') or die('Restricted access');

class UniteCreatorParamsProcessor extends UniteCreatorParamsProcessorWork{
	
	private static $arrPostTypeTaxCache = array();
	
	
	/**
	 * add other image thumbs based of the platform
	 */
	protected function addOtherImageData($data, $name, $imageID){
		
		if(empty($data))
			$data = array();
		
		$imageID = trim($imageID);
		if(is_numeric($imageID) == false)
			return($data);
		
		$post = get_post($imageID);
		
		if(empty($post))
			return($data);
		
		$title = UniteFunctionsWPUC::getAttachmentPostTitle($post);
		$caption = 	$post->post_excerpt;
		$description = 	$post->post_content;
		
		
		$alt = UniteFunctionsWPUC::getAttachmentPostAlt($imageID);
		
		if(empty($alt))
			$alt = $title;
		
		$data["{$name}_title"] = $title;
		$data["{$name}_alt"] = $alt;
		$data["{$name}_description"] = $description;
		$data["{$name}_caption"] = $caption;
		$data["{$name}_imageid"] = $imageID;
		
		return($data);
	}
	
	
	/**
	 * add other image thumbs based of the platform
	 */
	protected function addOtherImageThumbs($data, $name, $imageID){
		
		if(empty($data))
			$data = array();
		
		$imageID = trim($imageID);
		if(is_numeric($imageID) == false)
			return($data);
		
		$arrSizes = UniteFunctionsWPUC::getArrThumbSizes();
		
		$metaData = wp_get_attachment_metadata($imageID);
		$imageWidth = UniteFunctionsUC::getVal($metaData, "width");
		$imageHeight = UniteFunctionsUC::getVal($metaData, "height");
		
		$urlFull = UniteFunctionsWPUC::getUrlAttachmentImage($imageID);
				
		$data["{$name}_width"] = $imageWidth;
		$data["{$name}_height"] = $imageHeight;

		$metaSizes = UniteFunctionsUC::getVal($metaData, "sizes");
				
		foreach($arrSizes as $size => $sizeTitle){
			
			if(empty($size))
				continue;
			
			if($size == "full")
				continue;
			
			//change the hypen to underscore
			$thumbName = $name."_thumb_".$size;
			if($size == "medium")
				$thumbName = $name."_thumb";
			
			$thumbName = str_replace("-", "_", $thumbName);
			
			if(isset($data[$thumbName]))
				continue;
			
			$arrSize = UniteFunctionsUC::getVal($metaSizes, $size);
			
			$thumbWidth = UniteFunctionsUC::getVal($arrSize, "width");
			$thumbHeight = UniteFunctionsUC::getVal($arrSize, "height");
			
			$thumbWidth = trim($thumbWidth);
						
			$urlThumb = UniteFunctionsWPUC::getUrlAttachmentImage($imageID, $size);
			if(empty($urlThumb))
				$urlThumb = $urlFull;

			if(empty($thumbWidth) && $urlThumb == $urlFull){
				$thumbWidth = $imageWidth;
				$thumbHeight = $imageHeight;
			}
			
			$data[$thumbName] = $urlThumb;
			$data[$thumbName."_width"] = $thumbWidth;
			$data[$thumbName."_height"] = $thumbHeight;			
		}
		
		return($data);
	}
	
	
	/**
	 * get post data
	 */
	public function getPostData($postID, $arrPostAdditions = null){
		
		if(empty($postID))
			return(null);
		
		$post = get_post($postID);
		
		if(empty($post))
			return(null);
		
		try{
			
			$arrData = $this->getPostDataByObj($post, $arrPostAdditions);
			
			return($arrData);
						
		}catch(Exception $e){
			return(null);
		}
		
	}

	
	/**
	 * add custom fields to terms array
	 */
	private function addCustomFieldsToTermsArray($arrTermsOutput){
		
		if(empty($arrTermsOutput))
			return($arrTermsOutput);
		
		foreach($arrTermsOutput as $index => $term){
			
			$termID = $term["id"];
		
			$arrCustomFields = UniteFunctionsWPUC::getTermCustomFields($termID);
			
			if(empty($arrCustomFields))
				continue;
				
			$term = array_merge($term, $arrCustomFields);
			
			$arrTermsOutput[$index] = $term;
		}
		
		return($arrTermsOutput);
	}
	
	
	/**
	 * modify terms array for output
	 */
	public function modifyArrTermsForOutput($arrTerms, $taxonomy = "", $addCustomFields = false){
			
			$isWooCat = false;
			if($taxonomy == "product_cat" && UniteCreatorWooIntegrate::isWooActive())
				$isWooCat = true;
			
			if(empty($arrTerms))
				return(array());
				
			$arrOutput = array();
			
			$index = 0;
			foreach($arrTerms as $slug => $arrTerm){
				
				$item = array();
				
				$item["index"] = $index;
				$item["id"] = UniteFunctionsUC::getVal($arrTerm, "term_id");
				$item["slug"] = UniteFunctionsUC::getVal($arrTerm, "slug");
				$item["name"] = UniteFunctionsUC::getVal($arrTerm, "name");
				$item["description"] = UniteFunctionsUC::getVal($arrTerm, "description");
				$item["link"] = UniteFunctionsUC::getVal($arrTerm, "link");
				$item["parent_id"] = UniteFunctionsUC::getVal($arrTerm, "parent_id");
				
				$index++;
				
				$current = UniteFunctionsUC::getVal($arrTerm, "iscurrent");
				
				$item["iscurrent"] = $current;
				
				$item["class_selected"] = "";
				if($current == true)
					$item["class_selected"] = "	uc-selected";
				
				if(isset($arrTerm["count"])){
										
					if($isWooCat == true)
						$item["num_products"] = $arrTerm["count"];
					else
						$item["num_posts"] = $arrTerm["count"];
					
				}
				
				//get woo data
				if($isWooCat == true){
						
					$thumbID = get_term_meta($item["id"], 'thumbnail_id', true);
					$hasImage = !empty($thumbID);
					
					$item["has_image"] = $hasImage;
					
					if(!empty($thumbID))
						$item = $this->getProcessedParamsValue_image($item, $thumbID, array("name"=>"image"));
					
				}
								
				$arrOutput[] = $item;
			}
			
			//add custom fields
			if($addCustomFields == true)
				$arrOutput = $this->addCustomFieldsToTermsArray($arrOutput);
			
			
			return($arrOutput);
		}
	
	
	protected function z_______________POSTS____________(){}

		
	/**
	 * get post category taxonomy
	 */
	private function getPostCategoryTaxonomy($postType){
		
		if(isset(self::$arrPostTypeTaxCache[$postType]))
			return(self::$arrPostTypeTaxCache[$postType]);
		
		$taxonomy = "category";
		
		if($postType == "post" || $postType == "page"){
			
			self::$arrPostTypeTaxCache[$postType] = $taxonomy;
			return($taxonomy);
		}
		
		//for woo
		if($postType == "product"){
			$taxonomy = "product_cat";
			self::$arrPostTypeTaxCache[$postType] = $taxonomy;
			return($taxonomy);
		}
			
		//search in tax data
		$arrTax = UniteFunctionsWPUC::getPostTypeTaxomonies($postType);
		
		if(empty($arrTax)){
			
			self::$arrPostTypeTaxCache[$postType] = $taxonomy;
			return($taxonomy);
		}
		
		$taxonomy = null;
		foreach($arrTax as $key=>$name){
				
				$name = strtolower($name);

				if(empty($taxonomy))
					$taxonomy = $key;
				
				if($name == "category")
					$taxonomy = $key;
		}
		
		if(empty($taxonomy))
			$taxonomy = "category";
		
		self::$arrPostTypeTaxCache[$postType] = $taxonomy;
		
		return($taxonomy);
	}
	
	
	/**
	 * get post category fields
	 * for single category
	 * choose category from list
	 */
	private function getPostCategoryFields($postID, $post){
		
		//choose right taxonomy
		$postType = $post->post_type;
		
		$taxonomy = $this->getPostCategoryTaxonomy($postType);
				
		if(empty($postID))
			return(array());
		
		$arrTerms = UniteFunctionsWPUC::getPostSingleTerms($postID, $taxonomy);
		
		//get single category
		if(empty($arrTerms))
			return(array());
		
		$arrCatsOutput = $this->modifyArrTermsForOutput($arrTerms);
		
		//get term data
		if(count($arrTerms) == 1){		//single
			$arrTermData = UniteFunctionsUC::getArrFirstValue($arrTerms);
		}else{		//multiple
		
			unset($arrTerms["uncategorized"]);
			
			$arrTermData = UniteFunctionsUC::getArrFirstValue($arrTerms);			
		}

		$catID = UniteFunctionsUC::getVal($arrTermData, "term_id");
		
		$arrCategory = array();
		$arrCategory["category_id"] = $catID;
		$arrCategory["category_name"] = UniteFunctionsUC::getVal($arrTermData, "name");
		$arrCategory["category_slug"] = UniteFunctionsUC::getVal($arrTermData, "slug");
		$arrCategory["category_link"] = UniteFunctionsUC::getVal($arrTermData, "link");
		$arrCategory["categories"] = $arrCatsOutput;
		
		
		return($arrCategory);
	}
	
	
	/**
	 * get post data
	 */
	private function getPostDataByObj($post, $arrPostAdditions = array()){
		
		try{
			
			$arrPost = (array)$post;
			$arrData = array();
			
			$postID = UniteFunctionsUC::getVal($arrPost, "ID");
			
			$arrData["id"] = $postID;
			$arrData["title"] = UniteFunctionsUC::getVal($arrPost, "post_title");
			$arrData["alias"] = UniteFunctionsUC::getVal($arrPost, "post_name");
			$arrData["author_id"] = UniteFunctionsUC::getVal($arrPost, "post_author");
			$arrData["content"] = UniteFunctionsUC::getVal($arrPost, "post_content");
			$arrData["link"] = UniteFunctionsWPUC::getPermalink($post);
			
			
			//get intro
			$intro = UniteFunctionsUC::getVal($arrPost, "post_excerpt");
			$introFull = "";
			
			if(empty($intro)){
				$intro = $arrData["content"];
			}
			
			if(!empty($intro)){
				$intro = strip_tags($intro);
				$introFull = $intro;
				$intro = UniteFunctionsUC::truncateString($intro, 100);
			}
			
			$arrData["intro"] = $intro;			
			$arrData["intro_full"] = $introFull;			
			
			//put data
			$strDate = UniteFunctionsUC::getVal($arrPost, "post_date");
			$arrData["date"] = !empty($strDate)?strtotime($strDate):"";
			
			//check woo commmerce data
			$postType = UniteFunctionsUC::getVal($arrPost, "post_type");
			
			if($postType == "product"){
				
				$arrWooData = UniteCreatorWooIntegrate::getWooDataByType($postType, $postID);
								
				if(!empty($arrWooData))
					$arrData = $arrData + $arrWooData;
			}
			
			$featuredImageID = UniteFunctionsWPUC::getFeaturedImageID($postID);
			
			if(!empty($featuredImageID))
				$arrData = $this->getProcessedParamsValue_image($arrData, $featuredImageID, array("name"=>"image"));
			
			if(is_array($arrPostAdditions) == false)
				$arrPostAdditions = array();
				
			//add custom fields
			foreach($arrPostAdditions as $addition){
				
				switch($addition){
					case GlobalsProviderUC::POST_ADDITION_CUSTOMFIELDS:
						
						$arrCustomFields = UniteFunctionsWPUC::getPostCustomFields($postID);
						
						$arrData = array_merge($arrData, $arrCustomFields);
					break;
					case GlobalsProviderUC::POST_ADDITION_CATEGORY:
						
						$arrCategory = $this->getPostCategoryFields($postID, $post);
							
						//HelperUC::addDebug("Get Category For Post: $postID ", $arrCategory);
						
						$arrData = array_merge($arrData, $arrCategory);
						
					break;
				}
				
			}

			
		}catch(Exception $e){
			
			$message = $e->getMessage();
			HelperUC::addDebug("Get Post Exception: ($postID) ".$message);
			
			return(null);
		}
			
		return($arrData);
	}
	
	/**
	 * run custom query
	 */
	private function getPostListData_getCustomQueryFilters($args, $value, $name, $data){
		
		if(GlobalsUC::$isProVersion == false)
			return($args);
		
		$queryID = UniteFunctionsUC::getVal($value, "{$name}_queryid");
		$queryID = trim($queryID);
		
		if(empty($queryID))
			return($args);
		
		HelperUC::addDebug("applying custom args filter: $queryID");
		
		//pass the widget data
		$widgetData = $data;
		unset($widgetData[$name]);
		
		$args = apply_filters($queryID, $args, $widgetData);
		
		HelperUC::addDebug("args after custom query", $args);
		
		return($args);
	}
	
	/**
	 * get single page query pagination
	 */
	private function getSinglePageQueryCurrentPage(){
		
		if(is_archive() == true || is_front_page() == true)
			return(false);
		
		$page = get_query_var("page", null);
		
		return($page);
	}
	
	
	/**
	 * get pagination args from the query
	 */
	private function getPostListData_getPostGetFilters_pagination($args, $value, $name, $data){
		
		//check the single page pagination
		$paginationType = UniteFunctionsUC::getVal($value, $name."_pagination_type");
		
		if(empty($paginationType))
			return($args);
		
		if(is_archive() == true || is_home() == true)
			return($args);
		
		$page = get_query_var("page", null);
		
		if(empty($page)){
			$page = get_query_var("paged", null);
		}
		
		if(empty($page))
			return($args);
		
		$postsPerPage = UniteFunctionsUC::getVal($args, "posts_per_page");
		if(empty($postsPerPage))
			return($args);
		
		$offset = ($page-1)*$postsPerPage;
		
		$args["offset"] = $offset;
		
		//save the last page for the pagination output
		GlobalsProviderUC::$lastPostQuery_page = $page;
		
		return($args);
	}
	
	
	/**
	 * update filters from post and get
	 */
	private function getPostListData_getPostGetFilters($args, $value, $name, $data){

		$args = $this->getPostListData_getPostGetFilters_pagination($args, $value, $name, $data);
		
		$order = UniteFunctionsUC::getPostGetVariable("uc_order", "", UniteFunctionsUC::SANITIZE_KEY);
		
		$isChanged = false;
		if(!empty($order)){
			$isChanged = true;
			$args = UniteFunctionsWPUC::updatePostArgsOrderBy($args, $order);
		}
		
		if($isChanged == true){
			
			HelperUC::addDebug("args after post get update", $args);
		}
		
		return($args);
	}
	
	/**
	 * add order by
	 */
	private function getPostListData_addOrderBy($filters, $value, $name, $isArgs = false){
		
		$keyOrderBy = "orderby";
		$keyOrderDir = "orderdir";
		$keyMeta = "meta_key";
		
		if($isArgs == true){
			$keyOrderDir = "order";
		}
		
		$orderBy = UniteFunctionsUC::getVal($value, "{$name}_orderby");
		if($orderBy == "default")
			$orderBy = null;
				
		if(!empty($orderBy))
			$filters[$keyOrderBy] = $orderBy;
		
		$orderDir = UniteFunctionsUC::getVal($value, "{$name}_orderdir1");
		if($orderDir == "default")
			$orderDir = "";
		
		if(!empty($orderDir))
			$filters[$keyOrderDir] = $orderDir;
		
		if($orderBy == UniteFunctionsWPUC::SORTBY_META_VALUE || $orderBy == UniteFunctionsWPUC::SORTBY_META_VALUE_NUM){
			$filters["meta_key"] = UniteFunctionsUC::getVal($value, "{$name}_orderby_meta_key1");
		}
		
		
		return($filters);
	}
	
	/**
	 * get date query
	 */
	private function getPostListData_dateQuery($value, $name){
		
		$dateString = UniteFunctionsUC::getVal($value, "{$name}_includeby_date");
		
		if($dateString == "all")
			return(array());
		
		$arrDateQuery = array();
			
		$after = "";
		$before = "";
		
		switch($dateString){
			case "today":
				$after = "-1 day";
			break;
			case "yesterday":
				$after = "-2 day";
			break;
			case "week":
				$after = '-1 week';
			break;
			case "month":
				$after = "-1 month";
			break;
			case "three_months":
				$after = "-3 months";
			break;
			case "year":
				$after = "-1 year";
			break;
			case "custom":
				
				$before = UniteFunctionsUC::getVal($value, "{$name}_include_date_before");

				$after = UniteFunctionsUC::getVal($value, "{$name}_include_date_after");
				
				if(!empty($before) || !empty($after))
					$arrDateQuery['inclusive'] = true;
				
			break;
		}
		
		if(!empty($before))
			$arrDateQuery["before"] = $before;
		
		if(!empty($after))
			$arrDateQuery["after"] = $after;
		
		return($arrDateQuery);
	}
	
	
	/**
	 * get post list data custom from filters
	 */
	private function getPostListData_custom($value, $name, $processType, $param, $data){
		
		if(empty($value))
			return(array());
		
		if(is_array($value) == false)
			return(array());
		
		//dmp($value);exit();
		
		$filters = array();	
		
		$showDebugQuery = UniteFunctionsUC::getVal($value, "{$name}_show_query_debug");
		$showDebugQuery = UniteFunctionsUC::strToBool($showDebugQuery);
		
		$source = UniteFunctionsUC::getVal($value, "{$name}_source");
		
		$isForWoo = UniteFunctionsUC::getVal($param, "for_woocommerce_products");
		$isForWoo = UniteFunctionsUC::strToBool($isForWoo);
		
		$isRelatedPosts = $source == "related";
		if(is_single() == false)
			$isRelatedPosts = false;
		
		$arrMetaQuery = array();
		
		$getRelatedProducts = false;

		//get post type
		$postType = UniteFunctionsUC::getVal($value, "{$name}_posttype", "post");
		if($isForWoo)
			$postType = "product";
		
		$filters["posttype"] = $postType;
		
		$post = null;
		
		if($isRelatedPosts == true){
			
			$post = get_post();
			$postType = $post->post_type;
			
			$filters["posttype"] = $postType;		//rewrite the post type argument
			
			if($postType == "product"){
				
				$getRelatedProducts = true;
				$productID = $post->ID;
				
			}else{
				
				if($showDebugQuery == true){
					dmp("Related Posts Query");
				}
				
				//prepare terms string
				$arrTerms = UniteFunctionsWPUC::getPostTerms($post);
				
				$strTerms = "";
							
				foreach($arrTerms as $tax => $terms){
					
					if($tax == "product_type")
						continue;
					
					foreach($terms as $term){
						$termID = UniteFunctionsUC::getVal($term, "term_id");
						$strTerm = "{$tax}--{$termID}";
						
						if(!empty($strTerms))
							$strTerms .= ",";
						
						$strTerms .= $strTerm;
					}
				}
				
				//add terms
				if(!empty($strTerms)){
					$filters["category"] = $strTerms;
					$filters["category_relation"] = "OR";				
				}
				
				$filters["exclude_current_post"] = true;
			}
			
		}else{
						
			$category = UniteFunctionsUC::getVal($value, "{$name}_category");
			
			if(!empty($category))
				$filters["category"] = UniteFunctionsUC::getVal($value, "{$name}_category");
			
			$relation = UniteFunctionsUC::getVal($value, "{$name}_category_relation");
			
			if(!empty($relation) && !empty($category))
				$filters["category_relation"] = $relation;
			
			$termsIncludeChildren = UniteFunctionsUC::getVal($value, "{$name}_terms_include_children");
			$termsIncludeChildren = UniteFunctionsUC::strToBool($termsIncludeChildren);
			
			if($termsIncludeChildren === true)
				$filters["category_include_children"] = true;
				
		}
		
		$limit = UniteFunctionsUC::getVal($value, "{$name}_maxitems");
		
		$limit = (int)$limit;
		if($limit <= 0)
			$limit = 100;
		
		if($limit > 1000)
			$limit = 1000;

			
		//------ Exclude ---------
		
		$arrExcludeBy = UniteFunctionsUC::getVal($value, "{$name}_excludeby", array());
		if(is_string($arrExcludeBy))
			$arrExcludeBy = array($arrExcludeBy);
		
		if(is_array($arrExcludeBy) == false)
			$arrExcludeBy = array();

		$excludeProductsOnSale = false;
		$excludeSpecificPosts = false;
		$excludeByAuthors = false;
		$arrExcludeTerms = array();
		$offset = null;
		
		foreach($arrExcludeBy as $excludeBy){
			
			switch($excludeBy){
				case "current_post":
					$filters["exclude_current_post"] = true;					
				break;
				case "out_of_stock":
					$arrMetaQuery[] = array(
			            'key' => '_stock_status',
			            'value' => 'instock'
					);
					$arrMetaQuery[] = array(
				            'key' => '_backorders',
				            'value' => 'no'
				    );
				break;
				case "terms":
					
					$arrTerms = UniteFunctionsUC::getVal($value, "{$name}_exclude_terms");

					$arrExcludeTerms = UniteFunctionsUC::mergeArraysUnique($arrExcludeTerms, $arrTerms);
															
					$termsExcludeChildren = UniteFunctionsUC::getVal($value, "{$name}_terms_exclude_children");
					$termsExcludeChildren = UniteFunctionsUC::strToBool($termsExcludeChildren);
					
					$filters["category_exclude_children"] = $termsExcludeChildren;
					
				break;
				case "products_on_sale":
					
					$excludeProductsOnSale = true;
				break;
				case "specific_posts":
					
					$excludeSpecificPosts = true;
				break;
				case "author":
					
					$excludeByAuthors = true;
				break;
				case "no_image":
					
					$arrMetaQuery[] = array(
						"key"=>"_thumbnail_id",
						"compare"=>"EXISTS"
					);
					
				break;
				case "current_category":
					
					if(empty($post))
						$post = get_post();
										
					$arrCatIDs = UniteFunctionsWPUC::getPostCategoriesIDs($post);
					
					$arrExcludeTerms = UniteFunctionsUC::mergeArraysUnique($arrExcludeTerms, $arrCatIDs);
				break;
				case "current_tag":
					
					if(empty($post))
						$post = get_post();
					
					$arrTagsIDs = UniteFunctionsWPUC::getPostTagsIDs($post);
					
					$arrExcludeTerms = UniteFunctionsUC::mergeArraysUnique($arrExcludeTerms, $arrTagsIDs);
				break;
				case "offset":
					
					$offset = UniteFunctionsUC::getVal($value, $name."_offset");
					$offset = (int)$offset;
					
				break;
			}
			
		}
		
		if(!empty($arrExcludeTerms))
			$filters["exclude_category"] = $arrExcludeTerms;
		
		$filters["limit"] = $limit;
		
		$filters = $this->getPostListData_addOrderBy($filters, $value, $name);
		
		//add debug for further use
		HelperUC::addDebug("Post Filters", $filters);
		
		//run custom query if available
		$args = UniteFunctionsWPUC::getPostsArgs($filters);
		
		//exclude by authors
		
		if($excludeByAuthors == true){
			$arrExcludeByAuthors = UniteFunctionsUC::getVal($value, "{$name}_excludeby_authors");
								
			if(!empty($arrExcludeByAuthors))
				$args["author__not_in"] = $arrExcludeByAuthors;
		}
		
		//exclude by specific posts
		
		$arrPostsNotIn = array();
		
		if($excludeProductsOnSale == true){
			
			$arrPostsNotIn = wc_get_product_ids_on_sale();
		}
		
		if($excludeSpecificPosts == true){
			
			$specificPostsToExclude = UniteFunctionsUC::getVal($value, "{$name}_exclude_specific_posts");
			
			if(!empty($specificPostsToExclude)){
				
				if(empty($arrPostsNotIn))
					$arrPostsNotIn = $specificPostsToExclude;
				else
					$arrPostsNotIn = array_merge($arrPostsNotIn, $specificPostsToExclude);
					$arrPostsNotIn = array_unique($arrPostsNotIn);
			}
			
		}
		
		//add the include by
		$arrIncludeBy = UniteFunctionsUC::getVal($value, "{$name}_includeby");
		if(empty($arrIncludeBy))
			$arrIncludeBy = array();
		
		$args["ignore_sticky_posts"] = true;
		
		$getOnlySticky = false;
		
		$product = null;
		
		$arrProductsUpSells = array();
		$arrProductsCrossSells = array();
		$arrIDsOnSale = array();
		
		foreach($arrIncludeBy as $includeby){
						
			switch($includeby){
				case "sticky_posts":
					$args["ignore_sticky_posts"] = false;
				break;
				case "sticky_posts_only":
					$getOnlySticky = true;
				break;
				case "products_on_sale":
					
					$arrIDsOnSale = wc_get_product_ids_on_sale();
					
					if(empty($arrIDsOnSale))
						$arrIDsOnSale = array("0");
					
				break;
				case "up_sells":		//product up sells
					
					if(empty($product))
						$product = wc_get_product();
					
					if(!empty($product)){
						$arrProductsUpSells = $product->get_upsell_ids();
						if(empty($arrProductsUpSells))
							$arrProductsUpSells = array("0");
					}
										
				break;
				case "cross_sells":

					if(empty($product))
						$product = wc_get_product();
				 	
					if(!empty($product)){
						$arrProductsCrossSells = $product->get_cross_sell_ids();
						if(empty($arrProductsUpSells))
							$arrProductsCrossSells = array("0");
					}
					
				break;
				case "out_of_stock":
					
					$arrMetaQuery[] = array(
			            'key' => '_stock_status',
			            'value' => 'instock',
						'compare'=>'!='
					);
					
				break;
				case "author":
					
					$arrIncludeByAuthors = UniteFunctionsUC::getVal($value, "{$name}_includeby_authors");
					
					if(!empty($arrIncludeByAuthors))
						$args["author__in"] = $arrIncludeByAuthors;
					
				break;
				case "date":
					
					$arrDateQuery = $this->getPostListData_dateQuery($value, $name);
					
					if(!empty($arrDateQuery))
						$args["date_query"] = $arrDateQuery;
				break;
				case "parent":
					
					$parent =  UniteFunctionsUC::getVal($value, "{$name}_includeby_parent");
					if(!empty($parent)){
						
						if(is_array($parent) && count($parent) == 1)
							$parent = $parent[0];
							
						if(is_array($parent))
							$args["post_parent__in"] = $parent;
						else
							$args["post_parent"] = $parent;
					}
				break;
			}
			
		}

		//include id's
		$arrPostInIDs = UniteFunctionsUC::mergeArraysUnique($arrProductsCrossSells, $arrProductsUpSells);
		
		if(!empty($arrIDsOnSale)){
			
			if(!empty($arrPostInIDs))		//intersect with previous id's
				$arrPostInIDs = array_intersect($arrPostInIDs, $arrIDsOnSale);
			else
				$arrPostInIDs = $arrIDsOnSale;
			
		}
		
		if(!empty($arrPostInIDs))
			$args["post__in"] = $arrPostInIDs;
		
		//------ get woo  related products ------ 
		
		if($getRelatedProducts == true){
			
			if($showDebugQuery == true){
				
				$debugText = "Debug: Getting up to $limit related products";
				
				if(!empty($arrPostsNotIn)){
					$strPostsNotIn = implode(",", $arrPostsNotIn);
					$debugText = " excluding $strPostsNotIn";
				}
				
				dmp($debugText);
			}
			
			$arrRelatedProductIDs = wc_get_related_products($productID, $limit, $arrPostsNotIn);
			if(empty($arrRelatedProductIDs))
				$arrRelatedProductIDs = array("0");
			$args["post__in"] = $arrRelatedProductIDs;
		}
		
		if(!empty($arrMetaQuery))
			$args["meta_query"] = $arrMetaQuery;

		//add exclude specific posts if available
		if(!empty($arrPostsNotIn))
			$args["post__not_in"] = $arrPostsNotIn;
		
		$isWpmlExists = UniteCreatorWpmlIntegrate::isWpmlExists();
		if($isWpmlExists)
			$args["suppress_filters"] = false;
		
		//add post status
		$arrStatuses = UniteFunctionsUC::getVal($value, "{$name}_post_status");
		
		if(empty($arrStatuses))
			$arrStatuses = "publish";
		
		if(!empty($offset))
			$args["offset"] = $offset;
		
		if(is_array($arrStatuses) && count($arrStatuses) == 1)
			$arrStatuses = $arrStatuses[0];
			
		$args["post_status"] = $arrStatuses;
				
		
		//add sticky posts only
		$arrStickyPosts = array();
		
		if($getOnlySticky == true){
			
			$arrStickyPosts = get_option("sticky_posts");
				
			$args["ignore_sticky_posts"] = true;
			
			if(!empty($arrStickyPosts) && is_array($arrStickyPosts)){
				$args["post__in"] = $arrStickyPosts;
			}else{
				$args["post__in"] = array("0");		//no posts at all
			}
		}
		
		$args = $this->getPostListData_getPostGetFilters($args, $value, $name, $data);
		
		$args = $this->getPostListData_getCustomQueryFilters($args, $value, $name, $data);
		
		HelperUC::addDebug("Posts Query", $args);
		
		//-------- show debug query --------------
				
		if($showDebugQuery == true){
			dmp("The Query Is:");
			dmp($args);
		}
		
		//$arrPosts = get_posts($args);
		
		$query = new WP_Query($args);
		
		/*
		dmp($query->query);
		dmp($query->post_count);
		dmp($query->found_posts);
		*/
		
		$arrPosts = $query->posts;
		
		if(!$arrPosts)
			$arrPosts = array();
		
		//sort sticky posts
		if($getOnlySticky == true && !empty($arrStickyPosts)){
			
			$orderby = UniteFunctionsUC::getVal($args, "orderby");
			if(empty($orderby))
				$arrPosts = UniteFunctionsWPUC::orderPostsByIDs($arrPosts, $arrStickyPosts);
		}
		
		//save last query
		GlobalsProviderUC::$lastPostQuery = $query;
		
		HelperUC::addDebug("posts found: ".count($arrPosts));
				
		if($showDebugQuery == true){
			dmp("Found Posts: ".count($arrPosts));
		}
				
		
		return($arrPosts);
	}
	
	
	/**
	 * clean query args for debug
	 */
	private function cleanQueryArgsForDebug($args){
		
		$argsNew = array();
		
		foreach($args as $name=>$value){
			
			//keep
			switch($name){
				case "ignore_sticky_posts":
				case "suppress_filters":
					
					$argsNew[$name] = $value;
					continue(2);
				break;
			}
			
			if(empty($value))
				continue;
				
			$argsNew[$name] = $value;
		}

		
		return($argsNew);
	}
	
	
	/**
	 * get current posts
	 */
	private function getPostListData_currentPosts($value, $name, $data){
		
		//add debug for further use
		HelperUC::addDebug("Getting Current Posts");
		
		
		$maxPosts = UniteFunctionsUC::getVal($value, $name."_maxitems_current");
		$maxPosts = (int)$maxPosts;
		
		$orderBy = UniteFunctionsUC::getVal($value, $name."_orderby");
		$orderDir = UniteFunctionsUC::getVal($value, $name."_orderdir1");
		$orderByMetaKey = UniteFunctionsUC::getVal($value, $name."_orderby_meta_key1");
		
		if($orderBy == "default")
			$orderBy = null;
			
		if($orderDir == "default")
			$orderDir = null;
				
		global $wp_query;
		$currentQueryVars = $wp_query->query_vars;
		
		// ----- current query settings --------
		
		//--- set posts per page --- 
		
		if(!empty($maxPosts))
			$currentQueryVars["posts_per_page"] = $maxPosts;
		
		//--- set order --- 
		if(!empty($orderBy))
			$currentQueryVars["orderby"] = $orderBy;
		
		if($orderBy == "meta_value" || $orderBy == "meta_value_num")
			$currentQueryVars["meta_key"] = $orderByMetaKey;
		
		if(!empty($orderDir))
			$currentQueryVars["order"] = $orderDir;
		
		$currentQueryVars = apply_filters( 'elementor/theme/posts_archive/query_posts/query_vars', $currentQueryVars);
				
		$currentQueryVars = $this->getPostListData_getCustomQueryFilters($currentQueryVars, $value, $name, $data);
				
		$showDebugQuery = UniteFunctionsUC::getVal($value, "{$name}_show_query_debug");
		$showDebugQuery = UniteFunctionsUC::strToBool($showDebugQuery);
		
		if($showDebugQuery == true){
			dmp("Current Posts. The Query Is:");
			$argsForDebug = $this->cleanQueryArgsForDebug($currentQueryVars);
			dmp($argsForDebug);
		}
		
		$query = $wp_query;
		if($currentQueryVars !== $wp_query->query_vars){
			
			HelperUC::addDebug("New Query", $currentQueryVars);
						
			$query = new WP_Query( $currentQueryVars );
		}
		
		HelperUC::addDebug("Query Vars", $currentQueryVars);
		
		$arrPosts = $query->posts;
				
		if(empty($arrPosts))
			$arrPosts = array();
			
		if($showDebugQuery == true){
			dmp("Found Posts: ".count($arrPosts));
		}
			
		HelperUC::addDebug("Posts Found: ". count($arrPosts));
			
		return($arrPosts);
	}
	
	
	/**
	 * get manual selection
	 */
	private function getPostListData_manualSelection($value, $name, $data){
		
		$args = array();
		
		$postIDs = UniteFunctionsUC::getVal($value, $name."_manual_select_post_ids");
		
		$showDebugQuery = UniteFunctionsUC::getVal($value, "{$name}_show_query_debug");
		$showDebugQuery = UniteFunctionsUC::strToBool($showDebugQuery);
		
		if(empty($postIDs)){
			
			if($showDebugQuery == true){
				
				dmp("Query Debug, Manual Selection: No Posts Selected");
				HelperUC::addDebug("No Posts Selected");
			}
			
			return(array());
		}
		
		$args["post__in"] = $postIDs;
		$args["ignore_sticky_posts"] = true;
		$args["post_type"] = "any";
		$args["post_status"] = "publish, private";
		
		$args = $this->getPostListData_addOrderBy($args, $value, $name, true);
		
		if($showDebugQuery == true){
			dmp("Manual Selection. The Query Is:");
			dmp($args);
		}
				
		$query = new WP_Query($args);
		$arrPosts = $query->posts;
		
		if(empty($arrPosts))
			$arrPosts = array();
		
		//keep original order if no orderby
		$orderby = UniteFunctionsUC::getVal($args, "orderby");
		if(empty($orderby))
			$arrPosts = UniteFunctionsWPUC::orderPostsByIDs($arrPosts, $postIDs);
		
		//save last query
		GlobalsProviderUC::$lastPostQuery = $query;
		
		HelperUC::addDebug("posts found: ".count($arrPosts));
		
		if($showDebugQuery == true){
			dmp("Found Posts: ".count($arrPosts));
		}
				
		return($arrPosts);
		
	}
	
	
	/**
	 * get post list data
	 */
	private function getPostListData($value, $name, $processType, $param, $data){
		
		if($processType != self::PROCESS_TYPE_OUTPUT && $processType != self::PROCESS_TYPE_OUTPUT_BACK)
			return(null);
		
		HelperUC::addDebug("getPostList values", $value);
		HelperUC::addDebug("getPostList param", $param);
		
		$source = UniteFunctionsUC::getVal($value, "{$name}_source");
		
		$arrPosts = array();
				
		switch($source){
			case "manual":
				
				$arrPosts = $this->getPostListData_manualSelection($value, $name, $data);
				
			break;
			case "current":
				
				$arrPosts = $this->getPostListData_currentPosts($value, $name, $data);
				
			break;
			default:		//custom
				
				$arrPosts = $this->getPostListData_custom($value, $name, $processType, $param, $data);
				
				$filters = array();
				$arrPostsFromFilter = UniteProviderFunctionsUC::applyFilters("uc_filter_posts_list", $arrPosts, $value, $filters);
				
				if(!empty($arrPostsFromFilter))
					$arrPosts = $arrPostsFromFilter;
				
			break;
		}
		
		
		if(empty($arrPosts))
			$arrPosts = array();
			
		$useCustomFields = UniteFunctionsUC::getVal($param, "use_custom_fields");
		$useCustomFields = UniteFunctionsUC::strToBool($useCustomFields);
		
		$useCategory = UniteFunctionsUC::getVal($param, "use_category");
		$useCategory = UniteFunctionsUC::strToBool($useCategory);
		
		$arrPostAdditions = HelperProviderUC::getPostDataAdditions($useCustomFields, $useCategory);
				
		HelperUC::addDebug("post additions", $arrPostAdditions);
		
		$arrData = array();
		foreach($arrPosts as $post){
			
			$arrData[] = $this->getPostDataByObj($post, $arrPostAdditions);
		}

		
		return($arrData);
	}
	
	protected function z_______________TERMS____________(){}
	
	
	/**
	 * get woo categories data
	 */
	protected function getWooCatsData($value, $name, $processType, $param){

		
		$selectionType = UniteFunctionsUC::getVal($value, $name."_type");
		
		//add params
		$params = array();
		$taxonomy = "product_cat";
		
		if($selectionType == "manual"){
		
			$includeSlugs = UniteFunctionsUC::getVal($value, $name."_include");
			
			$arrTerms = UniteFunctionsWPUC::getSpecificTerms($includeSlugs, $taxonomy);
			
		}else{
		
				$orderBy =  UniteFunctionsUC::getVal($value, $name."_orderby");
				$orderDir =  UniteFunctionsUC::getVal($value, $name."_orderdir");
				
				$hideEmpty = UniteFunctionsUC::getVal($value, $name."_hideempty");
				
				$strExclude = UniteFunctionsUC::getVal($value, $name."_exclude");
				$strExclude = trim($strExclude);
				
				$excludeUncategorized = UniteFunctionsUC::getVal($value, $name."_excludeuncat");
				
				$parent = UniteFunctionsUC::getVal($value, $name."_parent");
				$parent = trim($parent);
				
				$includeChildren = UniteFunctionsUC::getVal($value, $name."_children");
				
				$parentID = 0;
				if(!empty($parent)){
					
					$term = UniteFunctionsWPUC::getTermBySlug("product_cat", $parent);
					
					if(!empty($term))
						$parentID = $term->term_id;
				}
				
				$isHide = false;
				if($hideEmpty == "hide")
					$isHide = true;
								
				//add exclude
				$arrExcludeSlugs = null;
				
				if(!empty($strExclude))
					$arrExcludeSlugs = explode(",", $strExclude);
				
				//exclude uncategorized
				if($excludeUncategorized == "exclude"){
					if(empty($arrExcludeSlugs))
						$arrExcludeSlugs = array();
					
					$arrExcludeSlugs[] = "uncategorized";
				}			
				
		
				if($includeChildren == "not_include"){
					$params["parent"] = $parentID;
					
				}else{
					$params["child_of"] = $parentID;
				}
				
				
				$isWpmlExists = UniteCreatorWpmlIntegrate::isWpmlExists();
				if($isWpmlExists)
					$params["suppress_filters"] = false;
				
				$arrTerms = UniteFunctionsWPUC::getTerms($taxonomy, $orderBy, $orderDir, $isHide, $arrExcludeSlugs, $params);
					
		}//not manual
		
		$arrTerms = $this->modifyArrTermsForOutput($arrTerms, $taxonomy);
				
		return($arrTerms);
	}
	
	
	/**
	 * get terms data
	 */
	protected function getWPTermsData($value, $name, $processType, $param){
		
		$postType = UniteFunctionsUC::getVal($value, $name."_posttype");
		$taxonomy =  UniteFunctionsUC::getVal($value, $name."_taxonomy");
		
		$orderBy =  UniteFunctionsUC::getVal($value, $name."_orderby");
		$orderDir =  UniteFunctionsUC::getVal($value, $name."_orderdir");
		
		$hideEmpty = UniteFunctionsUC::getVal($value, $name."_hideempty");
		
		$strExclude = UniteFunctionsUC::getVal($value, $name."_exclude");
		$strExclude = trim($strExclude);

		$useCustomFields = UniteFunctionsUC::getVal($param, "use_custom_fields");
		$useCustomFields = UniteFunctionsUC::strToBool($useCustomFields);
		
		
		$isHide = false;
		if($hideEmpty == "hide")
			$isHide = true;
		
		if(empty($postType)){
			$postType = "post";
			$taxonomy = "category";
		}
		
		//add exclude
		$arrExcludeSlugs = null;
		
		if(!empty($strExclude))
			$arrExcludeSlugs = explode(",", $strExclude);
		
		//add params
		$params = array();
		
		$isWpmlExists = UniteCreatorWpmlIntegrate::isWpmlExists();
		if($isWpmlExists)
			$params["suppress_filters"] = false;
		
		$arrTerms = UniteFunctionsWPUC::getTerms($taxonomy, $orderBy, $orderDir, $isHide, $arrExcludeSlugs, $params);
		
		$arrTerms = $this->modifyArrTermsForOutput($arrTerms, $taxonomy, $useCustomFields);
		
		return($arrTerms);
	}
	
	protected function z_______________USERS____________(){}
	
	
	/**
	 * modify users array for output
	 */
	public function modifyArrUsersForOutput($arrUsers, $getMeta, $getAvatar, $arrMetaKeys = null){
		
		if(empty($arrUsers))
			return(array());
		
		$arrUsersData = array();
		
		foreach($arrUsers as $objUser){
			
			$arrUser = UniteFunctionsWPUC::getUserData($objUser, $getMeta, $getAvatar, $arrMetaKeys);
			
			$arrUsersData[] = $arrUser;
		}
		
		return($arrUsersData);
	}
	
	
	/**
	 * get users data
	 */
	protected function getWPUsersData($value, $name, $processType, $param){
		
		$showDebug = UniteFunctionsUC::getVal($value, $name."_show_query_debug");
		$showDebug = UniteFunctionsUC::strToBool($showDebug);

		$selectType = UniteFunctionsUC::getVal($value, $name."_type");
			
		$args = array();
		
		if($selectType == "manual"){		//manual select
		
			$arrIncludeUsers = UniteFunctionsUC::getVal($value, $name."_include_authors");
			if(empty($arrIncludeUsers))
				$arrIncludeUsers = array("0");
			
			$args["include"] = $arrIncludeUsers;
			
		}else{

			//create the args
			$strRoles = UniteFunctionsUC::getVal($value, $name."_role");
			
			if(is_array($strRoles))
				$arrRoles = $strRoles;
			else
				$arrRoles = explode(",", $strRoles);
			
			$arrRoles = UniteFunctionsUC::arrayToAssoc($arrRoles);
			unset($arrRoles["__all__"]);
						
			if(!empty($arrRoles)){
				$arrRoles = array_values($arrRoles);
				
				$args["role__in"] = $arrRoles;
			}
			
			//add exclude roles:
			$arrRolesExclude = UniteFunctionsUC::getVal($value, $name."_role_exclude");
			
			if(!empty($strRolesExclude) && is_string($strRolesExclude))
				$arrRolesExclude = explode(",", $arrRolesExclude);
			
			if(!empty($arrRolesExclude))
				$args["role__not_in"] = $arrRolesExclude;
			
			//--- number of users
			
			$numUsers = UniteFunctionsUC::getVal($value, $name."_maxusers");
			$numUsers = (int)$numUsers;
			
			if(!empty($numUsers))
				$args["number"] = $numUsers;
			
			//--- exclude by users
			
			$arrExcludeAuthors = UniteFunctionsUC::getVal($value, $name."_exclude_authors");
			
			if(!empty($arrExcludeAuthors))
				$args["exclude"] = $arrExcludeAuthors;
			
			
		}
		
		
		//--- orderby --- 
		
		$orderby = UniteFunctionsUC::getVal($value, $name."_orderby");
		if($orderby == "default")
			$orderby = null;
		
		if(!empty($orderby))
			$args["orderby"] = $orderby;
		
		//--- order dir ----
			
		$orderdir = UniteFunctionsUC::getVal($value, $name."_orderdir");
		if($orderdir == "default")
			$orderdir = null;
		
		if(!empty($orderdir))
			$args["order"] = $orderdir;
		
		//---- debug
			
		if($showDebug == true){
			dmp("The users query is:");
			dmp($args);
		}
		
		HelperUC::addDebug("Get Users Args", $args);
		
		$arrUsers = get_users($args);
		
		HelperUC::addDebug("Num Users fetched: ".count($arrUsers));
		
		
		
		if($showDebug == true){
			dmp("Num Users fetched: ".count($arrUsers));
		}
		
		$getMeta = UniteFunctionsUC::getVal($param, "get_meta");
		$getMeta = UniteFunctionsUC::strToBool($getMeta);
		
		$getAvatar = UniteFunctionsUC::getVal($param, "get_avatar");
		$getAvatar = UniteFunctionsUC::strToBool($getAvatar);

		//add meta fields
		
		$strAddMetaKeys = UniteFunctionsUC::getVal($value, $name."_add_meta_keys");
		
		$arrMetaKeys = null;
		if(!empty($strAddMetaKeys))
			$arrMetaKeys = explode(",", $strAddMetaKeys);
		
		$arrUsers = $this->modifyArrUsersForOutput($arrUsers, $getMeta, $getAvatar, $arrMetaKeys);
		
		return($arrUsers);
	}
	
	protected function z_______________MENU____________(){}
	
	
	/**
	 * get menu output
	 */
	protected function getWPMenuData($value, $name, $param, $processType){
				
		$menuID = UniteFunctionsUC::getVal($value, $name."_id");
				
		//get first menu
		if(empty($menuID)){
			$htmlMenu = __("menu not selected","unlimited-elements-for-elementor");
			return($htmlMenu);
		}
		
		$depth = UniteFunctionsUC::getVal($value, $name."_depth");
		
		$depth = (int)$depth;
		
		//make the arguments
		$args = array();
		$args["echo"] = false;
		$args["container"] = "";
		
		if(!empty($depth) && is_numeric($depth))
			$args["depth"] = $depth;
		
		
		$args["menu"] = $menuID;
		
		$arrKeysToAdd = array(
			"menu_class",
			"before",
			"after"
		);
		
		foreach($arrKeysToAdd as $key){
			
			$value = UniteFunctionsUC::getVal($param, $key);
			if(!empty($value))
				$args[$key] = $value;
		}
				
		HelperUC::addDebug("menu arguments", $args);
		
		$htmlMenu = wp_nav_menu($args);
		
		return($htmlMenu);
	}
	
	/**
	 * get template data
	 */
	private function getElementorTemplateData($value, $name, $processType, $param){
				
		$templateID = UniteFunctionsUC::getVal($value, $name."_templateid");
		
		if(empty($templateID))
			return("");
		
		$shortcode = "[elementor-template id=\"$templateID\"]";
		
		return($shortcode);
	}
	
	protected function z_______________GET_PARAMS____________(){}
	
	
	
	/**
	 * get processe param data, function with override
	 */
	protected function getProcessedParamData($data, $value, $param, $processType){
		
		$type = UniteFunctionsUC::getVal($param, "type");
		$name = UniteFunctionsUC::getVal($param, "name");
				
		//special params
		switch($type){
			case UniteCreatorDialogParam::PARAM_POSTS_LIST:
			    $data[$name] = $this->getPostListData($value, $name, $processType, $param, $data);
			break;
			case UniteCreatorDialogParam::PARAM_POST_TERMS:
				$data[$name] = $this->getWPTermsData($value, $name, $processType, $param);
			break;
			case UniteCreatorDialogParam::PARAM_WOO_CATS:
				$data[$name] = $this->getWooCatsData($value, $name, $processType, $param);
			break;
			case UniteCreatorDialogParam::PARAM_USERS:
				$data[$name] = $this->getWPUsersData($value, $name, $processType, $param);
			break;
			case UniteCreatorDialogParam::PARAM_TEMPLATE:
				$data[$name] = $this->getElementorTemplateData($value, $name, $processType, $param);
			break;
			default:
				$data = parent::getProcessedParamData($data, $value, $param, $processType);
			break;
		}
		
			
		return($data);
	}
	
	
	/**
	 * get param value, function for override, by type
	 * to get multiple values from one, as array
	 */
	public function getSpecialParamValue($paramType, $paramName, $value, $arrValues){
		
	    switch($paramType){
	        case UniteCreatorDialogParam::PARAM_POSTS_LIST:
	        case UniteCreatorDialogParam::PARAM_POST_TERMS:
	        case UniteCreatorDialogParam::PARAM_WOO_CATS:
	        case UniteCreatorDialogParam::PARAM_USERS:
	        case UniteCreatorDialogParam::PARAM_CONTENT:
	        case UniteCreatorDialogParam::PARAM_BACKGROUND:
	        case UniteCreatorDialogParam::PARAM_MENU:
	        case UniteCreatorDialogParam::PARAM_INSTAGRAM:
	        case UniteCreatorDialogParam::PARAM_TEMPLATE:
	            
	            $paramArrValues = array();
	            $paramArrValues[$paramName] = $value;
	            
	            foreach($arrValues as $key=>$value){
	                if(strpos($key, $paramName."_") === 0)
	                    $paramArrValues[$key] = $value;
	            }
	            
	            $value = $paramArrValues;
	            	            
	        break;
	    }
	   	
	    return($value);
	}
	
	
	
}