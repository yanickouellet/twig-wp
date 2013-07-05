<?php

if ( !class_exists('TwigWp') ) {

	/**
	 * Class TwigWp
	 * Main class of the plugin, using singleton pattern
	 */
	class TwigWp {

		/**
		 * @var Twig_Environment
		 */
		protected $twig;

		/**
		 * Initialise the plugin with action and hooks
		 */
		private function __construct()
		{
			require_once 'twig/lib/Twig/Autoloader.php';
			Twig_Autoloader::register();

			$loader = new Twig_Loader_Filesystem('/');
			$this->twig = new Twig_Environment($loader, array(
				'cache' => plugin_dir_path(__FILE__) . '/cache',
			));
		}

		/**
		 * Render a twig template
		 *
		 * @param $template
		 * @param $params
		 *
		 * @return string
		 */
		public function render($template, $params = array())
		{
			return $this->twig->render($template, $params);
		}

		public static function renderStatic($template, $params = array())
		{
			$core = self::get_instance();
			return $core->render($template, $params);
		}


		/**
		 * Get an instance of TwigWp
		 */
		public static function get_instance()
		{
			static $core;
			if ( !$core ) {
				$core = new self();
			}

			return $core;
		}
	}
}