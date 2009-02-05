<?php 
http://debuggable.com/posts/macgyver-menu-for-cakephp-whats-the-active-menu-item:480f4dd6-c044-436e-bbde-4ed8cbdd56cb
http://cakeforge.org/snippet/detail.php?type=snippet&id=194
class MenuHelper extends Helper {

    var $helpers = array('Html');
	var $__out;
	
	var $__typeTags = array('dl'=>'dd', 'ul'=>'li', 'ol'=>'li');
	
	/**
	 *
	 * @param array 	$data data for menu as Name=>value pairs
	 * @param string 	$tag html tag to enclose link in
	 * @param string 	$activeClass Css class to use for highlight
	 * @access public
	 * usage: <?php $menus->menu(array('Home'=>'/home', 'Profile'=>'/profile'), 'li', 'current'); ?>
	 */

	function menu($data=array(), $tag='li', $activeClass='current', $mainMenuActive=null)
	{
		// reset output
		$this->__out = array();
		// check data
		if (empty($data) && count($data) < 1)
		{
			return '';
		}
		
		// sort out matching links
		$matchingLinks = array();
		
		foreach ($data as $link) 
		{
			//
			if ($mainMenuActive)
			{
				if (preg_match('/^'.preg_quote($link, '/').'/', $mainMenuActive))
				{
					$matchingLinks[strlen($link)] = $link;
				}
			}
			else
			{
				if (preg_match('/^'.preg_quote($link, '/').'/', substr($this->here, strlen($this->base))))
				{
					$matchingLinks[strlen($link)] = $link;
				}
			}
		}
		
		krsort($matchingLinks);

		$activeLink = ife(!empty($matchingLinks), array_shift($matchingLinks));
	
		# VIEW html
	
		foreach($data as $title => $link)
		{
			$this->__out[] = '<'.$tag.'>'.$this->Html->link($title, $link, ife($link == $activeLink, array('class'=>$activeClass)), null, false).'</'.$tag.'>';
		}
	
		return join("\n", $this->__out);
	}
	
	/**
	 *
	 * @param array 	$data data for menu as Name=>array(Name=>value) pairs
	 * @param array 	$options options for menu as array to enable new features to be added
	 * @access public
	 * usage: <?php $menu->twoTierMenu($data, array('type'=>'dl', 'class'=>'sub-menu', 'title'=>'dt', 'activeClass'=>'current')); ?>
	 */
	
	
	function twoTierMenu($data=array(), $options=array('activeClass'=>'current', 'type'=>'ul', 'class'=>false, 'title'=>false))
	{
		// reset output
		$this->__out = array();
		// check data
		if (empty($data) && count($data) < 1)
		{
			return '';
		}
		// check we have a 2 level structure
		$keys = array_keys($data);
		if (!is_array($data[$keys[0]]))
		{
			return '';
		}
		
		// sort out matching links
		$activeLinks = array();
		
		// get array of all links
		foreach ($data as $groupTitle=>$groupLinks)
		{
			$matchingLinks = array();
			
			foreach($groupLinks as $linkTitle => $linkUrl)
			{	
				if (preg_match('/^'.preg_quote($linkUrl, '/').'/', substr($this->here, strlen($this->base)))) 
				// if (preg_match('/^'.preg_quote($link, '/').'/', $this->params['url']['url'])) 
				{
					$matchingLinks[strlen($linkUrl)] = $linkUrl;
				}
				elseif ($linkUrl == substr($this->here, strlen($this->base)))
				{
					// $matchingLinks[$groupTitle][strlen($linkUrl)] = $linkUrl;
				}
				else
				{
					// pr('link: '.$link.' | url: '.substr($this->here, strlen($this->base)));
				}
				// pr('preg: '.preg_quote($link).'/');
				// pr('base: '.substr($this->here, strlen($this->base)));
				// pr('url: '.$this->params['url']['url']);
			}
			// sorting
			krsort($matchingLinks);
			// pr($matchingLinks);
			// active link
			$activeLinks[$groupTitle] = ife(!empty($matchingLinks), array_shift($matchingLinks));
		}
		
		// pr($matchingLinks);
		// pr($activeLinks);

		// output menu
		if ($options['class'])
		{
			$this->__out[] = '<'.$options['type'].' class="'.$options['class'].'">';
		}
		else
		{
			$this->__out[] = '<'.$options['type'].'>';
		}
		
		// build html
		foreach ($data as $groupTitle=>$links)
		{
			if ($options['title'])
			{
				$this->__out[] = "<".$options['title'].">".$groupTitle."</".$options['title'].">";
			}

			foreach($links as $linkTitle => $linkUrl)
			{
				$this->__out[] = '<'.$this->__typeTags[$options['type']].'>'.$this->Html->link($linkTitle, $linkUrl, ife($linkUrl == $activeLinks[$groupTitle], array('class'=>$options['activeClass'])), null, false).'</'.$this->__typeTags[$options['type']].'>';
			}
		}
		$this->__out[] = '</'.$options['type'].'>';
		
		// return
		return join("\n", $this->__out);
	}

}

?>