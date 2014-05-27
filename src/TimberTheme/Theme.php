<?php

namespace TimberTheme;

Class Theme
{
	
	protected static $instance;

	public static function getInstance() {
		if ( ! self::$instance ) {
			self::$instance = new static();
		}
		return self::$instance;
	}

	protected function __construct() {
		// not used in singleton
	}

	public function init()
	{
		// parent::init();
		add_action( 'after_setup_theme', array( $this, 'setup' ) );
	}

	public function setup()
	{
		add_theme_support('post-formats');
		add_theme_support('post-thumbnails');
		add_theme_support('menus');

		add_filter('get_twig', array($this, 'addToTwig'));
		add_filter('timber_context', array($this, 'addToContext'));

		add_action('wp_enqueue_scripts', array($this, 'loadScripts'));

		define('THEME_URL', get_template_directory_uri());
	}

	public function addToTwig($twig)
	{
		/* this is where you can add your own fuctions to twig */
		$twig->addExtension(new \Twig_Extension_StringLoader());
		$filter = new \Twig_SimpleFilter('myfoo', array('\TimberTheme\Theme', 'myfoo'));
		$twig->addFilter($filter);
		return $twig;
	}

	public function addToContext($data)
	{
		/* this is where you can add your own data to Timber's context object */
		$data['qux'] = 'I am a value set in your functions.php file';
		$data['menu'] = new \TimberMenu();
		return $data;
	}

	public function loadScripts()
	{
		wp_enqueue_script('jquery');
	}

	public function myfoo($text){
		$text .= ' bar!';
		return $text;
	}

}