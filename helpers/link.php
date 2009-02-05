<?php
/* /app/views/helpers/link.php */

class LinkHelper extends AppHelper {
	var $helpers = array('Html');
	var $site = null;
	var $links = array ();
	
	function LinkHelper() {
	
		$this->links = array (
			'home' 			=> array('name' => 'Home', 'url' => array('controller' => 'pages', 'action' => 'display', 'home'), 'title' => Configure::read('SITE_NAME').', LLC'),
			'services' 		=> array('name' => 'Services', 'url' => '/services.htm', 'title' => 'Our Services'),
			'philosophy'	=> array('name' => 'Philosophy', 'url' => '/philosophy.htm', 'title' => 'Our Philosophy'),
			'process' 		=> array('name' => 'Process', 'url' => '/process.htm', 'title' => 'The Planning Process'),
			'about' 		=> array('name' => 'About Us', 'url' => '/about.htm', 'title' => 'About Us'),
			'articles' 		=> array('name' => 'Articles', 'url' => array('controller' => 'articles', 'action' => 'index'), 'title' => 'Articles and Advice'),
			'contact'		=> array('name' => 'Contact', 'url' => array('controller' => 'contact', 'action' => 'index'), 'title' => 'Frequently Asked Questions'),
			'faq' 			=> array('name' => 'FAQ', 'url' => '/faq.htm', 'title' => 'Frequently Asked Questions'),
		);
	
		$this->site = Configure::read('SITE_NAME');
	}

	function logo() {
		return $this->output(
			$this->Html->link(
			$this->Html->image('logo.png', array('alt' => $this->links['home']['title'], 'id' => 'logo')), 
			$this->links['home']['url'],
			array('escape' => false, 'title' => $this->links['home']['title']))
		);
	}

	function home_link() {
		return $this->output(
			$this->Html->link(
			$this->Html->image('home.png', array('alt' => $this->links['home']['title'])), 
			$this->links['home']['url'],
			array('escape' => false, 'title' => $this->links['home']['title']))
		);
	}

	function contact() {
		return $this->output(
			$this->Html->link(
			$this->Html->image('contact.png', array('alt' => 'Contact Us')), 
			//'mailto:Advisor@CovenantAdvisorsPlanning.com',
			array('controller' => 'contact', 'action' => 'index'),
			array('escape' => false, 'title' => 'Contact Us'))
		);
	}

	function header_logo() {
		$link = $this->Html->link(
				$this->Html->image('header-logo.png', array('alt' => $this->links['home']['title'])), 
				$this->links['home']['url'],
				array('escape' => false, 'title' => $this->links['home']['title'], 'class' => 'float-right'));
				
		$link .= $this->Html->link(
			"<h1>{$this->site}</h1>", 
			$this->links['home']['url'],
			array('escape' => false, 'title' => $this->links['home']['title']));
		$link .= Configure::read('TAG');
		return $this->output($link);
	}

	function navigationOrg($active = true, $activeText = 'active') {
		$links = null;
		$matchingLinks = array();
		foreach ($this->links as $link) {
			if (preg_match('/^'.preg_quote($link['url'], '/').'/', substr($this->here, strlen($this->base)))) {
				$matchingLinks[strlen($link['url'])] = $link['url'];
			}
		}
		krsort($matchingLinks);
		$activeLink = ife(!empty($matchingLinks), array_shift($matchingLinks));
		 
		$out = array();
		foreach ($this->links as $link) {
			$options = array('title' => $link['title']);
			if ($link['url'] == $activeLink && $active == true) {
				$options['class'] = $activeText;
			}
			$out[] = '<li>'.$this->Html->link($link['name'], $link['url'], $options).'</li>';
		}
		$links = join("\n", $out);
		return $this->output('<ul>'.$links.'</ul>');
	}

	function navigation($activeText = 'active',$type = 'ul', $links = array(), $exclude = array(), $urlCheck = true) {
		if (count($links) <= 0) {
			$links = $this->links;
		}
		$tags['ul'] = '<ul>%s</ul>';
		$tags['ol'] = '<ol>%s</ol>';
		$tags['li'] = '<li>%s</li>';
		$out = array();
		foreach ($links as $key => $link) {
			$options = array('title' => $link['title']);
			
			if($this->url($link['url']) == substr($this->here,0) || Router::getParam() == $link['url']['controller']) {
				$options['class'] = $activeText;
			}
			if (!in_array($key, $exclude)) {
				$out[] = sprintf($tags['li'],$this->Html->link($link['name'], $link['url'], $options));
			}
		}
		$tmp = join("\n", $out);
		
		return $this->output(sprintf($tags[$type],$tmp));
	}

	function navigationAdmin($activeText = 'active', $type = 'ul', $links = array(), $exclude = array()) {
		$links = array (
			array('name' => 'Pages', 'url' => array('controller' => 'contents', 'action' => 'index', 'admin' => true), 'title' => 'Pages'),
			array('name' => 'Templates', 'url' => array('controller' => 'templates', 'action' => 'index', 'admin' => true), 'title' => 'Templates'),
			array('name' => 'Settings', 'url' => array('controller' => 'settings', 'action' => 'index', 'admin' => true), 'title' => 'Settings'),
			array('name' => 'Documents', 'url' => array('controller' => 'documents', 'action' => 'index', 'admin' => true), 'title' => 'Documents'),
			array('name' => 'Articles & Advice', 'url' => array('controller' => 'articles', 'action' => 'index', 'admin' => true), 'title' => 'Articles and Advice'),
			array('name' => 'Profile', 'url' => array('controller' => 'Users', 'action' => 'profile', 'admin' => true), 'title' => 'Documents'),
		);
			
		$tags['ul'] = '<ul>%s</ul>';
		$tags['ol'] = '<ol>%s</ol>';
		$tags['li'] = '<li>%s</li>';
		$out = array();
	

		return $this->navigation('active', 'ul', $links, $exclude, true);
	}

	function footer($separator = ' | ') {
		$links = $this->links;
		$out = array();
		foreach ($links as $link) {
			$options = array('title' => $link['title']);
			$out[] = $this->Html->link($link['name'], $link['url'], $options);
		}
		$tmp = join($separator, $out);
		return $this->output($tmp);
	}
	
	function background() {
		if (!empty($this->params['pass']['0']))	{
			if ($this->params['pass'][0] == 'philosophy') {
				$img = 'header_philosophy.jpg';
			} elseif ($this->params['pass'][0] == 'process') {
				$img = 'header_process.jpg';
			} elseif ($this->params['pass'][0] == 'services') {
				$img = 'header_services.jpg';
			} elseif ($this->params['pass'][0] == 'faq') {
				$img = 'header_faq.jpg';
			} elseif ($this->params['pass'][0] == 'about') {
				$img = 'about.jpg';
			} else {
				$img = 'header_left.jpg';
				//$img = 'about1.jpg';
			}
		} else {
			$img = 'header_left.jpg';
		}
		
		$path = $this->webroot(IMAGES_URL . $img);
		return $path;
	}
	
}
?>